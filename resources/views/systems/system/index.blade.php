@extends('layouts.master')

@section('content')
    <div id="breadcrumb" style="position:relative">
        <a href="{{url("system/index")}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 系统</a>
        <a href="#" class="current">用户列表</a>
        <a href="{{url('system/add')}}"> <div class=" btn btn-primary " style="position:absolute;right: 10px;bottom:0;">添加</div></a>
    </div>

    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>姓名</th>
                    <th>登录名</th>
                    <th>手机号</th>
                    <th>角色</th>
                    <th>部门</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                <tr>
                    <td>{{$data['Name']}}</td>
                    <td>{{$data['Email']}}</td>
                    <td>{{$data['PhoneNumber']}}</td>
                    <td>{{$data['RoleName']}}</td>
                    <td>{{$data['Department']}}</td>
                    <td>
                        <a href="{{url('system/update/'.$data['id'])}}">编辑</a>&nbsp&nbsp&nbsp
                        <a href="{{url('system/delete/'.$data['id'])}}"onclick="return confirm('确定将此记录删除?')">删除</a>
                    </td>
                </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination alternate" style="margin:0 auto">
            {!! $datas->render() !!}
        </div>
    </div>


    @endsection
    <!-- TODO: Current Tasks -->

