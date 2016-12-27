
<?php $__env->startSection('content'); ?>
    <div id="breadcrumb" style="position: relative">
        <a href="<?php echo e(asset("auth/index")); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>权限</a>
        <a href="#" class="current">角色列表</a>
    </div>
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>角色名称</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($datas as $data): ?>
                    <tr>
                        <td><?php echo e($data->RoleName); ?></td>
                        <td>
                            <a href="<?php echo e(url('auth/assign/'.$data->id)); ?>">分配权限</a>&nbsp&nbsp&nbsp
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="pagination alternate" >
            <?php echo $datas->render(); ?>

        </div>
    </div>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>