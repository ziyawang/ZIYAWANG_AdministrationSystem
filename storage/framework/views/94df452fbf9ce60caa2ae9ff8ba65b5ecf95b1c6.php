<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/member.css ')); ?>"/>
    <div id="breadcrumb" style="position:relative">
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>会员</a>
        <a href="#" class="current">会员列表</a>
    </div>
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped checkTable">
                <thead>
                <tr>
                    <th>公司名称</th>
                    <th>信息类型</th>
                    <th>会员类型</th>
                    <th>会员费(元)</th>
                    <th>开始时间</th>
                    <th>结束时间</th>
                    <th>支付渠道</th>
                    <th>支付状态</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($datas as $data): ?>
                    <tr>
                        <td><?php echo e($data->ServiceName); ?></td>
                        <td><?php echo e($data->MemberName); ?></td>
                        <?php if($data->Month==1): ?>
                            <td>月度会员</td>
                        <?php elseif($data->Month==3): ?>
                            <td>季度会员</td>
                        <?php else: ?>
                            <td>年度会员</td>
                        <?php endif; ?>
                            <td><?php echo e($data->PayMoney/100); ?></td>
                        <td><?php echo e($data->StartTime); ?></td>
                        <td><?php echo e($data->EndTime); ?></td>
                        <td><?php echo e($data->Channel); ?></td>
                        <?php if($data->PayFlag==0): ?>
                            <td>未支付</td>
                        <?php else: ?>
                            <td>已支付</td>
                        <?php endif; ?>
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