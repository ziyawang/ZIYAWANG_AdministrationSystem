@extends('layouts.master')
@section('content')
    <div id="breadcrumb" style="position:relative">
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>会员</a>
        <a href="#" class="current">服务方详情页</a>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>
								</span>
                        <h5>Basic validation</h5>
                        <span class="label label-important">48 notices</span>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="{{asset('service/update')}}"
                              name="basic_validate" id="basic_validate" novalidate="novalidate"/>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @foreach($datas as $data)
                            <input type="hidden" name="id" value="{{$id}}">
                            <div class="control-group">
                                <label class="control-label">公司名称</label>
                                <div class="controls">
                                    <input type="text" name="name" id="required" value="{{$data->ServiceName}}"
                                           readonly/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">联系方式</label>
                                <div class="controls">
                                    <input type="text" name="email" id="email" value="{{$data->ConnectPhone}}"
                                           readonly/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">地址</label>
                                <div class="controls">
                                    <input type="text" name="number" id="date" value="{{$data->ServiceLocation}}"
                                           readonly/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">服务类型</label>
                                <div class="controls">
                                    <input type="text" name="password" id="url" value="{{$data->ServiceType}}"
                                           readonly/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">服务地区</label>
                                <div class="controls">
                                    <input type="area" name="password" id="url" value="{{$data->ServiceArea}}"
                                           readonly/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">审核状态</label>
                                <div class="controls">
                                    <select name="state" id="state">
                                        <option value="0" @if($data->State==0) selected="selected" @endif>拒审核</option>
                                        <option value="1" @if($data->State==1)selected="selected" @endif>待审核</option>
                                        <option value="2" @if($data->State==2)selected="selected" @endif>已审核</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group" id="remark" style="display: none">
                                <label class="control-label">备注</label>
                                <div class="controls">
                                    <input type="text" name="remark" value="{{$data->ServiceIntroduction}}"/>
                                </div>
                            </div>
                        @endforeach
                        <div class="form-actions">
                            <input type="submit" value="修改" class="btn btn-primary"/>
                            <a href="{{url('service/index')}}"><input type=button value="返回"
                                                                      class="btn btn-primary"/></a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var result1 = $("#state").val();
            $("#state").on("change", function () {
                var result2 = $(this).val();
                if (result1 == result2) {
                    $("#remark").hide();
                } else {
                    $("#remark").css("display", "block");
                }


                // alert($result);
            });

        </script>
    </div>
@endsection