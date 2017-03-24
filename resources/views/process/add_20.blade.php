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
        <a href="{{asset('customer/index')}}" title="审核列表" class="tip-bottom"><i class="icon-home"></i>客户档案</a>
        <a href="#" class="current">添加客户</a>
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
                    </div>
                    <div class="control-group" id="AssetType">
                        <label class="control-label">资产类型</label>
                        <div class="controls">
                            <input type="radio" name="AssetType"   value="21"checked="checked" />土地
                            <input type="radio" name="AssetType"    value="20" />房产
                            <input type="radio" name="AssetType"    value="22" />汽车
                        </div>
                    </div>
                    <div class="control-group" id="Brand" style="display: none">
                        <label class="control-label">品牌型号</label>
                        <div class="controls">
                            <input type="text" name="Brand"  value="" />
                        </div>
                    </div>
                    <div class="control-group" id="Area">
                        <label class="control-label">面积</label>
                        <div class="controls">
                            <input type="number" name="Area"  value=""/>
                        </div>
                    </div>
                    <div class="control-group"  id="Nature">
                        <label class="control-label checkState">性质</label>
                        <div class="controls selectBox" >
                            <select  name="Nature"/>
                            <option value="工业"selected="selected">工业</option>
                            <option value="商业" >商业</option>
                            <option value="住宅">住宅</option>
                            <option value="其他">其他</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">起拍价</label>
                        <div class="controls">
                            <input type="number" name="Money" id="Money" value=""/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label ">拍卖地点</label>
                        <div class="controls " >
                            <input type="text" name="ProArea" id="ProArea" value=""/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label ">拍卖时间</label>
                        <div class="controls " >
                            <input type="text" name="Year" class="shortTime" value=""/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label checkState">拍卖阶段</label>
                        <div class="controls selectBox" >
                            <select  name="State" id="State"/>
                            <option value="一拍" selected="selected">一拍</option>
                            <option value="二拍" >二拍</option>
                            <option value="三拍" >三拍</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label ">处置单位</label>
                        <div class="controls " >
                            <input type="text" name="Court" id="Court" value=""  />
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
                  {{--  <div class="control-group">
                        <label class="control-label">服务方名称</label>
                        <div class="controls">
                            <input type="text" name="SerName" id="SerName" value=""   />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label paddingTop" style="padding-top: 35px;">服务方信息</label>
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
                        <label class="control-label paddingTop" style="padding-top: 35px;">项目推进进度</label>
                        <div class="controls">
                            <table id="tableTo">
                                <tr>
                                    <th>时间</th>
                                    <th>事件</th>
                                    <th>备注</th>
                                </tr>
                                <tr>
                                    <td> <input type="text" name="Events[0][]" class="shortTime" value="" /></td>
                                    <td> <input type="text" name="Events[0][]" value="" style='margin-right: 20px;width: 600px;' /></td>
                                    <td> <input type="text" name="Events[0][]" value="" /></td>
                                    <td id="addTo">+添加</td>
                                </tr>
                            </table>
                        </div>
                    </div>--}}
                    <div class="form-actions">
                        <input type="submit" value="保存" class="btn btn-primary"/>
                    </div>
                    </form>
                </div>
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
        <script>
            $(function (){

                $("#typeName").on("change",function(){
                    var typeName=$("#typeName").val();
                    location.href="http://admin.ziyawang.com/process/add?typeName="+typeName;
                })
            })
        </script>
     {{--   <script>
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
                    var str="<tr><td><input type='text' name='Events["+number+"][]' class='shortTime' value=''/></td><td><input type='text' name='Events["+number+"][]' value='' style='margin-right: 20px;width: 600px;' /></td><td><input type='text' name='Events["+number+"][]' value=''/></td><td onclick='reduceTo(this)'>"+"-删除"+"</td></tr>";
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


        </script>--}}
        <script>
            $(function() {
                $("input[type='radio']").on("click", function () {
                    var types = $("#AssetType input[type='radio']:checked").val();
                    if(types=="22"){

                        $("#Brand").show();
                        $("#Area").hide();
                        $("#Nature").hide();
                    }else{
                        $("#Brand").hide();
                        $("#Area").show();
                        $("#Nature").show();
                    }
                })
            })
        </script>
    </div>
    </div>
@endsection