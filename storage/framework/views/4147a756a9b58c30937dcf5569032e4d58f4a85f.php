<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/member.css ')); ?>"/>
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
        <a href="<?php echo e(asset('money/index')); ?>" title="芽币统计" class="tip-bottom"><i class="icon-home"></i>芽币统计</a>
        <a href="#" class="current">芽币统计</a>
    </div>
   <?php /* <div style="height:120px;margin-bottom:15px;margin-top: 5px;">
        <div style="height:60px;margin-left:40px;">
            <div style="float: right">
                <input type="radio" name="choose" value="7"/>近7天&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <input type="radio" name="choose" value="30" checked="checked"/>全部&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

                */ ?><?php /* <?php if(!empty($longTime) && !empty($shortTime)): ?>
                             <input type="text" name="shortTime"  id="shortTime" value="<?php echo e($shortTime); ?>"  style="width:100px"/>&nbsp&nbsp&nbsp&nbsp~&nbsp&nbsp&nbsp&nbsp <input type="text" name="longTime"  id="longTime" value="<?php echo e($longTime); ?>"  style="width:100px"/>
                    <?php else: ?>*/ ?><?php /*
                <input type="radio" name="choose" value="-1"/>时间区间<input type="text" name="shortTime" id="shortTime" value="" style="width:100px"/>&nbsp&nbsp&nbsp&nbsp~&nbsp&nbsp&nbsp&nbsp <input type="text" name="longTime"  id="longTime" value=""  style="width:100px"/>
                */ ?><?php /* <?php endif; ?>*/ ?><?php /*
            </div>
        </div>
        <div class="totalmoney">
            <div style=" height:40px;width:50%;padding-left: 40px;float:left;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                <h3>总芽币:<?php echo e($money); ?><span style="font-size: 12px;color:lightskyblue">(单位/个)</span></h3>
            </div>
            <div style="height:40px;width:50%;float:right">
                <h3>总金额:<?php echo e($realMoney); ?><span style="font-size: 12px;color:lightskyblue">(单位/元)</span></h3>
            </div>
        </div>
    </div>*/ ?>
   <?php /* <script>
        $(function () {
            var date = new Date();
            var Y = date.getFullYear() + '-';
            var  M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
            var D = date.getDate() + ' ';
            var longDataTime = Y+M+D;
            var shortDataTime=Y+M+D;
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
    </script>*/ ?>
    <?php /* <script>
         $(function(){
             // var connectPhone = $('#connectPhone').val();
             var shortTime=$("#shortTime").val();
             var longTime=$("#longTime").val();
             var serviceName=$("#serviceName").val()
             var url = 'http://admin.ziyawang.com/data/export?shortTime='+shortTime+"&longTime="+longTime+"&serviceName="+serviceName;
             $('#export').attr('href',url);
         });
     </script>*/ ?>
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
                    <th>支付渠道</th>
                    <th>订单号</th>
                    <th>充值时间</th>
                    <th>操作详情</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($datas as $data): ?>
                    <tr>
                        <td style="text-align:center"><?php echo e($data->phonenumber); ?></td>
                        <?php if($data->role==1): ?>
                            <td>服务方</td>
                        <?php elseif($data->role==2): ?>
                            <td>发布方</td>
                        <?php else: ?>
                            <td>注册</td>
                        <?php endif; ?>
                        <?php if(!empty($data->username)): ?>
                            <td style="text-align:center"><?php echo e($data->username); ?></td>
                        <?php else: ?>
                            <td style="text-align:center"></td>
                        <?php endif; ?>
                        <?php if(!empty($data->ServiceName)): ?>
                            <td style="text-align:center"><a href="http://ziyawang.com/service/<?php echo e($data->ServiceID); ?>" target="_blank"><?php echo e($data->ServiceName); ?></a></td>
                        <?php else: ?>
                            <td style="text-align:center"></td>
                        <?php endif; ?>
                        <td style="text-align:center"><?php echo e($data->Money); ?></td>
                        <td style="text-align:center"><?php echo e($data->RealMoney/100); ?></td>
                        <td style="text-align:center"><?php echo e($data->Channel); ?></td>
                        <td style="text-align:center"><?php echo e($data->OrderNumber); ?></td>
                        <td style="text-align:center"><?php echo e($data->created_at); ?></td>
                        <td>
                            <?php if(!empty($data->ProjectID)): ?>
                            <a href="http://ziyawang.com/project/<?php echo e($data->ProjectID); ?>" target="_blank"><?php echo e($data->Operates); ?></a>
                            <?php else: ?>
                                <?php echo e($data->Operates); ?>

                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="pagination alternate">
            <?php echo $datas->appends(["value"=>$value,"shortTime"=>$shortTime,"longTime"=>$longTime])->render(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>