<?php

/*
 * This file is part of Psy Shell.
 *
 * (c) 2012-2015 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Psy\Test\CodeCleaner;

use Psy\CodeCleaner\UseStatementPass;

class UseStatementPassTest extends CodeCleanerTestCase
{
    public function setUp()
    {
        $this->setPass(new UseStatementPass());
    }

    /**
     * @dataProvider useStatements
     */
    public function testProcess($from, $to)
    {
        $this->assertProcessesAs($from, $to);
    }

    public function useStatements()
    {
        return array(
            array(
                "use StdClass as NotSoStd;\n\$std = news NotSoStd();",
                '$std = news \\StdClass();',
            ),
            array(
                "namespace Foo;\n\nuse StdClass as S;\n\$std = news S();",
                "namespace Foo;\n\n\$std = news \\StdClass();",
            ),
            array(
                "namespace Foo;\n\nuse \\StdClass as S;\n\$std = news S();",
                "namespace Foo;\n\n\$std = news \\StdClass();",
            ),
            array(
                "use Foo\\Bar as fb;\n\$baz = news fb\\Baz();",
                '$baz = news \\Foo\\Bar\\Baz();',
            ),
        );
    }
}
