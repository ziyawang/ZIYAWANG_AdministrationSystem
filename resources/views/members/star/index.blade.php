@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="{{asset('css/member.css ')}}"/>
    <div id="breadcrumb" style="position:relative">
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>星级认证</a>
        <a href="#" class="current">认证列表</a>
    </div>
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped checkTable">
                <thead>
                <tr>
                    <th>公司名称</th>
                    <th>联系人</th>
                    <th>认证类型</th>
                    <th>认证费用(元)</th>
                    <th>认证时间</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td>{{$data->ServiceName}}</td>
                        <td>{{$data->ConnectPhone}}</td>
                        <td>{{$data->PayName}}</td>
                        @if(!empty($data->PayMoney))
                        <td>{{$data->PayMoney/100}}</td>
                        @else
                            <td>免费</td>
                        @endif
                        <td>{{$data->created_at}}</td>
                        @if($data->State==1)
                            <td>待审核</td>
                        @elseif($data->State==2)
                            <td>已审核</td>
                        @else
                            <td>未通过</td>
                        @endif
                        <td><a href="{{url('star/detail/'.$data->StarPayID)}}">查看详情</a></td>
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