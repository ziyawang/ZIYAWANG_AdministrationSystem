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
                        <form class="form-horizontal" method="post" action="{{asset('check/update')}}" name="basic_validate" id="basic_validate" novalidate="novalidate" />
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
                                <label class="control-label">发布时间</label>
                                <div class="controls">
                                    <input type="text" name="email" id="email"  value="{{$data->PublishTime}}" readonly/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">地址</label>
                                <div class="controls">
                                    <input type="text" name="number" id="date" value="{{$data->ProArea}}" readonly/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">服务类型</label>
                                <div class="controls">
                                    <input type="text" name="password" id="url" value="{{$data->TypeName}}"readonly/>
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
        </script>

@endsection