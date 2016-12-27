<?php $__env->startSection('content'); ?>
    <div id="breadcrumb" style="position:relative">
        <a href="<?php echo e(asset('check/index')); ?>" title="审核列表" class="tip-bottom"><i class="icon-home"></i>推送</a>
        <a href="#" class="current">信息详情</a>
    </div>
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                            <span class="icon">
                                <i class="icon-align-justify"></i>
                            </span>
                    <h5>信息详情</h5>
                </div>
                <div class="widget-content nopadding">
                    <form class="form-horizontal" method="post" action="" />
                    <?php foreach($datas as $data): ?>
                        <div class="control-group">
                            <label class="control-label">推送人</label>
                            <div class="controls">
                                <input type="text" name="name" id="required" value="<?php echo e(session("userName")); ?>"  placeholder="Readonly input here…" readonly/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">联系电话(收信人)</label>
                            <div class="controls">
                                <input type="text" name="type" id="type" value="<?php echo e($data->phonenumber); ?>"readonly/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">联系人(收信人)</label>
                            <div class="controls">
                                <input type="text" name="type" id="type" value="<?php echo e($data->ConnectPerson); ?>"readonly/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">公司名称(收信人)</label>
                            <div class="controls">
                                <input type="text" name="number" id="date" value="<?php echo e($data->ServiceName); ?>" readonly/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">标题</label>
                            <div class="controls">
                                <input type="text" name="AssetType" id="AssetType" value="<?php echo e($data->Title); ?>"readonly/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">内容</label>
                            <div class="controls">
                               <textarea name="contant"><?php echo e($data->Text); ?></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">推送时间</label>
                            <div class="controls">
                                <input type="text" name="wordDes" id="eordDes" value="<?php echo e($data->Time); ?>"
                                       readonly/>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="form-actions">
                        <a href="<?php echo e(url('push/detail')); ?>"><input type=button value="返回" class="btn btn-primary"/></a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>