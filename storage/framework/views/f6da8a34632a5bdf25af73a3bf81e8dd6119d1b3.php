<?php $__env->startSection('content'); ?>
    <style>
        .newsType .checker span .checker span{background-position: -76px -240px;}
    </style>
    <div id="breadcrumb">
        <a href="<?php echo e(url('video/index')); ?>" title="视频列表" class="tip-bottom"><i class="icon-home"></i> 视频</a>
        <a href="#" class="current">编辑视频</a>
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
                    <h5>编辑视频</h5>
                </div>
                <div class="widget-content nopadding">
                    <form method="post" action="<?php echo e(asset('video/saveupdate')); ?>" class="form-horizontal" />
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <input type="hidden" name="videoid" value="<?php echo e($datas->VideoID); ?>">
                    <div class="control-group">
                        <label class="control-label">视频标题</label>
                        <div class="controls">
                            <input type="text" name="title" value="<?php echo e($datas->VideoTitle); ?>" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">视频类型</label>
                        <div class="controls newsType">
                            <?php foreach($types as $type): ?>
                                <?php if(!isset($count)): ?>
                                    <input type="checkbox" name="type[]" value="<?php echo e($type->id); ?>"/><?php echo e($type->TypeName); ?>

                                <?php else: ?>
                                    <input type="checkbox" name="type[]" value="<?php echo e($type->id); ?>" <?php if(in_array($type->id,$count)): ?> checked="checked" <?php endif; ?> /><?php echo e($type->TypeName); ?>

                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">视频简介</label>
                        <div class="controls">
                            <textarea name="description" maxlength="200" placeholder="请您输入200个字数之内" ><?php echo e($datas->VideoDes); ?></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">视频封面(737X411)</label>
                        <div class="controls">
                            <input type="hidden" id="filepath" name="videologo" value="<?php echo e($datas->VideoLogo); ?>">
                            <input id="file_uploadvideopic" name="file_uploadvideopic"  multiple="true">
                        </div>
                        <div class="controls  span4">
                            <img src="<?php echo e("Http://images.ziyawang.com".$datas->VideoLogo); ?>" id="thumb" alt=""/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">首页封面(290X188)</label>
                        <div class="controls">
                            <input type="hidden" id="filepath3" name="videoThumb" value="<?php echo e($datas->VideoThumb); ?>">
                            <input id="file_uploadvideopic1" name="file_uploadvideopic1"  multiple="true">
                        </div>
                        <div class="controls  span4">
                            <img src="<?php echo e("Http://images.ziyawang.com".$datas->VideoThumb); ?>" id="thumb1" alt=""/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">视频内容</label>
                        <div class="controls">
                            <input type="hidden" id="filepath1" name="videolink" value="<?php echo e($datas->VideoLink); ?>">
                            <input id="file_uploadvideo" name="file_uploadvideo"  multiple="true">
                        </div>
                        <div class="controls  span4">
                            <video src="<?php echo e("Http://videos.ziyawang.com".$datas->VideoLink); ?>" id="videolink" controls="controls" width="400px" height="300px">
                                your browser does not support the video tag
                            </video>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">视频内容</label>
                        <div class="controls">
                            <input type="hidden" id="filepath2" name="videolink2" value="<?php echo e($datas->VideoLink2); ?>">
                            <input id="file_uploadvideo2" name="file_uploadvideo2"  multiple="true">
                        </div>
                        <div class="controls  span4">
                            <video src="<?php echo e("Http://videos.ziyawang.com".$datas->VideoLink2); ?>" id="videolink2" controls="controls" width="400px" height="300px">
                                your browser does not support the video tag
                            </video>
                        </div>
                    </div>
                    <div class="control-group span4" >
                        <label class="control-label">修改顺序</label>
                        <div class="controls"  >
                            <input type="text" name="order"  value="<?php echo e($datas->Order); ?>"/>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary" onClick="savevideo(0)" >保存</button>
                        <button id="publish" type="submit" class="btn btn-primary" onClick="savevideo(1)" >保存并发布</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        <?php $timestamp = time();?>

        function savevideo(para){
            var f = document.getElementsByTagName("form")[0];
            f.action=f.action+"/"+para;
        }

        $(function() {
            $("#file_uploadvideo2").uploadifive({
                'buttonText' : '上传视频',
                'formData'     : {
                    'timestamp' : '<?php echo $timestamp;?>',
                    '_token'     : "<?php echo e(csrf_token()); ?>"
                },
                'removeCompleted' : false,
                'uploadScript'     :"<?php echo e(url('/video/smallupload')); ?>",
                'onUploadComplete' : function(file, data) {
                    $('#filepath2').val(data);
                    $('#videolink2').attr('src', "Http://videos.ziyawang.com"+data);
                }
            });
        });
        $(function() {
            $("#file_uploadvideo").uploadifive({
                'buttonText' : '上传视频',
                'formData'     : {
                    'timestamp' : '<?php echo $timestamp;?>',
                    '_token'     : "<?php echo e(csrf_token()); ?>"
                },
                'removeCompleted' : false,
                'uploadScript'     :"<?php echo e(url('/video/bigupload')); ?>",
                'onUploadComplete' : function(file, data) {
                    $('#filepath1').val(data);
                    $('#videolink').attr('src',"Http://videos.ziyawang.com"+data);
                }
            });
        });
        $(function() {
            $("#file_uploadvideopic").uploadifive({
                'buttonText' : '上传图片',
                'formData'     : {
                    'timestamp' : '<?php echo $timestamp;?>',
                    '_token'     : "<?php echo e(csrf_token()); ?>"
                },
                'removeCompleted' : true,
                'fileSizeLimit':1024,
                'uploadScript'     :"<?php echo e(url('video/upload')); ?>",
                'onUploadComplete' : function(file, data) {
                    $('#filepath').val(data);
                    $('#thumb').attr('src',"Http://images.ziyawang.com"+data);
                }
            });
        });
        $(function() {
            $("#file_uploadvideopic1").uploadifive({
                'buttonText' : '上传图片',
                'formData'     : {
                    'timestamp' : '<?php echo $timestamp;?>',
                    '_token'     : "<?php echo e(csrf_token()); ?>"
                },
                'removeCompleted' : true,
                'fileSizeLimit':1024,
                'uploadScript'     :"<?php echo e(url('video/upload')); ?>",
                'onUploadComplete' : function(file, data) {
                    $('#filepath3').val(data);
                    $('#thumb1').attr('src',"Http://images.ziyawang.com"+data);
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>