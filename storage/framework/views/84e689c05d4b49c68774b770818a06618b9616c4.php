<?php $__env->startSection('content'); ?>
    <div id="breadcrumb" style="position:relative" xmlns="http://www.w3.org/1999/html">
        <a href="<?php echo e(asset('push/index')); ?>" title="审核列表" class="tip-bottom"><i class="icon-home"></i>推送</a>
        <a href="#" class="current">推送信息</a>
    </div>
    <?php if(session("msg")): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong><?php echo e(session("msg")); ?></strong>
        </div>
    <?php endif; ?>
    <?php if(session('status')): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong><?php echo e(session("status")); ?></strong>
        </div>
    <?php endif; ?>
    <?php if(session("msgReceive")): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong><?php echo e(session("msgReceive")); ?></strong>
        </div>
    <?php endif; ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                            <span class="icon">
                                <i class="icon-align-justify"></i>
                            </span>
                    <h5>推送消息</h5>
                </div>
                <div class="widget-content nopadding ">
                    <form class="form-horizontal" method="post" action="<?php echo e(asset('push/sent')); ?>" />
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <input type="hidden" name="receiveId" value="<?php echo  session("receiveId") ?>">
                        <div class="control-group">
                            <label class="control-label">收信人</label>
                            <div class="controls">
                                <?php if(!empty(session("receiveName"))): ?>
                                    <input type="text" name="receive" id="receive"   value="<?php echo  session("receiveName") ?>" />
                                    <?php elseif(!empty(session("receives"))): ?>
                                    <input type="text" name="receives" id="receives"   value="<?php echo  session("receives") ?>" />
                                    <?php else: ?>
                                      <input type="text" name="receives" id="receives"   value="" />
                                <?php endif; ?>
                                    <a href="<?php echo e(asset('push/receive')); ?>"><input type="button" value="选择收信人" class="btn btn-success" /></a>
                            </div>
                        </div>
                        <div class="control-group " >
                            <label class="control-label">标题</label>
                            <div class="controls">
                                <?php if(!empty(session("title"))): ?>
                                <input type="text" name="title" id="title" value="<?php echo  session("title") ?>" />
                                <?php else: ?>
                                    <input type="text" name="title" id="title" value="" />
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">内容</label>
                            <div class="controls">
                                <?php if(!empty(session("con"))): ?>
                                <textarea name="con" id="contant" ><?php echo  session("con") ?></textarea>
                                <?php else: ?>
                                    <textarea  name="con"  id="contant"  /> </textarea>
                                <?php endif; ?>
                                    <a href="<?php echo e(asset('push/message')); ?>"> <input type="button" value="选择消息" class="btn btn-success"  id="button"/></a>
                            </div>
                        </div>
                    <div class="form-actions">
                        <input type="submit" value="推送" class="btn btn-primary"/>
                       <a href="<?php echo e(asset('push/clear')); ?>"> <input type="button" value="取消" class="btn btn-primary"/></a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $("#title").on("blur",function(){
                var title=$("#title").val();
                $.ajax({
                    url:"<?php echo e(asset('push/title')); ?>",
                    data:{"title":title,_token:"<?php echo e(csrf_token()); ?>"},
                    dataType:"json",
                    type:"post",
                    success:function(msg){
                        console.log(msg)
                    }
                });
            });
            $("#contant").on("blur",function(){
                var con=$("#contant").val();
                $.ajax({
                    url:"<?php echo e(asset('push/contant')); ?>",
                    data:{"con":con,_token:"<?php echo e(csrf_token()); ?>"},
                    dataType:"json",
                    type:"post",
                    success:function(msg){
                        console.log(msg)
                    }
                });
            });
            $("#receives").on("blur",function(){
                var receives=$("#receives").val();
                $.ajax({
                    url:"<?php echo e(asset('push/receives')); ?>",
                    data:{"receives":receives,_token:"<?php echo e(csrf_token()); ?>"},
                    dataType:"json",
                    type:"post",
                    success:function(msg){
                        console.log(msg)
                    }
                });
            });

        </script>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>