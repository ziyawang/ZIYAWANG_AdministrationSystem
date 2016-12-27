<?php $__env->startSection('content'); ?>
    <style>
        .authentic tr td .checker span .checker span{background-position: -76px -240px;}
    </style>
    <div id="breadcrumb" style="position:relative">
        <a href="<?php echo e(asset("auth/index")); ?>" title="角色列表" class="tip-bottom"><i class="icon-home"></i>权限</a>
        <a href="#" class="current">分配权限</a>
    </div>
    <?php if(session("msg")): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong><?php echo e(session("msg")); ?></strong>
        </div>
    <?php endif; ?>
    <div  class="container-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                            <span class="icon">
                                <i class="icon-align-justify"></i>
                            </span>
                    <h5>分配权限</h5>
                </div>
        <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="<?php echo e(asset('auth/edit')); ?>" name="basic_validate"  novalidate="novalidate" />
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            <input type="hidden" name="id" value="<?php echo e($id); ?>">
            <table class="table table-bordered table-striped with-check authentic">
                <thead>
                <tr>
                    <th>一级权限</th>
                    <th>二级权限</th>

                </tr>
                </thead>
                <tbody>
                <?php if(!empty($authId)): ?>
                            <?php foreach($tpAuths as $tpAuth): ?>
                                <tr>
                                    <td><input type="checkbox"  name="ids[]" value="<?php echo e($tpAuth->Auth_ID); ?>" <?php if(in_array($tpAuth->Auth_ID,$authId)): ?> checked="checked" <?php endif; ?>/><?php echo e($tpAuth->AuthName); ?></td>
                                    <td>
                                        <?php foreach($tAuths as $tAuth): ?>
                                            <?php if($tAuth->PID==$tpAuth->Auth_ID): ?>
                                       <input type="checkbox"  name="ids[]" value="<?php echo e($tAuth->Auth_ID); ?>"  <?php if(in_array($tAuth->Auth_ID,$authId)): ?> checked="checked" <?php endif; ?>/> <?php echo e($tAuth->AuthName); ?>

                                            <?php endif; ?>
                                       <?php endforeach; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                <?php if(empty($authId)): ?>
                        <?php foreach($tpAuths as $tpAuth): ?>
                            <tr>
                                <td><input type="checkbox"  name="ids[]" value="<?php echo e($tpAuth->Auth_ID); ?>" /><?php echo e($tpAuth->AuthName); ?></td>
                                <td>
                                    <?php foreach($tAuths as $tAuth): ?>
                                        <?php if($tAuth->PID==$tpAuth->Auth_ID): ?>
                                            <input type="checkbox"  name="ids[]" value="<?php echo e($tAuth->Auth_ID); ?>" /> <?php echo e($tAuth->AuthName); ?>

                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="form-actions">
            <input type="submit"  id="submit" value="确认" class="btn btn-primary" />
        </div>
        </form>
                <style>
                    .table.with-check tr td:first-child {
                        width: 100px;
                    }
                </style>
    </div>
<?php $__env->stopSection(); ?>
            <!-- TODO: Current Tasks -->
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>