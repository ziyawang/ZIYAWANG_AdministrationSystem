<!DOCTYPE html>
<html>
<!-- container-fluid -->
<head>
    <title>资芽网后台管理系统</title>
    <meta charset="UTF-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css ')}}"/>
    <link rel="stylesheet" href="{{asset('css/bootstrap-responsive.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/select2.css')}}" />
    <link rel="stylesheet" href="{{asset('css/unicorn.main.css')}}" />
    <link rel="stylesheet" href="{{asset('css/unicorn.grey.css')}}"/>
    <link rel="stylesheet" href="{{asset('/css/uploadifive.css')}}" />

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/unicorn.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/jquery.uniform.js')}}"></script>
    <script src="{{asset('js/jquery.validate.js')}}"></script>
    <script src="{{asset('js/unicorn.form_validation.js')}}"></script>
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('js/jquery.uploadifive.min.js')}}"></script>
</head>
<body>

<div id="header">
    <h1>资芽网后台管理系统</h1>
</div>

<div id="user-nav" class="navbar navbar-inverse">
    <ul class="nav btn-group">
        <li class="btn btn-inverse"><a title="" href="{{url("login/index")}}"><i class="icon icon-share-alt"></i> <span class="text" >退出</span></a></li>
    </ul>
</div>

<div id="sidebar">
    <a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
    <ul>
        <li class="active"><a href="index.html"><i class="icon icon-home"></i> <span>Dashboard</span></a></li>
        <li class="submenu">
            <a href="#"><i class="icon icon-th-list"></i> <span>系统管理</span> <span class="label">3</span></a>
            <ul>
                <li><a href="{{url('system/index')}}">人员管理</a></li>
                <li><a href="form-validation.html">角色管理</a></li>
                <li><a href="form-wizard.html">权限管理</a></li>
            </ul>
        </li>
        <li class="submenu">
            <a href="#"><i class="icon  icon-user"></i> <span>会员管理</span> <span class="label">3</span></a>
            <ul>
                <li><a href="{{url("publish/index")}}">发布方管理</a></li>
                <li><a href="{{url("service/index")}}">服务方管理</a></li>
                <li><a href="{{url("check/index")}}">审核发布信息</a></li>
            </ul>
        </li>
        <li class="submenu">
            <a href="#"><i class="icon  icon-globe"></i> <span>合作管理</span> <span class="label">2</span></a>
            <ul>
                <li><a href="{{url('order/index')}}">订单管理</a></li>
                <li><a href="{{url('refuse/index')}}">退单管理</a></li>
            </ul>
        </li>
        <li class="submenu">
            <a href="#"><i class="icon icon-inbox"></i> <span>新闻视频</span> <span class="label">2</span></a>
            <ul>
                <li><a href="{{url("news/index")}}">新闻管理</a></li>
                <li><a href="{{url("video/index")}}">视频管理</a></li>
            </ul>
        </li>
        <li class="submenu">
            <a href="#"><i class="icon icon-hand-up"></i> <span>推送管理</span> <span class="label">2</span></a>
            <ul>
                <li><a href="invoice.html">推送信息</a></li>
                <li><a href="chat.html">已推送列表</a></li>
            </ul>
        </li>
    </ul>

</div>

<div id="style-switcher">
    <i class="icon-arrow-left icon-white"></i>
    <span>Style:</span>
    <a href="#grey" style="background-color: #555555;border-color: #aaaaaa;"></a>
    <a href="#blue" style="background-color: #2D2F57;"></a>
    <a href="#red" style="background-color: #673232;"></a>
</div>

<div id="content">
    @yield('content')



</div>
<div class="row-fluid">
    <div id="footer" class="span12">
        2016 &copy; ziyawang Admin. Brought to you by <a href="https://wrapbootstrap.com/user/diablo9983">diablo9983</a>
    </div>
</div>
<
</body>
</html>