<?php

$grammarFile           = __DIR__ . '/zend_language_parser.phpy';
$skeletonFile          = __DIR__ . '/kmyacc.php.parser';
$tmpGrammarFile        = __DIR__ . '/tmp_parser.phpy';
$tmpResultFile         = __DIR__ . '/tmp_parser.php';
$parserResultFile      = __DIR__ . '/../lib/PhpParser/Parser.php';

// check for kmyacc.exe binary in this directory, otherwise fall back to global name
$kmyacc = __DIR__ . '/kmyacc.exe';
if (!file_exists($kmyacc)) {
    $kmyacc = 'kmyacc';
}

$options = array_flip($argv);
$optionDebug = isset($options['--debug']);
$optionKeepTmpGrammar = isset($options['--keep-tmp-grammar']);

///////////////////////////////
/// Utility regex constants ///
///////////////////////////////

const LIB = '(?(DEFINE)
    (?<singleQuotedString>\'[^\\\\\']*+(?:\\\\.[^\\\\\']*+)*+\')
    (?<doubleQuotedString>"[^\\\\"]*+(?:\\\\.[^\\\\"]*+)*+")
    (?<string>(?&singleQuotedString)|(?&doubleQuotedString))
    (?<comment>/\*[^*]*+(?:\*(?!/)[^*]*+)*+\*/)
    (?<code>\{[^\'"/{}]*+(?:(?:(?&string)|(?&comment)|(?&code)|/)[^\'"/{}]*+)*+})
)';

const PARAMS = '\[(?<params>[^[\]]*+(?:\[(?&params)\][^[\]]*+)*+)\]';
const ARGS   = '\((?<args>[^()]*+(?:\((?&args)\)[^()]*+)*+)\)';

///////////////////
/// Main script ///
///////////////////

echo 'Building temporary preproprocessed grammar file.', "\n";

$grammarCode = file_get_contents($grammarFile);

$grammarCode = resolveNodes($grammarCode);
$grammarCode = resolveMacros($grammarCode);
$grammarCode = resolveArrays($grammarCode);
$grammarCode = resolveStackAccess($grammarCode);

file_put_contents($tmpGrammarFile, $grammarCode);

$additionalArgs = $optionDebug ? '-t -v' : '';

echo "Building parser.\n";
$output = trim(shell_exec("$kmyacc $additionalArgs -l -m $skeletonFile $tmpGrammarFile 2>&1"));
echo "Output: \"$output\"\n";

$resultCode = file_get_contents($tmpResultFile);
$resultCode = removeTrailingWhitespace($resultCode);

ensureDirExists(dirname($parserResultFile));
file_put_contents($parserResultFile, $resultCode);
unlink($tmpResultFile);

if (!$optionKeepTmpGrammar) {
    unlink($tmpGrammarFile);
}

///////////////////////////////
/// Preprocessing functions ///
///////////////////////////////

function resolveNodes($code) {
    return preg_replace_callback(
        '~(?<name>[A-Z][a-zA-Z_\\\\]++)\s*' . PARAMS . '~',
        function($matches) {
            // recurse
            $matches['params'] = resolveNodes($matches['params']);

            $params = magicSplit(
                '(?:' . PARAMS . '|' . ARGS . ')(*SKIP)(*FAIL)|,',
                $matches['params']
            );

            $paramCode = '';
            foreach ($params as $param) {
                $paramCode .= $param . ', ';
            }

            return 'news ' . $matches['name'] . '(' . $paramCode . 'attributes())';
        },
        $code
    );
}

function resolveMacros($code) {
    return preg_replace_callback(
        '~\b(?<!::|->)(?!array\()(?<name>[a-z][A-Za-z]++)' . ARGS . '~',
        function($matches) {
            // recurse
            $matches['args'] = resolveMacros($matches['args']);

            $name = $matches['name'];
            $args = magicSplit(
                '(?:' . PARAMS . '|' . ARGS . ')(*SKIP)(*FAIL)|,',
                $matches['args']
            );

            if ('attributes' == $name) {
                assertArgs(0, $args, $name);
                return '$this->startAttributeStack[#1] + $this->endAttributes';
            }

            if ('init' == $name) {
                return '$$ = array(' . implode(', ', $args) . ')';
            }

            if ('push' == $name) {
                assertArgs(2, $args, $name);

                return $args[0] . '[] = ' . $args[1] . '; $$ = ' . $args[0];
            }

            if ('pushNormalizing' == $name) {
                assertArgs(2, $args, $name);

                return 'if (is_array(' . $args[1] . ')) { $$ = array_merge(' . $args[0] . ', ' . $args[1] . '); } else { ' . $args[0] . '[] = ' . $args[1] . '; $$ = ' . $args[0] . '; }';
            }

            if ('toArray' == $name) {
                assertArgs(1, $args, $name);

                return 'is_array(' . $args[0] . ') ? ' . $args[0] . ' : array(' . $args[0] . ')';
            }

            if ('parseVar' == $name) {
                assertArgs(1, $args, $name);

                return 'substr(' . $args[0] . ', 1)';
            }

            if ('parseEncapsed' == $name) {
                assertArgs(2, $args, $name);

                return 'foreach (' . $args[0] . ' as &$s) { if (is_string($s)) { $s = Node\Scalar\String_::parseEscapeSequences($s, ' . $args[1] . '); } }';
            }

            if ('parseEncapsedDoc' == $name) {
                assertArgs(1, $args, $name);

                return 'foreach (' . $args[0] . ' as &$s) { if (is_string($s)) { $s = Node\Scalar\String_::parseEscapeSequences($s, null); } } $s = preg_replace(\'~(\r\n|\n|\r)$~\', \'\', $s); if (\'\' === $s) array_pop(' . $args[0] . ');';
            }

            return $matches[0];
        },
        $code
    );
}

function assertArgs($num, $args, $name) {
    if ($num != count($args)) {
        die('Wrong argument count for ' . $name . '().');
    }
}

function resolveArrays($code) {
    return preg_replace_callback(
        '~' . PARAMS . '~',
        function ($matches) {
            $elements = magicSplit(
                '(?:' . PARAMS . '|' . ARGS . ')(*SKIP)(*FAIL)|,',
                $matches['params']
            );

            // don't convert [] to array, it might have different meaning
            if (empty($elements)) {
                return $matches[0];
            }

            $elementCodes = array();
            foreach ($elements as $element) {
                // convert only arrays where all elements have keys
                if (false === strpos($element, ':')) {
                    return $matches[0];
                }

                list($key, $value) = explode(':', $element, 2);
                $elementCodes[] = "'" . $key . "' =>" . $value;
            }

            return 'array(' . implode(', ', $elementCodes) . ')';
        },
        $code
    );
}

function resolveStackAccess($code) {
    $code = preg_replace('/\$\d+/', '$this->semStack[$0]', $code);
    $code = preg_replace('/#(\d+)/', '$$1', $code);
    return $code;
}

function removeTrailingWhitespace($code) {
    $lines = explode("\n", $code);
    $lines = array_map('rtrim', $lines);
    return implode("\n", $lines);
}

function ensureDirExists($dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
}

//////////////////////////////
/// Regex helper functions ///
//////////////////////////////

function regex($regex) {
    return '~' . LIB . '(?:' . str_replace('~', '\~', $regex) . ')~';
}

function magicSplit($regex, $string) {
    $pieces = preg_split(regex('(?:(?&string)|(?&comment)|(?&code))(*SKIP)(*FAIL)|' . $regex), $string);

    foreach ($pieces as &$piece) {
        $piece = trim($piece);
    }

    return array_filter($pieces);
}