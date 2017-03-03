@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="{{asset('css/news.css ')}}"/>
    <div id="breadcrumb" >
        <a href="#" title="约谈管理" class="tip-bottom"><i class="icon-home"></i>约谈管理</a>
        <a href="#" class="current">约谈列表</a>
        <a href="#" class="pull-right" id="export">
            {{--<div class="btn btn-primary" >导出</div>--}}
        </a>
    </div>
    <div class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>信息类型</th>
                    <th>发布方</th>
                    <th>约谈次数</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr class="tr">
                        <td>{{$data->ProjectID}}</td>
                        <td><a href="http://ziyawang.com/project/{{$data->ProjectID}}" target="_blank">{{$data->TypeName}}</a></td>
                        <td>{{$data->phonenumber}}</td>
                        <td>{{$data->count}}</td>
                        <td><a href="{{asset("rush/detail/".$data->ProjectID)}}">查看约谈人</a></td>
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
