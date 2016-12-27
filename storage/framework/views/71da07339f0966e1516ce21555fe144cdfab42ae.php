<?php $__env->startSection('content'); ?>
    <style xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
        .radio input[type="radio"] {
            float: left;
            margin-left: 0px;
        }
        .newsType .checker span .checker span{background-position: -76px -240px;}
    </style>
    <script language="javascript" src="<?php echo e(asset('./js/YMDClass.js')); ?>"></script>
    <?php if(session("msg")): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong><?php echo e(session("msg")); ?></strong>
        </div>
    <?php endif; ?>
    <div id="breadcrumb" style="position:relative">
        <a href="<?php echo e(asset('check/index')); ?>" title="审核列表" class="tip-bottom"><i class="icon-home"></i>审核</a>
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
                    <form class="form-horizontal" method="post" action="<?php echo e(asset('check/update')); ?>" />
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <input type="hidden" name="typeId" value="<?php echo e($typeId); ?>">
                    <?php foreach($datas as $data): ?>
                        <input type="hidden" name="id" value="<?php echo e($id); ?>">
                        <input type="hidden" name="typeId" value="<?php echo e($typeId); ?>">
                        <div class="control-group">
                            <label class="control-label"><span style="color:red;font-size:24px">*</span>标题</label>
                            <div class="controls">
                                <?php if(!empty($data->Title)): ?>
                                    <textarea name="Title" id="Title" ><?php echo e($data->Title); ?></textarea>
                                <?php else: ?>
                                    <textarea name="Title" id="Title" ></textarea>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php if(!empty($data->ConnectPerson)): ?>
                        <div class="control-group">
                            <label class="control-label">联系人</label>
                            <div class="controls">
                                <input type="text" name="ConnectPerson" id="ConnectPerson" value="<?php echo e($data->ConnectPerson); ?>"   />
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($data->Identity)): ?>
                        <div class="control-group">
                            <label class="control-label checkState">身份</label>
                            <div class="controls selectBox" >
                                <select  name="Identity" id="Identity"/>
                                <option value="项目持有者" <?php if($data->Identity=="项目持有者"): ?> selected="selected" <?php endif; ?>>项目持有者</option>
                                <option value="FA（中介)" <?php if($data->Identity=="FA（中介）"): ?> selected="selected" <?php endif; ?>>FA（中介）</option>
                                </select>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($data->ConnectPhone)): ?>
                                <div class="control-group">
                                    <label class="control-label">联系方式</label>
                                    <div class="controls">
                                        <input type="text" name="ConnectPhone" id="ConnectPhone" value="<?php echo e($data->ConnectPhone); ?>"   />
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="control-group">
                                    <label class="control-label">联系方式</label>
                                    <div class="controls">
                                        <input type="text" name="ConnectPhone" id="ConnectPhone" value="<?php echo e($data->phonenumber); ?>"   />
                                    </div>
                                </div>
                        <?php endif; ?>
                        <div class="control-group">
                            <label class="control-label checkState">地区</label>
                                <div class="controls selectBox" >
                                    <select  name="ProArea" id="ProArea"/>
                                    <option   value="全国" <?php if( $data->ProArea=="全国"): ?> selected="selected" <?php endif; ?>>--全国--</option>
                                    <option value="北京市" <?php if($data->ProArea=="北京市"): ?> selected="selected" <?php endif; ?>>北京市</option>
                                    <option value="上海市" <?php if($data->ProArea=="上海市"): ?> selected="selected" <?php endif; ?>>上海市</option>
                                    <option value="广东省" <?php if($data->ProArea=="广东省"): ?> selected="selected" <?php endif; ?>>广东省</option>
                                    <option value="江苏省" <?php if($data->ProArea=="江苏省"): ?> selected="selected" <?php endif; ?>>江苏省</option>
                                    <option value="山东省" <?php if($data->ProArea=="山东省"): ?> selected="selected" <?php endif; ?>>山东省</option>
                                    <option value="浙江省" <?php if($data->ProArea=="浙江省"): ?> selected="selected" <?php endif; ?>>浙江省</option>
                                    <option value="河南省" <?php if($data->ProArea=="河南省"): ?> selected="selected" <?php endif; ?>>河南省</option>
                                    <option value="河北省" <?php if($data->ProArea=="河北省"): ?> selected="selected" <?php endif; ?>>河北省</option>
                                    <option value="辽宁省" <?php if($data->ProArea=="辽宁省"): ?> selected="selected" <?php endif; ?>>辽宁省</option>
                                    <option value="四川省" <?php if($data->ProArea=="四川省"): ?> selected="selected" <?php endif; ?>>四川省</option>
                                    <option value="湖北省" <?php if($data->ProArea=="湖北省"): ?> selected="selected" <?php endif; ?>>湖北省</option>
                                    <option value="湖南省" <?php if($data->ProArea=="湖南省"): ?> selected="selected" <?php endif; ?>>湖南省</option>
                                    <option value="福建省" <?php if($data->ProArea=="福建省"): ?> selected="selected" <?php endif; ?>>福建省</option>
                                    <option value="安徽省" <?php if($data->ProArea=="安徽省"): ?> selected="selected" <?php endif; ?>>安徽省</option>
                                    <option value="陕西省" <?php if($data->ProArea=="陕西省"): ?> selected="selected" <?php endif; ?>>陕西省</option>
                                    <option value="天津市" <?php if($data->ProArea=="天津市"): ?> selected="selected" <?php endif; ?> >天津市</option>
                                    <option value="江西省" <?php if($data->ProArea=="江西省"): ?> selected="selected" <?php endif; ?>>江西省</option>
                                    <option value="广西" <?php if($data->ProArea=="广西"): ?> selected="selected" <?php endif; ?>>广西</option>
                                    <option value="重庆市" <?php if($data->ProArea=="重庆市"): ?> selected="selected" <?php endif; ?>>重庆市</option>
                                    <option value="吉林省" <?php if($data->ProArea=="吉林省"): ?> selected="selected" <?php endif; ?>>吉林省</option>
                                    <option value="云南省" <?php if($data->ProArea=="云南省"): ?> selected="selected" <?php endif; ?>>云南省</option>
                                    <option value="山西省" <?php if($data->ProArea=="山西省"): ?> selected="selected" <?php endif; ?>>山西省</option>
                                    <option value="新疆" <?php if($data->ProArea=="新疆"): ?> selected="selected" <?php endif; ?>>新疆</option>
                                    <option value="贵州省" <?php if($data->ProArea=="贵州省"): ?> selected="selected" <?php endif; ?>>贵州省</option>
                                    <option value="甘肃省" <?php if($data->ProArea=="甘肃省"): ?> selected="selected" <?php endif; ?>>甘肃省</option>
                                    <option value="海南省" <?php if($data->ProArea=="海南省"): ?> selected="selected" <?php endif; ?>>海南省</option>
                                    <option value="宁夏" <?php if($data->ProArea=="宁夏"): ?> selected="selected" <?php endif; ?>>宁夏</option>
                                    <option value="青海省" <?php if($data->ProArea=="青海省"): ?> selected="selected" <?php endif; ?>>青海省</option>
                                    <option value="西藏" <?php if($data->ProArea=="西藏"): ?> selected="selected" <?php endif; ?>>西藏</option>
                                    <option value="黑龙江省" <?php if($data->ProArea=="黑龙江省"): ?> selected="selected" <?php endif; ?>>黑龙江省</option>
                                    <option value="内蒙古" <?php if($data->ProArea=="内蒙古"): ?> selected="selected" <?php endif; ?>>内蒙古</option>
                                    <option value="台湾省" <?php if($data->ProArea=="台湾省"): ?> selected="selected" <?php endif; ?>>台湾省</option>
                                    <option value="香港" <?php if($data->ProArea=="香港"): ?> selected="selected" <?php endif; ?>>香港</option>
                                    <option value="澳门" <?php if($data->ProArea=="澳门"): ?> selected="selected" <?php endif; ?>>澳门</option>
                                    </select>
                                </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">信息类型</label>
                            <div class="controls">
                                <input type="text" name="TypeName" id="TypeName" value="<?php echo e($data->TypeName); ?>" readonly/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label checkState">资产包类型</label>
                            <div class="controls selectBox" >
                                <select  name="AssetType" id="AssetType"/>
                                <option value="抵押" <?php if($data->AssetType=="抵押"): ?> selected="selected" <?php endif; ?>>抵押</option>
                                <option value="信用" <?php if($data->AssetType=="信用"): ?> selected="selected" <?php endif; ?>>信用</option>
                                <option value="综合" <?php if($data->AssetType=="综合"): ?> selected="selected" <?php endif; ?>>综合</option>
                                <option value="其他" <?php if($data->AssetType=="其他"): ?> selected="selected" <?php endif; ?>>其他</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label checkState">来源</label>
                            <div class="controls selectBox" >
                                <select  name="FromWhere" id="FromWhere"/>
                                <option value="银行" <?php if($data->AssetType=="银行"): ?> selected="selected" <?php endif; ?>>银行</option>
                                <option value="非银行机构" <?php if($data->AssetType=="非银行机构"): ?> selected="selected" <?php endif; ?>>非银行机构</option>
                                <option value="企业" <?php if($data->AssetType=="企业"): ?> selected="selected" <?php endif; ?>>企业</option>
                                <option value="其他" <?php if($data->AssetType=="其他"): ?> selected="selected" <?php endif; ?>>其他</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">总金额</label>
                            <div class="controls">
                                <input type="number" name="TotalMoney" id="TotalMoney" value="<?php echo e($data->TotalMoney); ?>"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">转让价</label>
                            <div class="controls">
                                <input type="number" name="TransferMoney" id="TransferMoney" value="<?php echo e($data->TransferMoney); ?>"/>
                            </div>
                        </div>
                    <?php if(!empty($data->Money)): ?>
                        <div class="control-group">
                            <label class="control-label">本金</label>
                            <div class="controls">
                                <input type="number" name="Money" id="Money" value="<?php echo e($data->Money); ?>"/>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($data->Rate)): ?>
                        <div class="control-group">
                            <label class="control-label">利息</label>
                            <div class="controls">
                                <input type="number" name="Rate" id="Rate" value="<?php echo e($data->Rate); ?>"/>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($data->Counts)): ?>
                        <div class="control-group">
                            <label class="control-label">户数</label>
                            <div class="controls">
                                <input type="number" name="Counts" id="Counts" value="<?php echo e($data->Counts); ?>"/>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($data->Report)): ?>
                        <div class="control-group">
                            <label class="control-label">尽调报告</label>
                            <div class="controls">
                                <input type="radio" name="Report" id="Report" value="有" <?php if($data->Report=="有"): ?> checked="checked" <?php endif; ?>/>有
                                <input type="radio" name="Report"  id="Report" value="无"  <?php if($data->Report=="无"): ?> checked="checked" <?php endif; ?> />无
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($data->Counts)): ?>
                       <div class="control-group ">
                            <label class="control-label">出表时间</label>
                            <div class="controls" >
                                <input type="text" name="shortTime"  id="shortTime" value="<?php echo e($data->Time); ?>"  style="width:100px" readonly/>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($data->Pawn)): ?>
                        <div class="control-group">
                            <label class="control-label checkState">抵押物类型</label>
                            <div class="controls newsType">
                                    <input type="checkbox" name="Pawn[]" id="Pawn" value="土地"   <?php if(in_array("土地",$pawn)): ?> checked="checked" <?php endif; ?>/>土地
                                    <input type="checkbox" name="Pawn[]"  id="Pawn" value="住宅"  <?php if(in_array("住宅",$pawn)): ?> checked="checked" <?php endif; ?> />住宅
                                    <input type="checkbox" name="Pawn[]"  id="Pawn" value="商业"  <?php if(in_array("商业",$pawn)): ?> checked="checked" <?php endif; ?> />商业
                                    <input type="checkbox" name="Pawn[]"  id="Pawn" value="厂房"  <?php if(in_array("厂房",$pawn)): ?> checked="checked" <?php endif; ?> />厂房
                                    <input type="checkbox" name="Pawn[]"  id="Pawn" value="设备"  <?php if(in_array("设备" ,$pawn)): ?> checked="checked" <?php endif; ?> />设备
                                    <input type="checkbox" name="Pawn[]"  id="Pawn" value="其他"  <?php if(in_array("其他",$pawn)): ?> checked="checked" <?php endif; ?> />其他
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($data->ProLabel)): ?>
                        <div class="control-group">
                            <label class="control-label checkState">项目亮点</label>
                            <div class="controls newsType">
                                    <input type="checkbox" name="ProLabel[]" id="ProLabel" value="抵押足值"   <?php if(in_array("抵押足值",$proLabels)): ?> checked="checked" <?php endif; ?>/>抵押足值
                                    <input type="checkbox" name="ProLabel[]"  id="ProLabel" value="可拆包"  <?php if(in_array("可拆包",$proLabels)): ?> checked="checked" <?php endif; ?> />可拆包
                                    <input type="checkbox" name="ProLabel[]"  id="ProLabel" value="一手包"  <?php if(in_array("一手包",$proLabels)): ?> checked="checked" <?php endif; ?> />一手包
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="control-group">
                            <label class="control-label">文字描述</label>
                            <div class="controls">
                                <textarea name="wordDes" id="eordDes" ><?php echo e($data->WordDes); ?></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">语音描述</label>
                            <div class="controls">
                                <input type="text" name="videoDes" id="videoDes" value="<?php echo e($data->VoiceDes); ?> " readonly/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">发布时间</label>
                            <div class="controls">
                                <input type="text" name="PublishTime" id="PublishTime" value="<?php echo e($data->PublishTime); ?>"
                                       />
                            </div>
                        </div>
                       <div class="control-group">
                            <label class="control-label">发布方式</label>
                            <div class="controls">
                                <input type="radio" name="publisher" id="publisher_0" value="0" <?php if($data->Publisher==0): ?> checked="checked" <?php endif; ?>/>自然发布
                                <input type="radio" name="publisher"  id="publisher_1" value="1"  <?php if($data->Publisher==1): ?> checked="checked" <?php endif; ?> />委托发布
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">浏览次数</label>
                            <div class="controls">
                                <input type="text" name="ViewCount" id="ViewCount" value="<?php echo e($data->ViewCount); ?>" readonly
                                       />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">收藏次数</label>
                            <div class="controls">
                                <input type="text" name="CollectionCount" id="CollectionCount" value="<?php echo e($data->CollectionCount); ?>" readonly/>
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
                            <label class="control-label">相关凭证</label>
                            <div class="controls ec_right upload">
                           <?php /* <div class="ec_right upload">*/ ?>
                                <div class="fileinput-button">
                                    <!-- The file input field used as target for the file upload widget -->
                                    <input id="fileupload" type="file" name="files[]" data-url="http://admin.ziyawang.com/public/upload" multiple accept="image/png, image/gif, image/jpg, image/jpeg">
                                </div>
                                </div>
                            </div>
                        <div class="control-group">
                            <p id="nopz" style="margin-left:170px;" class="error"></p>
                            <div class="clearfix img_box" style="margin-left:200px;">
                                <?php if(!empty($data->PictureDes1)): ?>
                                    <div class="pictures" style="display: block"><img class="preview" id="PictureDes1" src="http://images.ziyawang.com<?php echo e($data->PictureDes1); ?>"  picname=''><span class="deleteBtn1 deleteImg" title="删除" style="display: none"></span></div>
                                <?php else: ?>
                                    <div class="pictures"><img class="preview" id="PictureDes1" src=""  picname=''><span class="deleteBtn1 deleteImg" title="删除"></span></div>
                               <?php endif; ?>
                                <?php if(!empty($data->PictureDes2)): ?>
                                    <div class="pictures" style="display: block"><img class="preview" id="PictureDes2" src="http://images.ziyawang.com<?php echo e($data->PictureDes2); ?>"  picname=''><span class="deleteBtn2 deleteImg" title="删除" style="display: none"></span></div>
                                <?php else: ?>
                                    <div class="pictures"><img class="preview" id="PictureDes2" src=""  picname=''><span class="deleteBtn2 deleteImg" title="删除"></span></div>
                                <?php endif; ?>
                                <?php if(!empty($data->PictureDes3)): ?>
                                    <div class="pictures" style="display: block"><img class="preview" id="PictureDes3" src="http://images.ziyawang.com<?php echo e($data->PictureDes3); ?>"  picname=''><span class="deleteBtn3 deleteImg" title="删除" style="display: none"></span></div>
                                <?php else: ?>
                                    <div class="pictures"><img class="preview" id="PictureDes3" src=""  picname=''><span class="deleteBtn3 deleteImg" title="删除"></span></div>
                                <?php endif; ?>
                                <?php if(!empty($data->PictureDes4)): ?>
                                    <div class="pictures" style="display: block"><img class="preview" id="PictureDes4" src="http://images.ziyawang.com<?php echo e($data->PictureDes4); ?>"  picname=''><span class="deleteBtn4 deleteImg" title="删除" style="display: none"></span></div>
                                <?php else: ?>
                                    <div class="pictures"><img class="preview" id="PictureDes4" src=""  picname=''><span class="deleteBtn4 deleteImg" title="删除"></span></div>
                                <?php endif; ?>
                                <?php if(!empty($data->PictureDes5)): ?>
                                    <div class="pictures" style="display: block"><img class="preview" id="PictureDes5" src="http://images.ziyawang.com<?php echo e($data->PictureDes5); ?>"  picname=''><span class="deleteBtn5 deleteImg" title="删除" style="display: none"></span></div>
                                <?php else: ?>
                                    <div class="pictures"><img class="preview" id="PictureDes5" src=""  picname=''><span class="deleteBtn5 deleteImg" title="删除"></span></div>
                                <?php endif; ?>
                            </div>
                            <p><input type="hidden" name="PictureDes1" value="<?php echo e($data->PictureDes1); ?>"></p>
                            <p><input type="hidden" name="PictureDes2" value="<?php echo e($data->PictureDes2); ?>"></p>
                            <p><input type="hidden" name="PictureDes3" value="<?php echo e($data->PictureDes3); ?>"></p>
                            <p><input type="hidden" name="PictureDes4" value="<?php echo e($data->PictureDes4); ?>"></p>
                            <p><input type="hidden" name="PictureDes5" value="<?php echo e($data->PictureDes5); ?>"></p>
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
                                                $(".preview[src='']:first").attr({'src':encodeURI('http://images.ziyawang.com/user/'+file.name), 'picname':file.name}).parent().show();
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
                                        var typeId=  $(_this).prev().attr("id");
                                        $("input[name='"+typeId+"']").val("");
                                        $(_this).hide();
                                        $(_this).prev().attr('src','');
                                        var url = "http://admin.ziyawang.com/public/upload?file=" + $(this).prev().attr('picname');
                                        $.ajax({
                                            'url':url,
                                            'type': 'DELETE',
                                            'success':function(msg){
                                            }
                                        })

                                    })
                                });
                            </script>
                            <script>
                                $(function () {
                                    $("#shortTime").datetimepicker({
                                        minView: "month", //选择日期后，不会再跳转去选择时分秒
                                        format: "yyyy-mm-dd", //选择日期后，文本框显示的日期格式
                                        language: 'zh-CN', //汉化
                                        autoclose:true //选择日期后自动关闭
                                    });
                                });
                            </script>
                        <?php /* <div class="control-group">
                            <label class="control-label">相关凭证</label>
                            <div class="controls">
                                <input type="hidden" id="filepath" name="checklogo">
                                <input id="file_upload" name="file_upload"  multiple="true">
                            </div>
                            <div class="controls  span3">
                                <div><img id="PictureDes1" alt=""  <?php if(!empty($data->PictureDes1)): ?> src="<?php echo e('Http://images.ziyawang.com'.$data->PictureDes1); ?>"   <?php endif; ?>/>
                                       <span><a href="<?php echo e('Http://images.ziyawang.com'.$data->PictureDes1); ?>"><i class="icon-download PictureDes1" <?php if(empty($data->PictureDes1)): ?> style="display:none" <?php endif; ?>></i></a>&nbsp&nbsp
                                           <i class="icon-trash PictureDes1" <?php if(empty($data->PictureDes1)): ?> style="display:none" <?php endif; ?> ></i>
                                       </span>
                                </div>
                                <div><img  id="PictureDes2" alt=""  <?php if(!empty($data->PictureDes2)): ?>  src="<?php echo e('Http://images.ziyawang.com'.$data->PictureDes2); ?>" <?php endif; ?>/>
                                        <span><a href="<?php echo e('Http://images.ziyawang.com'.$data->PictureDes2); ?>"><i class="icon-download PictureDes2"  <?php if(empty($data->PictureDes2)): ?> style="display:none" <?php endif; ?>></i></a>&nbsp&nbsp
                                            <i class="icon-trash PictureDes2" <?php if(empty($data->PictureDes2)): ?> style="display:none" <?php endif; ?>></i>
                                        </span>
                                </div>
                                <div><img  id="PictureDes3" alt=""  <?php if(!empty($data->PictureDes3)): ?>  src="<?php echo e('Http://images.ziyawang.com'.$data->PictureDes3); ?>"  <?php endif; ?>/>
                                            <span><a href="<?php echo e('Http://images.ziyawang.com'.$data->PictureDes3); ?>"><i class="icon-download PictureDes3 " <?php if(empty($data->PictureDes3)): ?> style="display:none" <?php endif; ?> ></i></a>&nbsp&nbsp
                                                <i class="icon-trash PictureDes3" <?php if(empty($data->PictureDes3)): ?> style="display:none" <?php endif; ?> ></i>
                                            </span>
                                </div>
                            </div>
                        </div>*/ ?>
                        <div class="control-group">
                            <label class="control-label">审核状态</label>
                            <div class="controls">
                                <select name="state" id="state">
                                    <option value="0" >-请选择-</option>
                                    <option value="1" <?php if($data->CertifyState==1): ?>selected="selected" <?php endif; ?>>已审核</option>
                                    <option value="2" <?php if($data->CertifyState==2): ?>selected="selected" <?php endif; ?>>拒审核</option>
                                    <option value="3" <?php if($data->CertifyState==3): ?>selected="selected" <?php endif; ?>>删除</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group" id="remark" style="display: none">
                            <label class="control-label">备注</label>
                            <div class="controls">
                                <input type="text" name="remark" id="date" value=""/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">信息状态</label>
                            <div class="controls">
                                <input type="radio" name="togetherType" id="togetherType" checked="checked" value="0" <?php if($data->PublishState==0): ?> checked="checked" <?php endif; ?>/>未合作
                                <input type="radio" name="togetherType"  id="togetherType" value="1"  <?php if($data->PublishState==1): ?> checked="checked" <?php endif; ?> />已合作
                            </div>
                        </div>
                        <div class="control-group">
                                <label class="control-label">信息等级</label>
                                <div class="controls" id="messageType">
                                    <input type="radio" name="member" id="member_0" value="0" <?php if($data->Member==0): ?> checked="checked" <?php endif; ?>/>普通
                                    <input type="radio" name="member"  id="member_1" value="1"  <?php if($data->Member==1): ?> checked="checked" <?php endif; ?> />vip
                                    <input type="radio" name="member"  id="member_2" value="2"  <?php if($data->Member==2): ?> checked="checked" <?php endif; ?> />收费
                                </div>
                            </div>
                        <?php if($data->Member==2): ?>
                                <div class="control-group" id="goldId" >
                                    <label class="control-label">芽币</label>
                                    <div class="controls">
                                        <input type="number" name="gold" id="gold" value="<?php echo e($data->Price); ?>"/>
                                    </div>
                                </div>

                            <?php else: ?>
                                <div class="control-group" id="goldId" style="display: none">
                                    <label class="control-label">芽币</label>
                                    <div class="controls">
                                        <input type="number" name="gold" id="gold" value=""/>
                                    </div>
                                </div>
                            <?php endif; ?>
                    <?php /*    <div class="control-group">
                            <label class="control-label">备注信息</label>
                            <div class="controls">
                                <?php if(!empty($data->CompanyDes)): ?>
                                    <textarea name="companyDes" id="comDes" /> <?php echo e($data->CompanyDes); ?></textarea>
                                <?php else: ?>
                                    <textarea name="companyDes" id="comDes" /></textarea>
                                <?php endif; ?>
                            </div>
                        </div>*/ ?>
                        <div class="control-group">
                            <label class="control-label">备注信息</label>
                            <div class="controls">
                                <?php if(!empty($data->CompanyDes)): ?>
                                <textarea name="companyDes" class="ckeditor" id="comDes"><?php echo e($data->CompanyDes); ?></textarea>
                                <?php else: ?>
                                <textarea name="companyDes" class="ckeditor" id="comDes" ></textarea>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="control-group" id="remark">
                            <label class="control-label">清单</label>
                            <div class="controls">
                                <a href="<?php echo e('Http://files.ziyawang.com/'.$data->AssetList); ?>"  id="upload"> <div class="btn btn-success " >下载清单</div></a>
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
    <script>
        $("input[type='radio']").on("click",function(){
            var type=$("#messageType input[type='radio']:checked").val();
            if(type==2){
                $("#goldId").css("display","block");
            }else{
                $("#goldId").css("display","none");
            }
        });
        $("#state").on("change", function () {
            var result2 = $(this).val();
            if (result2==2) {
                $("#remark").show();
            } else {
                $("#remark").hide();
            }
        });
        /*$(function(){
            $(".icon-trash.PictureDes1").on("click",function(){
                var id=$("input[name='id']").val();
                var title=$("#PictureDes1").attr("id")
                $.ajax({
                    url:"",
                    data:{"id":id,"title":title,"_token":""},
                    dataType:"json",
                    type:"post",
                    success:function(msg){
                        if(msg.state==1){
                            $("#PictureDes1").removeAttrs("src");
                            $(".PictureDes1").hide();
                        }
                    }
                });
            });
        });
        $(function(){
            $(".icon-trash.PictureDes2").on("click",function(){
                var id=$("input[name='id']").val();
                var title=$("#PictureDes2").attr("id")
                $.ajax({
                    url:"",
                    data:{"id":id,"title":title,"_token":""},
                    dataType:"json",
                    type:"post",
                    success:function(msg){
                        if(msg.state==1){
                            $("#PictureDes2").removeAttrs("src");
                            $(".PictureDes2").hide();
                        }
                    }
                });
            });
        });
        $(function(){
            $(".icon-trash.PictureDes3").on("click",function(){
                var id=$("input[name='id']").val();
                var title=$("#PictureDes3").attr("id")
                $.ajax({
                    url:"",
                    data:{"id":id,"title":title,"_token":""},
                    dataType:"json",
                    type:"post",
                    success:function(msg){
                        if(msg.state==1){
                            $("#PictureDes3").removeAttrs("src");
                            $(".PictureDes3").hide();
                        }
                    }
                });
            });
        });
        <?php $timestamp = time();?>
       $(function() {
            $("#file_upload").uploadifive({
                'buttonText' : '上传图片',
                'formData'     : {
                    'timestamp' : '',
                    '_token'     : ""
                },
                'removeCompleted' : true,
                'fileSizeLimit':1024,
                'uploadLimit'     :3,
                'uploadScript'     :"",
                'onUploadComplete' : function(file, data) {
                    $('#filepath').val(data);
                    //$('#confirmationP1').attr('src', data);
                    var p1=$("#PictureDes1").attr('src');
                    var p2=$("#PictureDes2").attr('src');
                    var p3=$("#PictureDes3").attr('src');
                    if(typeof(p1)=="undefined"){
                        $('#PictureDes1').attr('src','Http://images.ziyawang.com'+data);
                        $(".PictureDes1").show();
                        // var data= $('#PictureDes1').attr('src');
                        var id=$("input[name='id']").val();
                        $.ajax({
                            url:"",
                            data:{"id":id,"data":data,"title":"PictureDes1","_token":""},
                            dataType:"json",
                            type:"post",
                            success:function(mag){
                                if(mag.state==0){
                                    alert("您添加失败!");
                                }
                            }
                        });
                    }else if(typeof(p2)=="undefined"){
                        $('#PictureDes2').attr('src','Http://images.ziyawang.com'+ data);
                        $(".PictureDes2").show();
                        // var data= $('#PictureDes2').attr('src');
                        var id=$("input[name='id']").val();
                        $.ajax({
                            url:"",
                            data:{"id":id,"data":data,"title":"PictureDes2","_token":""},
                            dataType:"json",
                            type:"post",
                            success:function(mag){
                                if(mag.state==0){
                                    alert("您添加失败!");
                                }
                            }
                        });
                    }else{
                        $('#PictureDes3').attr('src','Http://images.ziyawang.com'+ data);
                        $(".PictureDes3").show();
                        // var data= $('#PictureDes3').attr('src');
                        var id=$("input[name='id']").val();
                        $.ajax({
                            url:"",
                            data:{"id":id,"data":data,"title":"PictureDes3","_token":"}"},
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
        });*/
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>