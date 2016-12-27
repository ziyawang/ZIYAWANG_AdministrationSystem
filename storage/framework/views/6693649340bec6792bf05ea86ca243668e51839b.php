<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/member.css ')); ?>"/>
    <?php if(session("msg")): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong><?php echo e(session("msg")); ?></strong>
        </div>
    <?php endif; ?>
    <div id="breadcrumb" style="position:relative">
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>审核</a>
        <a href="#" class="current">审核列表</a>
        <a href="#" class="pull-right" id="export"> <div class="btn btn-primary " >导出</div></a>
    </div>
    <div class="widget-content nopadding">
        <form class="form-horizontal" method="post" action="<?php echo e(asset('export/index')); ?>" name="basic_validate"  novalidate="novalidate" />
        <table  class="table table-bordered table-striped">
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            <td>
                <div class="control-group">
                    <label class="control-label checkState">类型</label>
                    <div class="controls selectBox" >
                        <select  name="typeName" id="typeName"/>
                        <option value="0">---全部---</option>
                        <?php foreach($results as $result): ?>
                            <option value="<?php echo e($result->TypeID); ?>" <?php if(!empty($typeName) && $typeName==$result->TypeID): ?> selected="selected" <?php endif; ?>><?php echo e($result->TypeName); ?></option>
                            <?php endforeach; ?>
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
    <script>
        $(function(){
            var type = $('#typeName').val();
            var url = 'http://admin.ziyawang.com/export/export?type='+type;
            $('#export').attr('href',url);
        });
    </script>
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped checkTable">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>ID</th>
                    <th>联系方式</th>
                    <th>发布时间</th>
                    <th>地址</th>
                    <th>信息类型</th>
                    <th>约谈次数</th>
                    <th>浏览次数</th>
                    <th>收藏次数</th>
                    <th>发布渠道</th>
                    <th>审核状态</th>
                    <th>备注</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($datas as $data): ?>
                    <tr>
                        <td><?php echo e($data->number); ?></td>
                        <td><?php echo e($data->ProjectID); ?></td>
                        <td><?php echo e($data->phonenumber); ?></td>
                        <td><?php echo e($data->PublishTime); ?></td>
                        <td><?php echo e($data->ProArea); ?></td>
                        <td><?php echo e($data->TypeName); ?></td>
                        <td><a href="<?php echo e(asset("rush/detail/".$data->ProjectID)); ?>"><?php echo e($data->counts); ?></a></td>
                        <td><a href="<?php echo e(asset("check/viewDetail/".$data->ProjectID)); ?>"><?php echo e($data->ViewCount); ?></a></td>
                        <td><a href="<?php echo e(asset("check/collectDetail/".$data->ProjectID)); ?>"><?php echo e($data->CollectionCount); ?></a></td>
                        <td><?php echo e($data->Channel); ?></td>
                        <?php if($data->State==0): ?>
                            <td><p style="color: #149bdf">待审核</p></td>
                        <?php elseif($data->State==1): ?>
                            <td><p style="color: #149bdf">已审核</p></td>
                        <?php else: ?>
                            <td><p style="color: #149bdf">拒审核</p></td>
                        <?php endif; ?>
                        <td><?php echo e($data->Remark); ?></td>
                        <td><a href="<?php echo e(url('check/detail/'.$data->ProjectID.'/'.$data->TypeID)); ?>">查看</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="pagination alternate">
            <?php echo $datas->appends(["typeName"=>$typeName])->render(); ?>

        </div>
    </div>
    <?php $__env->stopSection(); ?>
            <!-- TODO: Current Tasks -->

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>