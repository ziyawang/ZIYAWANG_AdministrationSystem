<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/news.css ')); ?>"/>
    <div id="breadcrumb" >
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>订单</a>
        <a href="#" class="current">订单列表</a>
        <a href="#" class="pull-right" id="export">
            <div class="btn btn-primary" >导出</div>
        </a>
    </div>
    <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="<?php echo e(asset('order/index')); ?>" name="basic_validate"  novalidate="novalidate" />
                <table  class="table table-bordered table-striped">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <td>
                    <div class="control-group">
                        <label class="control-label">类型</label>
                        <div class="controls" >
                            <select  name="typeName" id="typeName"/>
                                <option value="0">---全部---</option>
                            <?php foreach($results as $result): ?>
                                <option value="<?php echo e($result->TypeID); ?>" <?php if(!empty($typeName) && $typeName==$result->TypeID): ?> selected="selected" <?php endif; ?>><?php echo e($result->TypeName); ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    </td>
                    <td>
                    <div class="form-actions">
                        <input type="submit" value="搜索" class="btn btn-success" />
                    </div>
                    </td>
                </table>
            </form>
        </div>
<script>
    $(function(){
       var type = $('#typeName').val();
        var url = 'http://admin.ziyawang.com/order/export?type='+type;
        $('#export').attr('href',url);
    });
</script>
    <div class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>服务类型</th>
                    <th>发布方</th>
                    <th>处置方名称</th>
                    <th>下单时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($datas as $data): ?>
                    <tr>
                        <td><?php echo e($data->ProjectID); ?></td>
                        <td><?php echo e($data->TypeName); ?></td>
                        <td><?php echo e($data->phonenumber); ?></td>
                        <td><?php echo e($data->ServiceName); ?></td>
                        <td><?php echo e($data->RushTime); ?></td>
                        <td><a href="<?php echo e(url('order/detail/'.$data->RushProID)); ?>">查看</a></td>
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
        <!-- TODO: Current Tasks -->

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>