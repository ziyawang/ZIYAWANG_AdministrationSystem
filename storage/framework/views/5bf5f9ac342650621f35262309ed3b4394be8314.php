<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/member.css ')); ?>"/>
    <div id="breadcrumb" style="position:relative">
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>服务方</a>
        <a href="#" class="current">服务方列表</a>
        <a href="#" class="pull-right" id="export"> <div class="btn btn-primary">导出</div></a>
    </div>
    <div class="widget-content nopadding">
        <form class="form-horizontal" method="post" action="<?php echo e(asset('service/index')); ?>" name="basic_validate"  novalidate="novalidate" />
        <table  class="table table-bordered table-striped servicerTable">
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            <td>
                <div class="control-group">
                    <label class="control-label checkState">审核状态</label>
                    <div class="controls selectBox" >
                        <select  name="state" id="state"/>
                        <option value="3">--全部--<option>
                        <option value="1" <?php if(isset($state) && $state==1): ?> selected="selected" <?php endif; ?>>已审核</option>
                        <option value="0" <?php if(isset($state) && $state==0): ?> selected="selected" <?php endif; ?>>待审核</option>
                        <option value="2" <?php if(isset($state) && $state==2): ?> selected="selected" <?php endif; ?>>拒审核</option>
                        </select>
                    </div>
                </div>
            </td>
            <td>
                <div class="control-group">
                    <label class="control-label checkState">类型</label>
                    <div class="controls selectBox" >
                        <select  name="typeName" id="typeName"/>
                        <option value="0" class="select1">---全部---</option>
                        <option value="01" <?php if(!empty($typeName) && $typeName=="01"): ?> selected="selected" <?php endif; ?>>资产包收购</option>
                        <option value="02" <?php if(!empty($typeName) && $typeName=="02"): ?> selected="selected" <?php endif; ?>>催收机构</option>
                        <option value="03" <?php if(!empty($typeName) && $typeName=="03"): ?> selected="selected" <?php endif; ?>>律师事务所</option>
                        <option value="04" <?php if(!empty($typeName) && $typeName=="04"): ?> selected="selected" <?php endif; ?>>保理公司</option>
                        <option value="05" <?php if(!empty($typeName) && $typeName=="05"): ?> selected="selected" <?php endif; ?>>典当担保</option>
                        <option value="06" <?php if(!empty($typeName) && $typeName=="06"): ?> selected="selected" <?php endif; ?>>投融资服务</option>
                        <option value="10" <?php if(!empty($typeName) && $typeName=="10"): ?> selected="selected" <?php endif; ?>>尽职调查</option>
                        <option value="12" <?php if(!empty($typeName) && $typeName=="12"): ?> selected="selected" <?php endif; ?>>资产收购</option>
                        <option value="13" <?php if(!empty($typeName) && $typeName=="13"): ?> selected="selected" <?php endif; ?>>资金过桥</option>
                        <option value="14" <?php if(!empty($typeName) && $typeName=="14"): ?> selected="selected" <?php endif; ?>>债权收购</option>
                        </select>
                    </div>
                </div>
            </td>
           <td>
                <div class="control-group">
                    <label class="control-label checkState">手机号</label>
                    <div class="controls selectBox" >
                        <?php if(!empty($connectPhone)): ?>
                            <input type="text" name="connectPhone"  id="connectPhone" value="<?php echo e($connectPhone); ?>"  style="width:100px"/>
                        <?php else: ?>
                            <input type="text" name="connectPhone" id="connectPhone" value="" style="width:100px"/>
                        <?php endif; ?>
                    </div>
                </div>
            </td>
            <td>
                <div class="control-group">
                    <label class="control-label checkState">公司名称</label>
                    <div class="controls selectBox" >
                        <?php if(!empty($serviceName)): ?>
                            <input type="text" name="serviceName"  id="serviceName" value="<?php echo e($serviceName); ?>"  style="width:100px"/>
                        <?php else: ?>
                            <input type="text" name="serviceName" id="serviceName" value="" style="width:100px"/>
                        <?php endif; ?>
                    </div>
                </div>
            </td>
            <td class="tdSearch">
                <div class="form-actions searchBox">
                    <input type="submit" value="搜索" class="btn btn-success" />
                </div>
            </td>
        </table>
        </form>
    </div>
    <script>
        $(function(){
            var type = $('#typeName').val();
            var state=$("#state").val();
            var connectPhone=$("#connectPhone").val();
            var serviceName=$("#serviceName").val();
            var url = 'http://admin.ziyawang.com/service/export?type='+type+"&state="+state+"&connectPhone="+connectPhone+"&serviceName="+serviceName;
            $('#export').attr('href',url);
        });
    </script>
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped servicerInfoTable">
                <thead>
                <tr>
                    <th>编号</th>
                    <th class="w1">ID</th>
                    <th class="w2">公司名称</th>
                    <th class="w3">注册号</th>
                    <th class="w3">联系号</th>
                    <th class="w4">地区</th>
                    <th class="w5">服务类型</th>
                    <th class="w6">服务地区</th>
                    <th class="w8">完善时间</th>
                    <th class="w8">审核时间</th>
                    <th class="w1">浏览次数</th>
                    <th class="w1">收藏次数</th>
                    <th class="w1">查看次数</th>
                    <th class="w1">登录次数</th>
                    <th class="w9">审核状态</th>
                    <th class="w10">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($datas as $data): ?>
                    <tr>
                        <td><?php echo e($data->number); ?></td>
                        <td><?php echo e($data->ServiceID); ?></td>
                        <td><?php echo e($data->ServiceName); ?></td>
                        <td><?php echo e($data->phonenumber); ?></td>
                        <td><?php echo e($data->ConnectPhone); ?></td>
                        <td><?php echo e($data->ServiceLocation); ?></td>
                        <td><?php echo e($data->ServiceType); ?></td>
                        <td><?php echo e($data->ServiceArea); ?></td>
                <?php /*        <td class="tdCompanyIntro"><div><?php echo e($data->ServiceIntroduction); ?></div></td>*/ ?>
                        <td><?php echo e($data->created_at); ?></td>
                        <td><?php echo e($data->updated_at); ?></td>
                        <td><?php echo e($data->ViewCount); ?></td>
                        <td><?php echo e($data->CollectionCount); ?></td>
                        <td><?php echo e($data->CheckCount); ?></td>
                        <td><?php echo e($data->loginCounts); ?></td>
                        <?php if($data->State==2): ?>
                            <td><p style="color: #149bdf">拒审核</p></td>
                            <?php elseif($data->State==0): ?>
                            <td><p style="color: #149bdf">待审核</p></td>
                            <?php else: ?>
                            <td><p style="color: #149bdf">已审核</p></td>
                            <?php endif; ?>

                        <td><a href="<?php echo e(url('service/detail/'.$data->ServiceID)); ?>" id="look">查看</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="pagination alternate" >
            <?php echo $datas->appends(['State'=>$state,"typeName"=>$typeName,"connectPhone"=>$connectPhone,"serviceName"=>$serviceName])->render(); ?>

        </div>
    </div>

    <?php $__env->stopSection(); ?>
            <!-- TODO: Current Tasks -->

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>