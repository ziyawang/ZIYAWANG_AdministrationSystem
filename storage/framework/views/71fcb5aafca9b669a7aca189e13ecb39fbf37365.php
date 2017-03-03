<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/member.css ')); ?>"/>
    <div id="breadcrumb" style="position:relative">
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>审核</a>
        <a href="#" class="current">审核列表</a>
        <a href="#" class="pull-right" id="export"> <div class="btn btn-primary " >导出</div></a>
    </div>
    <div class="widget-content nopadding">
        <form class="form-horizontal" method="post" action="<?php echo e(asset('check/index')); ?>" name="basic_validate"  novalidate="novalidate" />
        <table  class="table table-bordered table-striped">
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            <td>
                <div class="control-group">
                    <label class="control-label checkState" >审核状态</label>
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
                    <label class="control-label checkState">ID</label>
                    <div class="controls selectBox" >
                        <?php if(!empty($projectId)): ?>
                            <input type="text" name="projectId" id="projectId" value="<?php echo e($projectId); ?>"  style="width:80px" />
                        <?php else: ?>
                            <input type="text" name="projectId" id="projectId" value=""   style="width:80px"/>
                        <?php endif; ?>
                    </div>
                </div>
            </td>
            <td>
                <div class="control-group">
                    <label class="control-label checkState" >信息等级</label>
                    <div class="controls selectBox" >
                        <select  name="member" id="member"/>
                        <option value="3">--全部--<option>
                        <option value="1" <?php if(isset($member) && $member==1): ?> selected="selected" <?php endif; ?>>vip信息</option>
                        <option value="0" <?php if(isset($member) && $member==0): ?> selected="selected" <?php endif; ?>>普通信息</option>
                        <option value="2" <?php if(isset($member) && $member==2): ?> selected="selected" <?php endif; ?>>收费信息</option>
                        </select>
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
                    <label class="control-label checkState">类型</label>
                    <div class="controls selectBox" >
                       <?php /* <?php foreach($results as $result): ?>
                            <option value="<?php echo e($result->TypeID); ?>" <?php if(!empty($typeName) && $typeName==$result->TypeID): ?> selected="selected" <?php endif; ?>><?php echo e($result->TypeName); ?></option>
                        <?php endforeach; ?>*/ ?>
                        <select  name="typeName" id="typeName"/>
                            <option value="0">---全部---</option>
                            <option value="1" <?php if($typeName=="1"): ?> selected="selected" <?php endif; ?>>资产包</option>
                            <option value="6,17" <?php if($typeName=="6,17"): ?> selected="selected" <?php endif; ?>>融资信息</option>
                            <option value="12,16" <?php if($typeName=="12,16"): ?> selected="selected" <?php endif; ?>>固定资产</option>
                            <option value="18" <?php if($typeName=="18"): ?> selected="selected" <?php endif; ?>>企业商账</option>
                            <option value="19" <?php if($typeName=="19"): ?> selected="selected" <?php endif; ?>>个人债权</option>
                            <option value="20,21,22" <?php if($typeName=="20,21,22"): ?> selected="selected" <?php endif; ?>>法拍资产</option>
                        </select>
                    </div>
                </div>
            </td>
            <td>
                <div class="control-group">
                    <label class="control-label checkState">服务地区</label>
                    <div class="controls selectBox" >
                        <select  name="province" id="province"/>
                        <option   value="全国" <?php if(!empty($province) && $province=="全国"): ?> selected="selected" <?php endif; ?>>--全国--</option>
                        <option value="北京" <?php if(!empty($province) && $province=="北京"): ?> selected="selected" <?php endif; ?>>北京</option>
                        <option value="上海" <?php if(!empty($province) && $province=="上海"): ?> selected="selected" <?php endif; ?>>上海</option>
                        <option value="广东" <?php if(!empty($province) && $province=="广东"): ?> selected="selected" <?php endif; ?>>广东</option>
                        <option value="江苏" <?php if(!empty($province) && $province=="江苏"): ?> selected="selected" <?php endif; ?>>江苏</option>
                        <option value="山东" <?php if(!empty($province) && $province=="山东"): ?> selected="selected" <?php endif; ?>>山东</option>
                        <option value="浙江" <?php if(!empty($province) && $province=="浙江"): ?> selected="selected" <?php endif; ?>>浙江</option>
                        <option value="河南" <?php if(!empty($province) && $province=="河南"): ?> selected="selected" <?php endif; ?>>河南</option>
                        <option value="河北" <?php if(!empty($province) && $province=="河北"): ?> selected="selected" <?php endif; ?>>河北</option>
                        <option value="辽宁" <?php if(!empty($province) && $province=="辽宁"): ?> selected="selected" <?php endif; ?>>辽宁</option>
                        <option value="四川" <?php if(!empty($province) && $province=="四川"): ?> selected="selected" <?php endif; ?>>四川</option>
                        <option value="湖北" <?php if(!empty($province) && $province=="湖南"): ?> selected="selected" <?php endif; ?>>湖北</option>
                        <option value="湖南" <?php if(!empty($province) && $province=="湖南"): ?> selected="selected" <?php endif; ?>>湖南</option>
                        <option value="福建" <?php if(!empty($province) && $province=="福建"): ?> selected="selected" <?php endif; ?>>福建</option>
                        <option value="安徽" <?php if(!empty($province) && $province=="安徽"): ?> selected="selected" <?php endif; ?>>安徽</option>
                        <option value="陕西" <?php if(!empty($province) && $province=="陕西"): ?> selected="selected" <?php endif; ?>>陕西</option>
                        <option value="天津" <?php if(!empty($province) && $province=="天津"): ?> selected="selected" <?php endif; ?> >天津</option>
                        <option value="江西" <?php if(!empty($province) && $province=="江西"): ?> selected="selected" <?php endif; ?>>江西</option>
                        <option value="广西" <?php if(!empty($province) && $province=="广西"): ?> selected="selected" <?php endif; ?>>广西</option>
                        <option value="重庆" <?php if(!empty($province) && $province=="重庆"): ?> selected="selected" <?php endif; ?>>重庆</option>
                        <option value="吉林" <?php if(!empty($province) && $province=="吉林"): ?> selected="selected" <?php endif; ?>>吉林</option>
                        <option value="云南" <?php if(!empty($province) && $province=="云南"): ?> selected="selected" <?php endif; ?>>云南</option>
                        <option value="山西" <?php if(!empty($province) && $province=="山西"): ?> selected="selected" <?php endif; ?>>山西</option>
                        <option value="新疆" <?php if(!empty($province) && $province=="新疆"): ?> selected="selected" <?php endif; ?>>新疆</option>
                        <option value="贵州" <?php if(!empty($province) && $province=="贵州"): ?> selected="selected" <?php endif; ?>>贵州</option>
                        <option value="甘肃" <?php if(!empty($province) && $province=="甘肃"): ?> selected="selected" <?php endif; ?>>甘肃</option>
                        <option value="海南" <?php if(!empty($province) && $province=="海南"): ?> selected="selected" <?php endif; ?>>海南</option>
                        <option value="宁夏" <?php if(!empty($province) && $province=="宁夏"): ?> selected="selected" <?php endif; ?>>宁夏</option>
                        <option value="青海" <?php if(!empty($province) && $province=="青海"): ?> selected="selected" <?php endif; ?>>青海</option>
                        <option value="西藏" <?php if(!empty($province) && $province=="西藏"): ?> selected="selected" <?php endif; ?>>西藏</option>
                        <option value="黑龙江" <?php if(!empty($province) && $province=="黑龙江"): ?> selected="selected" <?php endif; ?>>黑龙江</option>
                        <option value="内蒙古" <?php if(!empty($province) && $province=="内蒙古"): ?> selected="selected" <?php endif; ?>>内蒙古</option>
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
            var province=$("#province").val();
            var state=$("#state").val();
            var phoneNumber=$("#phoneNumber").val();
            var member=$("#member").val();
            var url = 'http://admin.ziyawang.com/check/export?type='+type+"&province="+province+"&state="+state+"&phoneNumber="+phoneNumber+"&member="+member;
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
                    <th>联系人</th>
                    <th>注册号</th>
                    <th>发布时间</th>
                    <th>地址</th>
                    <th>信息类型</th>
                    <th>约谈次数</th>
                    <th>浏览次数</th>
                    <th>收藏次数</th>
                    <th>发布渠道</th>
                    <th>芽币</th>
                    <th>审核状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($datas as $data): ?>
                    <tr>
                        <td><?php echo e($data->number); ?></td>
                        <td><?php echo e($data->ProjectID); ?></td>
                        <?php if(!empty($data->ConnectPerson)): ?>
                        <td><?php echo e($data->ConnectPerson); ?></td>
                        <?php else: ?>
                            <td></td>
                        <?php endif; ?>
                        <td><?php echo e($data->phonenumber); ?></td>
                        <td><?php echo e($data->PublishTime); ?></td>
                        <td><?php echo e($data->ProArea); ?></td>
                        <td><?php echo e($data->TypeName); ?></td>
                        <td><a href="<?php echo e(asset("rush/detail/".$data->ProjectID)); ?>"><?php echo e($data->counts); ?></a></td>
                        <td><a href="<?php echo e(asset("check/viewDetail/".$data->ProjectID)); ?>"><?php echo e($data->ViewCount); ?></a></td>
                        <td><a href="<?php echo e(asset("check/collectDetail/".$data->ProjectID)); ?>"><?php echo e($data->CollectionCount); ?></a></td>
                        <td><?php echo e($data->Channel); ?></td>
                        <td><?php echo e($data->Price); ?></td>
                        <?php if($data->State==0): ?>
                            <td><p style="color: #149bdf">待审核</p></td>
                        <?php elseif($data->State==1): ?>
                            <td><p style="color: #149bdf">已审核</p></td>
                        <?php else: ?>
                            <td><p style="color: #149bdf">拒审核</p></td>
                        <?php endif; ?>
                        <td><a href="<?php echo e(url('check/detail/'.$data->ProjectID.'/'.$data->TypeID)); ?>">查看</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="pagination alternate">
            <?php echo $datas->appends(["state"=>$state,"province"=>$province,"typeName"=>$typeName,"phoneNumber"=>$phoneNumber,"member"=>$member])->render(); ?>

        </div>
    </div>
    <?php $__env->stopSection(); ?>
            <!-- TODO: Current Tasks -->

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>