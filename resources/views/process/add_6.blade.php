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
                            <label class="control-label checkState">项目所在地</label>
                            <div class="controls selectBox" >
                                <input type="text" name="ProArea" id="ProArea" value=""/>
                            </div>
                        </div>
                        <div class="control-group" id="AssetType">
                            <label class="control-label">融资方式</label>
                            <div class="controls">
                                <input type="radio" name="AssetType"  value="17"checked="checked" />债权融资
                                <input type="radio" name="AssetType"  value="6" />股权融资
                            </div>
                        </div>
                        <div class="control-group" id="Type">
                            <label class="control-label">担保方式</label>
                            <div class="controls">
                                <input type="radio" name="Type"  value="抵押"  checked="checked">抵押
                                <input type="radio" name="Type"   value="质押" />质押
                                <input type="radio" name="Type"  value="担保人"  />担保人
                                <input type="radio" name="Type"  value="其他" />其他
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">融资金额</label>
                            <div class="controls">
                                <input type="number" name="Money" id="Money" value=""/>
                            </div>
                        </div>
                        <div class="control-group" id="Month" >
                            <label class="control-label">使用期限(月)</label>
                            <div class="controls">
                                <input type="number" name="Month" value=""/>
                            </div>
                        </div>
                    <div class="control-group" id="Rate" style="display: none">
                        <label class="control-label">出让股权比例</label>
                        <div class="controls">
                            <input type="number" name="Rate"  value=""/>
                        </div>
                    </div>
                    <div class="control-group" id="Status" style="display: none">
                        <label class="control-label">企业现状</label>
                        <div class="controls">
                            <input type="radio" name="Status"  value="初创期" />初创期
                            <input type="radio" name="Status"  value="成长期" />成长期
                            <input type="radio" name="Status"  value="其他" />其他
                        </div>
                    </div>
                    <div class="control-group" id="Belong" style="display: none">
                        <label class="control-label checkState">所属行业</label>
                        <div class="controls selectBox" >
                            <select  name="Belong" />
                            <option value="IT|通信|电子|互联网" >IT|通信|电子|互联网</option>
                            <option value="金融业" >金融业</option>
                            <option value="房地产|建筑业" >房地产|建筑业</option>
                            <option value="商业服务">商业服务</option>
                            <option value="贸易|批发|零售|租赁业" >贸易|批发|零售|租赁业</option>
                            <option value="文体教育|工艺美术" >文体教育|工艺美术</option>
                            <option value="生产|加工|制造" >生产|加工|制造</option>
                            <option value="交通|运输|物流|仓储">交通|运输|物流|仓储</option>
                            <option value="服务业" >服务业</option>
                            <option value="文化|传媒|娱乐|体育">文化|传媒|娱乐|体育</option>
                            <option value="能源|矿产|环保" >能源|矿产|环保</option>
                            <option value="政府|非盈利机构" >政府|非盈利机构</option>
                            <option value="农|林|牧|渔|其他" >农|林|牧|渔|其他</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group"  id="Usefor" style="display: none">
                        <label class="control-label checkState">资金用途</label>
                        <div class="controls selectBox" >
                            <select  name="Usefor"/>
                            <option value="经营" >经营</option>
                            <option value="扩张" >扩张</option>
                            <option value="其他" >其他</option>
                            </select>
                        </div>
                    </div>
                        <div class="control-group" id="ProLabel_01">
                            <label class="control-label checkState">项目亮点</label>
                            <div class="controls newsType">
                                <input type="checkbox" name="ProLabel[]"  value="抵押物足值"  />抵押物足值
                                <input type="checkbox" name="ProLabel[]"  value="回报率高" />回报率高
                            </div>
                        </div>
                    <div class="control-group"  id="ProLabel_02" style="display: none" >
                        <label class="control-label checkState">项目亮点</label>
                        <div class="controls newsType">
                            <input type="checkbox" name="ProLabel[]"  value="大股东兜底"  />大股东兜底
                            <input type="checkbox" name="ProLabel[]"   value="热门项目"  />热门项目
                            <input type="checkbox" name="ProLabel[]"   value="成熟市场"  />成熟市场
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
                                    <th>事件</th>
                                    <th>备注</th>
                                </tr>
                                <tr>
                                    <td> <input type="text" name="Events[0][]" class="shortTime" value="" /></td>
                                    <td> <input type="text" name="Events[0][]" value=""  style='margin-right: 20px;width: 600px;'/></td>
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
            </script>
        <script>
            $(function() {
                $("input[type='radio']").on("click", function () {
                    var types = $("#AssetType input[type='radio']:checked").val();
                   if(types=="6"){
                       $("#Month").hide();
                       $("#Type").hide();
                       $("#ProLabel_01").hide();
                       $("#Rate").show();
                       $("#Status").show();
                       $("#Belong").show();
                       $("#Usefor").show();
                       $("#ProLabel_02").show();
                   }else{
                       $("#Month").show();
                       $("#Type").show();
                       $("#ProLabel_01").show();
                       $("#Rate").hide();
                       $("#Status").hide();
                       $("#Belong").hide();
                       $("#Usefor").hide();
                       $("#ProLabel_02").hide();
                   }
                })
            })
        </script>
        </div>
    </div>
@endsection