<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/news.css ')); ?>"/>
    <div id="breadcrumb" >
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>约谈</a>
        <a href="#" class="current">约谈</a>
        <a href="#" class="pull-right" id="export">
            <?php /*<div class="btn btn-primary" >导出</div>*/ ?>
        </a>
    </div>
    <div class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>服务方名称</th>
                    <th>联系电话</th>
                    <th>约谈时间</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($datas as $data): ?>
                    <tr class="tr">
                        <td><?php echo e($data->ServiceID); ?></td>
                        <td><?php echo e($data->ServiceName); ?></td>
                        <td><?php echo e($data->ConnectPhone); ?></td>
                        <td><?php echo e($data->RushTime); ?></td>
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