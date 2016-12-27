<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/member.css ')); ?>"/>
    <style>
        .totalmoney{
            height: 50px;
        }
        .radio input[type="radio"] {
            float: left;
            margin-left: 0px;
        }
    </style>
    <div id="breadcrumb" style="position:relative;height: 42px;">
        <a href="<?php echo e(asset('money/consume')); ?>" title="芽币消耗" class="tip-bottom"><i class="icon-home"></i>芽币统计</a>
        <a href="#" class="current">芽币统计</a>
    </div>
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>手机号</th>
                    <th>角色</th>
                    <th>名称</th>
                    <th>公司名称</th>
                    <th>芽币</th>
                    <th>金额</th>
                    <th>订单号</th>
                    <th>充值时间</th>
                    <th>操作详情</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($datas as $data): ?>
                    <tr>
                        <td style="text-align:center"><?php echo e($data->phonenumber); ?></td>
                        <?php if($data->role==1): ?>
                            <td>服务方</td>
                        <?php elseif($data->role==2): ?>
                            <td>发布方</td>
                        <?php else: ?>
                            <td>注册</td>
                        <?php endif; ?>
                        <?php if(!empty($data->username)): ?>
                            <td style="text-align:center"><?php echo e($data->username); ?></td>
                        <?php else: ?>
                            <td style="text-align:center"></td>
                        <?php endif; ?>
                        <?php if(!empty($data->ServiceName)): ?>
                            <td style="text-align:center"><a href="http://ziyawang.com/service/<?php echo e($data->ServiceID); ?>" target="_blank"><?php echo e($data->ServiceName); ?></a></td>
                        <?php else: ?>
                            <td style="text-align:center"></td>
                        <?php endif; ?>
                        <td style="text-align:center"><?php echo e($data->Money); ?></td>
                        <td style="text-align:center"><?php echo e($data->Money/10); ?></td>
                        <td style="text-align:center"><?php echo e($data->OrderNumber); ?></td>
                        <td style="text-align:center"><?php echo e($data->created_at); ?></td>
                        <td>
                            <?php if(!empty($data->ProjectID)): ?>
                                <a href="<?php echo e(url('check/detail/'.$data->ProjectID.'/'.$data->TypeID)); ?>" target="_blank"><?php echo e($data->Operates); ?></a>
                            <?php else: ?>
                                <?php echo e($data->Operates); ?>

                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="pagination alternate">
            <?php echo $datas->appends(["value"=>$value,"shortTime"=>$shortTime,"longTime"=>$longTime])->render(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>