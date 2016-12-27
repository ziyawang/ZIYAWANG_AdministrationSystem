<?php $__env->startSection('content'); ?>
    <div id="breadcrumb">
        <a data-original-title="Go to Home"  class="tip-bottom" id="talkMessage"><i class="icon-home"></i>融云信息</a>
        <a href="#" class="current">聊天记录</a>
    </div>
    <input type="hidden" name="talkUrl" id="talkUrl" value="<?php echo e($talkUrl); ?>">
    <script>
        $("#talkMessage").on("click",function(){
            var url=$("#talkUrl").val();
            $("#talkMessage").attr('href',url);
        })
    </script>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box widget-chat">
                    <div class="widget-title">
					<span class="icon">
						<i class="icon-comment"></i>
					</span>
                        <h5>聊天记录</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <div class="chat-content panel-left">
                            <div class="chat-messages" id="chat-messages">
                                <div id="chat-messages-inner">
                                </div>
                            </div>
                        </div>
                        <div class="chat-users panel-right">
                            <div class="panel-title"><h5> Users</h5></div>
                            <div class="panel-content nopadding">
                                <ul class="contact-list">
                                    <input type="hidden" id="fromUserId" name="fromUserId" value="<?php echo e($fromUserId); ?>">
                                    <?php if($system==1): ?>
                                        <li id="Msg_0" class="online new">
                                            <a href="">
                                                <input type="hidden" name="userid" value="0"/>
                                                <img alt="" src="http://images.ziyawang.com/user/kefu.png">
                                                <span>客服</span>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php foreach($datas as $data): ?>
                                         <?php foreach($data as $value): ?>
                                                <li id="Msg_<?php echo e($value['userid']); ?>" class="online new">
                                                    <a href="">
                                                        <input type="hidden" name="userid" value="<?php echo e($value['userid']); ?>">
                                                        <img alt="" src="<?php echo e('http://images.ziyawang.com'.$value['UserPicture']); ?>">
                                                        <span><?php echo e($value['phonenumber']); ?></span>
                                                    </a>
                                                </li>
                                             <script type="text/javascript">
                                                 $("#Msg_<?php echo e($value['userid']); ?>").on("click",function(){
                                                     var targetId= $("#Msg_<?php echo e($value['userid']); ?>").children(":first").children(":first").val();
                                                     var fromUserId=$("#fromUserId").val();
                                                     //var url="http://admin.ziyawang.cn/talk/showMessage/"+targetId+"/"+fromUserId;
                                                     var url="http://admin.ziyawang.com/talk/showMessage/"+targetId+"/"+fromUserId;
                                                        $("#Msg_<?php echo e($value['userid']); ?>").children(":first").attr("href",url);
                                                 })
                                             </script>
                                         <?php endforeach; ?>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
        $("#Msg_0").on("click",function(){
            var targetId=$(this).children(":first").children(":first").val();
            var fromUserId=$("#fromUserId").val();
           // var url="http://admin.ziyawang.cn/talk/showMessage/"+targetId+"/"+fromUserId;
            var url="http://admin.ziyawang.com/talk/showMessage/"+targetId+"/"+fromUserId;
            $("#Msg_0").children(":first").attr("href",url);
        });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>