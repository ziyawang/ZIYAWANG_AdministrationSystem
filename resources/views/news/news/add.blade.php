@extends('layouts.master')

@section('content')
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
                        <label class="control-label">Input with description</label>
                        <div class="controls">
                            <input type="text" />
                            <span class="help-block">This is a description</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Input with placeholder</label>
                        <div class="controls">
                            <input type="text" placeholder="This is a placeholder..." />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Normal textarea</label>
                        <div class="controls">
                            <textarea></textarea>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
@endsection