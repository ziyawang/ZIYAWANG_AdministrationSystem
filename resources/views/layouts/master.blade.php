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
    <link rel="stylesheet" href="{{asset('css/uploadifive.css')}}" />
    <link rel="stylesheet" href="{{asset('css/uniform.css')}}" />

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
    <script src="{{asset('js/jquery.ui.custom.js')}}"></script>
    <script src="{{asset('js/unicorn.tables.js')}}"></script>
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
        <?php $pAuths = unserialize(Session::get('pAuths'));
            $Auths = unserialize(Session::get('Auths'));

        ?>
        @foreach($pAuths as $pAuth)
            <li class="submenu">
                <a href="#"><i class="icon icon-th-list"></i> <span>{{$pAuth->AuthName}}</span> <span class="label">{{$pAuth->count}}</span></a>
            <ul>
                @foreach($Auths as $Auth)
                    @if($Auth->PID==$pAuth->Auth_ID)
                <li><a href="{{url($Auth->Path)}}">{{$Auth->AuthName}}</a></li>
                    @endif
                @endforeach
            </ul>
        </li>
        @endforeach
    </ul>

</div>



<div id="content">
    @yield('content')
</div>
<div class="row-fluid">
    <div id="footer" class="span12">
        2016 &copy; ziyawang Admin. Brought to you by <a href="https://wrapbootstrap.com/user/diablo9983">diablo9983</a>
    </div>
</div>
</body>
</html>