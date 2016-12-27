<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/news.css ')); ?>"/>
    <div id="breadcrumb" >
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>约谈</a>
        <a href="#" class="current">约谈列表</a>
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
                    <th>信息类型</th>
                    <th>发布方</th>
                    <th>约谈次数</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($datas as $data): ?>
                    <tr class="tr">
                        <td><?php echo e($data->ProjectID); ?></td>
                        <td><a href="http://ziyawang.com/project/<?php echo e($data->ProjectID); ?>" target="_blank"><?php echo e($data->TypeName); ?></a></td>
                        <td><?php echo e($data->phonenumber); ?></td>
                        <td><?php echo e($data->count); ?></td>
                        <td><a href="<?php echo e(asset("rush/detail/".$data->ProjectID)); ?>">查看约谈人</a></td>
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