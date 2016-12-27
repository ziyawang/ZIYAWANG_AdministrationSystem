<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/member.css ')); ?>"/>
    <div id="breadcrumb" style="position:relative">
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>委托发布</a>
        <a href="#" class="current">列表</a>
    </div>
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped checkTable">
                <thead>
                <tr>
                    <th>联系人</th>
                    <th>联系方式</th>
                    <th>信息类型(委托)</th>
                    <th>渠道</th>
                    <th>委托时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($datas as $data): ?>
                    <tr>
                        <?php if(!empty($data->ConnectPerson)): ?>
                            <td><?php echo e($data->ConnectPerson); ?></td>
                        <?php else: ?>
                            <td></td>
                        <?php endif; ?>
                        <td><?php echo e($data->ConnectPhone); ?></td>
                        <td><?php echo e($data->TypeName); ?></td>
                        <td><?php echo e($data->Channel); ?></td>
                        <td><?php echo e($data->EntrustTime); ?></td>
                        <td>
                            <?php if($data->HandleFlag==0): ?>
                                <button class="btn btn-primary" id="<?php echo e($data->ID); ?>" >处理</button>
                            <?php else: ?>
                                <button class="btn btn-danger" >已处理</button>
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
        $(function(){
            $(".btn.btn-primary").on("click",function(){
                var id=$(this).attr("id");
               $.ajax({
                   url:"<?php echo e(asset('entrust/change')); ?>",
                   data:{"id":id},
                   dateType:"json",
                   type:"post",
                   success:function(msg){
                       if(msg==1){
                           location.href="<?php echo e(asset('entrust/index')); ?>"
                       }
                   }
               })
            })
        })
    </script>
    </div>
    <?php $__env->stopSection(); ?>
            <!-- TODO: Current Tasks -->

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>