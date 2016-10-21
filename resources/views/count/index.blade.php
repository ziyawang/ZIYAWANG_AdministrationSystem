@extends('layouts.master')
@section('content')
<!-- 为 ECharts 准备一个具备大小（宽高）的 DOM -->
<div id="breadcrumb" style="position:relative">
    <a href="{{asset('data/index')}}" title="数据分析" class="tip-bottom"><i class="icon-home"></i>信息统计</a>
    <a href="#" class="current">信息统计</a>
</div>
<style>
    .radio input[type="radio"] {
        float: left;
        margin-left: 0px;
    }
</style>
<div style="height:80px;margin-left:40px;">
    <div style="float: right">
        @if($value!=1)
            <input type="radio" name="choose" value="30" checked="checked"/>全部&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <input type="radio" name="choose" value="1"  />时间区间<input type="text" name="shortTime" id="shortTime" value="" style="width:100px"/>&nbsp&nbsp&nbsp&nbsp~&nbsp&nbsp&nbsp&nbsp <input type="text" name="longTime"  id="longTime" value=""  style="width:100px"/>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        @else
            <input type="radio" name="choose" value="30" />全部&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <input type="radio" name="choose" value="1"  checked="checked" />时间区间<input type="text" name="shortTime" id="shortTime" value="{{$shortTime}}" style="width:100px"/>&nbsp&nbsp&nbsp&nbsp~&nbsp&nbsp&nbsp&nbsp <input type="text" name="longTime"  id="longTime" value="{{$longTime}}"  style="width:100px"/>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            @endif
            地区<select  name="province" id="province"/>
            <option   value="全国" @if(!empty($province) && $province=="北京") selected="selected" @endif>--全国--</option>
            <option value="北京" @if(!empty($province) && $province=="北京") selected="selected" @endif>北京</option>
            <option value="上海" @if(!empty($province) && $province=="上海") selected="selected" @endif>上海</option>
            <option value="广东" @if(!empty($province) && $province=="广东") selected="selected" @endif>广东</option>
            <option value="江苏" @if(!empty($province) && $province=="江苏") selected="selected" @endif>江苏</option>
            <option value="山东" @if(!empty($province) && $province=="山东") selected="selected" @endif>山东</option>
            <option value="浙江" @if(!empty($province) && $province=="浙江") selected="selected" @endif>浙江</option>
            <option value="河南" @if(!empty($province) && $province=="河南") selected="selected" @endif>河南</option>
            <option value="河北" @if(!empty($province) && $province=="河北") selected="selected" @endif>河北</option>
            <option value="辽宁" @if(!empty($province) && $province=="辽宁") selected="selected" @endif>辽宁</option>
            <option value="四川" @if(!empty($province) && $province=="四川") selected="selected" @endif>四川</option>
            <option value="湖北" @if(!empty($province) && $province=="湖南") selected="selected" @endif>湖北</option>
            <option value="湖南" @if(!empty($province) && $province=="湖南") selected="selected" @endif>湖南</option>
            <option value="福建" @if(!empty($province) && $province=="福建") selected="selected" @endif>福建</option>
            <option value="安徽" @if(!empty($province) && $province=="安徽") selected="selected" @endif>安徽</option>
            <option value="陕西" @if(!empty($province) && $province=="陕西") selected="selected" @endif>陕西</option>
            <option value="天津" @if(!empty($province) && $province=="天津") selected="selected" @endif >天津</option>
            <option value="江西" @if(!empty($province) && $province=="江西") selected="selected" @endif>江西</option>
            <option value="广西" @if(!empty($province) && $province=="广西") selected="selected" @endif>广西</option>
            <option value="重庆" @if(!empty($province) && $province=="重庆") selected="selected" @endif>重庆</option>
            <option value="吉林" @if(!empty($province) && $province=="吉林") selected="selected" @endif>吉林</option>
            <option value="云南" @if(!empty($province) && $province=="云南") selected="selected" @endif>云南</option>
            <option value="山西" @if(!empty($province) && $province=="山西") selected="selected" @endif>山西</option>
            <option value="新疆" @if(!empty($province) && $province=="新疆") selected="selected" @endif>新疆</option>
            <option value="贵州" @if(!empty($province) && $province=="贵州") selected="selected" @endif>贵州</option>
            <option value="甘肃" @if(!empty($province) && $province=="甘肃") selected="selected" @endif>甘肃</option>
            <option value="海南" @if(!empty($province) && $province=="海南") selected="selected" @endif>海南</option>
            <option value="宁夏" @if(!empty($province) && $province=="宁夏") selected="selected" @endif>宁夏</option>
            <option value="青海" @if(!empty($province) && $province=="青海") selected="selected" @endif>青海</option>
            <option value="西藏" @if(!empty($province) && $province=="西藏") selected="selected" @endif>西藏</option>
            <option value="黑龙江" @if(!empty($province) && $province=="黑龙江") selected="selected" @endif>黑龙江</option>
            <option value="内蒙古" @if(!empty($province) && $province=="内蒙古") selected="selected" @endif>内蒙古</option>
        </select>
    </div>
</div>
<div class="clearfix">
    <div>
        <div id="main" style="width: 500px;height:400px; float:left;"></div>
        <div id="total" style="width: 120px;height:200px;padding-top: 145px; float:left;">
        </div>
        <div id="moneyMain" style="width: 500px;height:400px; float:left;"></div>
    </div>
    <div id="mapMain" style="width: 1000px;height:800px;float:left;margin-left: 50px"></div>
</div>
<script src="{{asset('js/echarts.js')}}"></script>
<script src="{{asset('js/china.js')}}"></script>
<script>
    $(function () {
        var value=$("input[type='radio']:checked").val();
        if(value==1){
            var longDataTime=$("#longTime").val();
            var shortDataTime=$("#shortTime").val();
        }else{
            var date = new Date();
            var Y = date.getFullYear() + '-';
            var  M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
            var D = date.getDate();
            var longDataTime = Y+M+D;
            var shortDataTime=Y+M+D;
        }
        $("#longTime").val(longDataTime);
        $("#shortTime").val(shortDataTime);
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
<script>
    $(function(){
        $("input[type='radio']").on("click",function(){
           var  value= $("input[type='radio']:checked").val();
            if(value==1){
                var longDataTime=$("#longTime").val();
                var shortDataTime=$("#shortTime").val();
            }else {
                var longDataTime = "1";
                var shortDataTime = "1";
            }
            var provinces=$("#province").val();
            window.location.href="http://admin.ziyawang.com/count/index?value="+value+"&longTime="+longDataTime+"&shortTime="+shortDataTime+"&province="+provinces;
        });
        $("#province").on("change",function(){
            var provinces=$("#province").val();
            if(provinces!="全国"){
                var province=provinces
            }else{
                var province="全国";
            }
            var  value= $("input[type='radio']:checked").val();
            if(value==1){
                var longDataTime=$("#longTime").val();
                var shortDataTime=$("#shortTime").val();
            }else {
                var longDataTime = "1";
                var shortDataTime = "1";
            }
            window.location.href="http://admin.ziyawang.com/count/index?value="+value+"&longTime="+longDataTime+"&shortTime="+shortDataTime+"&province="+provinces;
        });

    });
</script>

{{--资芽信息地区的统计--}}
<script>
    $(function () {
        $.ajax({
            url:"{{asset('count/mapCounts')}}",
            data:{data:1},
            type:"post",
            dataType:"json",
            success:function(msg){
                // console.log(msg);
                var chart = echarts.init(document.getElementById('mapMain'));
                var mapdatas=new Array();
                var json={};
                $.each(msg,function(key1,value1){
                    var typeName=key1;
                    var areaDatas=new Array();
                    var areaJson={};
                    $.each(value1,function(key2,value2){
                       areaJson={name:key2,
                                value: value2,
                                /*label:{
                                    normal:{
                                        show:false
                                    }
                                }*/
                                };
                        areaDatas=areaDatas.concat(areaJson);
                    });
                    json={
                        name: key1,
                        type: 'map',
                        mapType: 'china',
                        roam: false,
                        showLegendSymbol: false,
                        label: {
                            normal: {
                                show: true
                            },
                            emphasis: {
                                show: true
                            }
                        },
                        data:areaDatas,
                    }
                    mapdatas=mapdatas.concat(json);
                });
                option = {
                    title: {
                        text: '资芽信息分布地区统计',
                        left: 'center'
                    },
                    tooltip: {
                        trigger: 'item',

                    },
                    legend: {
                        orient: 'vertical',
                        left: 'left',

                        data:['资产包转让','债权转让','固产转让','商业保理','资产求购','融资需求','法律服务','悬赏信息','尽职调查','委外催收','投资需求']
                    },
                    visualMap: {
                        min: 0,
                        max: 600,
                        left: 'left',
                        top: 'bottom',
                        text: ['高','低'],           // 文本，默认为数值文本
                        calculable: true
                    },
                    toolbox: {
                        show: true,
                        orient: 'vertical',
                        left: 'right',
                        top: 'center',
                        feature: {
                            dataView: {readOnly: false},
                            restore: {},
                            saveAsImage: {}
                        }
                    },
                    series: mapdatas,
                };
                chart.setOption(option);
            }
        })
    })
</script>
{{--资芽信息饼状图的信息统计--}}
<script type="text/javascript">
    // 基于准备好的dom，初始化echarts实例
   $(function(){
       var province=$("#province").val();

       var shortTime = $("#shortTime").val();
       if(shortTime==""){
           shortTime=1;
       }
       var longTime = $("#longTime").val();
       if(longTime==""){
           longTime=1;
       }
       var value=$("input[type='radio']:checked").val();
       $.ajax({
           url:"{{asset('count/numMoneyCount')}}",
           data:{"province":province,"shortTime":shortTime,"longTime":longTime,"value":value},
           dataType:"json",
           type:"post",
           success:function(msg) {
               var myChart = echarts.init(document.getElementById('main'));
               var numdatas=new Array();
               var numJson={};
               $.each(msg.distribute,function(numKey1,valueKey1){
                   $.each(valueKey1,function(numKey2,valueKey2){
                       numJson={
                           value:valueKey1.number,name:numKey1
                       };
                   });
                   numdatas=numdatas.concat(numJson);
               });
               option = {
                   title : {
                       text: '资芽信息数量比例统计',
                       x: 'center'
                   },
                   tooltip: {
                       trigger: 'item',
                       formatter: "{a} <br/>{b} : {c} ({d}%)"
                   },
                 /*  legend: {
                       orient: 'vertical',
                       left: 'left',
                       data: ['资产包转让','债权转让','固产转让','商业保理','资产求购','融资需求','法律服务','悬赏信息','尽职调查','委外催收','投资需求']
                   },*/
                   series : [
                       {
                           name: '比例',
                           type: 'pie',
                           radius : '55%',
                           center: ['50%', '60%'],
                           data:numdatas,
                           itemStyle: {
                               emphasis: {
                                   shadowBlur: 10,
                                   shadowOffsetX: 0,
                                   shadowColor: 'rgba(0, 0, 0, 0.5)'
                               }
                           }
                       }
                   ]
               };
               myChart.setOption(option);
           }
       })
   });

</script>

{{--资芽信息平台金额统计--}}
<script type="text/javascript">
    // 基于准备好的dom，初始化echarts实例
  $(function() {
      var province=$("#province").val();

      var shortTime = $("#shortTime").val();
      if(shortTime==""){
          shortTime=1;
      }

      var longTime = $("#longTime").val();
      if(longTime==""){
          longTime=1;
      }

      var value=$("input[type='radio']:checked").val();
      $.ajax({
          url: "{{asset('count/numMoneyCount')}}",
          data: {"province":province,"shortTime": shortTime, "longTime": longTime,"value":value},
          dataType: "json",
          type: "post",
          success: function (msg) {
              var myChart = echarts.init(document.getElementById('moneyMain'));
              var moneydatas = new Array();
              var moneyJson = {};
              $.each(msg.distribute, function (numKey1, valueKey1) {
                  $.each(valueKey1, function (numKey2, valueKey2) {
                      moneyJson = {
                          value: valueKey1.money, name: numKey1
                      };
                  });
                  moneydatas = moneydatas.concat(moneyJson);
              });
              option = {
                  title : {
                      text: '资芽信息金额比例统计',
                      x: 'center'
                  },
                  tooltip: {
                      trigger: 'item',
                      formatter: "{a} <br/>{b} : {c} ({d}%)"
                  },
                  /* legend: {
                   orient: 'vertical',
                   left: 'left',
                   data: ['资产包转让','债权转让','固产转让','商业保理','资产求购','融资需求','法律服务','悬赏信息','尽职调查','委外催收','投资需求']
                   },*/
                  series : [
                      {
                          name: '比例',
                          type: 'pie',
                          radius : '55%',
                          center: ['50%', '60%'],
                          data:moneydatas,
                          itemStyle: {
                              emphasis: {
                                  shadowBlur: 10,
                                  shadowOffsetX: 0,
                                  shadowColor: 'rgba(0, 0, 0, 0.5)'
                              }
                          }
                      }
                  ]
              };
              myChart.setOption(option);
              var str="";
              $.each(msg.total,function(key,value){
                  if(key=="信息总量"){
                      str+="<p>"+key+"(单位/条):<br>"+value+"</p>";
                  }else{
                      str+="<p>"+key+"(单位/万):<br>"+value+"</p>";
                  }

              });
              $("#total").append(str);
          }
     });

  });

    // 指定图表的配置项和数据
    /* var option = {
     title: {
     text: '资芽信息统计'
     },
     tooltip: {},
     legend: {
     data:['销量']
     },
     xAxis: {
     data: ["衬衫","羊毛衫","雪纺衫","裤子","高跟鞋","袜子"]
     },
     yAxis: {},
     series: [{
     name: '销量',
     type: 'bar',
     data: [5, 20, 36, 10, 10, 20]
     }]
     };*/

    // 使用刚指定的配置项和数据显示图表。
    /*  myChart.setOption({
     series : [
     {
     name: '资芽信息统计',
     type: 'pie',
     radius: '60%',
     data:[
     {value:400, name:'资产包转让'},
     {value:335, name:'债权转让'},
     {value:310, name:'固产转让'},
     {value:274, name:'商业保理'},
     {value:235, name:'资产求购'},
     {value:235, name:'融资需求'},
     {value:235, name:'法律服务'},
     {value:235, name:'悬赏信息'},
     {value:235, name:'尽职调查'},
     {value:235, name:'委外催收'},
     {value:235, name:'投资需求'}
     ]
     }
     ]
     })*/

    //自动显示比列的代码
    /*app.currentIndex = -1;

     app.timeTicket = setInterval(function () {
     var dataLen = option.series[0].data.length;
     // 取消之前高亮的图形
     myChart.dispatchAction({
     type: 'downplay',
     seriesIndex: 0,
     dataIndex: app.currentIndex
     });
     app.currentIndex = (app.currentIndex + 1) % dataLen;
     // 高亮当前图形
     myChart.dispatchAction({
     type: 'highlight',
     seriesIndex: 0,
     dataIndex: app.currentIndex
     });
     // 显示 tooltip
     myChart.dispatchAction({
     type: 'showTip',
     seriesIndex: 0,
     dataIndex: app.currentIndex
     });
     }, 1000);*/

</script>




{{--资芽信息地区统计的代码--}}


{{--<script>

    var chart = echarts.init(document.getElementById('mapMain'));
    function randomData() {
        return Math.round(Math.random()*1000);
    }

    option = {
        title: {
            text: '资芽信息地区统计',
           left: 'center'
        },
        tooltip: {
            trigger: 'item'
        },
        legend: {
            orient: 'vertical',
            left: 'left',
            data:['资产包转让','债权转让','固产转让','商业保理','资产求购','融资需求','法律服务','悬赏信息','尽职调查','委外催收','投资需求']
        },
       visualMap: {
            min: 0,
            max: 2500,
            left: 'left',
            top: 'bottom',
            text: ['高','低'],           // 文本，默认为数值文本
            calculable: true
        },
        toolbox: {
            show: true,
            orient: 'vertical',
            left: 'right',
            top: 'center',
            feature: {
                dataView: {readOnly: false},
                restore: {},
                saveAsImage: {}
            }
        },
        series: [
            {
                name: '资产包转让',
                type: 'map',
                mapType: 'china',
                roam: false,
                label: {
                    normal: {
                        show: true
                    },
                    emphasis: {
                        show: true
                    }
                },
                data:[
                    {name: '北京',value: randomData() },
                    {name: '天津',value: randomData() },

                    {name: '台湾',value: randomData() },
                    {name: '香港',value: randomData() },
                    {name: '澳门',value: randomData() }
                ]
            },
            {
                name: '债权转让',
                type: 'map',
                mapType: 'china',
                label: {
                    normal: {
                        show: true
                    },
                    emphasis: {
                        show: true
                    }
                },
                data:[
                    {name: '北京',value: randomData() },
                    {name: '天津',value: randomData() },
                    {name: '上海',value: randomData() },

                    {name: '宁夏',value: randomData() },
                    {name: '海南',value: randomData() },
                    {name: '台湾',value: randomData() },
                    {name: '香港',value: randomData() },
                    {name: '澳门',value: randomData() }
                ]
            },
            {
                name: '固产转让',
                type: 'map',
                mapType: 'china',
                label: {
                    normal: {
                        show: true
                    },
                    emphasis: {
                        show: true
                    }
                },
                data:[


                    {name: '澳门',value: randomData() }
                ]
            },
            {
                name: '商业保理',
                type: 'map',
                mapType: 'china',
                label: {
                    normal: {
                        show: true
                    },
                    emphasis: {
                        show: true
                    }
                },
                data:[

                    {name: '四川',value: randomData() },
                    {name: '宁夏',value: randomData() },
                    {name: '海南',value: randomData() },
                    {name: '台湾',value: randomData() },
                    {name: '香港',value: randomData() },
                    {name: '澳门',value: randomData() }
                ]
            },
            {
                name: '资产求购',
                type: 'map',
                mapType: 'china',
                label: {
                    normal: {
                        show: true
                    },
                    emphasis: {
                        show: true
                    }
                },
                data:[
                    {name: '北京',value: randomData() },

                    {name: '香港',value: randomData() },
                    {name: '澳门',value: randomData() }
                ]
            },
            {
                name: '融资需求',
                type: 'map',
                mapType: 'china',
                label: {
                    normal: {
                        show: true
                    },
                    emphasis: {
                        show: true
                    }
                },
                data:[
                    {name: '北京',value: randomData() },

                    {name: '香港',value: randomData() },
                    {name: '澳门',value: randomData() }
                ]
            },
            {
                name: '法律服务',
                type: 'map',
                mapType: 'china',
                label: {
                    normal: {
                        show: true
                    },
                    emphasis: {
                        show: true
                    }
                },
                data:[
                    {name: '北京',value: randomData() },
                    {name: '天津',value: randomData() },
                    {name: '上海',value: randomData() },
                    {name: '重庆',value: randomData() },
                    {name: '河北',value: randomData() },
                    {name: '河南',value: randomData() },
                    {name: '云南',value: randomData() },
                    {name: '辽宁',value: randomData() },
                    {name: '黑龙江',value: randomData() },
                    {name: '湖南',value: randomData() },
                    {name: '安徽',value: randomData() },

                ]
            },
            {
                name: '悬赏信息',
                type: 'map',
                mapType: 'china',
                label: {
                    normal: {
                        show: true
                    },
                    emphasis: {
                        show: true
                    }
                },
                data:[
                    {name: '北京',value: randomData() },

                    {name: '辽宁',value: randomData() },
                    {name: '黑龙江',value: randomData() },
                    {name: '湖南',value: randomData() },
                    {name: '安徽',value: randomData() },
                    {name: '山东',value: randomData() },

                    {name: '香港',value: randomData() },
                    {name: '澳门',value: randomData() }
                ]
            },
            {
                name: '尽职调查',
                type: 'map',
                mapType: 'china',
                label: {
                    normal: {
                        show: true
                    },
                    emphasis: {
                        show: true
                    }
                },
                data:[
                    {name: '北京',value: randomData() },

                    {name: '澳门',value: randomData() }
                ]
            },
            {
                name: '委外催收',
                type: 'map',
                mapType: 'china',
                label: {
                    normal: {
                        show: true
                    },
                    emphasis: {
                        show: true
                    }
                },
                data:[

                    {name: '海南',value: randomData() },
                    {name: '台湾',value: randomData() },
                    {name: '香港',value: randomData() },
                    {name: '澳门',value: randomData() }
                ]
            },
            {
                name: '投资需求',
                type: 'map',
                mapType: 'china',
                label: {
                    normal: {
                        show: true
                    },
                    emphasis: {
                        show: true
                    }
                },
                data:[
                    {name: '北京',value: randomData() },
                    {name: '天津',value: randomData() },
                    {name: '上海',value: randomData() },
                    {name: '重庆',value: randomData() },
                    {name: '河北',value: randomData() },
                    {name: '河南',value: randomData() },
                    {name: '云南',value: randomData() },
                    {name: '辽宁',value: randomData() },
                    {name: '黑龙江',value: randomData() },

                ]
            },
        ]
    };
    chart.setOption(option);
</script>--}}

@endsection