<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/news.css ')); ?>"/>
    <div id="breadcrumb" >
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>收藏</a>
        <a href="#" class="current">收藏详情</a>
        <a href="#" class="pull-right" id="export">
            <?php /*<div class="btn btn-primary" >导出</div>*/ ?>
        </a>
    </div>
    <div class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>注册手机号</th>
                    <th>名称</th>
                    <th>公司名称</th>
                    <th>角色</th>
                    <th>服务类型</th>
                    <th>收藏时间</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($datas as $data): ?>
                    <tr class="tr">
                        <td><?php echo e($data->phonenumber); ?></td>
                        <td><?php echo e($data->username); ?></td>
                        <td><?php echo e($data->ServiceName); ?></td>
                        <?php if($data->role==1): ?>
                            <td>服务方</td>
                        <?php elseif($data->role==2): ?>
                            <td>发布方</td>
                        <?php else: ?>
                            <td>注册</td>
                        <?php endif; ?>
                        <td><?php echo e($data->ServiceType); ?></td>
                        <td><?php echo e($data->CollectTime); ?></td>
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