@extends('layouts.master');
@section('content')
    <div id="breadcrumb" style="position:relative">
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>会员</a>
        <a href="#" class="current">服务方详情页</a>
    </div>
    <div  class="container-fluid">
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
                        <form class="form-horizontal" method="post" action="{{asset('systems/system/add')}}" name="basic_validate" id="basic_validate" novalidate="novalidate" />
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @foreach($datas as $data)
                            <div class="control-group">
                                <label class="control-label">公司名称</label>
                                <div class="controls">
                                    <input type="text" name="name" id="required" value="{{$data->ServiceName}}"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">联系方式</label>
                                <div class="controls">
                                    <input type="text" name="email" id="email"  value="{{$data->ConnectPhone}}"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">地址</label>
                                <div class="controls">
                                    <input type="text" name="number" id="date" value="{{$data->ServiceLocation}}"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">服务类型</label>
                                <div class="controls">
                                    <input type="text" name="password" id="url" value="{{$data->ServiceType}}"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">服务地区</label>
                                <div class="controls">
                                    <input type="area" name="password" id="url" value="{{$data->ServiceArea}}"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">审核状态</label>
                                <div class="controls">
                                    @if($data->State==0)
                                        <input type="text" name="number" id="date" value="拒审核"/>
                                    @elseif($data->State==1)
                                        <input type="text" name="number" id="date" value="待审核"/>
                                        @else
                                        <input type="text" name="number" id="date" value="已审核"/>
                                    @endif
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">备注</label>
                                <div class="controls">
                                    <input type="text" name="number" id="date" value="{{$data->ServiceIntroduction}}"/>
                                </div>
                            </div>
                        @endforeach
                        <div class="form-actions">
                            <a href="{{url('service/index')}}"><input type=button value="返回" class="btn btn-primary"/></a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection