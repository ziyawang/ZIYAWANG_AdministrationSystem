@extends('layouts.master')
@section('content')
    <style xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
        .radio input[type="radio"] {
            float: left;
            margin-left: 0px;
        }

        .newsType .checker span .checker span {
            background-position: -76px -240px;
        }

        .customerNeed {
            color: red;
            font-size: 27px;
            display: inline-block;
            vertical-align: -5px;
            margin-left: 5px;
        }
    </style>
    <script language="javascript" src="{{asset('./js/YMDClass.js')}}"></script>
    <script src="{{asset('assets/layer/layer/layer.js')}}"></script>
    @if(session("msg"))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            <strong>{{session("msg")}}</strong>
        </div>
    @endif
    <div id="breadcrumb" style="position:relative">
        <a href="{{asset('customer/index')}}" title="档案列表" class="tip-bottom"><i class="icon-home"></i>客户详情</a>
        <a href="#" class="current">编辑详情</a>
    </div>
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                            <span class="icon">
                                <i class="icon-align-justify"></i>
                            </span>
                    <h5>客户详情</h5>
                </div>
                <div class="widget-content nopadding">
                    <form class="form-horizontal" method="post" action="{{asset('customer/saveUpdate')}}"/>
                    <input type="hidden" name="customerId" value="{{$customerId}}">
                    @foreach($results as $data)
                        <div class="control-group">
                            <label class="control-label checkState">客情维护人</label>
                            <div class="controls selectBox">
                                <select name="Name" id="Name"/>
                                <option value="{{$data->Name}}">{{$data->Name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label checkState">客情级别</label>
                            <div class="controls selectBox">
                                <select name="Level" id="Level"/>
                                <option value="普通"
                                        @if(!empty($data->Level && $data->Level=="普通")) selected="selected" @endif>普通
                                </option>
                                <option value="关系良好"
                                        @if(!empty($data->Level && $data->Level=="关系良好")) selected="selected" @endif>
                                    关系良好
                                </option>
                                <option value="关系一般"
                                        @if(!empty($data->Level && $data->Level=="关系一般")) selected="selected" @endif>
                                    关系一般
                                </option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label checkState">客户级别</label>
                            <div class="controls selectBox">
                                <select name="CustLevel" id="CustLevel"/>
                                <option value="大客户"
                                        @if(!empty($data->CustLevel && $data->CustLevel=="大客户")) selected="selected" @endif>
                                    大客户
                                </option>
                                <option value="中型客户"
                                        @if(!empty($data->CustLevel && $data->CustLevel=="中型客户")) selected="selected" @endif>
                                    中型客户
                                </option>
                                <option value="小客户"
                                        @if(!empty($data->CustLevel && $data->CustLevel=="小客户"))  selected="selected" @endif>
                                    小客户
                                </option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label checkState">客户类型</label>
                            <div class="controls selectBox">
                                <select name="CustType" id="CustType"/>
                                <option value="服务方"
                                        @if(!empty($data->CustType && $data->CustType=="服务方")) selected="selected" @endif>
                                    服务方
                                </option>
                                <option value="发布方"
                                        @if(!empty($data->CustType && $data->CustType=="发布方")) selected="selected" @endif>
                                    发布方
                                </option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">客户名称</label>
                            <div class="controls">
                                <input type="text" name="CustomerName" id="CustomerName"
                                       value="{{$data->CustomerName}}"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">公司所在地</label>
                            <div class="controls">
                                <input type="text" name="Adress" id="Adress" value="{{$data->Adress}}"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">公司规模(人)</label>
                            <div class="controls">
                                <input type="text" name="Size" id="Size" value="{{$data->Size}}"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">注册资金(万)</label>
                            <div class="controls">
                                <input type="text" name="Money" id="Money" value="{{$data->Money}}"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">公司简介</label>
                            <div class="controls">
                                <textarea name="Describe" class="ckeditor" id="Describe">{{$data->Describe}}</textarea>
                            </div>
                        </div>
                        @foreach($keys as $key)
                            <div class="control-group">
                                <label class="control-label">关键人姓名</label>
                                <div class="controls">
                                    <input type="text" name="saveperson[{{$key->KeyID}}][KeyName]" class="ckeditor"
                                           id="KeyName" value="{{$key->KeyName}}">
                                </div>
                                <label class="control-label">关键人年龄</label>
                                <div class="controls">
                                    <input type="text" name="saveperson[{{$key->KeyID}}][KeyAge]" class="ckeditor"
                                           id="KeyAge" value="{{$key->KeyAge}}">
                                </div>
                                <label class="control-label">关键人性别</label>
                                <div class="controls">
                                    <input type="text" name="saveperson[{{$key->KeyID}}][KeySex]" class="ckeditor"
                                           id="KeySex" value="{{$key->KeySex}}">
                                </div>
                                <label class="control-label">关键人职位</label>
                                <div class="controls">
                                    <input type="text" name="saveperson[{{$key->KeyID}}][KeyWork]" class="ckeditor"
                                           id="KeyWork" value="{{$key->KeyWork}}">
                                </div>
                                <label class="control-label">关键人生日</label>
                                <div class="controls">
                                    <input type="text" name="saveperson[{{$key->KeyID}}][Birthday]" class="ckeditor"
                                           id="Birthday" value="{{$key->Birthday}}">
                                </div>
                                <label class="control-label">联系电话</label>
                                <div class="controls">
                                    <input type="text" name="saveperson[{{$key->KeyID}}][PhoneNumber]" class="ckeditor"
                                           id="PhoneNumber" value="{{$key->PhoneNumber}}">
                                </div>
                                <label class="control-label">邮箱</label>
                                <div class="controls">
                                    <input type="text" name="saveperson[{{$key->KeyID}}][Email]" class="ckeditor"
                                           id="Email" value="{{$key->Email}}">
                                </div>
                                <label class="control-label">微信</label>
                                <div class="controls">
                                    <input type="text" name="saveperson[{{$key->KeyID}}][Chart]" class="ckeditor"
                                           id="Chart" value="{{$key->Chart}}">
                                </div>
                            </div>
                        @endforeach
                        <script>
                            $(function () {
                                $("#Birthday").datetimepicker({
                                    minView: "month", //选择日期后，不会再跳转去选择时分秒
                                    format: "yyyy-mm-dd", //选择日期后，文本框显示的日期格式
                                    language: 'zh-CN', //汉化
                                    autoclose: true //选择日期后自动关闭
                                });
                            });
                        </script>
                        <div class="control-group">
                            <label class="control-label">添加关键人</label>
                            <div class="controls">
                                <input type="button" name="addKey" id="addKey" value="点击添加" class="btn btn-primary"/>
                            </div>
                        </div>
                        <div id="addperson" class="controls">
                        </div>
                        <script>
                            $(function () {
                                $("#addKey").on("click", function () {
                                    layer.open({
                                        type: 2,
                                        title: false,
                                        closeBtn: 1,
                                        area: ['500px', '500px'],
                                        /* skin: 'layui-layer-nobg', //没有背景色*/
                                        skin: 'layui-layer-lan',
                                        shadeClose: false,
                                        content: "http://admin.ziyawang.com/customer/addKey",
                                        yes: function (index) {
                                            layer.close(index);
                                        },
                                    });
                                });
                            });

                        </script>

                        <div class="control-group">
                            <label class="control-label">服务类型</label>
                            <div class="controls newsType">
                                <input type="checkbox" name="ServiceType[]" value="收购资产包"
                                       @if(in_array("收购资产包",$data->ServiceType)) checked="checked" @endif/>收购资产包
                                <input type="checkbox" name="ServiceType[]" value="委外催收"
                                       @if(in_array("委外催收",$data->ServiceType)) checked="checked" @endif />委外催收
                                <input type="checkbox" name="ServiceType[]" value="法律服务"
                                       @if(in_array("法律服务",$data->ServiceType)) checked="checked" @endif />法律服务
                                <input type="checkbox" name="ServiceType[]" value="收购固产"
                                       @if(in_array("收购固产",$data->ServiceType)) checked="checked" @endif />收购固产
                                <input type="checkbox" name="ServiceType[]" value="投融资服务"
                                       @if(in_array("投融资服务",$data->ServiceType)) checked="checked" @endif />投融资服务
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">服务地区</label>
                            <div class="controls newsType" style="width: 60%">
                                <input type="checkbox" name="ProArea[]" value="全国"
                                       @if(in_array("全国",$data->ProArea)) checked="checked" @endif/>全国
                                <input type="checkbox" name="ProArea[]" value="北京"
                                       @if(in_array("北京",$data->ProArea)) checked="checked" @endif>北京
                                <input type="checkbox" name="ProArea[]" value="上海"
                                       @if(in_array("上海",$data->ProArea)) checked="checked" @endif>上海
                                <input type="checkbox" name="ProArea[]" value="广东"
                                       @if(in_array("广东",$data->ProArea)) checked="checked" @endif>广东
                                <input type="checkbox" name="ProArea[]" value="江苏"
                                       @if(in_array("江苏",$data->ProArea)) checked="checked" @endif>江苏
                                <input type="checkbox" name="ProArea[]" value="山东"
                                       @if(in_array("山东",$data->ProArea)) checked="checked" @endif>山东
                                <input type="checkbox" name="ProArea[]" value="浙江"
                                       @if(in_array("浙江",$data->ProArea)) checked="checked" @endif>浙江
                                <input type="checkbox" name="ProArea[]" value="河南"
                                       @if(in_array("河南",$data->ProArea)) checked="checked" @endif >河南
                                <input type="checkbox" name="ProArea[]" value="河北"
                                       @if(in_array("河北",$data->ProArea)) checked="checked" @endif>河北
                                <input type="checkbox" name="ProArea[]" value="辽宁"
                                       @if(in_array("辽宁",$data->ProArea)) checked="checked" @endif>辽宁
                                <input type="checkbox" name="ProArea[]" value="四川"
                                       @if(in_array("四川",$data->ProArea)) checked="checked" @endif >四川
                                <input type="checkbox" name="ProArea[]" value="湖北"
                                       @if(in_array("湖北",$data->ProArea)) checked="checked" @endif >湖北
                                <input type="checkbox" name="ProArea[]" value="湖南"
                                       @if(in_array("湖南",$data->ProArea)) checked="checked" @endif>湖南
                                <input type="checkbox" name="ProArea[]" value="福建"
                                       @if(in_array("福建",$data->ProArea)) checked="checked" @endif>福建
                                <input type="checkbox" name="ProArea[]" value="安徽"
                                       @if(in_array("安徽",$data->ProArea)) checked="checked" @endif>安徽
                                <input type="checkbox" name="ProArea[]" value="陕西"
                                       @if(in_array("陕西",$data->ProArea)) checked="checked" @endif>陕西
                                <input type="checkbox" name="ProArea[]" value="天津"
                                       @if(in_array("天津",$data->ProArea)) checked="checked" @endif>天津
                                <input type="checkbox" name="ProArea[]" value="江西"
                                       @if(in_array("江西",$data->ProArea)) checked="checked" @endif>江西
                                <input type="checkbox" name="ProArea[]" value="广西"
                                       @if(in_array("广西",$data->ProArea)) checked="checked" @endif>广西
                                <input type="checkbox" name="ProArea[]" value="重庆"
                                       @if(in_array("重庆",$data->ProArea)) checked="checked" @endif>重庆
                                <input type="checkbox" name="ProArea[]" value="吉林"
                                       @if(in_array("吉林",$data->ProArea)) checked="checked" @endif>吉林
                                <input type="checkbox" name="ProArea[]" value="云南"
                                       @if(in_array("云南",$data->ProArea)) checked="checked" @endif>云南
                                <input type="checkbox" name="ProArea[]" value="山西"
                                       @if(in_array("山西",$data->ProArea)) checked="checked" @endif>山西
                                <input type="checkbox" name="ProArea[]" value="新疆"
                                       @if(in_array("新疆",$data->ProArea)) checked="checked" @endif>新疆
                                <input type="checkbox" name="ProArea[]" value="贵州"
                                       @if(in_array("贵州",$data->ProArea)) checked="checked" @endif>贵州
                                <input type="checkbox" name="ProArea[]" value="甘肃"
                                       @if(in_array("甘肃",$data->ProArea)) checked="checked" @endif>甘肃
                                <input type="checkbox" name="ProArea[]" value="海南"
                                       @if(in_array("海南",$data->ProArea)) checked="checked" @endif>海南
                                <input type="checkbox" name="ProArea[]" value="宁夏"
                                       @if(in_array("宁夏",$data->ProArea)) checked="checked" @endif>宁夏
                                <input type="checkbox" name="ProArea[]" value="青海"
                                       @if(in_array("青海",$data->ProArea)) checked="checked" @endif>青海
                                <input type="checkbox" name="ProArea[]" value="西藏"
                                       @if(in_array("西藏",$data->ProArea)) checked="checked" @endif>西藏
                                <input type="checkbox" name="ProArea[]" value="黑龙江"
                                       @if(in_array("黑龙江",$data->ProArea)) checked="checked" @endif>黑龙江
                                <input type="checkbox" name="ProArea[]" value="内蒙古"
                                       @if(in_array("内蒙古",$data->ProArea)) checked="checked" @endif>内蒙古
                                <input type="checkbox" name="ProArea[]" value="台湾"
                                       @if(in_array("台湾",$data->ProArea)) checked="checked" @endif>台湾
                                <input type="checkbox" name="ProArea[]" value="香港"
                                       @if(in_array("香港",$data->ProArea)) checked="checked" @endif>香港
                                <input type="checkbox" name="ProArea[]" value="澳门"
                                       @if(in_array("澳门",$data->ProArea)) checked="selected" @endif>澳门
                            </div>
                        </div>
                        <div class="control-group" id="CustomerNeed">
                            <label class="control-label">客户需求</label>
                            @foreach($data->CustomerNeed as $key=>$val)
                                @if($key==0)
                                    <div class="controls">
                                        <input type="text" name="CustomerNeed[]" value="{{$val}}"/><span id="add"
                                                                                                         class="customerNeed">+</span>
                                    </div>
                                @else
                                    <div class="controls">
                                        <input type="text" name="CustomerNeed[]" value="{{$val}}"/><span id="reduce"
                                                                                                         class="customerNeed"
                                                                                                         onclick='reduce(this)'>-</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <script>
                            $(function () {
                                $("#add").on("click", function () {
                                    var str = "<div class='controls'><input type='text' name='CustomerNeed[]'  value=''   /><span id='reduce'  class='customerNeed'  onclick='reduce(this)'>-</span> </div>"
                                    $("#CustomerNeed").append(str);
                                })
                            })
                            function reduce(e) {
                                $(e).parent().remove();
                            }
                        </script>
                        <script src="{{asset('./FileUpload/js/vendor/jquery.ui.widget.js')}}"></script>
                        <script src="{{asset('./FileUpload/js/jquery.fileupload.js')}}"></script>
                        <script src="{{asset('./FileUpload/js/jquery.iframe-transport.js')}}"></script>
                        <script src="{{asset('./FileUpload/js/jquery.fileupload-process.js')}}"></script>
                        <script src="{{asset('./FileUpload/js/jquery.fileupload-validate.js')}}"></script>
                        <style>
                            .pictures {
                                float: left;
                                margin-right: 20px;
                                display: none;
                                position: relative;
                                margin-bottom: 28px;
                            }

                            .pictures img {
                                width: 150px;
                                height: 150px;
                                border: 1px solid #ccc;
                            }

                            .deleteImg {
                                position: absolute;
                                width: 22px;
                                height: 22px;
                                background: #b8b8b8 url(/img/zhifu.png) no-repeat -147px -46px;
                                cursor: pointer;
                                right: 0;
                                top: 0;
                            }
                        </style>
                        <div class="control-group">
                            <label class="control-label">上传图片</label>
                            <div class="controls ec_right upload">
                                {{-- <div class="ec_right upload">--}}
                                <div class="fileinput-button">
                                    <!-- The file input field used as target for the file upload widget -->
                                    <input id="fileupload" type="file" name="files[]"
                                           data-url="http://admin.ziyawang.com/public/upload" multiple
                                           accept="image/png, image/gif, image/jpg, image/jpeg">
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <p id="nopz" style="margin-left:170px;" class="error"></p>
                            <div class="clearfix img_box" style="margin-left:200px;">
                                @if(!empty($data->PictureDes1))
                                    <div class="pictures" style="display: block"><img class="preview" id="PictureDes1"
                                                                                      onclick="enlarge(this)"
                                                                                      src="http://images.ziyawang.com{{$data->PictureDes1}}"
                                                                                      picname=''><span
                                                class="deleteBtn1 deleteImg" title="删除" style="display: none"></span>
                                    </div>
                                @else
                                    <div class="pictures"><img class="preview" id="PictureDes1" src="" picname=''><span
                                                class="deleteBtn1 deleteImg" title="删除"></span></div>
                                @endif
                                @if(!empty($data->PictureDes2))
                                    <div class="pictures" style="display: block"><img class="preview" id="PictureDes2"
                                                                                      onclick="enlarge(this)"
                                                                                      src="http://images.ziyawang.com{{$data->PictureDes2}}"
                                                                                      picname=''><span
                                                class="deleteBtn2 deleteImg" title="删除" style="display: none"></span>
                                    </div>
                                @else
                                    <div class="pictures"><img class="preview" id="PictureDes2" src="" picname=''><span
                                                class="deleteBtn2 deleteImg" title="删除"></span></div>
                                @endif
                                @if(!empty($data->PictureDes3))
                                    <div class="pictures" style="display: block"><img class="preview" id="PictureDes3"
                                                                                      onclick="enlarge(this)"
                                                                                      src="http://images.ziyawang.com{{$data->PictureDes3}}"
                                                                                      picname=''><span
                                                class="deleteBtn3 deleteImg" title="删除" style="display: none"></span>
                                    </div>
                                @else
                                    <div class="pictures"><img class="preview" id="PictureDes3" src="" picname=''><span
                                                class="deleteBtn3 deleteImg" title="删除"></span></div>
                                @endif
                                @if(!empty($data->PictureDes4))
                                    <div class="pictures" style="display: block"><img class="preview" id="PictureDes4"
                                                                                      onclick="enlarge(this)"
                                                                                      src="http://images.ziyawang.com{{$data->PictureDes4}}"
                                                                                      picname=''><span
                                                class="deleteBtn4 deleteImg" title="删除" style="display: none"></span>
                                    </div>
                                @else
                                    <div class="pictures"><img class="preview" id="PictureDes4" src="" picname=''><span
                                                class="deleteBtn4 deleteImg" title="删除"></span></div>
                                @endif
                                @if(!empty($data->PictureDes5))
                                    <div class="pictures" style="display: block"><img class="preview" id="PictureDes5"
                                                                                      onclick="enlarge(this)"
                                                                                      src="http://images.ziyawang.com{{$data->PictureDes5}}"
                                                                                      picname=''><span
                                                class="deleteBtn5 deleteImg" title="删除" style="display: none"></span>
                                    </div>
                                @else
                                    <div class="pictures"><img class="preview" id="PictureDes5" src="" picname=''><span
                                                class="deleteBtn5 deleteImg" title="删除"></span></div>
                                @endif
                            </div>
                            <p><input type="hidden" name="PictureDes1" value="{{$data->PictureDes1}}"></p>
                            <p><input type="hidden" name="PictureDes2" value="{{$data->PictureDes2}}"></p>
                            <p><input type="hidden" name="PictureDes3" value="{{$data->PictureDes3}}"></p>
                            <p><input type="hidden" name="PictureDes4" value="{{$data->PictureDes4}}"></p>
                            <p><input type="hidden" name="PictureDes5" value="{{$data->PictureDes5}}"></p>
                        </div>
                        <script>
                            $(function () {
                                $('#fileupload').fileupload({
                                    dataType: 'json',
                                    formAcceptCharset: 'utf-8',
                                    maxNumberOfFiles: 5,
                                    done: function (e, data) {
                                        $.each(data.result.files, function (index, file) {
                                            // console.log(file.name);
                                            $('input[name=PictureDes]').val(data);
                                            var name = $(".preview[src='']:first").attr('id');
                                            $("input[name='" + name + "']").val('/user/' + file.name);
                                            $(".preview[src='']:first").next().hide();
                                            $(".preview[src='']:first").attr({
                                                'src': encodeURI('http://images.ziyawang.com/user/' + file.name),
                                                'picname': file.name
                                            }).parent().show();
                                            $('#nopz').html('');
                                        });
                                    }
                                });
                                $('.pictures').hover(function () {
                                    $(this).children('.deleteImg').toggle();
                                })
                                $('.deleteImg').click(function () {
                                    var _this = $(this);
                                    $(_this).parent().hide();
                                    var typeId = $(_this).prev().attr("id");
                                    $("input[name='" + typeId + "']").val("");
                                    $(_this).hide();
                                    $(_this).prev().attr('src', '');
                                    var url = "http://admin.ziyawang.com/public/upload?file=" + $(this).prev().attr('picname');
                                    $.ajax({
                                        'url': url,
                                        'type': 'DELETE',
                                        'success': function (msg) {
                                        }
                                    })
                                })
                            });
                            function enlarge(e) {
                                var src = $(e).attr("src");
                                layer.open({
                                    type: 1,
                                    title: false,
                                    closeBtn: 0,
                                    area: '516px',
                                    skin: 'layui-layer-nobg', //没有背景色
                                    shadeClose: true,
                                    content: "<img src='" + src + "'>"
                                });

                            }

                        </script>
                        @if(!empty($data->AssetList))
                            <div class="control-group">
                                <label class="control-label">上传资料</label>
                                <div class="controls">
                                    <a href="http://images.ziyawang.com/{{$data->AssetList}}"> <input type="button"
                                                                                                      name="AssetList"
                                                                                                      id="AssetList"
                                                                                                      value="下载清单"
                                                                                                      class="btn btn-primary"/></a>
                                </div>
                            </div>
                        @endif
                        <div class="control-group">
                            <label class="control-label">合作进度</label>
                            <div class="controls">
                                <textarea name="WorkSpeed" id="WorkSpeed">{{$data->WorkSpeed}}</textarea>
                            </div>
                        </div>
                        {{-- <div class="control-group">
                             <label class="control-label">项目推进进度</label>
                             <div class="controls">
                                 <textarea name="Speed" id="Speed" >{{$data->Speed}}</textarea>
                             </div>
                         </div>--}}
                    @endforeach
                    <div class="form-actions">
                        <input type="submit" value="保存" class="btn btn-primary"/>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection