@extends('layouts.master')
@section('content')
    <div id="breadcrumb" >
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>系统</a>
        <a href="#" class="current">添加用户</a>

    </div>

    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                            <span class="icon">
                                <i class="icon-align-justify"></i>
                            </span>
                    <h5>Basic validation</h5>
                </div>
                <div class="widget-content nopadding">
                    <form class="form-horizontal" method="post" action="{{asset('systems/role/update')}}" name="basic_validate"  novalidate="novalidate" />
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="control-group">
                        <label class="control-label">角色名称</label>
                        @foreach($db as $value)
                            <input type="hidden" name="id" value="{{ $value->id }}">
                        <div class="controls">
                            <input type="text" name="roleName" value="{{$value->RoleName}}" />
                        </div>
                            @endforeach
                    </div>
                    <div class="form-actions">
                        <input type="submit" value="确定" class="btn btn-primary" />
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
