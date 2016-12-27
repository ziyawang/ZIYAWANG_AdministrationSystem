<?php $__env->startSection('content'); ?>
    <style>
        .newsType .checker span .checker span{background-position: -76px -240px;}
    </style>
    <script src="<?php echo e(asset('assets/layer/layer/layer.js')); ?>"></script>
    <div id="breadcrumb" style="position:relative">
        <a href="<?php echo e(asset("service/index")); ?>" title="服务方列表" class="tip-bottom"><i class="icon-home"></i>服务方</a>
        <a href="#" class="current">服务方详情</a>
    </div>
    <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                            <span class="icon">
                                <i class="icon-align-justify"></i>
                            </span>
                        <h5>服务方详情</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="<?php echo e(asset('service/update')); ?>"/>
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                        <?php foreach($datas as $data): ?>
                            <input type="hidden" name="id" value="<?php echo e($id); ?>" id="serviceId">
                            <div class="control-group">
                                <label class="control-label">公司名称</label>
                                <div class="controls">
                                    <input type="text" name="serviceName" id="serviceName" value="<?php echo e($data->ServiceName); ?>"
                                           />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">联系人</label>
                                <div class="controls">
                                    <input type="text" name="connectPerson" id="connectPerson" value="<?php echo e($data->ConnectPerson); ?>"
                                           readonly/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">联系方式</label>
                                <div class="controls">
                                    <input type="text" name="number" id="number" value="<?php echo e($data->ConnectPhone); ?>"
                                         />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">地区</label>
                                <div class="controls">
                                    <input type="text" name="area" id="area" value="<?php echo e($data->ServiceLocation); ?>"
                                           readonly/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">服务类型</label>
                                <div class="controls">
                                    <input type="text" name="type" id="type" value="<?php echo e($data->ServiceType); ?>"/>
                                </div>
                            </div>
                            <div class="control-group" style="display: none;" id="changeType">
                                <label class="control-label">修改服务类型</label>
                                <div class="controls newsType">
                                    <input type="checkbox" name="types[]" value="01" <?php if(in_array("01",$serviceType)): ?>checked="checked" <?php endif; ?> />资产包收购
                                    <input type="checkbox" name="types[]" value="02" <?php if(in_array("02",$serviceType)): ?>checked="checked" <?php endif; ?> />催收机构
                                    <input type="checkbox" name="types[]" value="03" <?php if(in_array("03",$serviceType)): ?>checked="checked" <?php endif; ?> />律师事务所
                                    <input type="checkbox" name="types[]" value="04" <?php if(in_array("04",$serviceType)): ?>checked="checked" <?php endif; ?> />保理公司
                                    <input type="checkbox" name="types[]" value="05" <?php if(in_array("05",$serviceType)): ?>checked="checked" <?php endif; ?> />典当担保
                                    <input type="checkbox" name="types[]" value="06"  <?php if(in_array("06",$serviceType)): ?>checked="checked" <?php endif; ?>/>投融资服务
                                    <input type="checkbox" name="types[]" value="10" <?php if(in_array("10",$serviceType)): ?>checked="checked" <?php endif; ?> />尽职调查
                                    <input type="checkbox" name="types[]" value="12" <?php if(in_array("12",$serviceType)): ?>checked="checked" <?php endif; ?> />资产收购
                                    <input type="checkbox" name="types[]" value="13"  <?php if(in_array("13",$serviceType)): ?>checked="checked" <?php endif; ?>/>资金过桥
                                    <input type="checkbox" name="types[]" value="14" <?php if(in_array("14",$serviceType)): ?>checked="checked" <?php endif; ?> />债权收购
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">服务地区</label>
                                <div class="controls">
                                    <input type="text" name="ServiceArea" id="url" value="<?php echo e($data->ServiceArea); ?>"
                                           readonly/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">服务方认证时间</label>
                                <div class="controls">
                                    <input type="text" name="time" id="time" value="<?php echo e($data->created_at); ?>"
                                           readonly/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">公司简介</label>
                                <div class="controls">
                                    <input type="text" name="SerInt" id="url" value="<?php echo e($data->ServiceIntroduction); ?>"
                                           />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">服务方资质认证</label>
                                <div class="controls">
                                    <input type="hidden" id="filepath" name="servicelogo[]">
                                    <input id="file_upload" name="file_upload"  multiple="true">
                                </div>
                                <div class="controls  span3">
                                   <div><img id="confirmationP1" alt=""  <?php if(!empty($data->ConfirmationP1)): ?> src="<?php echo e('Http://images.ziyawang.com'.$data->ConfirmationP1); ?>"   <?php endif; ?>/>
                                       <span><a href="<?php echo e(asset('Http://images.ziyawang.com'."$data->ConfirmationP1")); ?>"><i class="icon-download confirmationP1"  <?php if(empty($data->ConfirmationP1)): ?> style="display:none" <?php endif; ?>></i></a>&nbsp&nbsp
                                           <i class="icon-trash confirmationP1"  <?php if(empty($data->ConfirmationP1)): ?> style="display:none" <?php endif; ?>></i>
                                       </span>
                                   </div>
                                    <div><img  id="confirmationP2" alt=""  <?php if(!empty($data->ConfirmationP2)): ?>  src="<?php echo e('Http://images.ziyawang.com'.$data->ConfirmationP2); ?>" <?php endif; ?>/>
                                        <span><a href="<?php echo e(asset('Http://images.ziyawang.com'."$data->ConfirmationP2")); ?>"><i class="icon-download confirmationP2"  <?php if(empty($data->ConfirmationP2)): ?> style="display:none" <?php endif; ?>></i></a>&nbsp&nbsp
                                            <i class="icon-trash confirmationP2"  <?php if(empty($data->ConfirmationP2)): ?> style="display:none" <?php endif; ?>></i>
                                        </span>
                                    </div>
                                        <div><img  id="confirmationP3" alt=""  <?php if(!empty($data->ConfirmationP3)): ?>  src="<?php echo e('Http://images.ziyawang.com'.$data->ConfirmationP3); ?>"  <?php endif; ?>/>
                                            <span><a href="<?php echo e(asset('Http://images.ziyawang.com'."$data->ConfirmationP3")); ?>"><i class="icon-download confirmationP3"  <?php if(empty($data->ConfirmationP3)): ?> style="display:none" <?php endif; ?>></i></a>&nbsp&nbsp
                                                <i class="icon-trash confirmationP3"  <?php if(empty($data->ConfirmationP3)): ?> style="display:none" <?php endif; ?>></i>
                                            </span>
                                        </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">会员类型</label>
                                <div class="controls">
                                    <select name="MemberType" id="MemberType">
                                        <option value="0" > --请选择-- </option>
                                        <option value="7" >资产包(月)</option>
                                        <option value="8" >资产包(年)</option>
                                        <option value="3"  >融资信息(季)</option>
                                        <option value="4"  >融资信息(年)</option>
                                        <option value="5" >固定资产(季)</option>
                                        <option value="6" >固定资产(年)</option>
                                        <option value="9" >企业商账(季)</option>
                                        <option value="10" >企业商账(年)</option>
                                        <option value="1" >个人债权(季)</option>
                                        <option value="2" >个人债权(年)</option>
                                    </select>
                                </div>
                            </div>
                        <script>
                            $("#MemberType").on("change",function(){
                                    var memberId=$("#MemberType").val();
                                    var serviceId=$("#serviceId").val();
                                    layer.open({
                                        type: 2,
                                        title: false,
                                        closeBtn:1,
                                        area: ['500px', '300px'],
                                      /* skin: 'layui-layer-nobg', //没有背景色*/
                                       skin: 'layui-layer-lan',
                                        shadeClose:false,
                                        content:"http://admin.ziyawang.com/members/recharge?memberId="+memberId+"&serviceId="+serviceId,
                                        yes:function(index){
                                            layer.close(index);
                                            alert(1)
                                        },
                                        btn2:function(index){
                                            layer.close(index);
                                           alert(2);
                                        }
                                    });
                                });
                        </script>
                            <div class="control-group">
                                <label class="control-label">审核状态</label>
                                <div class="controls">
                                    <select name="state" id="state">
                                        <option value="1" <?php if($data->State==1): ?>selected="selected" <?php endif; ?>>已审核</option>
                                        <option value="2" <?php if($data->State==2): ?>selected="selected" <?php endif; ?>>拒审核</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group" id="remark" style="display: none">
                                <label class="control-label">备注</label>
                                <div class="controls">
                                    <input type="text" name="remark" value="<?php echo e($data->Remark); ?>"/>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="form-actions">
                            <input type="submit" value="修改" class="btn btn-primary"/>
                            <a href="javascript:void(0)" id="back"><input type=button value="返回"
                                                                      class="btn btn-primary" onclick="javascript:history.back(-1);"/></a>
                        </div>
                        </form>
                    </div>
                </div>
        </div>
        <script type="text/javascript">
            $("#state").on("change", function () {
                var result2 = $(this).val();
                if ( result2==2) {
                    $("#remark").show();
                } else {
                    $("#remark").hide();
                }
            });
            $(function(){
                $(".confirmationP1").on("click",function(){
                    var id=$("input[name='id']").val();
                    $("#confirmationP1").removeAttrs("src");
                    $(".confirmationP1").hide();
                });
            });
            $(function(){
                $(".confirmationP2").on("click",function(){
                    var id=$("input[name='id']").val();
                    $("#confirmationP2").removeAttrs("src")
                    $(".confirmationP2").hide();
                });
            });
            $(function(){
                $(".confirmationP3").on("click",function(){
                    var id=$("input[name='id']").val();
                        $("#confirmationP3").removeAttrs("src")
                         $(".confirmationP3").hide();
                });
            });
            <?php $timestamp = time();?>
           $(function() {
                $("#file_upload").uploadifive({
                    'buttonText' : '上传图片',
                    'formData'     : {
                        'timestamp' : '<?php echo $timestamp;?>',
                        '_token'     : "<?php echo e(csrf_token()); ?>"
                    },
                    'removeCompleted' : true,
                    'fileSizeLimit': 1024,
                    'uploadLimit'     : 3,
                    'uploadScript'     :"<?php echo e(url('/service/upload')); ?>",
                    'onUploadComplete' : function(file, data) {
                        $('#filepath').val(data);
                        var p1=$("#confirmationP1").attr('src');
                        var p2=$("#confirmationP2").attr('src');
                        var p3=$("#confirmationP3").attr('src');
                        if(typeof(p1)=="undefined"){
                            $('#confirmationP1').attr('src',"Http://images.ziyawang.com"+data);
                            $(".confirmationP1").show();
                            //var data= $('#confirmationP1').attr('src');
                            var id=$("input[name='id']").val();
                            $.ajax({
                                url:"<?php echo e(asset('service/editHandle')); ?>",
                                data:{"id":id,"data":data,"title":"ConfirmationP1","_token":"<?php echo e(csrf_token()); ?>"},
                                dataType:"json",
                                type:"post",
                                success:function(mag){
                                    if(mag.state==0){
                                        alert("您添加失败!");
                                    }
                                }
                            });
                        }else if(typeof(p2)=="undefined"){
                            $('#confirmationP2').attr('src',"Http://images.ziyawang.com"+data);
                            $(".confirmationP2").show();
                            //var data= $('#confirmationP2').attr('src');
                            var id=$("input[name='id']").val();
                            $.ajax({
                                url:"<?php echo e(asset('service/editHandle')); ?>",
                                data:{"id":id,"data":data,"title":"ConfirmationP2","_token":"<?php echo e(csrf_token()); ?>"},
                                dataType:"json",
                                type:"post",
                                success:function(mag){
                                    if(mag.state==0){
                                        alert("您添加失败!");
                                    }
                                }
                            });
                        }else{
                            $('#confirmationP3').attr('src',"Http://images.ziyawang.com"+data);
                            $(".confirmationP3").show();
                           // var data= $('#confirmationP3').attr('src');
                            var id=$("input[name='id']").val();
                            $.ajax({
                                url:"<?php echo e(asset('service/editHandle')); ?>",
                                data:{"id":id,"data":data,"title":"ConfirmationP3","_token":"<?php echo e(csrf_token()); ?>"},
                                dataType:"json",
                                type:"post",
                                success:function(mag){
                                    if(mag.state==0){
                                        alert("您添加失败!");
                                    }
                                }
                            });
                        }
                    }
                });
            });
            $("#type").on("click",function(){
                $("#changeType").css("display","block");
            });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>