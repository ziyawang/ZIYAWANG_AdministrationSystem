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
        <a href="<?php echo e(asset('money/consume')); ?>" title="芽币消耗" class="tip-bottom"><i class="icon-home"></i>芽币消耗</a>
        <a href="#" class="current">芽币消耗</a>
    </div>
     <div style="height:120px;margin-bottom:15px;margin-top: 5px;">
         <div style="height:60px;margin-left:40px;">
             <div style="float: right">
                 <?php if(empty($value)): ?>
                     <input type="radio" name="choose"  value="7"/>近7天&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                     <input type="radio" name="choose" value="30" checked="checked"/>全部&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                     <input type="radio" name="choose" value="1"  value="7"/>时间区间<input type="text" name="shortTime" id="shortTime" value="" style="width:100px"/>&nbsp&nbsp&nbsp&nbsp~&nbsp&nbsp&nbsp&nbsp <input type="text" name="longTime"  id="longTime" value=""  style="width:100px"/>
                 <?php else: ?>
                     <input type="radio" name="choose" <?php if(!empty($value) && $value==7): ?> checked="checked" <?php endif; ?> value="7"/>近7天&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                     <input type="radio" name="choose" value="30"<?php if(!empty($value) && $value==30): ?> checked="checked" <?php endif; ?>/>全部&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                     <?php if($shortTime!=1 && $value==1 && $longTime!=1): ?>
                         <input type="radio" name="choose" value="1"  checked="checked"/>时间区间<input type="text" name="shortTime" id="shortTime" value="<?php echo e($shortTime); ?>" style="width:100px"/>&nbsp&nbsp&nbsp&nbsp~&nbsp&nbsp&nbsp&nbsp <input type="text" name="longTime"  id="longTime" value="<?php echo e($longTime); ?>"  style="width:100px"/>
                     <?php else: ?>
                         <input type="radio" name="choose" value="1" />时间区间<input type="text" name="shortTime" id="shortTime" value="" style="width:100px"/>&nbsp&nbsp&nbsp&nbsp~&nbsp&nbsp&nbsp&nbsp <input type="text" name="longTime"  id="longTime" value=""  style="width:100px"/>
                     <?php endif; ?>
                 <?php endif; ?>
             </div>
         </div>
         <div class="totalmoney">
             <div style=" height:40px;width:50%;padding-left: 40px;float:left;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                 <h3>总芽币:<?php echo e($money); ?><span style="font-size: 12px;color:lightskyblue">(单位/个)</span></h3>
             </div>
             <div style="height:40px;width:50%;float:right">
                 <h3>已消耗:<?php echo e($consumeMoney); ?><span style="font-size: 12px;color:lightskyblue">(单位/个)</span></h3>
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
                    url:"<?php echo e(asset('money/ajax')); ?>",
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
                    <th>信息编号</th>
                   <?php /* <th>描述</th>*/ ?>
                    <th>信息类型</th>
                    <th>单价(单位/个)</th>
                    <th>总价(单位/个)</th>
                    <th>查看时间</th>
                    <th>查看次数</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($dataMoneys as $dataMoney): ?>
                    <tr>
                        <td style="text-align:center"> <a href="<?php echo e(url('check/detail/'.$dataMoney->ProjectID.'/'.$dataMoney->TypeID)); ?>" target="_blank"><?php echo e($dataMoney->ProjectID); ?></a></td>
                       <?php /* <td style="text-align:center"><?php echo e($dataMoney->WordDes); ?></td>*/ ?>
                        <td style="text-align:center"><?php echo e($dataMoney->TypeName); ?></td>
                        <td style="text-align:center"><?php echo e($dataMoney->Money); ?></td>
                        <td style="text-align:center"><?php echo e($dataMoney->Money*$dataMoney->recordCounts); ?></td>
                        <td style="text-align:center"><?php echo e($dataMoney->created_at); ?></td>
                        <td style="text-align:center"><?php echo e($dataMoney->recordCounts); ?></td>
                        <td>
                            <a href="<?php echo e(asset('money/conDetail/'.$dataMoney->ProjectID.'/'.$value.'/'.$longTime.'/'.$shortTime)); ?>">查看详情</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="pagination alternate">
            <?php echo $dataMoneys->appends(["value"=>$value,"shortTime"=>$shortTime,"longTime"=>$longTime])->render(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>