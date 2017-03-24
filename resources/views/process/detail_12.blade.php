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
        <a href="#" class="current">编辑客户</a>
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
                    </div>
                    <div class="control-group">
                        <label class="control-label checkState">请选择身份:</label>
                        <div class="controls selectBox" >
                            <select  name="Identity" id="Identity"/>
                            <option value="0">请选择</option>
                            <option value="项目持有者" @if($data->Identity=="项目持有者") selected="selected" @endif>项目持有者</option>
                            <option value="FA（中介）" @if($data->Identity=="FA（中介）") selected="selected" @endif>FA（中介）</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label checkState">项目所在地</label>
                        <div class="controls selectBox" >
                            <input type="text" name="ProArea" id="ProArea" value="{{$data->ProArea}}"/>
                        </div>
                    </div>
                    <div class="control-group" id="AssetType">
                        <label class="control-label">标的物类型</label>
                        <div class="controls">
                            @if($data->TypeID=="16")
                                <input type="radio" name="AssetType"   value="16" checked="checked"  />土地
                            @endif
                            @if($data->TypeID=="12")
                                <input type="radio" name="AssetType"    value="12" checked="checked"/>房产
                            @endif
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label checkState">规划用途</label>
                        <div class="controls selectBox" >
                            <select  name="Usefor" id="Usefor"/>
                            <option value="工业" @if($data->Usefor=="工业") selected="selected" @endif>工业</option>
                            <option value="商业" @if($data->Usefor=="商业") selected="selected" @endif>商业</option>
                            <option value="住宅" @if($data->Usefor=="住宅") selected="selected" @endif>住宅</option>
                            <option value="其他" @if($data->Usefor=="其他") selected="selected" @endif>其他</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">面积</label>
                        <div class="controls">
                            <input type="number" name="Area" id="Area" value="{{$data->Area}}" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">剩余使用年限</label>
                        <div class="controls">
                            <input type="number" name="Year" id="Year" value="{{$data->Year}}"/>年
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">转让方式</label>
                        <div class="controls">
                            <input type="radio" name="TransferType"  value="产权转让" @if($data->TransferType=="产权转让") checked="checked" @endif/>产权转让
                            <input type="radio" name="TransferType"  value="股权转让"  @if($data->TransferType=="股权转让") checked="checked" @endif />股权转让
                        </div>
                    </div>
                    @if($data->TypeID=="12")
                        <div class="control-group" id="Type" >
                            <label class="control-label checkState">房产类型</label>
                            <div class="controls selectBox" >
                                <select  name="Type" />
                                <option value="住宅" @if($data->Type=="住宅") selected="selected" @endif>住宅</option>
                                <option value="商业" @if($data->Type=="商业") selected="selected" @endif>商业</option>
                                <option value="厂房" @if($data->Type=="厂房") selected="selected" @endif>厂房</option>
                                <option value="其他" @if($data->Type=="其他") selected="selected" @endif>其他</option>
                                </select>
                            </div>
                        </div>
                        @endif
                        @if($data->TypeID=="12")
                        <div class="control-group" id="MarketPrice" >
                            <label class="control-label">市场价格(万)</label>
                            <div class="controls">
                                <input type="number" name="MarketPrice" value="{{$data->MarketPrice}}" />
                            </div>
                        </div>
                        @endif
                    <div class="control-group" >
                        <label class="control-label">转让价格(万)</label>
                        <div class="controls">
                            <input type="number" name="TransferMoney" id="TransferMoney" value="{{$data->TransferMoney}}"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">相关证件</label>
                        <div class="controls">
                            <input type="radio" name="Credentials"  value="有" @if($data->Credentials=="有") checked="checked" @endif/>有
                            <input type="radio" name="Credentials"   value="无"  @if($data->Credentials=="无") checked="checked" @endif />无
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">法律纠纷</label>
                        <div class="controls">
                            <input type="radio" name="Dispute"  value="有" @if($data->Dispute=="有") checked="checked" @endif/>有
                            <input type="radio" name="Dispute"  value="无"  @if($data->Dispute=="无") checked="checked" @endif />无
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">负债</label>
                        <div class="controls">
                            <input type="radio" name="Debt" value="有" @if($data->Debt=="有") checked="checked" @endif/>有
                            <input type="radio" name="Debt"  value="无"  @if($data->Debt=="无") checked="checked" @endif />无
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">抵押担保</label>
                        <div class="controls">
                            <input type="radio" name="Guaranty"  value="有" @if($data->Guaranty=="有") checked="checked" @endif/>有
                            <input type="radio" name="Guaranty"   value="无"  @if($data->Guaranty=="无") checked="checked" @endif />无
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">拥有全部产权</label>
                        <div class="controls">
                            <input type="radio" name="Property"  value="是" @if($data->Property=="是") checked="checked" @endif/>是
                            <input type="radio" name="Property"   value="否"  @if($data->Property=="否") checked="checked" @endif />否
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label checkState">项目亮点</label>
                        <div class="controls newsType">
                            <input type="checkbox" name="ProLabel[]"  value="可议价"   @if(in_array("可议价",$proLabels)) checked="checked" @endif/>可议价
                            <input type="checkbox" name="ProLabel[]"   value="位置优越"  @if(in_array("位置优越",$proLabels)) checked="checked" @endif />位置优越
                            <input type="checkbox" name="ProLabel[]"   value="折扣空间大"  @if(in_array("折扣空间大",$proLabels)) checked="checked" @endif />折扣空间大
                            <input type="checkbox" name="ProLabel[]"   value="有评估报告"  @if(in_array("有评估报告",$proLabels)) checked="checked" @endif />有评估报告
                        </div>
                    </div>
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
                 {{--   <div class="control-group">
                        <label class="control-label">服务方名称</label>
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
                                            <td> <input type="text" name="Events[0][]" value="{{$event->Events}}"  style='margin-right: 20px;width: 600px;'/></td>
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
                    </div>--}}
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
   {{--     <script>
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
                    if(types=="12"){

                        $("#MarketPrice").show();
                        $("#Type").show();
                    }else{
                        $("#MarketPrice").hide();
                        $("#Type").hide();
                    }
                })
            })
        </script>
    </div>
    </div>
@endsection