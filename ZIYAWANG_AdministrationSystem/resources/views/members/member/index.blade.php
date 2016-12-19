@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="{{asset('css/member.css ')}}"/>
    <div id="breadcrumb" style="position:relative">
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>会员</a>
        <a href="#" class="current">会员列表</a>
    </div>
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped checkTable">
                <thead>
                <tr>
                    <th>公司名称</th>
                    <th>信息类型</th>
                    <th>会员类型</th>
                    <th>会员费(元)</th>
                    <th>开始时间</th>
                    <th>结束时间</th>
                    <th>支付渠道</th>
                    <th>支付状态</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td>{{$data->ServiceName}}</td>
                        <td>{{$data->MemberName}}</td>
                        @if($data->Month==1)
                            <td>月度会员</td>
                        @elseif($data->Month==3)
                            <td>季度会员</td>
                        @else
                            <td>年度会员</td>
                        @endif
                            <td>{{$data->PayMoney/100}}</td>
                        <td>{{$data->StartTime}}</td>
                        <td>{{$data->EndTime}}</td>
                        <td>{{$data->Channel}}</td>
                        @if($data->PayFlag==0)
                            <td>未支付</td>
                        @else
                            <td>已支付</td>
                        @endif
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