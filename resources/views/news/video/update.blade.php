@extends('layouts.master')

@section('content')
    <style>
        .radio input[type="radio"] {
            float: left;
            margin-left: 0px;
        }
        .radio{ vertical-align: sub;}
        .newsType .checker span .checker span{background-position: -76px -240px;}
    </style>
    <div id="breadcrumb">
        <a href="{{url('video/index')}}" title="视频管理" class="tip-bottom"><i class="icon-home"></i>视频管理</a>
        <a href="#" class="current">编辑视频</a>
    </div>
    @if(session("msg"))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>{{session("msg")}}</strong>
        </div>
    @endif
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>
								</span>
                    <h5>编辑视频</h5>
                </div>
                <div class="widget-content nopadding">
                    <form method="post" action="{{asset('video/saveupdate')}}" class="form-horizontal" />
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="videoid" value="{{$datas->VideoID}}">
                    <div class="control-group">
                        <label class="control-label">视频标题</label>
                        <div class="controls">
                            <input type="text" name="title" value="{{$datas->VideoTitle}}" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">视频类型</label>
                        <div class="controls newsType">
                            @foreach($types as $type)
                                @if(empty($count))
                                    <input type="checkbox" name="type[]" value="{{$type->id}}"/>{{$type->TypeName}}
                                @else
                                    <input type="checkbox" name="type[]" value="{{$type->id}}" @if(in_array($type->id,$count)) checked="checked" @endif />{{$type->TypeName}}
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">视频简介</label>
                        <div class="controls">
                            <textarea name="description" maxlength="200" placeholder="请您输入200个字数之内" >{{$datas->VideoDes}}</textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">视频封面(737X411)</label>
                        <div class="controls">
                            <input type="hidden" id="filepath" name="videologo" value="{{$datas->VideoLogo}}">
                            <input id="file_uploadvideopic" name="file_uploadvideopic"  multiple="true">
                        </div>
                        <div class="controls  span4">
                            <img src="{{"Http://images.ziyawang.com".$datas->VideoLogo}}" id="thumb" alt=""/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">首页封面(290X188)</label>
                        <div class="controls">
                            <input type="hidden" id="filepath3" name="videoThumb" value="{{$datas->VideoThumb}}">
                            <input id="file_uploadvideopic1" name="file_uploadvideopic1"  multiple="true">
                        </div>
                        <div class="controls  span4">
                            <img src="{{"Http://images.ziyawang.com".$datas->VideoThumb}}" id="thumb1" alt=""/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">视频内容</label>
                        <div class="controls">
                            <input type="hidden" id="filepath1" name="videolink" value="{{$datas->VideoLink}}">
                            <input id="file_uploadvideo" name="file_uploadvideo"  multiple="true">
                        </div>
                        <div class="controls  span4">
                            <video src="{{"Http://videos.ziyawang.com".$datas->VideoLink}}" id="videolink" controls="controls" width="400px" height="300px">
                                your browser does not support the video tag
                            </video>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">视频内容</label>
                        <div class="controls">
                            <input type="hidden" id="filepath2" name="videolink2" value="{{$datas->VideoLink2}}">
                            <input id="file_uploadvideo2" name="file_uploadvideo2"  multiple="true">
                        </div>
                        <div class="controls  span4">
                            <video src="{{"Http://videos.ziyawang.com".$datas->VideoLink2}}" id="videolink2" controls="controls" width="400px" height="300px">
                                your browser does not support the video tag
                            </video>
                        </div>
                    </div>
                    <div class="control-group " >
                        <label class="control-label">修改顺序</label>
                        <div class="controls"  >
                            <input type="number" name="order"  value="{{$datas->Order}}"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" style="padding-top: 13px;">视频级别</label>
                        <div class="controls" id="messageType">
                            <input type="radio" name="member"  value="0" @if($datas->Member=="0") checked="checked" @endif/><span style="display: inline-block;vertical-align: 0;">免费</span>
                            <input type="radio" name="member"  value="1" @if($datas->Member=="1") checked="checked" @endif/><span style="display: inline-block;vertical-align: 0;">收费</span>
                        </div>
                    </div>
                    @if($datas->Member=="1" && !empty($datas->Price))
                        <div class="control-group" id="goldId">
                            <label class="control-label">芽币</label>
                            <div class="controls">
                                <input type="number" name="gold" id="gold" value="{{$datas->Price}}"/>
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
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary" onClick="savevideo(0)" >保存</button>
                        <button id="publish" type="submit" class="btn btn-primary" onClick="savevideo(1)" >保存并发布</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        <?php $timestamp = time();?>

        function savevideo(para){
            var f = document.getElementsByTagName("form")[0];
            f.action=f.action+"/"+para;
        }

        $(function() {
            $("#file_uploadvideo2").uploadifive({
                'buttonText' : '上传视频',
                'formData'     : {
                    'timestamp' : '<?php echo $timestamp;?>',
                    '_token'     : "{{csrf_token()}}"
                },
                'removeCompleted' : false,
                'uploadScript'     :"{{url('/video/smallupload')}}",
                'onUploadComplete' : function(file, data) {
                    $('#filepath2').val(data);
                    $('#videolink2').attr('src', "Http://videos.ziyawang.com"+data);
                }
            });
        });
        $(function() {
            $("#file_uploadvideo").uploadifive({
                'buttonText' : '上传视频',
                'formData'     : {
                    'timestamp' : '<?php echo $timestamp;?>',
                    '_token'     : "{{csrf_token()}}"
                },
                'removeCompleted' : false,
                'uploadScript'     :"{{url('/video/bigupload')}}",
                'onUploadComplete' : function(file, data) {
                    $('#filepath1').val(data);
                    $('#videolink').attr('src',"Http://videos.ziyawang.com"+data);
                }
            });
        });
        $(function() {
            $("#file_uploadvideopic").uploadifive({
                'buttonText' : '上传图片',
                'formData'     : {
                    'timestamp' : '<?php echo $timestamp;?>',
                    '_token'     : "{{csrf_token()}}"
                },
                'removeCompleted' : true,
                'fileSizeLimit':1024,
                'uploadScript'     :"{{url('video/upload')}}",
                'onUploadComplete' : function(file, data) {
                    $('#filepath').val(data);
                    $('#thumb').attr('src',"Http://images.ziyawang.com"+data);
                }
            });
        });
        $(function() {
            $("#file_uploadvideopic1").uploadifive({
                'buttonText' : '上传图片',
                'formData'     : {
                    'timestamp' : '<?php echo $timestamp;?>',
                    '_token'     : "{{csrf_token()}}"
                },
                'removeCompleted' : true,
                'fileSizeLimit':1024,
                'uploadScript'     :"{{url('video/upload')}}",
                'onUploadComplete' : function(file, data) {
                    $('#filepath3').val(data);
                    $('#thumb1').attr('src',"Http://images.ziyawang.com"+data);
                }
            });
        });
    </script>
    <script>
        $(function(){
            $("input[type='radio']").on("click",function(){
                var videoType=$("#messageType input[type='radio']:checked").val();
                if(videoType=="1"){
                    $("#goldId").show();
                }else{
                    $("#goldId").hide();
                }
            });
        })
    </script>
@endsection