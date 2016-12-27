<!DOCTYPE html>
<html lang="en">
<head>
    <title>ziyawang</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="<?php echo e(asset('/css/bootstrap.min.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap-responsive.min.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('css/unicorn.login.css')); ?>"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<div id="logo">
    <img src="<?php echo e(asset('img/ziya2.png')); ?>"  style="width:100px;height:100px"alt=""/>
</div>
<div id="loginbox" style="height:225px">
    <form id="loginform" class="form-vertical" action="<?php echo e(url('admin/login')); ?>" method="post"/>
    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
    <p>请输入您的邮箱和密码</p>
    <div class="control-group">
        <div class="controls">
            <div class="input-prepend">
                <span class="add-on"><i class="icon-user"></i></span><input type="text" placeholder="邮箱" name="email"/>
            </div>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <div class="input-prepend">
                <span class="add-on"><i class="icon-lock"></i></span><input type="password" placeholder="密码"
                                                                            name="password"/>
            </div>
        </div>
    </div>
    <?php if(session("msg")): ?>
        <div class="control-group">
            <p style="font-size: 15px;color:orangered"><?php echo e(session("msg")); ?></p>
        </div>
    <?php endif; ?>
    <div class="form-actions">
        <span class="pull-right"><input type="submit" class="btn btn-inverse" value="登录"/></span>
    </div>
    </form>
</div>

<script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/unicorn.login.js')); ?>"></script>
</body>
</html>
