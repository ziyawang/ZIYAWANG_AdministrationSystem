@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="{{asset('css/member.css ')}}"/>
    <div id="breadcrumb">
        <a href="#" title="用户管理" class="tip-bottom"><i class="icon-home"></i>用户管理</a>
        <a href="#" class="current">用户列表</a>
        <a href="#" class="pull-right" id="export"> <div class=" btn btn-primary ">导出</div></a>
    </div>
    @if(session("msg"))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>{{session("msg")}}</strong>
        </div>
    @endif
    <div class="widget-content nopadding">
        <form class="form-horizontal" method="post" action="{{asset('publish/index')}}" name="basic_validate"  novalidate="novalidate" />
        <table  class="table table-bordered table-striped publishTable">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <td>
                <div class="control-group">
                    <label class="control-label">当前状态</label>
                    <div class="controls" >
                        <select  name="state" id="state"/>
                        <option value="2">全部<option>
                        <option value="1" @if(isset($state) && $state==1) selected="selected" @endif>冻结</option>
                        <option value="0" @if(isset($state) && $state==0) selected="selected" @endif>正常</option>
                        </select>
                    </div>
                </div>
            </td>
            <td>
                <div class="control-group">
                    <label class="control-label">手机号</label>
                    <div class="controls" >
                        @if(!empty($phoneNumber))
                            <input type="text" name="connectPhone"  id="connectPhone" value="{{$phoneNumber}}"  style="width:100px"/>
                        @else
                            <input type="text" name="connectPhone" id="connectPhone" value="" style="width:100px"/>
                        @endif
                    </div>
                </div>
            </td>
            <td>
                <div class="control-group">
                    <label class="control-label">编号</label>
                    <div class="controls " >
                        @if(!empty($usersId))
                            <input type="text" name="usersId"  id="usersId" value="{{$usersId}}"  style="width:100px"/>
                        @else
                            <input type="text" name="usersId" id="usersId" value="" style="width:100px"/>
                        @endif
                    </div>
                </div>
            </td>
            <td class="tdTime">
            <div class="control-group ">
                <label class="control-label">时间</label>
                <div class="controls" >
                    @if(!empty($longTime) && !empty($shortTime))
                        <input type="text" name="shortTime"  id="shortTime" value="{{$shortTime}}"  style="width:100px"/>&nbsp&nbsp&nbsp&nbsp~&nbsp&nbsp&nbsp&nbsp <input type="text" name="longTime"  id="longTime" value="{{$longTime}}"  style="width:100px"/>
                    @else
                        <input type="text" name="shortTime" id="shortTime" value="" style="width:100px"/>&nbsp&nbsp&nbsp&nbsp~&nbsp&nbsp&nbsp&nbsp <input type="text" name="longTime"  id="longTime" value=""  style="width:100px"/>
                    @endif
                </div>
            </div>
            </td>
            <td class="tdSearch">
                <div class="form-actions searchBox">
                    <input type="submit" value="搜索" class="btn btn-success" />
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
            <div id="main" style="width: 100%;height:400px; float:left;"></div>
        </div>
        <script src="{{asset('js/echarts.js')}}"></script>
        <script src="{{asset('js/china.js')}}"></script>
    <script>
        $(function(){
            var longTime=$("#longTime").val();
            var shortTime=$("#shortTime").val();
            $.ajax({
                url:"{{asset('publish/getCounts')}}",
                data:{"longTime":longTime,"shortTime":shortTime},
                dataType:"json",
                 type:"post",
                success:function(msg){
                    var count= new Array();
                    $.each(msg,function(item,value){
                        count=count.concat(value);
                    });
                    var myChart = echarts.init(document.getElementById('main'));
                    option = {
                        color: ['#3398DB'],
                        tooltip : {
                            trigger: 'axis',
                            axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                                type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                            }
                        },
                        legend: {
                            data:['用户注册量']
                        },
                        grid: {
                            left: '3%',
                            right: '4%',
                            bottom: '3%',
                            containLabel: true
                        },
                        xAxis : [
                            {
                                type : 'category',
                                data : ['全部', '电脑', '安卓', '苹果'],
                                axisTick: {
                                    alignWithLabel: true
                                }
                            }
                        ],
                        yAxis : [
                            {
                                type : 'value'
                            }
                        ],
                        series : [
                            {
                                name:'用户注册量',
                                type:'bar',
                                barWidth: '30%',
                                data:count,
                            }
                        ]
                    };
                    myChart.setOption(option);
                    window.onresize = myChart.resize;
                    myChart.on('click', function (params) {
                        if (typeof params.seriesIndex != 'undefined') {
                            switch (params.name) {
                                case "全部":
                                    //window.location.href = "http://www.sina.com";
                                    window.open("http://admin.ziyawang.com/publish/regDirection/全部", "_blank");//在新页面打开
                                    break;
                                case "电脑":
                                    window.open("http://admin.ziyawang.com/publish/regDirection/电脑", "_blank");//在新页面打开
                                    break;
                                case "安卓":
                                    window.open("http://admin.ziyawang.com/publish/regDirection/安卓", "_blank");
                                    break;
                                case "苹果":
                                    window.open("http://admin.ziyawang.com/publish/regDirection/苹果", "_blank");
                                    break;
                                default:
                                    break;
                            }
                        }
                    });
                }

            })
        })
    </script>
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>ID</th>
                    <th>姓名</th>
                    <th>注册手机</th>
                    <th>注册时间</th>
                    <th>当前状态</th>
                    <th>角色</th>
                    <th>注册渠道</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td style="text-align: center">{{$data->number}}</td>
                        <td style="text-align: center">{{$data->userid}}</td>
                        <td style="text-align: center">{{$data->username}}</td>
                        <td style="text-align: center">{{$data->phonenumber}}</td>
                        <td style="text-align: center">{{$data->created_at}}</td>
                        @if($data->status==0)
                            <td style="text-align: center"><p style="color:dodgerblue;margin:0 auto">正常</p></td>
                        @else
                           <td style="text-align: center"><p  style="color:dodgerblue">冻结</p></td>
                        @endif
                        @if($data->role==1)
                        <td style="text-align: center">服务方</td>
                        @elseif($data->role==2)
                            <td style="text-align: center">发布方</td>
                        @else
                            <td style="text-align: center">注册</td>
                        @endif
                        <td style="text-align: center">{{$data->Channel}}</td>
                        <td style="text-align: center">
                            <a href="{{url('publish/detail/'.$data->userid)}}">查看</a>
                        </td>
                      
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination alternate">
            {!! $datas->appends(["state"=>$state,"phoneNumber"=>$phoneNumber,"usersId"=>$usersId,"shortTime"=>$shortTime,"longTime"=>$longTime])->render() !!}
        </div>

    </div>

    @endsection
            <!-- TODO: Current Tasks -->


