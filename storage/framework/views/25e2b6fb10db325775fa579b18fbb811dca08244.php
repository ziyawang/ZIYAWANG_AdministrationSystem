<?php $__env->startSection('content'); ?>
    <style>
        .newsType .checker span .checker span{background-position: -76px -240px;}
    </style>
    <div id="breadcrumb">
        <a href="<?php echo e(url('star/index')); ?>" title="审核列表" class="tip-bottom"><i class="icon-home"></i> 星级审核</a>
        <a href="#" class="current">审核列表</a>
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
                    <h5>审核详情</h5>
                </div>
                <div class="widget-content nopadding">
                    <form method="post" action="<?php echo e(asset('star/save')); ?>" class="form-horizontal" />
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <input type="hidden" name="starPayIds" value="<?php echo e($starPayIds); ?>">
                    <?php foreach($datas as $data): ?>
                    <div class="control-group">
                        <label class="control-label">公司名称</label>
                        <div class="controls">
                            <input type="text" name="ServiceName" value="<?php echo e($data->ServiceName); ?>" readonly />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">联系方式</label>
                        <div class="controls">
                            <input type="text" name="ConnectPhone" value="<?php echo e($data->ConnectPhone); ?>" readonly />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">认证类型</label>
                        <div class="controls">
                            <input type="text" name="PayName" value="<?php echo e($data->PayName); ?>" readonly />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">认证费用(元)</label>
                        <div class="controls">
                            <input type="text" name="PayMoney" value="<?php echo e($data->PayMoney); ?>" readonly />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">认证时间</label>
                        <div class="controls">
                            <input type="text" name="created" value="<?php echo e($data->created_at); ?>" readonly />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">视频认证</label>
                        <div class="controls">
                            <input type="hidden" id="filepath1" name="Resource" value="<?php echo e($data->Resource); ?>">
                            <input id="file_uploadvideo" name="file_uploadvideo"  multiple="true">
                        </div>
                        <div class="controls  span4">
                            <video src="<?php echo e("Http://videos.ziyawang.com".$data->Resource); ?>" id="videolink" controls="controls" width="400px" height="300px">
                                your browser does not support the video tag
                            </video>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <div class="form-actions">
                        <input type="submit" value="修改" class="btn btn-primary"/>
                        <a href="#"><input type=button value="返回" class="btn btn-primary" onclick="javascript:history.back(-1);"/></a>
                    </div>
                        </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        <?php $timestamp = time();?>
            $(function() {
            $("#file_uploadvideo").uploadifive({
                'buttonText' : '上传视频',
                'formData'     : {
                    'timestamp' : '<?php echo $timestamp;?>',
                    '_token'     : "<?php echo e(csrf_token()); ?>"
                },
                'removeCompleted' : false,
                'uploadScript'     :"<?php echo e(url('star/bigupload')); ?>",
                'onUploadComplete' : function(file, data) {
                    $('#filepath1').val(data);
                    $('#videolink').attr('src',"Http://videos.ziyawang.com"+data);
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>