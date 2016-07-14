@extends('layouts.master');
@section('content')
    <div id="breadcrumb" style="position:relative">
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
        <a href="#" class="current">添加用户</a>

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
                            <div class="control-group">
                                <label class="control-label">姓名</label>
                                <div class="controls">
                                    <input type="text" name="name" id="required" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">邮箱</label>
                                <div class="controls">
                                    <input type="text" name="email" id="email" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">手机号</label>
                                <div class="controls">
                                    <input type="password" name="number" id="date" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">密码</label>
                                <div class="controls">
                                    <input type="password" name="password" id="url" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">部门</label>
                                <div class="controls">
                                    <select  name="department" id="url" />
                                            <option value="技术部">技术部</option>
                                            <option value="产品部">产品部</option>
                                            <option value="销售部">销售部</option>
                                            <option value=人事部">人事部</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" value="添加" class="btn btn-primary" />
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>




    </div>

@endsection