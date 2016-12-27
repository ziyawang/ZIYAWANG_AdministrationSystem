<?php $__env->startSection('content'); ?>
    <style xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
        .radio input[type="radio"] {
            float: left;
            margin-left: 0px;
        }
        .newsType .checker span .checker span{background-position: -76px -240px;}
    </style>
    <script language="javascript" src="<?php echo e(asset('./js/YMDClass.js')); ?>"></script>
   <?php /* <?php if(session("msg")): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong><?php echo e(session("msg")); ?></strong>
        </div>
    <?php endif; ?>*/ ?>
    <div id="breadcrumb" style="position:relative">
        <a href="<?php echo e(asset('star/index')); ?>" title="审核列表" class="tip-bottom"><i class="icon-home"></i>星级审核</a>
        <a href="#" class="current">审核详情</a>
    </div>
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                            <span class="icon">
                                <i class="icon-align-justify"></i>
                            </span>
                    <h5>审核详情</h5>
                </div>
                <div class="widget-content nopadding">
                    <form class="form-horizontal" method="post" action="<?php echo e(asset('star/save')); ?>" />
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <input type="hidden" name="starPayIds" value="<?php echo e($starPayIds); ?>">
                    <?php foreach($datas as $data): ?>
                        <div class="control-group">
                                <label class="control-label">公司名称</label>
                                <div class="controls">
                                    <input type="text" name="ServiceName" id="ServiceName" value="<?php echo e($data->ServiceName); ?>"  readonly  />
                                </div>
                        </div>
                        <div class="control-group">
                                <label class="control-label">联系方式</label>
                                <div class="controls">
                                    <input type="text" name="ConnectPhone" id="ConnectPhone" value="<?php echo e($data->ConnectPhone); ?>"  readonly  />
                                </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">认证类型</label>
                            <div class="controls">
                                <input type="text" name="PayName" id="PayName" value="<?php echo e($data->PayName); ?>" readonly/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label ">认证费用(元)</label>
                            <div class="controls " >
                                <input type="text" name="PayMoney" id="PayMoney" value="<?php echo e($data->PayMoney/100); ?>" readonly/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">认证时间</label>
                            <div class="controls">
                                <input type="text" name="created" id="created" value="<?php echo e($data->created_at); ?>" readonly/>
                            </div>
                        </div>
                        <script src="<?php echo e(asset('./FileUpload/js/vendor/jquery.ui.widget.js')); ?>"></script>
                        <script src="<?php echo e(asset('./FileUpload/js/jquery.fileupload.js')); ?>"></script>
                        <script src="<?php echo e(asset('./FileUpload/js/jquery.iframe-transport.js')); ?>"></script>
                        <script src="<?php echo e(asset('./FileUpload/js/jquery.fileupload-process.js')); ?>"></script>
                        <script src="<?php echo e(asset('./FileUpload/js/jquery.fileupload-validate.js')); ?>"></script>
                        <style>
                            .pictures{float: left;margin-right: 20px;display: none;position: relative;margin-bottom: 28px;}
                            .pictures img{width: 150px;height: 150px;border: 1px solid #ccc;}
                            .deleteImg{position: absolute;width: 22px; height: 22px; background: #b8b8b8 url(/img/zhifu.png) no-repeat -147px -46px;cursor: pointer;right: 0;top: 0;}
                        </style>
                        <div class="control-group">
                            <label class="control-label">图片认证</label>
                            <div class="controls ec_right upload">
                                <div class="fileinput-button">
                                    <input id="fileupload" type="file" name="files[]" data-url="http://admin.ziyawang.cn/public/upload" multiple accept="image/png, image/gif, image/jpg, image/jpeg">
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <p id="nopz" style="margin-left:170px;" class="error"></p>
                            <div class="clearfix img_box" style="margin-left:200px;">
                                <?php if(!empty($PictureDes1)): ?>
                                    <div class="pictures" style="display: block"><img class="preview" id="PictureDes1" src="http://images.ziyawang.cn<?php echo e($PictureDes1); ?>"  picname=''><span class="deleteBtn1 deleteImg" title="删除" style="display: none"></span></div>
                                <?php else: ?>
                                    <div class="pictures"><img class="preview" id="PictureDes1" src=""  picname=''><span class="deleteBtn1 deleteImg" title="删除"></span></div>
                                <?php endif; ?>
                                <?php if(!empty($PictureDes2)): ?>
                                    <div class="pictures" style="display: block"><img class="preview" id="PictureDes2" src="http://images.ziyawang.cn<?php echo e($PictureDes2); ?>"  picname=''><span class="deleteBtn2 deleteImg" title="删除" style="display: none"></span></div>
                                <?php else: ?>
                                    <div class="pictures"><img class="preview" id="PictureDes2" src=""  picname=''><span class="deleteBtn2 deleteImg" title="删除"></span></div>
                                <?php endif; ?>
                                <?php if(!empty($PictureDes3)): ?>
                                    <div class="pictures" style="display: block"><img class="preview" id="PictureDes3" src="http://images.ziyawang.cn<?php echo e($PictureDes3); ?>"  picname=''><span class="deleteBtn3 deleteImg" title="删除" style="display: none"></span></div>
                                <?php else: ?>
                                    <div class="pictures"><img class="preview" id="PictureDes3" src=""  picname=''><span class="deleteBtn3 deleteImg" title="删除"></span></div>
                                <?php endif; ?>
                            </div>
                            <p><input type="hidden" name="PictureDes1" value="<?php echo e($PictureDes1); ?>"></p>
                            <p><input type="hidden" name="PictureDes2" value="<?php echo e($PictureDes2); ?>"></p>
                            <p><input type="hidden" name="PictureDes3" value="<?php echo e($PictureDes3); ?>"></p>
                        </div>

                        <script>
                            $(function(){
                                $('#fileupload').fileupload({
                                    dataType: 'json',
                                    formAcceptCharset :'utf-8',
                                    maxNumberOfFiles : 5,
                                    done: function (e, data) {
                                        $.each(data.result.files, function (index, file) {
                                            // console.log(file.name);
                                            $('input[name=PictureDes]').val(data);
                                            var name = $(".preview[src='']:first").attr('id');
                                            $("input[name='" + name + "']").val('/user/' + file.name);
                                            $(".preview[src='']:first").next().hide();
                                            $(".preview[src='']:first").attr({'src':encodeURI('http://images.ziyawang.cn/user/'+file.name), 'picname':file.name}).parent().show();
                                            $('#nopz').html('');
                                        });
                                    }
                                });
                                $('.pictures').hover(function(){
                                    $(this).children('.deleteImg').toggle();
                                })
                                $('.deleteImg').click(function(){
                                    var _this = $(this);
                                    $(_this).parent().hide();
                                    $(_this).hide();
                                    var typeId=  $(_this).prev().attr("id");
                                    $("input[name='"+typeId+"']").val("");
                                    $(_this).prev().attr('src','');
                                    var url = "http://admin.ziyawang.cn/public/upload?file=" + $(this).prev().attr('picname');
                                    $.ajax({
                                        'url':url,
                                        'type': 'DELETE',
                                        'success':function(msg){
                                        }
                                    })

                                })
                            });
                        </script>
                        <div class="control-group">
                            <label class="control-label">审核状态</label>
                            <div class="controls">
                                <select name="state" id="state">
                                    <option value="0" >-请选择-</option>
                                    <option value="2" <?php if($data->State==2): ?>selected="selected" <?php endif; ?>>已审核</option>
                                    <option value="1" <?php if($data->State==1): ?>selected="selected" <?php endif; ?>>拒审核</option>
                                </select>
                            </div>
                        </div>
                    <?php endforeach; ?>
                        <div class="form-actions">
                        <input type="submit" value="修改" class="btn btn-primary"/>
                        <a href="#"><input type=button value="返回" class="btn btn-primary" onclick="javascript:history.back(-1);"/></a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>