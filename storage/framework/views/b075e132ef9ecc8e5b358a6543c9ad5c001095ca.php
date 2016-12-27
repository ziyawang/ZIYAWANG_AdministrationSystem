<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/talk.css ')); ?>"/>
    <div id="breadcrumb">
        <a data-original-title="Go to Home" id="talkMessage" class="tip-bottom"><i class="icon-home"></i>融云信息</a>
        <a href="#" class="current">聊天记录</a>
    </div>
    <input type="hidden" name="showMessageUrl" id="showMessageUrl" value="<?php echo e($showMessageUrl); ?>">
    <script>
        $("#talkMessage").on("click",function(){
            var showMessageUrl=$("#showMessageUrl").val()
            var url=showMessageUrl;
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
                        <h5>聊天内容</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <div class="chat-content panel-left">
                            <div class="chat-messages" id="chat-messages">
                                <div id="chat-messages-inner">
                                    <?php foreach($messages as $message): ?>
                                        <?php if($message['fromUserId']==$fromUserId && !empty($message['content']) ): ?>
                                            <?php foreach($frominfos as $frominfo): ?>
                                            <p style="display: block;" id="msg-1" class="user-neytiri">
                                                <img src="<?php echo e('http://images.ziyawang.com'.$frominfo['UserPicture']); ?>" alt="" >
                                            <span class="msg-block">
                                                <strong><?php echo e($frominfo['phonenumber']); ?></strong>
                                                <span class="time"><?php echo e($message['dateTime']); ?></span>
                                                <?php if($message['classname']=="RC:ImgMsg"): ?>
                                                 <?php /*  <img src="http://images.ziyawang.com/user/14714151099883.jpg" alt="" >*/ ?>
                                                <img src="<?php echo e('http://talk.ziyawang.com/images'.$message['content']); ?>">
                                                <?php elseif($message['classname']=="RC:VcMsg"): ?>
                                                    <span class="msg">
                                                        <audio src="<?php echo e('http://talk.ziyawang.com/voices'.$message['content']); ?>" controls="controls"></audio>
                                                    </span>
                                                <?php else: ?>
                                                    <span class="msg"><?php echo e($message['content']); ?></span>
                                                <?php endif; ?>

                                            </span>
                                            </p>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <?php if(!empty($message['content'])): ?>
                                            <?php foreach($targetinfos as $targetinfo): ?>
                                            <p style="display: block;" id="msg-2" class="user-cartoon-man">
                                                <img src="<?php echo e('http://images.ziyawang.com'.$targetinfo['UserPicture']); ?>" alt="">
                                                <span class="msg-block">
                                                <strong><?php echo e($targetinfo['phonenumber']); ?></strong>
                                                 <span class="time"><?php echo e($message['dateTime']); ?></span>
                                                    <?php if($message['classname']=="RC:ImgMsg"): ?>
                                                        <span class="msg">
                                                           <?php /* <img src="http://images.ziyawang.com/user/14714151099883.jpg" alt="" >*/ ?>
                                                            <img src="<?php echo e('http://talk.ziyawang.com/images'.$message['content']); ?>">
                                                        </span>
                                                    <?php elseif($message['classname']=="RC:VcMsg"): ?>
                                                        <span class="msg">
                                                            <audio src="<?php echo e('http://talk.ziyawang.com/voices'.$message['content']); ?>" controls="controls"></audio>
                                                    </span>
                                                    <?php else: ?>
                                                        <span class="msg"><?php echo e($message['content']); ?></span>
                                                    <?php endif; ?>
                                                </span>
                                            </p>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
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
                                            <a href="#">
                                            <input type="hidden" name="userid" value="0"/>
                                                <img alt="" src="http://images.ziyawang.com/user/kefu.png">
                                                <span>客服</span>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php foreach($datas as $data): ?>
                                        <?php foreach($data as $value): ?>
                                            <li id="Msg_<?php echo e($value['userid']); ?>" class="online new"><a href="">
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
            $("#Msg_0").children(":first").attr('href',url);
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>