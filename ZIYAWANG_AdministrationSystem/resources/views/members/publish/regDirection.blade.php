@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="{{asset('css/member.css ')}}"/>
    <div id="breadcrumb">
        <a href="{{asset('publish/index')}}" title="用户注册" class="tip-bottom"><i class="icon-home"></i>用户注册</a>
        <a href="#" class="current">用户注册</a>

    </div>

  <div class="widget-content nopadding">
        <form class="form-horizontal" method="post" action="{{asset('publish/index')}}" name="basic_validate"  novalidate="novalidate" />
        <table  class="table table-bordered table-striped publishTable">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <td class="tdTime" style="float: right">
                <div class="control-group ">
                    <label class="control-label">时间</label>
                    <div class="controls" >
                        <input type="text" name="shortTime"  id="shortTime" value="{{$shortTime}}"  style="width:100px"/>&nbsp&nbsp~&nbsp&nbsp<input type="text" name="longTime"  id="longTime" value="{{$longTime}}"  style="width:100px"/>
                    </div>
                </div>
            </td>
            <td  style="float: right;width: 30%">
                <div class="control-group">
                    <label class="control-label">选择渠道</label>
                    <div class="controls" >
                        <select  name="changeChannel" id="changeChannel"/>
                        <option value="全部" @if($channel=="全部") selected="selected" @endif>全部</option>
                        <option value="电脑" @if($channel=="电脑") selected="selected" @endif>电脑</option>
                        <option value="安卓" @if($channel=="安卓") selected="selected" @endif>安卓</option>
                        <option value="苹果" @if($channel=="苹果") selected="selected" @endif>苹果</option>
                        </select>
                    </div>
                </div>
            </td>
        </table>
        </form>
    </div>
    <script>
        $(function () {
            $('#longTime').datetimepicker({
                minView: "month", //选择日期后，不会再跳转去选择时分秒
                format: "yyyy-mm-dd", //选择日期后，文本框显示的日期格式
                language: 'zh-CN', //汉化
                autoclose:true //选择日期后自动关闭
            });
            $("#shortTime").datetimepicker({
                minView: "month", //选择日期后，不会再跳转去选择时分秒
                format: "yyyy-mm-dd", //选择日期后，文本框显示的日期格式
                language: 'zh-CN', //汉化
                autoclose:true //选择日期后自动关闭
            });
        });
    </script>
    <script>
        $(function(){
            var connectPhone = $('#connectPhone').val();
            var state= $("#state").val();
            var usersId=$("#usersId").val();
            var shortTime=$("#shortTime").val();
            var longTime=$("#longTime").val();
            var url = 'http://admin.ziyawang.com/publish/export?state='+state+"&connectPhone="+connectPhone+"&usersId="+usersId+"&shortTime="+shortTime+"&longTime="+longTime;
            $('#export').attr('href',url);
        });
    </script>
        <div class="clearfix">
            <input type="hidden" id="channel" name="channel" value="{{$channel}}" >
            <div id="main" style="width: 100%;height:600px; float:left;"></div>
        </div>
        <script src="{{asset('js/echarts.js')}}"></script>
        <script src="{{asset('js/china.js')}}"></script>
        <script>
            $(function() {
               var longTime = $("#longTime").val();
                var shortTime = $("#shortTime").val();
                var channel=$("#channel").val();
                register(longTime,shortTime,channel);
                $("#changeChannel").on("change",function(){
                    var longTime = $("#longTime").val();
                    var shortTime = $("#shortTime").val();
                    var channel=$("#changeChannel").val();
                    register(longTime,shortTime,channel);

                });
                $("#shortTime").on("changeDate",function(){
                    var shortTime=$("#shortTime").val();
                      var longTime=$("#longTime").val()
                    var channel=$("#changeChannel").val();
                    register(longTime,shortTime,channel);
                });
                $("#longTime").on("changeDate",function(){
                    var shortTime=$("#shortTime").val();
                    var longTime=$("#longTime").val()
                    var channel=$("#changeChannel").val();
                    register(longTime,shortTime,channel);
                });

            });
            function register(longTime,shortTime,channel){
                $.ajax({
                    url: "{{asset("publish/dataDirection")}}",
                    data: {"longTime": longTime, "shortTime": shortTime,"channel":channel},
                    dataType: "json",
                    type: "post",
                    success: function (msg) {
                        var count = new Array();
                        var regTime=new Array();
                        $.each(msg, function (item, value) {
                            regTime=regTime.concat(item);
                            count = count.concat(value);
                        })
                        var myChart = echarts.init(document.getElementById('main'));
                        option = {
                            title: {
                                text: '资芽网用户注册走势图',
                            },
                            tooltip: {
                                trigger: 'axis'
                            },
                            legend: {
                                data: ['注册数']
                            },
                            xAxis: {
                                type: 'category',
                                boundaryGap: false,
                                data:regTime,
                            },
                            yAxis: {
                                type: 'value',
                                axisLabel: {
                                    formatter: '{value}个'
                                }
                            },
                            series: [
                                {
                                    name: '注册数',
                                    type: 'line',
                                    data: count,
                                    markPoint: {
                                        data: [
                                            {type: 'max', name: '最大值'},
                                            {type: 'min', name: '最小值'}
                                        ]
                                    },

                                },
                            ]
                        }
                        myChart.setOption(option);
                        window.onresize = myChart.resize;
                    }

                })
            };

        </script>
    @endsection
                <!-- TODO: Current Tasks -->