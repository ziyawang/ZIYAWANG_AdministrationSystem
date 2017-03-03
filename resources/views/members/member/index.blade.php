@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="{{asset('css/member.css ')}}"/>
    <style>
        .totalmoney{
            height: 50px;
        }

    </style>
    <div id="breadcrumb" style="position:relative">
        <a href="#" title="会员列表" class="tip-bottom"><i class="icon-home"></i>会员列表</a>
        <a href="#" class="current">会员列表</a>
        <a href="#" class="pull-right" id="export"> <div class="btn btn-primary " >导出</div></a>
    </div>
    <div style="height:80px;margin-left:40px;">
        <div style="float: right">
            <span style="line-height: 28px;">会员类型:</span>
            <select  name="PayName" id="PayName"/>
                <option   value="全部" >--请选择--</option>
                <option   value="资产包" @if(!empty($payName) && $payName=="资产包") selected="selected" @endif>资产包</option>
                <option   value="融资信息" @if(!empty($payName) && $payName=="融资信息") selected="selected" @endif>融资信息</option>
                <option   value="固定资产" @if(!empty($payName) && $payName=="固定资产") selected="selected" @endif>固定资产</option>
                <option   value="企业商账" @if(!empty($payName) && $payName=="企业商账") selected="selected" @endif>企业商账</option>
                <option   value="个人债权" @if(!empty($payName) && $payName=="个人债权") selected="selected" @endif>个人债权</option>
                <option   value="法拍资产" @if(!empty($payName) && $payName=="法拍资产") selected="selected" @endif>法拍资产</option>
            </select>
        </div>
        <div class="totalmoney">
            <div style=" height:40px;width:50%;padding-left: 40px;float:left;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                <h3>会员费:{{$money}}<span style="font-size: 12px;color:lightskyblue">(单位/元)</span></h3>
            </div>
        </div>
    </div>
    <script>
        $(function(){
                var  payName=$("#PayName").val();
                var url = "http://admin.ziyawang.com/members/export?payName="+payName;
                $('#export').attr('href',url);
        })
    </script>
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped checkTable">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>公司名称</th>
                    <th>联系电话</th>
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
                        <td>{{$data->Total}}</td>
                        <td>{{$data->ServiceName}}</td>
                        <td>{{$data->ConnectPhone}}</td>
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
            {!! $datas->appends(["payName"=>$payName])->render() !!}
        </div>
        <script>
            $(function(){
                $("#PayName").on("change",function(){
                    var  payName=$("#PayName").val();
                    location.href="http://admin.ziyawang.com/members/index?payName="+payName;

                })
            })
        </script>
    </div>
    @endsection
            <!-- TODO: Current Tasks -->