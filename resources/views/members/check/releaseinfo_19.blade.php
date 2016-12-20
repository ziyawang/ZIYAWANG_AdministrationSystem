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
    @if(session("msg"))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>{{session("msg")}}</strong>
        </div>
    @endif
    <div id="breadcrumb" style="position:relative">
        <a href="{{asset('check/index')}}" title="审核列表" class="tip-bottom"><i class="icon-home"></i>审核</a>
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
                    <form class="form-horizontal" method="post" action="{{asset('check/update')}}" />
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="typeId" value="{{ $typeId }}">
                    @foreach($datas as $data)
                        <input type="hidden" name="id" value="{{$id}}">
                        <div class="control-group">
                            <label class="control-label"><span style="color:red;font-size:24px">*</span>标题</label>
                            <div class="controls">
                                @if(!empty($data->Title))
                                    <textarea name="Title" id="Title" >{{$data->Title}}</textarea>
                                @else
                                    <textarea name="Title" id="Title" ></textarea>
                                @endif
                            </div>
                        </div>
                        @if(!empty($data->ConnectPerson))
                            <div class="control-group">
                                <label class="control-label">联系人</label>
                                <div class="controls">
                                    <input type="text" name="ConnectPerson" id="ConnectPerson" value="{{$data->ConnectPerson}}"   />
                                </div>
                            </div>
                        @endif
                        @if(!empty($data->Identity))
                            <div class="control-group">
                                <label class="control-label checkState">身份</label>
                                <div class="controls selectBox" >
                                    <select  name="Identity" id="Identity"/>
                                    <option value="项目持有者" @if($data->Identity=="债权人") selected="selected" @endif>债权人</option>
                                    <option value="FA（中介)" @if($data->Identity=="FA（中介）") selected="selected" @endif>FA（中介）</option>
                                    </select>
                                </div>
                            </div>
                        @endif
                        @if(!empty($data->ConnectPhone))
                            <div class="control-group">
                                <label class="control-label">联系方式</label>
                                <div class="controls">
                                    <input type="text" name="ConnectPhone" id="ConnectPhone" value="{{$data->ConnectPhone}}"   />
                                </div>
                            </div>
                        @else
                            <div class="control-group">
                                <label class="control-label">联系方式</label>
                                <div class="controls">
                                    <input type="text" name="ConnectPhone" id="ConnectPhone" value="{{$data->phonenumber}}"   />
                                </div>
                            </div>
                        @endif
                        <div class="control-group">
                            <label class="control-label">信息类型</label>
                            <div class="controls">
                                <input type="text" name="TypeName" id="TypeName" value="{{$data->TypeName}}" readonly/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">总金额</label>
                            <div class="controls">
                                <input type="number" name="TotalMoney" id="TotalMoney" value="{{$data->TotalMoney}}"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">逾期时间</label>
                            <div class="controls">
                                <input type="number" name="Month" id="Month" value="{{$data->Month}}"/>月
                            </div>
                        </div>
                        @if(!empty($data->Law))
                            <div class="control-group">
                                <label class="control-label">诉讼-佣金比例</label>
                                <div class="controls">
                                    <input type="text" name="Law" id="Law" value="{{$data->Law}}"/>
                                </div>
                            </div>
                        @endif
                        @if(!empty($data->UnLaw))
                            <div class="control-group">
                                <label class="control-label">非诉催收-佣金比例</label>
                                <div class="controls">
                                    <input type="text" name="UnLaw" id="UnLaw" value="{{$data->UnLaw}}"/>
                                </div>
                            </div>
                        @endif
                        <div class="control-group">
                            <label class="control-label ">债务人所在地</label>
                            <div class="controls " >
                                <input type="text" name="ProArea" id="ProArea" value="{{$data->ProArea}}" readonly  />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label ">债权人所在地</label>
                            <div class="controls " >
                                <input type="text" name="DebteeLocation" id="DebteeLocation" value="{{$data->DebteeLocation}}" readonly  />
                            </div>
                        </div>
                        @if(!empty($data->Guaranty))
                            <div class="control-group">
                                <label class="control-label">是否有担保</label>
                                <div class="controls">
                                    <input type="radio" name="Guaranty" id="Guaranty" value="是" @if($data->Guaranty=="是") checked="checked" @endif/>是
                                    <input type="radio" name="Guaranty"  id="Guaranty" value="否"  @if($data->Guaranty=="否") checked="checked" @endif />否
                                </div>
                            </div>
                        @endif
                        @if(!empty($data->Property))
                            <div class="control-group">
                                <label class="control-label">是否有抵押</label>
                                <div class="controls">
                                    <input type="radio" name="Property" id="Property" value="是" @if($data->Property=="是") checked="checked" @endif/>是
                                    <input type="radio" name="Property"  id="Property" value="否"  @if($data->Property=="否") checked="checked" @endif />否
                                </div>
                            </div>
                        @endif
                        @if(!empty($data->Connect))
                            <div class="control-group">
                                <label class="control-label">债务人是否失联</label>
                                <div class="controls">
                                    <input type="radio" name="Connect" id="Connect" value="是" @if($data->Connect=="是") checked="checked" @endif/>是
                                    <input type="radio" name="Connect"  id="Connect" value="否"  @if($data->Connect=="否") checked="checked" @endif />否
                                </div>
                            </div>
                        @endif
                        @if(!empty($data->Pay))
                            <div class="control-group">
                                <label class="control-label">债务人是否有偿还能力</label>
                                <div class="controls">
                                    <input type="radio" name="Pay" id="Pay" value="是" @if($data->Pay=="是") checked="checked" @endif/>是
                                    <input type="radio" name="Pay"  id="Pay" value="否"  @if($data->Pay=="否") checked="checked" @endif />否
                                </div>
                            </div>
                        @endif
                        @if(!empty($data->Credentials))
                            <div class="control-group">
                                <label class="control-label">相关凭证是否齐全</label>
                                <div class="controls">
                                    <input type="radio" name="Credentials" id="Credentials" value="是" @if($data->Credentials=="是") checked="checked" @endif/>是
                                    <input type="radio" name="Credentials"  id="Credentials" value="否"  @if($data->Credentials=="否") checked="checked" @endif />否
                                </div>
                            </div>
                        @endif
                        @if(!empty($data->ProLabel))
                            <div class="control-group">
                                <label class="control-label checkState">项目亮点</label>
                                <div class="controls newsType">
                                    <input type="checkbox" name="ProLabel[]" id="ProLabel" value="佣金比例高 "   @if(in_array("佣金比例高",$proLabels)) checked="checked" @endif/>佣金比例高
                                    <input type="checkbox" name="ProLabel[]"  id="ProLabel" value="法律关系明确"  @if(in_array("法律关系明确",$proLabels)) checked="checked" @endif />法律关系明确
                                </div>
                            </div>
                        @endif
                        <div class="control-group">
                            <label class="control-label">文字描述</label>
                            <div class="controls">
                                <textarea name="wordDes" id="eordDes" >{{$data->WordDes}}</textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">语音描述</label>
                            <div class="controls">
                                <input type="text" name="videoDes" id="videoDes" value="{{$data->VoiceDes}} " readonly/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">发布时间</label>
                            <div class="controls">
                                <input type="text" name="PublishTime" id="PublishTime" value="{{$data->PublishTime}}"
                                />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">发布方式</label>
                            <div class="controls">
                                <input type="radio" name="publisher" id="publisher_0" value="0" @if($data->Publisher==0) checked="checked" @endif/>自然发布
                                <input type="radio" name="publisher"  id="publisher_1" value="1"  @if($data->Publisher==1) checked="checked" @endif />委托发布
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">浏览次数</label>
                            <div class="controls">
                                <input type="text" name="ViewCount" id="ViewCount" value="{{$data->ViewCount}}" readonly
                                />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">收藏次数</label>
                            <div class="controls">
                                <input type="text" name="CollectionCount" id="CollectionCount" value="{{$data->CollectionCount}}" readonly/>
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
                            <label class="control-label">相关凭证</label>
                            <div class="controls ec_right upload">
                                {{-- <div class="ec_right upload">--}}
                                <div class="fileinput-button">
                                    <!-- The file input field used as target for the file upload widget -->
                                    <input id="fileupload" type="file" name="files[]" data-url="http://



admin.ziyawang.com/public/upload" multiple accept="image/png, image/gif, image/jpg, image/jpeg">
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
                                    $(_this).hide();
                                    var typeId=  $(_this).prev().attr("id");
                                    $("input[name='"+typeId+"']").val("");
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
                        {{-- <div class="control-group">
                            <label class="control-label">相关凭证</label>
                            <div class="controls">
                                <input type="hidden" id="filepath" name="checklogo">
                                <input id="file_upload" name="file_upload"  multiple="true">
                            </div>
                            <div class="controls  span3">
                                <div><img id="PictureDes1" alt=""  @if(!empty($data->PictureDes1)) src="{{'Http://images.ziyawang.com'.$data->PictureDes1}}"   @endif/>
                                       <span><a href="{{'Http://images.ziyawang.com'.$data->PictureDes1}}"><i class="icon-download PictureDes1" @if(empty($data->PictureDes1)) style="display:none" @endif></i></a>&nbsp&nbsp
                                           <i class="icon-trash PictureDes1" @if(empty($data->PictureDes1)) style="display:none" @endif ></i>
                                       </span>
                                </div>
                                <div><img  id="PictureDes2" alt=""  @if(!empty($data->PictureDes2))  src="{{'Http://images.ziyawang.com'.$data->PictureDes2}}" @endif/>
                                        <span><a href="{{'Http://images.ziyawang.com'.$data->PictureDes2}}"><i class="icon-download PictureDes2"  @if(empty($data->PictureDes2)) style="display:none" @endif></i></a>&nbsp&nbsp
                                            <i class="icon-trash PictureDes2" @if(empty($data->PictureDes2)) style="display:none" @endif></i>
                                        </span>
                                </div>
                                <div><img  id="PictureDes3" alt=""  @if(!empty($data->PictureDes3))  src="{{'Http://images.ziyawang.com'.$data->PictureDes3}}"  @endif/>
                                            <span><a href="{{'Http://images.ziyawang.com'.$data->PictureDes3}}"><i class="icon-download PictureDes3 " @if(empty($data->PictureDes3)) style="display:none" @endif ></i></a>&nbsp&nbsp
                                                <i class="icon-trash PictureDes3" @if(empty($data->PictureDes3)) style="display:none" @endif ></i>
                                            </span>
                                </div>
                            </div>
                        </div>--}}
                        <div class="control-group">
                            <label class="control-label">审核状态</label>
                            <div class="controls">
                                <select name="state" id="state">
                                    <option value="0" >-请选择-</option>
                                    <option value="1" @if($data->CertifyState==1)selected="selected" @endif>已审核</option>
                                    <option value="2" @if($data->CertifyState==2)selected="selected" @endif>拒审核</option>
                                    <option value="3" @if($data->CertifyState==3)selected="selected" @endif>删除</option>
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
                                <input type="radio" name="togetherType" id="togetherType" checked="checked" value="0" @if($data->PublishState==0) checked="checked" @endif/>未合作
                                <input type="radio" name="togetherType"  id="togetherType" value="1"  @if($data->PublishState==1) checked="checked" @endif />已合作
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">信息等级</label>
                            <div class="controls" id="messageType">
                                <input type="radio" name="member" id="member_0" value="0" @if($data->Member==0) checked="checked" @endif/>普通
                                <input type="radio" name="member"  id="member_1" value="1"  @if($data->Member==1) checked="checked" @endif />vip
                                <input type="radio" name="member"  id="member_2" value="2"  @if($data->Member==2) checked="checked" @endif />收费
                            </div>
                        </div>
                        @if($data->Member==2)
                            <div class="control-group" id="goldId" >
                                <label class="control-label">芽币</label>
                                <div class="controls">
                                    <input type="number" name="gold" id="gold" value="{{$data->Price}}"/>
                                </div>
                            </div>

                        @else
                            <div class="control-group" id="goldId" style="display: none">
                                <label class="control-label">芽币</label>
                                <div class="controls">
                                    <input type="number" name="gold" id="gold" value=""/>
                                </div>
                            </div>
                        @endif
                        {{--    <div class="control-group">
                                <label class="control-label">备注信息</label>
                                <div class="controls">
                                    @if(!empty($data->CompanyDes))
                                        <textarea name="companyDes" id="comDes" /> {{$data->CompanyDes}}</textarea>
                                    @else
                                        <textarea name="companyDes" id="comDes" /></textarea>
                                    @endif
                                </div>
                            </div>--}}
                        <div class="control-group">
                            <label class="control-label">备注信息</label>
                            <div class="controls">
                                @if(!empty($data->CompanyDes))
                                    <textarea name="companyDes" class="ckeditor" id="comDes">{{$data->CompanyDes}}</textarea>
                                @else
                                    <textarea name="companyDes" class="ckeditor" id="comDes" ></textarea>
                                @endif
                            </div>
                        </div>
                    @endforeach
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

@endsection