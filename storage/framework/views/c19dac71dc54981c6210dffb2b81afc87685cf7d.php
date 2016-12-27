<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/news.css ')); ?>"/>
    <div id="breadcrumb" >
        <a href="<?php echo e(asset('data/index')); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>用户行为</a>
        <a href="#" class="current">用户行为</a>
        <a href="#" class="pull-right" id="export">
           <?php /* <div class="btn btn-primary" >导出</div>*/ ?>
        </a>
    </div>
    <?php /* <div class="widget-content nopadding">
         <form class="form-horizontal" method="post" action="<?php echo e(asset('rush/index')); ?>" name="basic_validate"  novalidate="novalidate" />
         <table  class="table table-bordered table-striped">
             <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
             <td>
                 <div class="control-group">
                     <label class="control-label">类型</label>
                     <div class="controls" >
                         <select  name="typeName" id="typeName"/>
                         <option value="0">---全部---</option>
                         <?php foreach($results as $result): ?>
                             <option value="<?php echo e($result->TypeID); ?>" <?php if(!empty($typeName) && $typeName==$result->TypeID): ?> selected="selected" <?php endif; ?>><?php echo e($result->TypeName); ?></option>
                             <?php endforeach; ?>
                             </select>
                     </div>
                 </div>
             </td>
             <td>
                 <div class="form-actions">
                     <input type="submit" value="搜索" class="btn btn-success" />
                 </div>
             </td>
         </table>
         </form>
     </div>
     <script>
         $(function(){
             var type = $('#typeName').val();
             var url = 'http://admin.ziyawang.com/order/export?type='+type;
             $('#export').attr('href',url);
         });
     </script>*/ ?>
    <div class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>手机号</th>
                    <th>IP</th>
                    <th>登录时间</th>
                    <th>登录渠道</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($datas as $data): ?>
                    <tr class="tr">
                        <td><?php echo e($data->PhoneNumber); ?></td>
                        <td><?php echo e($data->IP); ?></td>
                        <td><?php echo e($data->LoginTime); ?></td>
                        <?php if($data->Channel=="ANDROID"): ?>
                            <td>安卓</td>
                        <?php elseif($data->Channel=="IOS"): ?>
                            <td>苹果</td>
                        <?php else: ?>
                            <td>电脑</td>
                        <?php endif; ?>
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
            <!-- TODO: Current Tasks -->
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>