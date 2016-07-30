@extends('layouts.master')
@section('content')
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
                    @foreach($datas as $data)
                        <input type="hidden" name="id" value="{{$id}}">
                        <div class="control-group">
                            <label class="control-label">联系方式</label>
                            <div class="controls">
                                <input type="text" name="name" id="required" value="{{$data->phonenumber}}"  placeholder="Readonly input here…" readonly/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">地区</label>
                            <div class="controls">
                                <input type="text" name="number" id="date" value="{{$data->ProArea}}" readonly/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">服务类型</label>
                            <div class="controls">
                                <input type="text" name="type" id="type" value="{{$data->TypeName}}"readonly/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">类型</label>
                            <div class="controls">
                                <input type="text" name="AssetType" id="AssetType" value="{{$data->AssetType}}"readonly/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">金额</label>
                            <div class="controls">
                                <input type="text" name="TotalMoney" id="TotalMoney" value="{{$data->TotalMoney}}"readonly/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">转让价</label>
                            <div class="controls">
                                <input type="text" name="transferMoney" id="transferMoney" value="{{$data->TransferMoney}}"readonly/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">文字描述</label>
                            <div class="controls">
                                <input type="text" name="wordDes" id="eordDes" value="{{$data->WordDes}}"
                                       readonly/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">语音描述</label>
                            <div class="controls">
                                <input type="text" name="videoDes" id="videoDes" value="{{$data->VoiceDes}}"
                                       readonly/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">发布时间</label>
                            <div class="controls">
                                <input type="text" name="PublishTime" id="PublishTime" value="{{$data->PublishTime}}"
                                       readonly/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">审核时间</label>
                            <div class="controls">
                                <input type="text" name="CertifyTime" id="CertifyTime" value="{{$data->CertifyTime}}"
                                       readonly/>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">浏览次数</label>
                            <div class="controls">
                                <input type="text" name="ViewCount" id="ViewCount" value="{{$data->ViewCount}}"
                                       readonly/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">收藏次数</label>
                            <div class="controls">
                                <input type="text" name="CollectionCount" id="CollectionCount" value="{{$data->CollectionCount}}"
                                       readonly/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">相关凭证</label>
                            <div class="controls">
                                <input type="hidden" id="filepath" name="checklogo">
                                <input id="file_upload" name="file_upload"  multiple="true">
                            </div>
                            <div class="controls  span3">
                                <div><img id="PictureDes1" alt=""  @if(!empty($data->PictureDes1)) src="{{'Http://images.ziyawang.com'.$data->PictureDes1}}"   @endif/>
                                       <span><a href="{{asset('Http://images.ziyawang.com'."$data->PictureDes1")}}"><i class="icon-download PictureDes1" @if(empty($data->PictureDes1)) style="display:none" @endif></i></a>&nbsp&nbsp
                                           <i class="icon-trash PictureDes1" @if(empty($data->PictureDes1)) style="display:none" @endif ></i>
                                       </span>
                                </div>
                                <div><img  id="PictureDes2" alt=""  @if(!empty($data->PictureDes2))  src="{{'Http://images.ziyawang.com'.$data->PictureDes2}}" @endif/>
                                        <span><a href="{{asset('Http://images.ziyawang.com'."$data->PictureDes2")}}"><i class="icon-download PictureDes2"  @if(empty($data->PictureDes2)) style="display:none" @endif></i></a>&nbsp&nbsp
                                            <i class="icon-trash PictureDes2" @if(empty($data->PictureDes2)) style="display:none" @endif></i>
                                        </span>
                                </div>
                                <div><img  id="PictureDes3" alt=""  @if(!empty($data->PictureDes3))  src="{{'Http://images.ziyawang.com'.$data->PictureDes3}}"  @endif/>
                                            <span><a href="{{asset('Http://images.ziyawang.com'."$data->PictureDes3")}}"><i class="icon-download PictureDes3 " @if(empty($data->PictureDes3)) style="display:none" @endif ></i></a>&nbsp&nbsp
                                                <i class="icon-trash PictureDes3" @if(empty($data->PictureDes3)) style="display:none" @endif ></i>
                                            </span>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">审核状态</label>
                            <div class="controls">
                                <select name="state" id="state">
                                    <option value="0" >-请选择-</option>
                                    <option value="1" @if($data->CertifyState==1)selected="selected" @endif>已审核</option>
                                    <option value="2" @if($data->CertifyState==2)selected="selected" @endif>拒审核</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group" id="remark" style="display: none">
                            <label class="control-label">备注</label>
                            <div class="controls">
                                <input type="text" name="remark" id="date" value=""/>
                            </div>
                        </div>
                    @endforeach
                    <div class="form-actions">
                        <input type="submit" value="修改" class="btn btn-primary"/>
                        <a href="{{url('check/index')}}"><input type=button value="返回" class="btn btn-primary"/></a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>

        $("#state").on("change", function () {
            var result2 = $(this).val();
            if (result2==2) {
                $("#remark").show();
            } else {
                $("#remark").hide();
            }
        });
        $(function(){
            $(".PictureDes1").on("click",function(){
                var id=$("input[name='id']").val();
                $.ajax({
                    url:"{{asset('check/handle')}}",
                    data:{"data":id,"title":"PictureDes1","_token":"{{ csrf_token() }}"},
                    dataType:"json",
                    type:"post",
                    success:function(mag){
                        if(mag.state==1){
                            $("#PictureDes1").removeAttrs("src")
                            $(".PictureDes1").hide();
                        }
                    }
                });
            });
        });
        $(function(){
            $(".PictureDes2").on("click",function(){
                var id=$("input[name='id']").val();
                $.ajax({
                    url:"{{asset('check/handle')}}",
                    data:{"data":id,"title":"PictureDes2","_token":"{{ csrf_token() }}"},
                    dataType:"json",
                    type:"post",
                    success:function(mag){
                        if(mag.state==1){
                            $("#PictureDes2").removeAttrs("src");
                            $(".PictureDes2").hide();
                        }
                    }
                });
            });
        });
        $(function(){
            $(".PictureDes3").on("click",function(){
                var id=$("input[name='id']").val();
                $.ajax({
                    url:"{{asset('check/handle')}}",
                    data:{"data":id,"title":"PictureDes3","_token":"{{ csrf_token() }}"},
                    dataType:"json",
                    type:"post",
                    success:function(mag){
                        if(mag.state==1){
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
                    'timestamp' : '<?php echo $timestamp;?>',
                    '_token'     : "{{csrf_token()}}"
                },
                'removeCompleted' : true,
                'fileSizeLimit':"1M",
                'uploadLimit'     : 10,
                'uploadScript'     :"{{url('/check/upload')}}",
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
                            url:"{{asset('check/editHandle')}}",
                            data:{"id":id,"data":data,"title":"PictureDes1","_token":"{{ csrf_token() }}"},
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
                            url:"{{asset('check/editHandle')}}",
                            data:{"id":id,"data":data,"title":"PictureDes2","_token":"{{ csrf_token() }}"},
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
                            url:"{{asset('check/editHandle')}}",
                            data:{"id":id,"data":data,"title":"PictureDes3","_token":"{{ csrf_token() }}"},
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
        });
    </script>

@endsection