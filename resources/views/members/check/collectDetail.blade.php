@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="{{asset('css/news.css ')}}"/>
    <div id="breadcrumb" >
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>收藏</a>
        <a href="#" class="current">收藏详情</a>
        <a href="#" class="pull-right" id="export">
            {{--<div class="btn btn-primary" >导出</div>--}}
        </a>
    </div>
    <div class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>注册手机号</th>
                    <th>名称</th>
                    <th>公司名称</th>
                    <th>角色</th>
                    <th>服务类型</th>
                    <th>收藏时间</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr class="tr">
                        <td>{{$data->phonenumber}}</td>
                        <td>{{$data->username}}</td>
                        <td>{{$data->ServiceName}}</td>
                        @if($data->role==1)
                            <td>服务方</td>
                        @elseif($data->role==2)
                            <td>发布方</td>
                        @else
                            <td>注册</td>
                        @endif
                        <td>{{$data->ServiceType}}</td>
                        <td>{{$data->CollectTime}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination alternate">
            {!! $datas->render() !!}
        </div>

    </div>
    @endsection
            <!-- TODO: Current Tasks -->