@extends('layouts.master')

@section('content')

    <div id="breadcrumb">
        <a href="{{url('video/index')}}" title="视频列表" class="tip-bottom"><i class="icon-home"></i> 视频</a>
        <a href="#" class="current">添加视频</a>
    </div>
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>
								</span>
                    <h5>添加视频</h5>
                </div>
                <div class="widget-content nopadding">
                    <form method="post" action="{{asset('video/add')}}" class="form-horizontal" />
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="control-group">
                        <label class="control-label">视频标题</label>
                        <div class="controls">
                            <input type="text" name="title" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">摘要</label>
                        <div class="controls">
                            <textarea name="description" ></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">视频封面</label>
                        <div class="controls">
                            <input type="hidden" id="filepath" name="videologo">
                            <input id="file_uploadvideopic" name="file_uploadvideopic"  multiple="true">
                        </div>
                        <div class="controls  span4">
                            <img src="" id="thumb" alt=""/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">视频内容</label>
                        <div class="controls">
                            <input type="hidden" id="filepath2" name="videolink">
                            <input id="file_uploadvideo" name="file_uploadvideo"  multiple="true">
                        </div>
                        <div class="controls  span4">
                            <video src="" id="videolink" controls="controls" width="400px" height="300px">
                                your browser does not support the video tag
                            </video>
                        </div>
                    </div>
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
            $("#file_uploadvideo").uploadifive({
                'buttonText' : '上传视频',
                'formData'     : {
                    'timestamp' : '<?php echo $timestamp;?>',
                    '_token'     : "{{csrf_token()}}"
                },
                'removeCompleted' : false,
                'uploadScript'     :"{{url('/news/upload')}}",
                'onUploadComplete' : function(file, data) {
                    $('#filepath2').val(data);
                    $('#videolink').attr('src', data);
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
                'uploadScript'     :"{{url('/news/upload')}}",
                'onUploadComplete' : function(file, data) {
                    $('#filepath').val(data);
                    $('#thumb').attr('src', data);
                }
            });
        });
    </script>
@endsection