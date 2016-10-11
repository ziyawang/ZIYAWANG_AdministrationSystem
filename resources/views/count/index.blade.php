@extends('layouts.master')
@section('content')
<!-- 为 ECharts 准备一个具备大小（宽高）的 DOM -->
<div id="breadcrumb" style="position:relative">
    <a href="{{asset('data/index')}}" title="数据分析" class="tip-bottom"><i class="icon-home"></i>信息统计</a>
    <a href="#" class="current">信息统计</a>
</div>
@foreach($counts as $key=>$count)
<input type="hidden" name="type_{{$key}}" id="type_{{$key}}" value="{{$count}}">
@endforeach
<div class="clearfix">
<div id="main" style="width: 600px;height:400px; float:left;"></div>
<div id="mapMain" style="width: 1000px;height:800px;float:left;margin-left: 50px"></div>
</div>
<script src="{{asset('js/echarts.js')}}"></script>
<script src="{{asset('js/china.js')}}"></script>
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

                /* function randomData() {
                 return Math.round(Math.random()*1000);
                 }*/
                option = {
                    title: {
                        text: '资芽信息地区统计',
                        /*subtext: '纯属虚构',*/
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
    var type_1=$("#type_1").val();
    var type_2=$("#type_2").val();
    var type_3=$("#type_3").val();
    var type_4=$("#type_4").val();
    var type_6=$("#type_6").val();
    var type_9=$("#type_9").val();
    var type_10=$("#type_10").val();
    var type_12=$("#type_12").val();
    var type_13=$("#type_13").val();
    var type_14=$("#type_14").val();
    var type_15=$("#type_15").val();
    var myChart = echarts.init(document.getElementById('main'));
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
    option = {
        title : {
            text: '资芽信息统计比例',
            x: 'center'
        },
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
            orient: 'vertical',
            left: 'left',
            data: ['资产包转让','债权转让','固产转让','商业保理','资产求购','融资需求','法律服务','悬赏信息','尽职调查','委外催收','投资需求']
        },
        series : [
            {
                name: '比例',
                type: 'pie',
                radius : '55%',
                center: ['50%', '60%'],
                data:[
                    {value:type_1, name:'资产包转让'},
                    {value:type_14, name:'债权转让'},
                    {value:type_12, name:'固产转让'},
                    {value:type_4, name:'商业保理'},
                    {value:type_13, name:'资产求购'},
                    {value:type_6, name:'融资需求'},
                    {value:type_3, name:'法律服务'},
                    {value:type_9, name:'悬赏信息'},
                    {value:type_10, name:'尽职调查'},
                    {value:type_2, name:'委外催收'},
                    {value:type_15, name:'投资需求'}
                ],
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

    myChart.setOption(option);
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