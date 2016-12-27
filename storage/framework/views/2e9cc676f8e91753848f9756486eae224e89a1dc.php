<?php $__env->startSection('content'); ?>
    <div id="breadcrumb" style="position:relative">
        <a href="<?php echo e(url("system/index")); ?>" title="用户列表" class="tip-bottom"><i class="icon-home"></i>用户</a>
        <a href="#" class="current">编辑用户</a>
    </div>

        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                            <span class="icon">
                                <i class="icon-align-justify"></i>
                            </span>
                        <h5>编辑用户</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="<?php echo e(asset('systems/system/update')); ?>"  />
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                        <input type="hidden" name="id" value="<?php echo e($datas['id']); ?>">
                        <div class="control-group">
                            <label class="control-label">姓名</label>
                            <div class="controls">
                                <input type="text" name="name" id="required" value="<?php echo e($datas['Name']); ?>" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">邮箱</label>
                            <div class="controls">
                                <input type="text" name="email" id="email" value="<?php echo e($datas['Email']); ?>"/>
                                <?php if(session(("msg0"))): ?>
                                    <span class="help-inline"  id= "remark" for="pwd" generated="true" style=" color: red"><?php echo e(session("msg0")); ?></span>
                                <?php endif; ?>
                                <?php if(session(("msg2"))): ?>
                                    <span class="help-inline"  id= "remark" for="pwd" generated="true" style="color: red"><?php echo e(session("msg2")); ?></span>
                                <?php endif; ?>
                                <?php if(session(("msg5"))): ?>
                                    <span class="help-inline"  id= "remark" for="pwd" generated="true" style="color: red"><?php echo e(session("msg5")); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">手机号</label>
                            <div class="controls">
                                <input type="text" name="number" id="date" value="<?php echo e($datas['PhoneNumber']); ?>"/>
                                <?php if(session(("msg3"))): ?>
                                    <span class="help-inline"  id= "remark" for="pwd" generated="true" style=" color: red"><?php echo e(session("msg3")); ?></span>
                                <?php endif; ?>
                                <?php if(session(("msg4"))): ?>
                                    <span class="help-inline"  id= "remark" for="pwd" generated="true" style="color: red"><?php echo e(session("msg4")); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">部门</label>
                            <div class="controls">
                                <select  name="department" id="url" />
                                    <option value="技术部"   <?php if($datas['Department']=='技术部'): ?> selected="selected" <?php endif; ?>>技术部</option>
                                    <option value="产品部"  <?php if($datas['Department']=='产品部'): ?>selected="selected" <?php endif; ?>>产品部</option>
                                    <option value="销售部"  <?php if($datas['Department']=='销售部'): ?> selected="selected" <?php endif; ?>>销售部</option>
                                    <option value="人事部"  <?php if($datas['Department']=='人事部'): ?> selected="selected" <?php endif; ?>>人事部</option>
                                    <option value="客服部" <?php if($datas['Department']=='客服部'): ?> selected="selected" <?php endif; ?>>客服部</option>
                                    <option value="视频部" <?php if($datas['Department']=='视频部'): ?> selected="selected" <?php endif; ?>>视频部</option>
                                    <option value="财务部" <?php if($datas['Department']=='财务部'): ?> selected="selected" <?php endif; ?>>财务部</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">角色</label>
                            <div class="controls">
                                <select  name="roleName" id="url" />
                                <?php foreach($results as $result): ?>
                                    <option value="<?php echo e($result->id); ?>" <?php if($result->id==$datas['RoleID']): ?>selected="selected" <?php endif; ?> ><?php echo e($result->RoleName); ?></option>
                                    <?php endforeach; ?>
                                    </select>
                            </div>
                        </div>
                        <div class="form-actions">
                            <input type="submit" value="编辑" class="btn btn-primary" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>