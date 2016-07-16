@extends('layouts.master');
@section('content')
    <div id="breadcrumb" style="position:relative">
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>合作</a>
        <a href="#" class="current">订单详情页</a>
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
                                <label class="control-label">订单号</label>
                                <div class="controls">
                                    <input type="text" name="name" id="required" value="{{$data->RushProID}}" readonly />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">服务类型</label>
                                <div class="controls">
                                    <input type="text" name="email" id="email"  value="{{$data->TypeName}}" readonly/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">发布方名称</label>
                                <div class="controls">
                                    <input type="text" name="number" id="date" value="{{$data->phonenumber}}" readonly/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">处置方名称</label>
                                <div class="controls">
                                    <input type="text" name="password" id="url" value="{{$data->ServiceName}}" readonly/>
                                </div>
                            </div>
                        <div class="control-group">
                                <label class="control-label">下单时间</label>
                                <div class="controls">
                                    <input type="text" name="password" id="url" value="{{$data->RushTime}}" readonly/>
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label">退单状态</label>
                                <div class="controls">
                                    @if($data->RushProID==0)
                                        <input type="text" name="number" id="date" value="拒审核"/>
                                    @elseif($data->RushProID==1)
                                        <input type="text" name="number" id="date" value="待审核"/>
                                    @else
                                        <input type="text" name="number" id="date" value="已审核"/>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        <div class="form-actions">
                            <a href="{{url('order/index')}}"><input type=button value="返回" class="btn btn-primary"/></a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection