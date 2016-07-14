@extends('layouts.master')

@section('content')
    <div id="breadcrumb">
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 新闻</a>
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
                    <form action="#" method="get" class="form-horizontal" />
                    <div class="control-group">
                        <label class="control-label">新闻标题</label>
                        <div class="controls">
                            <input type="text" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">摘要</label>
                        <div class="controls">
                            <textarea></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">新闻内容</label>
                        <div class="controls">
                            <textarea name="zertest" class="ckeditor"></textarea>
                            <script type="text/javascript">CKEDITOR.replace('zertest');</script>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Input with placeholder</label>
                        <div class="controls">
                            <input type="text" placeholder="This is a placeholder..." />
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">保存</button>
                    </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
@endsection