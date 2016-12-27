<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/member.css ')); ?>"/>
    <div id="breadcrumb">
        <a href="#" title="用户注册" class="tip-bottom"><i class="icon-home"></i>用户</a>
        <a href="#" class="current">用户列表</a>
        <a href="#" class="pull-right" id="export"> <div class=" btn btn-primary ">导出</div></a>
    </div>
    <?php if(session("msg")): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong><?php echo e(session("msg")); ?></strong>
        </div>
    <?php endif; ?>
    <div class="widget-content nopadding">
        <form class="form-horizontal" method="post" action="<?php echo e(asset('publish/index')); ?>" name="basic_validate"  novalidate="novalidate" />
        <table  class="table table-bordered table-striped publishTable">
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            <td>
                <div class="control-group">
                    <label class="control-label">当前状态</label>
                    <div class="controls" >
                        <select  name="state" id="state"/>
                        <option value="2">全部<option>
                        <option value="1" <?php if(isset($state) && $state==1): ?> selected="selected" <?php endif; ?>>冻结</option>
                        <option value="0" <?php if(isset($state) && $state==0): ?> selected="selected" <?php endif; ?>>正常</option>
                        </select>
                    </div>
                </div>
            </td>
            <td>
                <div class="control-group">
                    <label class="control-label">手机号</label>
                    <div class="controls" >
                        <?php if(!empty($phoneNumber)): ?>
                            <input type="text" name="connectPhone"  id="connectPhone" value="<?php echo e($phoneNumber); ?>"  style="width:100px"/>
                        <?php else: ?>
                            <input type="text" name="connectPhone" id="connectPhone" value="" style="width:100px"/>
                        <?php endif; ?>
                    </div>
                </div>
            </td>
            <td>
                <div class="control-group">
                    <label class="control-label">编号</label>
                    <div class="controls " >
                        <?php if(!empty($usersId)): ?>
                            <input type="text" name="usersId"  id="usersId" value="<?php echo e($usersId); ?>"  style="width:100px"/>
                        <?php else: ?>
                            <input type="text" name="usersId" id="usersId" value="" style="width:100px"/>
                        <?php endif; ?>
                    </div>
                </div>
            </td>
            <td class="tdTime">
            <div class="control-group ">
                <label class="control-label">时间</label>
                <div class="controls" >
                    <?php if(!empty($longTime) && !empty($shortTime)): ?>
                        <input type="text" name="shortTime"  id="shortTime" value="<?php echo e($shortTime); ?>"  style="width:100px"/>&nbsp&nbsp&nbsp&nbsp~&nbsp&nbsp&nbsp&nbsp <input type="text" name="longTime"  id="longTime" value="<?php echo e($longTime); ?>"  style="width:100px"/>
                    <?php else: ?>
                        <input type="text" name="shortTime" id="shortTime" value="" style="width:100px"/>&nbsp&nbsp&nbsp&nbsp~&nbsp&nbsp&nbsp&nbsp <input type="text" name="longTime"  id="longTime" value=""  style="width:100px"/>
                    <?php endif; ?>
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
        <script src="<?php echo e(asset('js/echarts.js')); ?>"></script>
        <script src="<?php echo e(asset('js/china.js')); ?>"></script>
    <script>
        $(function(){
            var longTime=$("#longTime").val();
            var shortTime=$("#shortTime").val();
            $.ajax({
                url:"<?php echo e(asset('publish/getCounts')); ?>",
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
                <?php foreach($datas as $data): ?>
                    <tr>
                        <td><?php echo e($data->number); ?></td>
                        <td><?php echo e($data->userid); ?></td>
                        <td><?php echo e($data->username); ?></td>
                        <td><?php echo e($data->phonenumber); ?></td>
                        <td><?php echo e($data->created_at); ?></td>
                        <?php if($data->status==0): ?>
                            <td><p style="color:dodgerblue;margin:0 auto">正常</p></td>
                        <?php else: ?>
                           <td><p  style="color:dodgerblue">冻结</p></td>
                        <?php endif; ?>
                        <?php if($data->role==1): ?>
                        <td>服务方</td>
                        <?php elseif($data->role==2): ?>
                            <td>发布方</td>
                        <?php else: ?>
                            <td>注册</td>
                        <?php endif; ?>
                        <td><?php echo e($data->Channel); ?></td>
                        <td>
                            <a href="<?php echo e(url('publish/detail/'.$data->userid)); ?>">查看</a>
                        </td>
                      
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="pagination alternate">
            <?php echo $datas->appends(["state"=>$state,"phoneNumber"=>$phoneNumber,"usersId"=>$usersId,"shortTime"=>$shortTime,"longTime"=>$longTime])->render(); ?>

        </div>

    </div>

    <?php $__env->stopSection(); ?>
            <!-- TODO: Current Tasks -->



<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>