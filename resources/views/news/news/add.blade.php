@extends('layouts.master')

@section('content')

    <div id="breadcrumb">
        <a href="{{url('news/index')}}" title="新闻列表" class="tip-bottom"><i class="icon-home"></i> 新闻</a>
        <a href="#" class="current">添加新闻</a>
    </div>
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>
								</span>
                    <h5>添加新闻</h5>
                </div>
                <div class="widget-content nopadding">
                    <form method="post" action="{{asset('news/add')}}" class="form-horizontal" />
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="control-group">
                        <label class="control-label">新闻标题</label>
                        <div class="controls">
                            <input type="text" name="title" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">新闻类型</label>
                        <div class="controls">
                            @foreach($datas as $data)
                            <input type="checkbox" name="type[]" value="{{$data->id}}" />{{$data->TypeName}}
                          @endforeach
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">摘要</label>
                        <div class="controls">
                            <textarea name="description" ></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">新闻封面</label>
                        <div class="controls">
                            <input type="hidden" id="filepath" name="newslogo">
                            <input id="file_upload" name="file_upload"  multiple="true">
                        </div>
                        <div class="controls  span4">
                            <img src="" id="thumb" alt=""/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">新闻内容</label>
                        <div class="controls">
                            <textarea name="content" class="ckeditor"></textarea>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary" onClick="savenews(0)" >保存</button>
                        <button id="publish" type="submit" class="btn btn-primary" onClick="savenews(1)" >保存并发布</button>
                    </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        <?php $timestamp = time();?>

        function savenews(para){
            var f = document.getElementsByTagName("form")[0];
            f.action=f.action+"/"+para;
        }

        $(function() {
            $("#file_upload").uploadifive({
                'buttonText' : '上传图片',
                'formData'     : {
                    'timestamp' : '<?php echo $timestamp;?>',
                    '_token'     : "{{csrf_token()}}"
                },
                'removeCompleted' : true,
                'uploadScript'     :"{{url('/news/upload')}}",
                'onUploadComplete' : function(file, data) {
                    $('#filepath').val(data);
                    $('#thumb').attr('src',"Http://img.ziyawang.cn"+data);
                }
            });
        });
    </script>
@endsection