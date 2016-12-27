<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/member.css ')); ?>"/>
    <div id="breadcrumb" style="position:relative">
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>星级认证</a>
        <a href="#" class="current">认证列表</a>
    </div>
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped checkTable">
                <thead>
                <tr>
                    <th>公司名称</th>
                    <th>联系人</th>
                    <th>认证类型</th>
                    <th>认证费用(元)</th>
                    <th>认证时间</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($datas as $data): ?>
                    <tr>
                        <td><?php echo e($data->ServiceName); ?></td>
                        <td><?php echo e($data->ConnectPhone); ?></td>
                        <td><?php echo e($data->PayName); ?></td>
                        <?php if(!empty($data->PayMoney)): ?>
                        <td><?php echo e($data->PayMoney/100); ?></td>
                        <?php else: ?>
                            <td>免费</td>
                        <?php endif; ?>
                        <td><?php echo e($data->created_at); ?></td>
                        <?php if($data->State==1): ?>
                            <td>待审核</td>
                        <?php else: ?>
                            <td>已审核</td>
                        <?php endif; ?>
                        <td><a href="<?php echo e(url('star/detail/'.$data->StarPayID)); ?>">查看详情</a></td>
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