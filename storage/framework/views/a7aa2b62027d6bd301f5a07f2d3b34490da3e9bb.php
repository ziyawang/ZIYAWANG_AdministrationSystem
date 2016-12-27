<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/member.css ')); ?>"/>
    <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('layer/layer/layer.js')); ?>"></script>
    <div id="breadcrumb" style="position:relative">
        <a href="<?php echo e(asset('data/index')); ?>" title="运维管理" class="tip-bottom"><i class="icon-home"></i>运维管理</a>
        <a href="#" class="current">举报反馈</a>
    </div>
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                   <th>举报人</th>
                    <th>手机号</th>
                    <th>举报类型</th>
                    <th>举报内容</th>
                    <th>举报问题</th>
                    <th>举报渠道</th>
                    <th>举报时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($datas as $data): ?>
                    <tr>
                        <td style="text-align:center"><?php echo e($data->username); ?></td>
                        <td style="text-align:center"><?php echo e($data->phonenumber); ?></td>
                        <td style="text-align:center"><?php echo e($data->Type); ?></td>
                        <?php if($data->Type=="信息"): ?>
                            <td><a href="http://ziyawang.com/project/<?php echo e($data->ItemID); ?>" target="_block"><?php echo e($data->ItemID); ?></a></td>
                        <?php else: ?>
                            <td><a href="http://ziyawang.com/service/<?php echo e($data->ItemID); ?>" target="_block"><?php echo e($data->ItemID); ?></a></td>
                        <?php endif; ?>
                        <td style="text-align:center"><?php echo e($data->Content); ?></td>
                        <?php if($data->Channel=="PC"): ?>
                        <td style="text-align:center">电脑</td>
                        <?php elseif($data->Channel=="IOS"): ?>
                            <td style="text-align:center">苹果</td>
                        <?php else: ?>
                            <td style="text-align:center">安卓</td>
                        <?php endif; ?>
                        <td style="text-align:center"><?php echo e($data->created_at); ?></td>
                        <td>
                            <?php if($data->Remark==1): ?>
                                <a class="btn btn-primary"id="handled_<?php echo e($data->ID); ?>">已处理</a>
                           <?php else: ?>
                                <a class="btn btn-danger"  <?php /*href="<?php echo e(asset('operate/handle/'.$data->ID)); ?>"*/ ?> id="handle_<?php echo e($data->ID); ?>">处理</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="pagination alternate">
            <?php echo $datas->render(); ?>

        </div>
        <script>
            $(".btn.btn-danger").on("click",function(){
                var ids=$(this).attr("id");
                var Id=ids.substr(7);
                layer.prompt({title: '请输入处理结果', formType: 2}, function(text, index){
                    layer.close(index);
                    $.ajax({
                        url:"<?php echo e(asset('operate/handle')); ?>",
                        data:{"result":text,"id":Id},
                        dateType:"json",
                        type:"post",
                        success:function(msg){
                            if(msg==1){
                                location.href="<?php echo e(asset('operate/report')); ?>"
                            }
                        }
                    })

                });
            });
            $(".btn.btn-primary").on("click",function(){
                var ids=$(this).attr("id");
                var Id=ids.substr(8);
                $.ajax({
                    url:"<?php echo e(asset('operate/getDate')); ?>",
                    data:{"id":Id},
                    dateType:"json",
                    type:"post",
                    success:function(msg){
                        var msgResult=msg.data;
                        layer.alert(msgResult);
                        }
                    });
                })
        </script>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>