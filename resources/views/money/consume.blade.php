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
        <a href="{{asset('money/index')}}" title="数据分析" class="tip-bottom"><i class="icon-home"></i>芽币消耗</a>
        <a href="#" class="current">芽币消耗</a>
    </div>
     <div style="height:120px;margin-bottom:15px;margin-top: 5px;">
         <div style="height:60px;margin-left:40px;">
             <div style="float: right">
                 @if(empty($value))
                     <input type="radio" name="choose"  value="7"/>近7天&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                     <input type="radio" name="choose" value="30" checked="checked"/>全部&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                     <input type="radio" name="choose" value="1"  value="7"/>时间区间<input type="text" name="shortTime" id="shortTime" value="" style="width:100px"/>&nbsp&nbsp&nbsp&nbsp~&nbsp&nbsp&nbsp&nbsp <input type="text" name="longTime"  id="longTime" value=""  style="width:100px"/>
                 @else
                     <input type="radio" name="choose" @if(!empty($value) && $value==7) checked="checked" @endif value="7"/>近7天&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                     <input type="radio" name="choose" value="30"@if(!empty($value) && $value==30) checked="checked" @endif/>全部&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                     @if($shortTime!=1 && $value==1 && $longTime!=1)
                         <input type="radio" name="choose" value="1"  checked="checked"/>时间区间<input type="text" name="shortTime" id="shortTime" value="{{$shortTime}}" style="width:100px"/>&nbsp&nbsp&nbsp&nbsp~&nbsp&nbsp&nbsp&nbsp <input type="text" name="longTime"  id="longTime" value="{{$longTime}}"  style="width:100px"/>
                     @else
                         <input type="radio" name="choose" value="1" />时间区间<input type="text" name="shortTime" id="shortTime" value="" style="width:100px"/>&nbsp&nbsp&nbsp&nbsp~&nbsp&nbsp&nbsp&nbsp <input type="text" name="longTime"  id="longTime" value=""  style="width:100px"/>
                     @endif
                 @endif
             </div>
         </div>
         <div class="totalmoney">
             <div style=" height:40px;width:50%;padding-left: 40px;float:left;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                 <h3>总芽币:{{$money}}<span style="font-size: 12px;color:lightskyblue">(单位/个)</span></h3>
             </div>
             <div style="height:40px;width:50%;float:right">
                 <h3>已消耗:{{$consumeMoney}}<span style="font-size: 12px;color:lightskyblue">(单位/个)</span></h3>
             </div>
         </div>
     </div>
    <script>
        $(function(){
            $("input[type='radio']").on("click",function(){
                var value=$("input[type='radio']:checked").val();
                if(value==7){
                    var longTime=1;
                    var shortTime=1;
                }else if(value==30){
                    var longTime=1;
                    var shortTime=1;
                }else{
                    var longTime=$("#longTime").val();
                    var shortTime=$("#shortTime").val();
                }
                $.ajax({
                    url:"{{asset('money/ajax')}}",
                    data:{value:value,longTime:longTime,shortTime:shortTime},
                    dataType:"json",
                    type:"post",
                    success:function(msg){
                        if(msg==1)
                            window.location.href="http://admin.ziyawang.com/money/consumeData"
                    }
                })
            });
        })
    </script>
    <script>
        $(function () {
            var value=$("input[type='radio']:checked").val();
            if(value==1){
                var longdataMoneyTime=$("#longTime").val();
                var shortdataMoneyTime=$("#shortTime").val();
            }else{
                var date = new Date();
                var Y = date.getFullYear() + '-';
                var  M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
                var D = date.getDate() + ' ';
                var longdataMoneyTime = Y+M+D;
                var shortdataMoneyTime=Y+M+D;
            }
            $("#longTime").val(longdataMoneyTime);
            $("#shortTime").val(shortdataMoneyTime);
            $('#longTime').datetimepicker({
                minView: "month", //选择日期后，不会再跳转去选择时分秒
                format: "yyyy-mm-dd", //选择日期后，文本框显示的日期格式
                language: 'zh-CN', //汉化
                todayBtn:"linked",
                autoclose:true //选择日期后自动关闭
            });
            $("#shortTime").datetimepicker({
                minView: "month", //选择日期后，不会再跳转去选择时分秒
                format: "yyyy-mm-dd", //选择日期后，文本框显示的日期格式
                language: 'zh-CN', //汉化
                todayBtn: "linked",
                autoclose:true //选择日期后自动关闭
            });
        });
    </script>
    {{-- <script>
         $(function(){
             // var connectPhone = $('#connectPhone').val();
             var shortTime=$("#shortTime").val();
             var longTime=$("#longTime").val();
             var serviceName=$("#serviceName").val()
             var url = 'http://admin.ziyawang.com/data/export?shortTime='+shortTime+"&longTime="+longTime+"&serviceName="+serviceName;
             $('#export').attr('href',url);
         });
     </script>--}}
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
                    <th>花费时间</th>
                    <th>查看次数</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($dataMoneys as $dataMoney)
                    <tr>
                        <td style="text-align:center">{{$dataMoney->phonenumber}}</td>
                        @if($dataMoney->role==1)
                            <td>服务方</td>
                        @elseif($dataMoney->role==2)
                            <td>发布方</td>
                        @else
                            <td>注册</td>
                        @endif
                        @if(!empty($dataMoney->username))
                            <td style="text-align:center">{{$data->username}}</td>
                        @else
                            <td style="text-align:center"></td>
                        @endif
                        @if(!empty($dataMoney->ServiceName))
                            <td style="text-align:center"><a href="http://ziyawang.com/service/{{$dataMoney->ServiceID}}" target="_blank">{{$dataMoney->ServiceName}}</a></td>
                        @else
                            <td style="text-align:center"></td>
                        @endif
                        <td style="text-align:center">{{$dataMoney->Money}}</td>
                        <td style="text-align:center">{{$dataMoney->Money/10}}</td>
                        <td style="text-align:center">{{$dataMoney->OrderNumber}}</td>
                        <td style="text-align:center">{{$dataMoney->created_at}}</td>
                        <td style="text-align:center">{{$dataMoney->recordCounts}}</td>
                        <td>
                            <a href="{{asset('money/conDetail/'.$dataMoney->UserID)}}">查看详情</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination alternate">
            {!! $dataMoneys->render() !!}
        </div>
    </div>
@endsection