@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="{{asset('css/member.css ')}}"/>
    <style>
        .totalmoney{
            height: 50px;
        }
        .radio input[type="radio"] {
            float: left;
            margin-left: 0px;
        }
    </style>
    <div id="breadcrumb" style="position:relative;height: 42px;">
        <a href="{{asset('money/consume')}}" title="芽币消耗" class="tip-bottom"><i class="icon-home"></i>芽币统计</a>
        <a href="#" class="current">芽币统计</a>
    </div>
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>手机号</th>
                    <th>角色</th>
                    <th>名称</th>
                    <th>公司名称</th>
                    <th>芽币</th>
                    <th>金额</th>
                    <th>订单号</th>
                    <th>充值时间</th>
                    <th>操作详情</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td style="text-align:center">{{$data->phonenumber}}</td>
                        @if($data->role==1)
                            <td>服务方</td>
                        @elseif($data->role==2)
                            <td>发布方</td>
                        @else
                            <td>注册</td>
                        @endif
                        @if(!empty($data->username))
                            <td style="text-align:center">{{$data->username}}</td>
                        @else
                            <td style="text-align:center"></td>
                        @endif
                        @if(!empty($data->ServiceName))
                            <td style="text-align:center"><a href="http://ziyawang.com/service/{{$data->ServiceID}}" target="_blank">{{$data->ServiceName}}</a></td>
                        @else
                            <td style="text-align:center"></td>
                        @endif
                        <td style="text-align:center">{{$data->Money}}</td>
                        <td style="text-align:center">{{$data->Money/10}}</td>
                        <td style="text-align:center">{{$data->OrderNumber}}</td>
                        <td style="text-align:center">{{$data->created_at}}</td>
                        <td>
                            @if(!empty($data->ProjectID))
                                <a href="{{url('check/detail/'.$data->ProjectID.'/'.$data->TypeID)}}" target="_blank">{{$data->Operates}}</a>
                            @else
                                {{$data->Operates}}
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination alternate">
            {!! $datas->appends(["value"=>$value,"shortTime"=>$shortTime,"longTime"=>$longTime])->render() !!}
        </div>
    </div>
@endsection