@extends('layouts.master')

@section('content')
    <div id="breadcrumb" style="position: relative">
        <a href="{{asset('role/index')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 系统</a>
        <a href="#" class="current">角色列表</a>
        <a href="{{url('role/add')}}"> <div class=" btn btn-primary " style="position:absolute;right: 10px;bottom:0;">添加</div></a>
    </div>

    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>角色名称</th>

                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->RoleName}}</td>

                        <td>
                            <a href="{{url('role/update/'.$data->id)}}">编辑</a>&nbsp&nbsp&nbsp
                            <a href="{{url('role/delete/'.$data->id)}}"onclick="return confirm('确定将此记录删除?')">删除</a>
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
