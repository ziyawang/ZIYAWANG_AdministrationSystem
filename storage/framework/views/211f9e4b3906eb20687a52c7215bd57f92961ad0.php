<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/member.css ')); ?>"/>
    <style>
        .red{
            color: red;
        }
    </style>
    <div id="breadcrumb" style="position:relative">
        <a href="<?php echo e(asset('talk/index')); ?>" title="融云信息" class="tip-bottom"><i class="icon-home"></i>融云信息</a>
        <a href="#" class="current">选择发送人</a>
    </div>
    <?php if(session("msg")): ?>
        <div class="alert alert-error alert-dismissible" role="alert">
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
                    <h5>选择发送人</h5>
                </div>
                <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="<?php echo e(asset('talk/index')); ?>" name="basic_validate"  novalidate="novalidate" />
                        <table  class="table table-bordered table-striped">
                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <td>
                                <div class="control-group">
                                    <label class="control-label">编号</label>
                                    <div class="controls " >
                                        <?php if(!empty($usersId)): ?>
                                            <input type="text" name="usersId"  id="usersId" value="<?php echo e($usersId); ?>"  style="width:100px"/>
                                        <?php else: ?>
                                            <input type="text" name="usersId" id="usersId" value="" style="width:100px"/>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="control-group">
                                    <label class="control-label checkState">手机号</label>
                                    <div class="controls selectBox" >
                                      <?php if(!empty($phoneNumber)): ?>
                                            <input type="text" name="phoneNumber" id="phoneNumber" value="<?php echo e($phoneNumber); ?>"  style="width:100px" />
                                       <?php else: ?>
                                            <input type="text" name="phoneNumber" id="phoneNumber" value=""   style="width:100px"/>
                                       <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="control-group">
                                    <label class="control-label">当前状态</label>
                                    <div class="controls" >
                                        <select  name="state" id="state"/>
                                        <option value="0" <?php if(isset($state) && $state==0): ?> selected="selected" <?php endif; ?>>全部</option>
                                        <option value="1" <?php if(isset($state) && $state==1): ?> selected="selected" <?php endif; ?>>已聊</option>
                                        </select>
                                    </div>
                                </div>
                            </td>
                            <td class="tdSearch">
                                <div class="form-actions searchBox checkSearch">
                                    <input type="submit" value="搜索" class="btn btn-success" />
                                </div>
                            </td>
                        </table>
                        </form>
                    </div>
                    <div  class="container-fluid">
                        <div class="widget-content nopadding">
                            <table class="table table-bordered table-striped">
                                <?php if(!empty($projectId)): ?>
                                <input type="hidden" name="projectID" id="projectID" value="<?php echo e($projectId); ?>">
                                    <?php else: ?>
                                    <input type="hidden" name="projectID" id="projectID" value="">
                                <?php endif; ?>
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>手机号</th>
                                    <th>注册时间</th>
                                    <th>角色</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($datas as $data): ?>
                                    <tr>
                                        <td><?php echo e($data->userid); ?></td>
                                        <td><?php echo e($data->phonenumber); ?></td>
                                        <td><?php echo e($data->created_at); ?></td>
                                        <?php if($data->role==1): ?>
                                            <td>服务方</td>
                                        <?php elseif($data->role==2): ?>
                                            <td>发布方</td>
                                        <?php else: ?>
                                            <td>注册</td>
                                        <?php endif; ?>
                                        <td class="talkMessage"  >
                                            <a href="<?php echo e(url('talk/message/'.$data->userid)); ?>" id="project_<?php echo e($data->userid); ?>" >查看聊天记录</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="pagination alternate">
                            <?php echo $datas->appends(["phonenumber"=>$phoneNumber,"userid"=>$usersId,"state"=>$state])->render(); ?>

                        </div>
                        <script>
                            $(function(){
                                $(".talkMessage a").on("focus",function(){
                                    var urlName=$(this).attr("href");
                                    var number=urlName.lastIndexOf('/');
                                    var id=urlName.substring(number+1);
                                    $.ajax({
                                        url:"<?php echo e(asset('talk/ajaxData')); ?>",
                                        data:{data:id,_token:"<?php echo e(csrf_token()); ?>"},
                                        dataType:"json",
                                        type:"post",
                                        success:function(msg){

                                        }
                                    })
                                });
                                var projectId=$("#projectID").val();
                                if(projectId){
                                    $("#"+projectId).addClass('red')
                                }
                            })
                        </script>
                    </div>
 <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>