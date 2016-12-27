<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/member.css ')); ?>"/>
    <div id="breadcrumb" style="position:relative">
        <a href="<?php echo e(asset('data/index')); ?>" title="数据分析" class="tip-bottom"><i class="icon-home"></i>用户反馈</a>
        <a href="#" class="current">用户反馈</a>
       <?php /* <a href="#" class="pull-right" id="export"> <div class=" btn btn-primary ">导出</div></a>*/ ?>
    </div>
    <div class="widget-content nopadding">
        <form class="form-horizontal" method="post" action="<?php echo e(asset('data/index')); ?>" name="basic_validate"  novalidate="novalidate" />
        <table  class="table table-bordered table-striped publishTable">
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            <?php /* <td>
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
             </td>*/ ?>
           <?php /* <td class="tdTime">
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
            // var connectPhone = $('#connectPhone').val();
            var shortTime=$("#shortTime").val();
            var longTime=$("#longTime").val();
            var url = 'http://admin.ziyawang.com/data/export?shortTime='+shortTime+"&longTime="+longTime;
            $('#export').attr('href',url);
        });
    </script>*/ ?>
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <?php /*<th>ID</th>*/ ?>
                    <th>手机号</th>
                      <th>角色</th>
                    <th>内容</th>
                    <th>图片</th>
                    <th>时间</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($datas as $data): ?>
                    <tr>
                        <?php /* <td><?php echo e($data->RecordID); ?></td>*/ ?>
                        <td style="text-align:center"><?php echo e($data->phonenumber); ?></td>
                        <?php if($data->role==1): ?>
                            <td>服务方</td>
                        <?php elseif($data->role==2): ?>
                            <td>发布方</td>
                        <?php else: ?>
                            <td>注册</td>
                        <?php endif; ?>
                        <?php /*  <td><?php echo e($data->IP); ?></td>*/ ?>
                        <td style="text-align:center"><?php echo e($data->Content); ?></td>
                        <?php if(!empty($data->Picture)): ?>
                       <td width="60" height="50"> 
                           <a href="<?php echo e(env('IMAGES').$data->Picture); ?>">
                           <img src="<?php echo e(env('IMAGES').$data->Picture); ?>">
                           </a>
                       </td>
                        <?php else: ?>
                            <td></td>
                        <?php endif; ?>
                        <td style="text-align:center"><?php echo e($data->FBTime); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="pagination alternate">
            <?php echo $datas->render(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>