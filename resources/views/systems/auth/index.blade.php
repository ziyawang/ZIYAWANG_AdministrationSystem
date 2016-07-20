@extends('layouts.master')
@section('content')
    <div id="breadcrumb" style="position:relative">
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
                    <form class="form-horizontal" method="post" action="{{asset('systems/system/add')}}" name="basic_validate"  novalidate="novalidate" />
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="control-group">
                        <label class="control-label">角色名称</label>
                        <div class="controls">
                            <select  name="roleName" id="roleName" />
                            <option value="0">-请选择-</option>
                            @foreach($datas as $data)
                                <option value="{{$data->id}}">{{$data->RoleName}}</option>
                                @endforeach
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
        {{--<script>--}}

            {{--$("#roleName").on("change",function(){--}}
               {{--var roleId= $("#roleName").val();--}}
                {{--$.ajax({--}}
                    {{--url:"{{url(auth/getAuth)}}",--}}
                    {{--data:{"roleId":roleId},--}}
                    {{--dataType:"json",--}}
                    {{--type:"get",--}}
                    {{--success:function(){--}}
                        {{--var str--}}
                    {{--}--}}

                {{--});--}}
            {{--});--}}
        {{--</script>--}}
    </div>
@endsection            <!-- TODO: Current Tasks -->