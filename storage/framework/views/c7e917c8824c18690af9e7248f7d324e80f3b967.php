<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/news.css ')); ?>"/>
    <div id="breadcrumb">
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 视频</a>
        <a href="#" class="current">视频列表</a>
        <a href="<?php echo e(url('video/add')); ?>" class="pull-right"> <button class="btn btn-primary">添加视频</button></a>
    </div>
    <div class="widget-content nopadding">
        <form class="form-horizontal" method="post" action="<?php echo e(asset('video/index')); ?>" name="basic_validate"  novalidate="novalidate" />
        <table  class="table table-bordered table-striped newsHeader">
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            <td>
                <div class="control-group span4" >
                    <label class="control-label">视频标题:</label>
                    <div class="controls"  >
                        <input type="text" name="videoTitle" >
                    </div>
                </div>
            </td>
            <td>
                <div class="form-actions searchBox">
                    <input type="submit" value="搜索" class="btn btn-success" />
                </div>
            </td>
        </table>
        </form>
    </div>
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped newsTable">
                <thead>
                <tr>
                    <th class="newsFace">视频封面</th>
                    <th class="newsTitle">标题</th>
                    <th class="newsAbstract">视频概要</th>
                    <th class="newsAuthor">权重</th>
                    <th class="newsState">状态</th>
                    <th class="newsReleasetime">发布时间</th>
                    <th class="newsOperate">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($datas as $data): ?>
                    <tr>
                        <td width="60" height="50"><img  src="<?php echo e("Http://images.ziyawang.com".$data->VideoLogo); ?>"/></td>
                        <td><?php echo e($data->VideoTitle); ?></td>
                        <td><?php echo e($data->VideoDes); ?></td>
                        <td><?php echo e($data->Order); ?></td>
                        <?php if($data->Flag==0): ?>
                            <td>保存</td>
                        <?php elseif($data->Flag==1): ?>
                            <td>保存并发布</td>
                        <?php endif; ?>
                        <td><?php echo e($data->PublishTime); ?></td>
                        <td class="text-center">
                            <a class="btn btn-primary" href="<?php echo e(url('video/update/'.$data->VideoID)); ?>"><i class="icon-pencil icon-white"></i></a>
                            <a class="btn btn-danger" href="<?php echo e(url('video/delete/'.$data->VideoID)); ?>" onclick="return confirm('确定将此记录删除?')"><i class="icon-remove icon-white"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="pagination alternate" style="margin:0 auto">
            <?php echo $datas->render(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>