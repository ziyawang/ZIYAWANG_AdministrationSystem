<!DOCTYPE html>
<html lang="en">
<!-- container-fluid -->
<head>
    <title>资芽网后台管理系统</title>
    <meta charset="UTF-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css ')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap-responsive.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('css/select2.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('css/unicorn.main.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('css/unicorn.grey.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('css/uploadifive.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('css/uniform.css')); ?>" class="skin-color"  />
    <link rel="stylesheet" href="<?php echo e(asset('css/fullcalendar.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap-datetimepicker.min.css')); ?>" />


    <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/unicorn.js')); ?>"></script>
    <script src="<?php echo e(asset('js/select2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.uniform.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.validate.js')); ?>"></script>
    <script src="<?php echo e(asset('js/unicorn.form_validation.js')); ?>"></script>
    <script src="<?php echo e(asset('ckeditor/ckeditor.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.uploadifive.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.ui.custom.js')); ?>"></script>
    <script src="<?php echo e(asset('js/unicorn.tables.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap-datetimepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap-datetimepicker.zh-CN.js')); ?>"></script>
</head>
<body>

<div id="header">
    <h1>资芽网后台管理系统</h1>
</div>


<div id="user-nav" class="navbar navbar-inverse">
    <ul class="nav btn-group">
        <li class="btn btn-inverse"><a title="" href="<?php echo e(url("login/index")); ?>"><i class="icon icon-share-alt"></i> <span class="text" >退出</span></a></li>
    </ul>
</div>

<div id="sidebar">
    <?php /*<a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>*/ ?>
    <ul>
        <li class="active"><a href="<?php echo e(asset('index/index')); ?>"><i class="icon icon-home"></i> <span>首页</span></a></li>
        <?php $pAuths = unserialize(Session::get('pAuths'));
            $Auths = unserialize(Session::get('Auths'));

        ?>
        <?php if(is_array($pAuths) ? $pAuths : array()): ?>
        <?php foreach($pAuths as $pAuth): ?>
            <li class="submenu">
                <a href="#"><i class="<?php echo e($pAuth->Class); ?>"></i> <span><?php echo e($pAuth->AuthName); ?></span></a>
            <ul>
                <?php foreach($Auths as $Auth): ?>
                    <?php if($Auth->PID==$pAuth->Auth_ID): ?>
                <li><a href="<?php echo e(url($Auth->Path)); ?>"><?php echo e($Auth->AuthName); ?></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </li>
        <?php endforeach; ?>
        <?php endif; ?>
    </ul>

</div>



<div id="content">
    <?php echo $__env->yieldContent('content'); ?>
</div>
<div class="row-fluid">
    <div id="footer" class="span12">
         &copy;2016 ziyawang.com
    </div>
</div>
</body>
</html>