@extends('layouts.master');
@section('content')
    <div id="breadcrumb" style="position:relative">
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>会员</a>
        <a href="#" class="current">发布方详情页</a>
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
                        @foreach($db as $data)
                        <div class="control-group">
                            <label class="control-label">姓名</label>
                            <div class="controls">
                                <input type="text" name="name" id="required" value="{{$data->username}}"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">邮箱</label>
                            <div class="controls">
                                <input type="text" name="email" id="email"  value="{{$data->email}}"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">注册手机号</label>
                            <div class="controls">
                                <input type="text" name="number" id="date" value="{{$data->phonenumber}}"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">注册时间</label>
                            <div class="controls">
                                <input type="text" name="password" id="url" value="{{$data->created_at}}"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">注册图像</label>
                            <div class="controls">
                                <input type="area" name="password" id="url" value="{{$data->UserPicture}}"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">当前状态</label>
                            <div class="controls">
                                @if($data->Status==0)
                                    <input type="text" name="number" id="date" value="冻结"/>
                                @else
                                    <input type="text" name="number" id="date" value="解冻"/>
                                @endif
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">备注</label>
                            <div class="controls">
                                <input type="text" name="number" id="date" value="{{$data->Remark}}"/>
                            </div>
                        </div>
                        @endforeach
                        <div class="form-actions">
                            <a href="{{url('publish/index')}}"><input type=button value="返回" class="btn btn-primary"/></a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>




    </div>

@endsection