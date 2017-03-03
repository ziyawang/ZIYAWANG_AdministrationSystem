@extends('layouts.master')
@section('content')
    <style xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
        .radio input[type="radio"] {
            float: left;
            margin-left: 0px;
        }
        #uniform-undefined{
            padding-top:0;
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
        <a href="#" class="current">添加项目</a>
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
                    <form class="form-horizontal" method="post" action="{{asset('process/saveAdd')}}" />
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
                                <option value="一星"  >一星</option>
                                <option value="二星"  >二星</option>
                                <option value="三星"  >三星</option>
                                <option value="四星"  >四星</option>
                                <option value="五星"  >五星</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">项目名称</label>
                        <div class="controls">
                            <input type="text" name="Title" id="Title" value=""/>
                        </div>
                    <div class="control-group">
                        <label class="control-label checkState">请选择身份:</label>
                        <div class="controls selectBox" >
                            <select  name="Identity" id="Identity"/>
                            <option value="0">请选择</option>
                            <option value="项目持有者">项目持有者</option>
                            <option value="FA（中介）">FA（中介）</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label checkState">资产包类型</label>
                        <div class="controls selectBox" >
                            <select  name="AssetType" id="AssetType"/>
                            <option value="抵押"  selected="selected" >抵押</option>
                            <option value="信用" >信用</option>
                            <option value="综合" >综合</option>
                            <option value="其他" >其他</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label checkState">来源</label>
                        <div class="controls selectBox" >
                            <select  name="FromWhere" id="FromWhere"/>
                                <option value="非银行机构"  selected="selected">非银行机构</option>
                                <option value="银行" >银行</option>
                                <option value="企业">企业</option>
                                <option value="其他">其他</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label checkState">地区</label>
                        <div class="controls selectBox" >
                            <select  name="ProArea" id="ProArea"/>
                            <option   value="请选择" >--请选择--</option>
                            <option value="北京市" >北京市</option>
                            <option value="上海市" >上海市</option>
                            <option value="广东省" >广东省</option>
                            <option value="江苏省" >江苏省</option>
                            <option value="山东省">山东省</option>
                            <option value="浙江省" >浙江省</option>
                            <option value="河南省" >河南省</option>
                            <option value="河北省" >河北省</option>
                            <option value="辽宁省">辽宁省</option>
                            <option value="四川省" >四川省</option>
                            <option value="湖北省" >湖北省</option>
                            <option value="湖南省" >湖南省</option>
                            <option value="福建省" >福建省</option>
                            <option value="安徽省" >安徽省</option>
                            <option value="陕西省" >陕西省</option>
                            <option value="天津市"  >天津市</option>
                            <option value="江西省" >江西省</option>
                            <option value="广西" >广西</option>
                            <option value="重庆市" >重庆市</option>
                            <option value="吉林省" >吉林省</option>
                            <option value="云南省" >云南省</option>
                            <option value="山西省" >山西省</option>
                            <option value="新疆" >新疆</option>
                            <option value="贵州省" >贵州省</option>
                            <option value="甘肃省">甘肃省</option>
                            <option value="海南省" >海南省</option>
                            <option value="宁夏" >宁夏</option>
                            <option value="青海省" >青海省</option>
                            <option value="西藏" >西藏</option>
                            <option value="黑龙江省" >黑龙江省</option>
                            <option value="内蒙古" >内蒙古</option>
                            <option value="台湾省" >台湾省</option>
                            <option value="香港" >香港</option>
                            <option value="澳门" >澳门</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">总金额(万)</label>
                        <div class="controls">
                            <input type="number" name="TotalMoney" id="TotalMoney" value=""/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">转让价(万)</label>
                        <div class="controls">
                            <input type="number" name="TransferMoney" id="TransferMoney" value=""/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">本金</label>
                        <div class="controls">
                            <input type="number" name="Money" id="Money" value=""/>
                        </div>
                    </div>

                        <div class="control-group">
                            <label class="control-label">利息</label>
                            <div class="controls">
                                <input type="number" name="Rate" id="Rate" value=""/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">户数</label>
                            <div class="controls">
                                <input type="number" name="Counts" id="Counts" value=""/>
                            </div>
                        </div>
                    <div class="control-group">
                        <label class="control-label"  style="padding-top: 11px;">尽调报告</label>
                        <div class="controls">
                            <input type="radio" name="Report"  value="有" /><span style="display: inline-block;vertical-align: 0;">有</span>
                            <input type="radio" name="Report"  value="无"  /><span style="display: inline-block;vertical-align: 0;">无</span>
                        </div>
                    </div>
                    <div class="control-group ">
                        <label class="control-label">出表时间</label>
                        <div class="controls" >
                            <input type="text" name="shortTime"  class="shortTime" value=""  style="width:100px" />
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
                    <div class="control-group">
                        <label class="control-label checkState">抵押物类型</label>
                        <div class="controls newsType">
                            <input type="checkbox" name="Pawn[]" id="Pawn" value="土地"  />土地
                            <input type="checkbox" name="Pawn[]"  id="Pawn" value="住宅" />住宅
                            <input type="checkbox" name="Pawn[]"  id="Pawn" value="商业"  />商业
                            <input type="checkbox" name="Pawn[]"  id="Pawn" value="厂房"  />厂房
                            <input type="checkbox" name="Pawn[]"  id="Pawn" value="设备"  />设备
                            <input type="checkbox" name="Pawn[]"  id="Pawn" value="其他" />其他
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label checkState">项目亮点</label>
                        <div class="controls newsType">
                            <input type="checkbox" name="ProLabel[]" id="ProLabel" value="抵押足值"  />抵押足值
                            <input type="checkbox" name="ProLabel[]"  id="ProLabel" value="可拆包"  />可拆包
                            <input type="checkbox" name="ProLabel[]"  id="ProLabel" value="一手包"  />一手包
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">文字描述</label>
                        <div class="controls">
                            <textarea name="wordDes" id="wordDes" ></textarea>
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
                            <div class="pictures"><img class="preview" id="PictureDes1" src=""  picname=''><span class="deleteBtn1 deleteImg" title="删除"></span></div>
                            <div class="pictures"><img class="preview" id="PictureDes2" src=""  picname=''><span class="deleteBtn2 deleteImg" title="删除"></span></div>
                            <div class="pictures"><img class="preview" id="PictureDes3" src=""  picname=''><span class="deleteBtn3 deleteImg" title="删除"></span></div>
                            <div class="pictures"><img class="preview" id="PictureDes4" src=""  picname=''><span class="deleteBtn4 deleteImg" title="删除"></span></div>
                            <div class="pictures"><img class="preview" id="PictureDes5" src=""  picname=''><span class="deleteBtn5 deleteImg" title="删除"></span></div>
                        </div>
                        <p><input type="hidden" name="PictureDes1" value=""></p>
                        <p><input type="hidden" name="PictureDes2" value=""></p>
                        <p><input type="hidden" name="PictureDes3" value=""></p>
                        <p><input type="hidden" name="PictureDes4" value=""></p>
                        <p><input type="hidden" name="PictureDes5" value=""></p>
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
                            <input type="text" name="ConnectPerson" id="ConnectPerson" value=""   />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">联系方式</label>
                        <div class="controls">
                            <input type="text" name="ConnectPhone" id="ConnectPhone" value=""   />
                        </div>
                    </div>
                        <div class="control-group">
                            <label class="control-label checkState">项目负责人</label>
                            <div class="controls selectBox" >
                                <select  name="Responsible" id="Responsible"/>
                                {{--<option value="0">请选择</option>--}}
                                @foreach($Names as $val)
                                    <option value="{{$val->id}}">{{$val->Name}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">服务方名称</label>
                            <div class="controls">
                                <input type="text" name="SerName" id="SerName" value=""   />
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
                                    <tr>
                                        <td> <input type="text" name="Name[0][]" value=""  /></td>
                                        <td> <input type="text" name="Name[0][]" value="" /></td>
                                        <td id="add">+添加</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" style="padding-top: 35px;">项目推进进度</label>
                            <div class="controls">
                                <table id="tableTo">
                                    <tr>
                                        <th>时间</th>
                                        <th >事件</th>
                                        <th>备注</th>
                                    </tr>
                                    <tr>
                                        <td> <input type="text" name="Events[0][]" class="shortTime" value="" /></td>
                                        <td > <input type="text" name="Events[0][]" value="" style="margin-right: 20px;width: 600px;"/></td>
                                        <td> <input type="text" name="Events[0][]" value="" /></td>
                                        <td id="addTo">+添加</td>
                                    </tr>
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
                        var str="<tr> <td> <input type='text' name='Events["+number+"][]' class='shortTime' value=''/></td><td><input type='text' name='Events["+number+"][]' value=''  style='margin-right: 20px;width: 600px;'/></td><td><input type='text' name='Events["+number+"][]' value=''/></td><td onclick='reduceTo(this)'>"+"-删除"+"</td></tr>";
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