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
                            <option value="项目持有者" value="项目持有者" @if($data->Identity=="债权人") selected="selected" @endif>项目持有者</option>
                            <option value="FA（中介）" @if($data->Identity=="FA（中介）") selected="selected" @endif>FA（中介）</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label checkState">商账类型</label>
                        <div class="controls selectBox" >
                            <select  name="AssetType" id="AssetType"/>
                            <option value="货款" @if($data->AssetType=="货款") selected="selected" @endif>货款</option>
                            <option value="工程款" @if($data->AssetType=="工程款") selected="selected" @endif>工程款</option>
                            <option value="违约金" @if($data->AssetType=="违约金") selected="selected" @endif>违约金</option>
                            <option value="其他" @if($data->AssetType=="其他") selected="selected" @endif>其他</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">债权金额(万)</label>
                        <div class="controls">
                            <input type="number" name="Money" id="Money" value="{{$data->Money}}"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">逾期时间</label>
                        <div class="controls">
                            <input type="number" name="Month" id="Month" value="{{$data->Month}}"/>月
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">诉讼-佣金比例</label>
                        <div class="controls">
                            <input type="text" name="Law" id="Law" value="{{$data->Law}}"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">非诉催收-佣金比例</label>
                        <div class="controls">
                            <input type="text" name="UnLaw" id="UnLaw" value="{{$data->UnLaw}}"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label checkState">债务方地区</label>
                        <div class="controls selectBox" >
                            <input type="text" name="ProArea" id="ProArea" value="{{$data->ProArea}}"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label checkState">债务方企业性质</label>
                        <div class="controls selectBox" >
                            <select  name="Nature" id="Nature"/>
                            <option value="国企" @if($data->Nature=="国企") selected="selected" @endif>国企</option>
                            <option value="央企" @if($data->Nature=="央企") selected="selected" @endif>央企</option>
                            <option value="民营" @if($data->Nature=="民营") selected="selected" @endif>民营</option>
                            <option value="其他" @if($data->Nature=="其他") selected="selected" @endif>其他</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label checkState">债务方经营情况</label>
                        <div class="controls selectBox" >
                            <select  name="Status" id="Status"/>
                            <option value="正常运营" @if($data->Status=="正常运营") selected="selected" @endif>正常运营</option>
                            <option value="濒临倒闭" @if($data->Status=="濒临倒闭") selected="selected" @endif>濒临倒闭</option>
                            <option value="倒闭" @if($data->Status=="倒闭") selected="selected" @endif>倒闭</option>
                            <option value="其他" @if($data->Status=="其他") selected="selected" @endif>其他</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">债权相关凭证</label>
                        <div class="controls">
                            <input type="radio" name="Guaranty"  value="有" @if($data->Guaranty=="有") checked="checked" @endif/>有
                            <input type="radio" name="Guaranty"   value="无"  @if($data->Guaranty=="无") checked="checked" @endif/>无
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">债权涉诉情况</label>
                        <div class="controls">
                            <input type="radio" name="State"  value="已诉" @if($data->State=="已诉") checked="checked" @endif/>已诉
                            <input type="radio" name="State"   value="未诉"  @if($data->State=="未诉") checked="checked" @endif />未诉
                            <input type="radio" name="State"   value="已判决"  @if($data->State=="已判决") checked="checked" @endif />已判决
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">债务方行业</label>
                        <div class="controls">
                            <select  name="Industry" id="Industry"/>
                            <option value="IT|通信|电子|互联网" @if($data->Industry=="IT|通信|电子|互联网") selected="selected" @endif>IT|通信|电子|互联网</option>
                            <option value="金融业" @if($data->Industry=="金融业") selected="selected" @endif>金融业</option>
                            <option value="房地产|建筑业" @if($data->Industry=="房地产|建筑业") selected="selected" @endif>房地产|建筑业</option>
                            <option value="商业服务" @if($data->Industry=="商业服务") selected="selected" @endif>商业服务</option>
                            <option value="贸易|批发|零售|租赁业" @if($data->Industry=="贸易|批发|零售|租赁业") selected="selected" @endif>贸易|批发|零售|租赁业</option>
                            <option value="文体教育|工艺美术" @if($data->Industry=="文体教育|工艺美术") selected="selected" @endif>文体教育|工艺美术</option>
                            <option value="生产|加工|制造" @if($data->Industry=="生产|加工|制造") selected="selected" @endif>生产|加工|制造</option>
                            <option value="交通|运输|物流|仓储" @if($data->Industry=="交通|运输|物流|仓储") selected="selected" @endif>交通|运输|物流|仓储</option>
                            <option value="服务业" @if($data->Industry=="服务业") selected="selected" @endif>服务业</option>
                            <option value="文化|传媒|娱乐|体育" @if($data->Industry=="文化|传媒|娱乐|体育") selected="selected" @endif>文化|传媒|娱乐|体育</option>
                            <option value="能源|矿产|环保" @if($data->Industry=="能源|矿产|环保") selected="selected" @endif>能源|矿产|环保</option>
                            <option value="政府|非盈利机构" @if($data->Industry=="政府|非盈利机构") selected="selected" @endif>政府|非盈利机构</option>
                            <option value="农|林|牧|渔|其他" @if($data->Industry=="农|林|牧|渔|其他") selected="selected" @endif>农|林|牧|渔|其他</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label checkState">项目亮点</label>
                        <div class="controls newsType">
                            <input type="checkbox" name="ProLabel[]"  value="债务方有偿还能力"   @if(in_array("债务方有偿还能力",$proLabels)) checked="checked" @endif/>佣金比例高
                            <input type="checkbox" name="ProLabel[]"   value="法律关系明确"  @if(in_array("法律关系明确",$proLabels)) checked="checked" @endif />法律关系明确
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
                   {{-- @foreach($Names as $name)
                        <div class="control-group">
                            <label class="control-label">服务方名称</label>
                            <div class="controls">
                                <input type="text" name="SerName" id="SerName" value="{{$name->SerName}}"   />
                            </div>
                        </div>
                    @endforeach
                    <div class="control-group">
                        <label class="control-label">服务方信息</label>
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
                    <div class="control-group">
                        <label class="control-label">項目推进进度</label>
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
                                        <td> <input type="text" name="Events[0][]" value="{{$event->Events}}" style='margin-right: 20px;width: 600px;' /></td>
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
    {{--    <script>
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


        </script>--}}
    </div>
    </div>
@endsection