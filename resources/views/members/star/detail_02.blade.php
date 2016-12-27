@extends('layouts.master')

@section('content')
    <style>
        .newsType .checker span .checker span{background-position: -76px -240px;}
    </style>
    <div id="breadcrumb">
        <a href="{{url('star/index')}}" title="审核列表" class="tip-bottom"><i class="icon-home"></i> 星级审核</a>
        <a href="#" class="current">审核列表</a>
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
                    <h5>审核详情</h5>
                </div>
                <div class="widget-content nopadding">
                    <form method="post" action="{{asset('star/save')}}" class="form-horizontal" />
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="starPayIds" value="{{ $starPayIds }}">
                    @foreach($datas as $data)
                    <div class="control-group">
                        <label class="control-label">公司名称</label>
                        <div class="controls">
                            <input type="text" name="ServiceName" value="{{$data->ServiceName}}" readonly />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">联系方式</label>
                        <div class="controls">
                            <input type="text" name="ConnectPhone" value="{{$data->ConnectPhone}}" readonly />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">认证类型</label>
                        <div class="controls">
                            <input type="text" name="PayName" value="{{$data->PayName}}" readonly />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">认证费用(元)</label>
                        @if(!empty($data->PayMoney))
                            <div class="controls">
                                <input type="text" name="PayMoney" value="{{$data->PayMoney/100}}" readonly />
                            </div>
                        @else
                            <div class="controls">
                                <input type="text" name="PayMoney" value="0" readonly />
                            </div>
                        @endif
                    </div>
                    <div class="control-group">
                        <label class="control-label">认证时间</label>
                        <div class="controls">
                            <input type="text" name="created" value="{{$data->created_at}}" readonly />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">视频认证</label>
                        <div class="controls">
                            <input type="hidden" id="filepath1" name="Resource" value="{{$data->Resource}}">
                            <input id="file_uploadvideo" name="file_uploadvideo"  multiple="true">
                        </div>
                        <div class="controls  span4">
                            <video src="{{"Http://videos.ziyawang.com".$data->Resource}}" id="videolink" controls="controls" width="400px" height="300px">
                                your browser does not support the video tag
                            </video>
                        </div>
                    </div>
                        <div class="control-group">
                            <label class="control-label">审核状态</label>
                            <div class="controls">
                                <select name="state" id="state">
                                    <option value="0" >-请选择-</option>
                                    <option value="2" @if($data->State==2)selected="selected" @endif>已审核</option>
                                    <option value="3" @if($data->State==3)selected="selected" @endif>未通过</option>
                                </select>
                            </div>
                        </div>
                    @endforeach
                    <div class="form-actions">
                        <input type="submit" value="修改" class="btn btn-primary"/>
                        <a href="#"><input type=button value="返回" class="btn btn-primary" onclick="javascript:history.back(-1);"/></a>
                    </div>
                        </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        <?php $timestamp = time();?>
            $(function() {
            $("#file_uploadvideo").uploadifive({
                'buttonText' : '上传视频',
                'formData'     : {
                    'timestamp' : '<?php echo $timestamp;?>',
                    '_token'     : "{{csrf_token()}}"
                },
                'removeCompleted' : false,
                'uploadScript'     :"{{url('star/bigupload')}}",
                'onUploadComplete' : function(file, data) {
                    $('#filepath1').val(data);
                    $('#videolink').attr('src',"Http://videos.ziyawang.com"+data);
                }
            });
        });
    </script>
@endsection