@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="{{asset('css/news.css ')}}"/>
    <div id="breadcrumb" >
        <a href="#" title="约谈管理" class="tip-bottom"><i class="icon-home"></i>约谈管理</a>
        <a href="#" class="current">约谈</a>
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
                    <th>服务方名称</th>
                    <th>联系电话</th>
                    <th>约谈时间</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr class="tr">
                        <td>{{$data->ServiceID}}</td>
                        <td>{{$data->ServiceName}}</td>
                        <td>{{$data->ConnectPhone}}</td>
                        <td>{{$data->RushTime}}</td>
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