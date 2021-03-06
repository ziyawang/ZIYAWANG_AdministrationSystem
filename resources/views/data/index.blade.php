@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="{{asset('css/member.css ')}}"/>
    <div id="breadcrumb" style="position:relative">
        <a href="{{asset('data/index')}}" title="用户行为" class="tip-bottom"><i class="icon-home"></i>用户行为</a>
        <a href="#" class="current">数据分析</a>
        <a href="#" class="pull-right" id="export"> <div class=" btn btn-primary ">导出</div></a>
    </div>
    <div class="widget-content nopadding">
        <form class="form-horizontal" method="post" action="{{asset('data/index')}}" name="basic_validate"  novalidate="novalidate" />
        <table  class="table table-bordered table-striped publishTable">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            {{-- <td>
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
             </td>--}}
            <td>
                <div class="control-group">
                    <label class="control-label checkState">公司名称</label>
                    <div class="controls selectBox" >
                        @if(!empty($serviceName))
                            <input type="text" name="serviceName"  id="serviceName" value="{{$serviceName}}"  style="width:100px"/>
                        @else
                            <input type="text" name="serviceName" id="serviceName" value="" style="width:100px"/>
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
           // var connectPhone = $('#connectPhone').val();
            var shortTime=$("#shortTime").val();
            var longTime=$("#longTime").val();
            var serviceName=$("#serviceName").val()
            var url = 'http://admin.ziyawang.com/data/export?shortTime='+shortTime+"&longTime="+longTime+"&serviceName="+serviceName;
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
                url:"{{asset('data/getCounts')}}",
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
                            data:['用户渠道登录量']
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
                                name:'用户渠道登录量',
                                type:'bar',
                                barWidth: '30%',
                                data:count,
                            }
                        ]
                    };
                    myChart.setOption(option);
                    window.onresize = myChart.resize;
                }

            })
        })
    </script>
                <div  class="container-fluid">
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                {{--<th>ID</th>--}}
                                <th>手机号</th>
                              {{--  <th>IP</th>--}}
                                <th>角色</th>
                                <th>名称</th>
                                <th>公司名称</th>
                                <th>服务类型</th>
                                <th>登录次数</th>
                                <th>注册时间</th>
                                <th>最后登录时间</th>
                                <th>操作</th>
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
                                    <td style="text-align:center">{{$data->ServiceName}}</td>
                                @else
                                    <td style="text-align:center"></td>
                                @endif
                                @if($data->role==1)
                                    <td style="text-align:center">{{$data->ServiceType}}</td>
                                @else
                                    <td style="text-align:center"></td>
                                @endif
                                <td style="text-align:center">{{$data->counts}}</td>
                                 <td style="text-align:center">{{$data->created_at}}</td>
                                <td style="text-align:center">{{$data->LoginTime}}</td>
                                <td>
                                    @if(!empty($longTime) && !empty($shortTime))
                                        <a href="{{url('data/detail/'.$data->phonenumber.'/'.$longTime.'/'.$shortTime)}}">登录详情</a>&nbsp&nbsp&nbsp&nbsp
                                    @else
                                        <a href="{{url('data/countDetail/'.$data->phonenumber)}}">登录详情</a>&nbsp&nbsp&nbsp&nbsp
                                    @endif
                                    <a  href="{{url('data/view/'.$data->userid)}}">浏览详情</a>
                                </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination alternate">
                        {!! $datas->appends(["shortTime"=>$shortTime,"longTime"=>$longTime,"serviceName"=>$serviceName])->render() !!}
                    </div>
                </div>
@endsection