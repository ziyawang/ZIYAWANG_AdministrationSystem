<?php $__env->startSection('content'); ?>
    <div id="breadcrumb" style="position:relative">
        <a href="<?php echo e(asset('publish/index')); ?>" title="发布方列表" class="tip-bottom"><i class="icon-home"></i>用户</a>
        <a href="#" class="current">用户详情</a>
    </div>
    <?php if(session("msg")): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong><?php echo e(session("msg")); ?></strong>
        </div>
    <?php endif; ?>
    <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                            <span class="icon">
                                <i class="icon-align-justify"></i>
                            </span>
                        <h5>发布方详情</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="<?php echo e(asset('publish/update')); ?>" />
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

                        <?php foreach($db as $data): ?>
                            <input type="hidden" name="id" value="<?php echo e($data->userid); ?>">
                        <div class="control-group">
                            <label class="control-label">姓名</label>
                            <div class="controls">
                                <input type="text" name="name" id="required" value="<?php echo e($data->username); ?>" readonly/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">邮箱</label>
                            <div class="controls">
                                <input type="text" name="email" id="email"  value="<?php echo e($data->email); ?>"  readonly/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">注册手机号</label>
                            <div class="controls">
                                <input type="text" name="number" id="date" value="<?php echo e($data->phonenumber); ?>"  readonly/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">注册时间</label>
                            <div class="controls">
                                <input type="text" name="password" id="url" value="<?php echo e($data->created_at); ?>"  readonly/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">当前状态</label>
                            <div class="controls">
                                <select name="status" id="status">
                                        <option value="1"  <?php if($data->status==1): ?> selected="selected"  <?php endif; ?>>冻结</option>
                                        <option value="0" <?php if($data->status==0): ?>selected="selected"  <?php endif; ?>>正常</option>
                                    </select>
                            </div>
                        </div>
                        <div class="control-group"  id="remark"style="display:none;">
                            <label class="control-label">备注</label>
                            <div class="controls">
                                <input type="text" name="remark" id="date" value="<?php echo e($data->Remark); ?>"/>
                            </div>
                        </div>
                            <div class="form-actions">
                                <input type="submit" value="修改" class="btn btn-primary"/>
                                <a href="#"><input type="button" value="返回" class="btn btn-primary" onclick="javascript:history.back(-1);"/></a>
                            </div>
                        <?php endforeach; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var result1 = $("#status").val();
            $("#status").on("change", function () {
                var result2 = $(this).val();
                if (result1 == result2) {
                    $("#remark").hide();
                } else {
                    $("#remark").css("display", "block");
                }
            });
        </script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>