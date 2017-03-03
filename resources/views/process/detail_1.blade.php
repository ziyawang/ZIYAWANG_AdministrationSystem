@extends('layouts.master')
@section('content')
    <style xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
        .radio input[type="radio"] {
            float: left;
            margin-left: 0px;
        }
        .newsType .checker span .checker span{background-position: -76px -240px;}
    </style>
    <script language="javascript" src="{{asset('./js/YMDClass.js')}}"></script>
    <script src="{{asset('assets/layer/layer/layer.js')}}"></script>
    @if(session("msg"))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>{{session("msg")}}</strong>
        </div>
    @endif
    <div id="breadcrumb" style="position:relative">
        <a href="{{asset('process/index')}}" title="项目列表" class="tip-bottom"><i class="icon-home"></i>项目列表</a>
        <a href="#" class="current">编辑项目</a>
    </div>
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                            <span class="icon">
                                <i class="icon-align-justify"></i>
                            </span>
                    <h5>添加客户</h5>
                </div>
                <div class="widget-content nopadding">
                    <form class="form-horizontal" method="post" action="{{asset('process/saveUpdate')}}" />
                    @foreach($datas as $data)
                        <input type="hidden" name="typeId" value="{{$typeId}}">
                        <input type="hidden" name="projectId" value="{{$projectId}}">
                    <div class="control-group">
                        <label class="control-label checkState">类型</label>
                        <div class="controls selectBox" >
                            <select  name="typeName" id="typeName"/>
                                    <option value="资产包" @if($typeName=="资产包")selected="selected" @endif >资产包</option>
                                    <option value="融资信息" @if($typeName=="融资信息")selected="selected" @endif >融资信息</option>
                                    <option value="固定资产"  @if($typeName=="固定资产")selected="selected" @endif>固定资产</option>
                                    <option value="企业商账" @if($typeName=="企业商账")selected="selected" @endif >企业商账</option>
                                    <option value="个人债权" @if($typeName=="个人债权")selected="selected" @endif >个人债权</option>
                                    <option value="法拍资产" @if($typeName=="法拍资产")selected="selected" @endif >法拍资产</option>
                            </select>
                        </div>
                    </div>
                        <div class="control-group">
                            <label class="control-label checkState">信息等级</label>
                            <div class="controls selectBox" >
                                <select  name="starLevel" id="starLevel"/>
                                    <option value="一星"  @if($data->StarLevel=="一星")selected="selected" @endif >一星</option>
                                    <option value="二星"   @if($data->StarLevel=="二星")selected="selected" @endif >二星</option>
                                    <option value="三星"   @if($data->StarLevel=="三星")selected="selected" @endif >三星</option>
                                    <option value="四星"   @if($data->StarLevel=="四星")selected="selected" @endif >四星</option>
                                    <option value="五星"   @if($data->StarLevel=="五星")selected="selected" @endif >五星</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                        <label class="control-label">项目名称</label>
                        <div class="controls">
                            <input type="text" name="Title" id="Title" value="{{$data->Title}}"/>
                        </div>
                        <div class="control-group">
                            <label class="control-label checkState">请选择身份:</label>
                            <div class="controls selectBox" >
                                <select  name="Identity" id="Identity"/>
                                <option value="0">请选择</option>
                                <option value="项目持有者"  @if($data->Identity=="项目持有者") selected="selected" @endif>项目持有者</option>
                                <option value="FA（中介）" @if($data->Identity=="FA（中介）") selected="selected" @endif>FA（中介）</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label checkState">资产包类型</label>
                            <div class="controls selectBox" >
                                <select  name="AssetType" id="AssetType"/>
                                <option value="抵押" @if($data->AssetType=="抵押") selected="selected" @endif>抵押</option>
                                <option value="信用" @if($data->AssetType=="信用") selected="selected" @endif>信用</option>
                                <option value="综合" @if($data->AssetType=="综合") selected="selected" @endif>综合</option>
                                <option value="其他" @if($data->AssetType=="其他") selected="selected" @endif>其他</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label checkState">来源</label>
                            <div class="controls selectBox" >
                                <select  name="FromWhere" id="FromWhere"/>
                                <option value="银行" @if($data->AssetType=="银行") selected="selected" @endif>银行</option>
                                <option value="非银行机构" @if($data->AssetType=="非银行机构") selected="selected" @endif>非银行机构</option>
                                <option value="企业" @if($data->AssetType=="企业") selected="selected" @endif>企业</option>
                                <option value="其他" @if($data->AssetType=="其他") selected="selected" @endif>其他</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label checkState">地区</label>
                            <div class="controls selectBox" >
                                <select  name="ProArea" id="ProArea"/>
                                <option   value="请选择" >--请选择--</option>
                                <option   value="全国" @if( $data->ProArea=="全国") selected="selected" @endif>--全国--</option>
                                <option value="北京市" @if($data->ProArea=="北京市") selected="selected" @endif>北京市</option>
                                <option value="上海市" @if($data->ProArea=="上海市") selected="selected" @endif>上海市</option>
                                <option value="广东省" @if($data->ProArea=="广东省") selected="selected" @endif>广东省</option>
                                <option value="江苏省" @if($data->ProArea=="江苏省") selected="selected" @endif>江苏省</option>
                                <option value="山东省" @if($data->ProArea=="山东省") selected="selected" @endif>山东省</option>
                                <option value="浙江省" @if($data->ProArea=="浙江省") selected="selected" @endif>浙江省</option>
                                <option value="河南省" @if($data->ProArea=="河南省") selected="selected" @endif>河南省</option>
                                <option value="河北省" @if($data->ProArea=="河北省") selected="selected" @endif>河北省</option>
                                <option value="辽宁省" @if($data->ProArea=="辽宁省") selected="selected" @endif>辽宁省</option>
                                <option value="四川省" @if($data->ProArea=="四川省") selected="selected" @endif>四川省</option>
                                <option value="湖北省" @if($data->ProArea=="湖北省") selected="selected" @endif>湖北省</option>
                                <option value="湖南省" @if($data->ProArea=="湖南省") selected="selected" @endif>湖南省</option>
                                <option value="福建省" @if($data->ProArea=="福建省") selected="selected" @endif>福建省</option>
                                <option value="安徽省" @if($data->ProArea=="安徽省") selected="selected" @endif>安徽省</option>
                                <option value="陕西省" @if($data->ProArea=="陕西省") selected="selected" @endif>陕西省</option>
                                <option value="天津市" @if($data->ProArea=="天津市") selected="selected" @endif >天津市</option>
                                <option value="江西省" @if($data->ProArea=="江西省") selected="selected" @endif>江西省</option>
                                <option value="广西" @if($data->ProArea=="广西") selected="selected" @endif>广西</option>
                                <option value="重庆市" @if($data->ProArea=="重庆市") selected="selected" @endif>重庆市</option>
                                <option value="吉林省" @if($data->ProArea=="吉林省") selected="selected" @endif>吉林省</option>
                                <option value="云南省" @if($data->ProArea=="云南省") selected="selected" @endif>云南省</option>
                                <option value="山西省" @if($data->ProArea=="山西省") selected="selected" @endif>山西省</option>
                                <option value="新疆" @if($data->ProArea=="新疆") selected="selected" @endif>新疆</option>
                                <option value="贵州省" @if($data->ProArea=="贵州省") selected="selected" @endif>贵州省</option>
                                <option value="甘肃省" @if($data->ProArea=="甘肃省") selected="selected" @endif>甘肃省</option>
                                <option value="海南省" @if($data->ProArea=="海南省") selected="selected" @endif>海南省</option>
                                <option value="宁夏" @if($data->ProArea=="宁夏") selected="selected" @endif>宁夏</option>
                                <option value="青海省" @if($data->ProArea=="青海省") selected="selected" @endif>青海省</option>
                                <option value="西藏" @if($data->ProArea=="西藏") selected="selected" @endif>西藏</option>
                                <option value="黑龙江省" @if($data->ProArea=="黑龙江省") selected="selected" @endif>黑龙江省</option>
                                <option value="内蒙古" @if($data->ProArea=="内蒙古") selected="selected" @endif>内蒙古</option>
                                <option value="台湾省" @if($data->ProArea=="台湾省") selected="selected" @endif>台湾省</option>
                                <option value="香港" @if($data->ProArea=="香港") selected="selected" @endif>香港</option>
                                <option value="澳门" @if($data->ProArea=="澳门") selected="selected" @endif>澳门</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">总金额(万)</label>
                            <div class="controls">
                                <input type="number" name="TotalMoney" id="TotalMoney" value="{{$data->TotalMoney}}"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">转让价(万)</label>
                            <div class="controls">
                                <input type="number" name="TransferMoney" id="TransferMoney" value="{{$data->TransferMoney}}"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">本金</label>
                            <div class="controls">
                                <input type="number" name="Money" id="Money" value="{{$data->Money}}"/>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">利息</label>
                            <div class="controls">
                                <input type="number" name="Rate" id="Rate" value="{{$data->Rate}}"/>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">户数</label>
                            <div class="controls">
                                <input type="number" name="Counts" id="Counts" value="{{$data->Counts}}"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">尽调报告</label>
                            <div class="controls">
                                <input type="radio" name="Report" id="Report" value="有" @if($data->Report=="有") checked="checked" @endif/>有
                                <input type="radio" name="Report"  id="Report" value="无"  @if($data->Report=="无") checked="checked" @endif />无
                            </div>
                        </div>
                        <div class="control-group ">
                            <label class="control-label">出表时间</label>
                            <div class="controls" >
                                <input type="text" name="shortTime"  class="shortTime" value="{{$data->Time}}"  style="width:100px" />
                            </div>
                        </div>
                        <script>
                            $(function () {
                                $(".shortTime").datetimepicker({
                                    minView: "month", //选择日期后，不会再跳转去选择时分秒
                                    format: "yyyy-mm-dd", //选择日期后，文本框显示的日期格式
                                    language: 'zh-CN', //汉化
                                    autoclose:true //选择日期后自动关闭
                                });
                            });
                        </script>
                        @if(isset($pawn))
                        <div class="control-group">
                            <label class="control-label checkState">抵押物类型</label>
                            <div class="controls newsType">
                                <input type="checkbox" name="Pawn[]"  value="土地"   @if(in_array("土地",$pawn)) checked="checked" @endif/>土地
                                <input type="checkbox" name="Pawn[]"  value="住宅"  @if(in_array("住宅",$pawn)) checked="checked" @endif />住宅
                                <input type="checkbox" name="Pawn[]"   value="商业"  @if(in_array("商业",$pawn)) checked="checked" @endif />商业
                                <input type="checkbox" name="Pawn[]"   value="厂房"  @if(in_array("厂房",$pawn)) checked="checked" @endif />厂房
                                <input type="checkbox" name="Pawn[]"   value="设备"  @if(in_array("设备" ,$pawn)) checked="checked" @endif />设备
                                <input type="checkbox" name="Pawn[]"   value="其他"  @if(in_array("其他",$pawn)) checked="checked" @endif/>其他
                            </div>
                        </div>
                        @endif
                        @if(!empty($proLabels))
                        <div class="control-group">
                            <label class="control-label checkState">项目亮点</label>
                            <div class="controls newsType">
                                <input type="checkbox" name="ProLabel[]"  value="抵押足值"  @if(in_array("抵押足值",$proLabels)) checked="checked" @endif  />抵押足值
                                <input type="checkbox" name="ProLabel[]"  value="可拆包"  @if(in_array("可拆包",$proLabels)) checked="checked" @endif />可拆包
                                <input type="checkbox" name="ProLabel[]"   value="一手包"  @if(in_array("一手包",$proLabels)) checked="checked" @endif />一手包
                            </div>
                        </div>
                        @endif
                        <div class="control-group">
                            <label class="control-label">文字描述</label>
                            <div class="controls">
                                <textarea name="wordDes" id="wordDes" >{{$data->WordDes}}</textarea>
                            </div>
                        </div>
                        <script src="{{asset('./FileUpload/js/vendor/jquery.ui.widget.js')}}"></script>
                        <script src="{{asset('./FileUpload/js/jquery.fileupload.js')}}"></script>
                        <script src="{{asset('./FileUpload/js/jquery.iframe-transport.js')}}"></script>
                        <script src="{{asset('./FileUpload/js/jquery.fileupload-process.js')}}"></script>
                        <script src="{{asset('./FileUpload/js/jquery.fileupload-validate.js')}}"></script>
                        <style>
                            .pictures{float: left;margin-right: 20px;display: none;position: relative;margin-bottom: 28px;}
                            .pictures img{width: 150px;height: 150px;border: 1px solid #ccc;}
                            .deleteImg{position: absolute;width: 22px; height: 22px; background: #b8b8b8 url(/img/zhifu.png) no-repeat -147px -46px;cursor: pointer;right: 0;top: 0;}
                        </style>
                        <div class="control-group">
                            <label class="control-label">上传图片</label>
                            <div class="controls ec_right upload">
                                {{-- <div class="ec_right upload">--}}
                                <div class="fileinput-button">
                                    <!-- The file input field used as target for the file upload widget -->
                                    <input id="fileupload" type="file" name="files[]" data-url="http://admin.ziyawang.com/public/upload" multiple accept="image/png, image/gif, image/jpg, image/jpeg">
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <p id="nopz" style="margin-left:170px;" class="error"></p>
                            <div class="clearfix img_box" style="margin-left:200px;">
                                @if(!empty($data->PictureDes1))
                                    <div class="pictures" style="display: block"><img class="preview" id="PictureDes1" src="http://images.ziyawang.com{{$data->PictureDes1}}"  picname=''><span class="deleteBtn1 deleteImg" title="删除" style="display: none"></span></div>
                                @else
                                    <div class="pictures"><img class="preview" id="PictureDes1" src=""  picname=''><span class="deleteBtn1 deleteImg" title="删除"></span></div>
                                @endif
                                @if(!empty($data->PictureDes2))
                                    <div class="pictures" style="display: block"><img class="preview" id="PictureDes2" src="http://images.ziyawang.com{{$data->PictureDes2}}"  picname=''><span class="deleteBtn2 deleteImg" title="删除" style="display: none"></span></div>
                                @else
                                    <div class="pictures"><img class="preview" id="PictureDes2" src=""  picname=''><span class="deleteBtn2 deleteImg" title="删除"></span></div>
                                @endif
                                @if(!empty($data->PictureDes3))
                                    <div class="pictures" style="display: block"><img class="preview" id="PictureDes3" src="http://images.ziyawang.com{{$data->PictureDes3}}"  picname=''><span class="deleteBtn3 deleteImg" title="删除" style="display: none"></span></div>
                                @else
                                    <div class="pictures"><img class="preview" id="PictureDes3" src=""  picname=''><span class="deleteBtn3 deleteImg" title="删除"></span></div>
                                @endif
                                @if(!empty($data->PictureDes4))
                                    <div class="pictures" style="display: block"><img class="preview" id="PictureDes4" src="http://images.ziyawang.com{{$data->PictureDes4}}"  picname=''><span class="deleteBtn4 deleteImg" title="删除" style="display: none"></span></div>
                                @else
                                    <div class="pictures"><img class="preview" id="PictureDes4" src=""  picname=''><span class="deleteBtn4 deleteImg" title="删除"></span></div>
                                @endif
                                @if(!empty($data->PictureDes5))
                                    <div class="pictures" style="display: block"><img class="preview" id="PictureDes5" src="http://images.ziyawang.com{{$data->PictureDes5}}"  picname=''><span class="deleteBtn5 deleteImg" title="删除" style="display: none"></span></div>
                                @else
                                    <div class="pictures"><img class="preview" id="PictureDes5" src=""  picname=''><span class="deleteBtn5 deleteImg" title="删除"></span></div>
                                @endif
                            </div>
                            <p><input type="hidden" name="PictureDes1" value="{{$data->PictureDes1}}"></p>
                            <p><input type="hidden" name="PictureDes2" value="{{$data->PictureDes2}}"></p>
                            <p><input type="hidden" name="PictureDes3" value="{{$data->PictureDes3}}"></p>
                            <p><input type="hidden" name="PictureDes4" value="{{$data->PictureDes4}}"></p>
                            <p><input type="hidden" name="PictureDes5" value="{{$data->PictureDes5}}"></p>
                        </div>
                        <div class="control-group">
                            <label class="control-label">上传清单</label>
                            <div class="controls ec_right upload">
                                {{-- <div class="ec_right upload">--}}
                                <div class="fileinput-button">
                                    <!-- The file input field used as target for the file upload widget -->
                                    <input id="list_upload" type="file" name="files[]" data-url="http://admin.ziyawang.com/public/upload" multiple >
                                </div>
                            </div>
                        </div>
                        <p><input type="hidden" name="AssetList" id="qd"></p>
                        <script type="text/javascript">
                            $(function() {
                                $('#list_upload').fileupload({
                                    dataType: 'json',
                                    limitMultiFileUploadSize : 10000,
                                    maxNumberOfFiles : 1,
                                    done: function (e, data) {
                                        $.each(data.result.files, function (index, file) {
                                            if(file.size > 0) {
                                                $('input[name=AssetList]').val(file.name);
                                                layer.msg('清单上传成功！');
                                                $('#listname').html('文件已上传');
                                                $('#list_upload').attr('disabled',true);
                                            } else {
                                                layer.msg('文件大小超过限制,上传失败！');
                                            }
                                        });
                                    }
                                });
                            });
                        </script>
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
                        <div class="control-group">
                            <label class="control-label">联系人</label>
                            <div class="controls">
                                <input type="text" name="ConnectPerson" id="ConnectPerson" value="{{$data->ConnectPerson}}"   />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">联系方式</label>
                            <div class="controls">
                                <input type="text" name="ConnectPhone" id="ConnectPhone" value="{{$data->ConnectPhone}}"   />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label checkState">项目负责人</label>
                            <div class="controls selectBox" >
                                <select  name="Responsible" id="Responsible"/>
                                {{--<option value="0">请选择</option>--}}
                                @foreach($auths as $val)
                                    <option value="{{$val->id}}" @if($data->Responsible==$val->id) selected="selected" @endif>{{$val->Name}}</option>
                                    @endforeach
                                    </select>
                            </div>
                        </div>
                        @endforeach
                        <div class="control-group">
                            <label class="control-label" >服务方名称</label>
                            <div class="controls">
                                <input type="text" name="SerName" id="SerName" value="{{$ServiceNames[0]}}"   />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" style="padding-top: 35px;">服务方信息</label>
                            <div class="controls">
                                <table id="table">
                                    <tr>
                                        <th>联系人</th>
                                        <th>电话</th>
                                        <th></th>
                                    </tr>
                                    @foreach($Names as $key=>$name)
                                        @if($key==0)
                                            <tr>
                                                <td> <input type="text" name="Name[0][]" value="{{$name->Name}}"  /></td>
                                                <td> <input type="text" name="Name[0][]" value="{{$name->PhoneNumber}}" /></td>
                                                <td id="add">+添加</td>
                                            </tr>
                                       @else
                                            <tr>
                                                <td> <input type="text" name="Name[{{$key}}][]" value="{{$name->Name}}"  /></td>
                                                <td> <input type="text" name="Name[{{$key}}][]" value="{{$name->PhoneNumber}}" /></td>
                                                <td onclick='reduce(this)'>-删除</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" style="padding-top: 35px;">项目推进进度</label>
                            <div class="controls">
                                <table id="tableTo">
                                    <tr>
                                        <th>时间</th>
                                        <th>事件</th>
                                        <th>备注</th>
                                    </tr>
                                    @foreach($Events as $keys=>$event)
                                        @if($keys==0)
                                            <tr>
                                                <td> <input type="text" name="Events[0][]" class="shortTime" value="{{$event->Time}}" /></td>
                                                <td> <input type="text" name="Events[0][]" value="{{$event->Events}}" style='margin-right: 20px;width: 600px;'/></td>
                                                <td> <input type="text" name="Events[0][]" value="{{$event->Remark}}" /></td>
                                                <td id="addTo">+添加</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td> <input type="text" name="Events[{{$keys}}][]" class="shortTime" value="{{$event->Time}}" /></td>
                                                <td> <input type="text" name="Events[{{$keys}}][]" value="{{$event->Events}}" style='margin-right: 20px;width: 600px;'/></td>
                                                <td> <input type="text" name="Events[{{$keys}}][]" value="{{$event->Remark}}" /></td>
                                                <td onclick='reduceTo(this)'>+删除</td>
                                            </tr>
                                        @endif
                                        @endforeach
                                </table>
                            </div>
                        </div>

                        <div class="form-actions">
                            <input type="submit" value="保存" class="btn btn-primary"/>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                $(function (){

                    $("#typeName").on("change",function(){
                        var typeName=$("#typeName").val();
                        location.href="http://admin.ziyawang.com/process/add?typeName="+typeName;
                    })
                })
            </script>
            <script>
                $(function () {
                    $(".shortTime").datetimepicker({
                        minView: "month", //选择日期后，不会再跳转去选择时分秒
                        format: "yyyy-mm-dd", //选择日期后，文本框显示的日期格式
                        language: 'zh-CN', //汉化
                        autoclose:true //选择日期后自动关闭
                    });
                });
            </script>
            <script>
                $(function(){
                    var num=0;
                    var number=0;
                    $("#add").on("click",function(){
                        num=num+1;
                        var str="<tr><td><input type='text' name='Name["+num+"][]' value=''  /></td><td><input type='text' name='Name["+num+"][]' value=''  /></td><td onclick='reduce(this)'>"+"-删除"+"</td></tr>";
                        $("#table").append(str);
                    })
                    $("#addTo").on("click",function(){
                        number=number+1;
                        var str="<tr> <td> <input type='text' name='Events["+number+"][]' class='shortTime' value=''/></td><td><input type='text' name='Events["+number+"][]' value='' style='margin-right: 20px;width: 600px;' /></td><td><input type='text' name='Events["+number+"][]' value=''/></td><td onclick='reduceTo(this)'>"+"-删除"+"</td></tr>";
                        $("#tableTo").append(str);
                        $(".shortTime").datetimepicker({
                            minView: "month", //选择日期后，不会再跳转去选择时分秒
                            format: "yyyy-mm-dd", //选择日期后，文本框显示的日期格式
                            language: 'zh-CN', //汉化
                            autoclose:true //选择日期后自动关闭
                        });
                    })
                })
                function reduce(obj){
                    $(obj).parent().remove();
                }
                function reduceTo(obj){
                    $(obj).parent().remove();
                }

            </script>
        </div>
    </div>
@endsection