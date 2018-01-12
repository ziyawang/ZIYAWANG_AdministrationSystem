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
        <a href="{{asset('customer/index')}}" title="客户档案" class="tip-bottom"><i class="icon-home"></i>客户档案</a>
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
                    <form class="form-horizontal" method="post" action="{{asset('customer/saveAdd')}}"/>
                    <div class="control-group">
                        <label class="control-label">客情维护人</label>
                        <div class="controls">
                            <input type="text" name="accendantName" id="accendantName" value="" style="width: 100px"/>
                            <span style="color: red">* 必填信息!</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label checkState">客情级别</label>
                        <div class="controls selectBox">
                            <select name="Level" id="Level"/>
                            <option value="普通">普通</option>
                            <option value="关系良好">关系良好</option>
                            <option value="关系一般">关系一般</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label checkState">客户级别</label>
                        <div class="controls selectBox">
                            <select name="CustLevel" id="CustLevel"/>
                            <option value="大客户">大客户</option>
                            <option value="中型客户">中型客户</option>
                            <option value="小客户">小客户</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label checkState">客户类型</label>
                        <div class="controls selectBox">
                            <select name="CustType" id="CustType"/>
                            <option value="服务方">服务方</option>
                            <option value="发布方">发布方</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">客户名称</label>
                        <div class="controls">
                            <input type="text" name="CustomerName" id="CustomerName" value=""/>
                        </div>
                    </div>
                    <script>
                        $("#CustomerName").on("blur",function(){
                            var customerName=$("#CustomerName").val();
                            if(customerName){
                                $.ajax({
                                    url:"{{url('customer/returnData')}}",
                                    data:{"customerName":customerName},
                                    type:"POST",
                                    dateType:"json",
                                    success:function (msg) {
                                        if(msg==1){
                                            layer.alert('该客户名称已经存在')
                                        }
                                    }

                                })
                            }

                        })
                    </script>
                    <div class="control-group">
                        <label class="control-label">公司所在地</label>
                        <div class="controls">
                            <input type="text" name="Adress" id="Adress" value=""/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">公司规模(人)</label>
                        <div class="controls">
                            <input type="text" name="Size" id="Size" value=""/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">注册资金(万)</label>
                        <div class="controls">
                            <input type="text" name="Money" id="Money" value=""/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">公司简介</label>
                        <div class="controls">
                            <textarea name="Describe" class="ckeditor" id="Describe"></textarea>
                        </div>
                    </div>
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
                            <input type="checkbox" name="ServiceType[]" value="收购资产包"/>收购资产包
                            <input type="checkbox" name="ServiceType[]" value="委外催收"/>委外催收
                            <input type="checkbox" name="ServiceType[]" value="法律服务"/>法律服务
                            <input type="checkbox" name="ServiceType[]" value="收购固产"/>收购固产
                            <input type="checkbox" name="ServiceType[]" value="投融资服务"/>投融资服务
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">服务地区</label>
                        <div class="controls newsType" style="width: 60%">
                            <input type="checkbox" name="ProArea[]" value="全国"/>全国
                            <input type="checkbox" name="ProArea[]" value="北京">北京
                            <input type="checkbox" name="ProArea[]" value="上海">上海
                            <input type="checkbox" name="ProArea[]" value="广东">广东
                            <input type="checkbox" name="ProArea[]" value="江苏">江苏
                            <input type="checkbox" name="ProArea[]" value="山东">山东
                            <input type="checkbox" name="ProArea[]" value="浙江">浙江
                            <input type="checkbox" name="ProArea[]" value="河南">河南
                            <input type="checkbox" name="ProArea[]" value="河北">河北
                            <input type="checkbox" name="ProArea[]" value="辽宁">辽宁
                            <input type="checkbox" name="ProArea[]" value="四川">四川
                            <input type="checkbox" name="ProArea[]" value="湖北">湖北
                            <input type="checkbox" name="ProArea[]" value="湖南">湖南
                            <input type="checkbox" name="ProArea[]" value="福建">福建
                            <input type="checkbox" name="ProArea[]" value="安徽">安徽
                            <input type="checkbox" name="ProArea[]" value="陕西">陕西
                            <input type="checkbox" name="ProArea[]" value="天津">天津
                            <input type="checkbox" name="ProArea[]" value="江西">江西
                            <input type="checkbox" name="ProArea[]" value="广西">广西
                            <input type="checkbox" name="ProArea[]" value="重庆">重庆
                            <input type="checkbox" name="ProArea[]" value="吉林">吉林
                            <input type="checkbox" name="ProArea[]" value="云南">云南
                            <input type="checkbox" name="ProArea[]" value="山西">山西
                            <input type="checkbox" name="ProArea[]" value="新疆">新疆
                            <input type="checkbox" name="ProArea[]" value="贵州">贵州
                            <input type="checkbox" name="ProArea[]" value="甘肃">甘肃
                            <input type="checkbox" name="ProArea[]" value="海南">海南
                            <input type="checkbox" name="ProArea[]" value="宁夏">宁夏
                            <input type="checkbox" name="ProArea[]" value="青海">青海
                            <input type="checkbox" name="ProArea[]" value="西藏">西藏
                            <input type="checkbox" name="ProArea[]" value="黑龙江">黑龙江
                            <input type="checkbox" name="ProArea[]" value="内蒙古">内蒙古
                            <input type="checkbox" name="ProArea[]" value="台湾">台湾
                            <input type="checkbox" name="ProArea[]" value="香港">香港
                            <input type="checkbox" name="ProArea[]" value="澳门">澳门
                        </div>
                    </div>
                    <div class="control-group" id="CustomerNeed">
                        <label class="control-label">客户需求</label>
                        <div class="controls">
                            <div>
                                <input type="text" name="CustomerNeed[]" value=""/><span id="add"
                                                                                         class='customerNeed'>+</span>
                            </div>
                        </div>
                    </div>
                    <script>
                        $(function () {
                            $("#add").on("click", function () {
                                var str = "<div class='controls'><input type='text' name='CustomerNeed[]'  value=''   /><span id='reduce' class='customerNeed' onclick='reduce(this)'>-</span> </div>"
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
                        <label class="control-label">图片资料</label>
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
                            <div class="pictures"><img class="preview" id="PictureDes1" src="" picname=''><span
                                        class="deleteBtn1 deleteImg" title="删除"></span></div>
                            <div class="pictures"><img class="preview" id="PictureDes2" src="" picname=''><span
                                        class="deleteBtn2 deleteImg" title="删除"></span></div>
                            <div class="pictures"><img class="preview" id="PictureDes3" src="" picname=''><span
                                        class="deleteBtn3 deleteImg" title="删除"></span></div>
                            <div class="pictures"><img class="preview" id="PictureDes4" src="" picname=''><span
                                        class="deleteBtn4 deleteImg" title="删除"></span></div>
                            <div class="pictures"><img class="preview" id="PictureDes5" src="" picname=''><span
                                        class="deleteBtn5 deleteImg" title="删除"></span></div>
                        </div>
                        <p><input type="hidden" name="PictureDes1" value=""></p>
                        <p><input type="hidden" name="PictureDes2" value=""></p>
                        <p><input type="hidden" name="PictureDes3" value=""></p>
                        <p><input type="hidden" name="PictureDes4" value=""></p>
                        <p><input type="hidden" name="PictureDes5" value=""></p>
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
                    </script>
                    <div class="control-group">
                        <label class="control-label">上传清单</label>
                        <div class="controls ec_right upload">
                            {{-- <div class="ec_right upload">--}}
                            <div class="fileinput-button">
                                <!-- The file input field used as target for the file upload widget -->
                                <input id="list_upload" type="file" name="files[]"
                                       data-url="http://admin.ziyawang.com/public/upload">
                            </div>
                        </div>
                    </div>
                    <p><input type="hidden" name="AssetList" id="qd"></p>
                    <script type="text/javascript">
                        $(function () {
                            $('#list_upload').fileupload({
                                dataType: 'json',
                                limitMultiFileUploadSize: 10000,
                                maxNumberOfFiles: 1,
                                done: function (e, data) {
                                    $.each(data.result.files, function (index, file) {
                                        if (file.size > 0) {
                                            $('input[name=AssetList]').val(file.name);
                                            layer.msg('清单上传成功！');
                                            $('#listname').html('文件已上传');
                                            $('#list_upload').attr('disabled', true);
                                        } else {
                                            layer.msg('文件大小超过限制,上传失败！');
                                        }
                                    });
                                }
                            });
                        });
                    </script>
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
                        <label class="control-label">合作进度</label>
                        <div class="controls">
                            <textarea name="WorkSpeed" id="WorkSpeed"></textarea>
                        </div>
                    </div>
                    {{--  <div class="control-group">
                          <label class="control-label">项目推进进度</label>
                          <div class="controls">
                              <textarea name="Speed" id="Speed" ></textarea>
                          </div>
                      </div>--}}
                    <div class="form-actions">
                        <input type="submit" value="保存" class="btn btn-primary"/>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection