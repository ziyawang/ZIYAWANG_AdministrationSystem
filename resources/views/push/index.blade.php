@extends('layouts.master')
@section('content')
    <div id="breadcrumb" style="position:relative" xmlns="http://www.w3.org/1999/html">
        <a href="{{asset('push/index')}}" title="审核列表" class="tip-bottom"><i class="icon-home"></i>推送</a>
        <a href="#" class="current">推送信息</a>
    </div>
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                            <span class="icon">
                                <i class="icon-align-justify"></i>
                            </span>
                    <h5>推送消息</h5>
                </div>
                <div class="widget-content nopadding ">
                    <form class="form-horizontal" method="post" action="{{asset('push/save')}}" />
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="control-group">
                            <label class="control-label">收信人</label>
                            <div class="controls">
                                <input type="text" name="recevie" id="receive"   value=""    />
                                       <a href="{{asset('push/receive')}}"><input type="button" value="选择收信人" class="btn btn-success" /></a>
                            </div>
                        </div>
                        <div class="control-group " >
                            <label class="control-label">标题</label>
                            <div class="controls">
                                <input type="text" name="title" id="title" value="" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">内容</label>
                            <div class="controls">
                                <textarea type= name="contant" id="contant" value=""></textarea>
                                <input type="button" value="选择推送内容" class="btn btn-success" />
                            </div>
                        </div>

                    <div class="form-actions">
                        <input type="submit" value="推送" class="btn btn-primary"/>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection