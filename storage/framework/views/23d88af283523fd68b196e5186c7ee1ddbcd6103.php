<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/news.css ')); ?>"/>
    <div id="breadcrumb">
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 推送</a>
        <a href="#" class="current">已推送列表</a>
    </div>
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped pushTable">
                <thead>
                <tr>
                    <th>推送人</th>
                    <th>联系电话(收信人)</th>
                    <th>标题</th>
                    <th>推送时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($datas as $data): ?>

                    <tr>
                        <td><?php echo e(session("userName")); ?></td>
                        <td><?php echo e($data->phonenumber); ?></td>
                        <td><?php echo e($data->Title); ?></td>
                        <td><?php echo e($data->Time); ?></td>
                        <td><a href="<?php echo e(asset('push/listDetail/'.$data->MessageID)); ?>">查看</a></td>
                    </tr>

                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="pagination alternate" style="margin:0 auto">
            <?php echo $datas->render(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>