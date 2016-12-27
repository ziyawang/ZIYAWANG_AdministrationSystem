<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/member.css ')); ?>"/>
    <div id="breadcrumb" style="position:relative">
        <a href="<?php echo e(asset('data/index')); ?>" title="数据分析" class="tip-bottom"><i class="icon-home"></i>数据分析</a>
        <a href="#" class="current">浏览详情</a>
    </div>
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>

                    <th>浏览内容</th>
                    <th>类型</th>
                    <th>IP</th>
                    <th>浏览时间</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($datas as $data): ?>
                    <tr>
                        <?php if($data->Type==1): ?>
                            <td style="text-align:center"><a href="http://ziyawang.com/project/<?php echo e($data->ItemID); ?>"><?php echo e($data->ItemID); ?></a></td>
                        <?php elseif($data->Type==2): ?>
                            <td style="text-align:center"><a href="http://ziyawang.com/video/<?php echo e($data->ItemID); ?>"><?php echo e($data->ItemID); ?></a></td>
                        <?php elseif($data->Type==3): ?>
                            <td style="text-align:center"><a href="http://ziyawang.com/news/<?php echo e($data->ItemID); ?>"><?php echo e($data->ItemID); ?></a></td>
                        <?php else: ?>
                            <td style="text-align:center"><a href="http://ziyawang.com/service/<?php echo e($data->ItemID); ?>"><?php echo e($data->ItemID); ?></a></td>
                        <?php endif; ?>
                        <?php if($data->Type==1): ?>
                            <td style="text-align:center">信息</td>
                        <?php elseif($data->Type==2): ?>
                            <td style="text-align:center">视频</td>
                        <?php elseif($data->Type==3): ?>
                            <td style="text-align:center">新闻</td>
                            <?php else: ?>
                            <td style="text-align:center">服务</td>
                        <?php endif; ?>
                        <td style="text-align:center"><?php echo e($data->IP); ?></td>
                        <td style="text-align:center"><?php echo e($data->created_at); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="pagination alternate">
            <?php echo $datas->render(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>