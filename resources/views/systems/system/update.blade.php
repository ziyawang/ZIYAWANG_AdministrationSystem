@extends('layouts.master');
@section('content')
    <div id="breadcrumb" style="position:relative">
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
        <a href="#" class="current">编辑用户</a>

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
                        <form class="form-horizontal" method="post" action="{{asset('systems/system/update')}}" name="basic_validate" id="basic_validate" novalidate="novalidate" />
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{$datas['id']}}">
                        <div class="control-group">
                            <label class="control-label">姓名</label>
                            <div class="controls">
                                <input type="text" name="name" id="required" value="{{$datas['Name']}}" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">邮箱</label>
                            <div class="controls">
                                <input type="text" name="email" id="email" value="{{$datas['Email']}}"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">手机号</label>
                            <div class="controls">
                                <input type="text" name="number" id="date" value="{{$datas['PhoneNumber']}}"/>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">部门</label>
                            <div class="controls">
                                <select  name="department" id="url" />

                                <option value="技术部"   @if($datas['Department']=='技术部') selected="selected" @endif>技术部</option>
                                <option value="产品部"  @if($datas['Department']=='产品部')selected="selected" @endif>产品部</option>
                                <option value="销售部"  @if($datas['Department']=='销售部') selected="selected" @endif>销售部</option>
                                <option value="人事部"  @if($datas['Department']=='人事部') selected="selected" @endif>人事部</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-actions">
                            <input type="submit" value="编辑" class="btn btn-primary" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection