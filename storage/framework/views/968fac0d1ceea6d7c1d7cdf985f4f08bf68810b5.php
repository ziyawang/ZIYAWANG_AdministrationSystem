
<?php $__env->startSection('content'); ?>
    <div id="breadcrumb" style="position: relative">
        <a href="<?php echo e(asset('role/index')); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>角色</a>
        <a href="#" class="current">角色列表</a>
        <a href="<?php echo e(url('role/add')); ?>" class="pull-right"> <button class="btn btn-success">添加角色</button></a>
    </div>
   <?php if(session("msg")): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong><?php echo e(session("msg")); ?></strong>
    </div>
    <?php endif; ?>
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>角色名称</th>

                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($datas as $data): ?>
                    <tr>
                        <td><?php echo e($data->id); ?></td>
                        <td><?php echo e($data->RoleName); ?></td>

                        <td>
                            <a class="btn btn-primary" href="<?php echo e(url('role/update/'.$data->id)); ?>"><i class="icon-pencil icon-white"></i></a>&nbsp&nbsp&nbsp
                            <a class="btn btn-danger"  href="<?php echo e(url('role/delete/'.$data->id)); ?>"onclick="return confirm('确定将此记录删除?')"><i class="icon-remove icon-white"></i></a>
                        </td>
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