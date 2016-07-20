@extends('layouts.master')
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
                        <form class="form-horizontal" method="post" action="{{asset('publish/update')}}" name="basic_validate" id="basic_validate" novalidate="novalidate" />
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        @foreach($db as $data)
                            <input type="hidden" name="id" value="{{$data->userid}}">
                        <div class="control-group">
                            <label class="control-label">姓名</label>
                            <div class="controls">
                                <input type="text" name="name" id="required" value="{{$data->username}}" readonly/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">邮箱</label>
                            <div class="controls">
                                <input type="text" name="email" id="email"  value="{{$data->email}}"  readonly/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">注册手机号</label>
                            <div class="controls">
                                <input type="text" name="number" id="date" value="{{$data->phonenumber}}"  readonly/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">注册时间</label>
                            <div class="controls">
                                <input type="text" name="password" id="url" value="{{$data->created_at}}"  readonly/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">注册图像</label>
                            <div class="controls">
                                <input type="area" name="password" id="url" value="{{$data->UserPicture}}"  readonly/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">当前状态</label>
                            <div class="controls">
                                <select name="status" id="status">
                                        <option value="0"  @if($data->Status==0) selected="selected"  @endif>冻结</option>
                                        <option value="1" @if($data->Status==1)selected="selected"  @endif>解冻</option>
                                    </select>
                            </div>
                        </div>
                        <div class="control-group"  id="remark"style="display:none;">
                            <label class="control-label">备注</label>
                            <div class="controls">
                                <input type="text" name="remark" id="date" value="{{$data->Remark}}"/>
                            </div>
                        </div>
                            <div class="form-actions">
                                <input type="submit" value="修改" class="btn btn-primary"/>
                                <a href="{{url('publish/index')}}"><input type="button" value="返回" class="btn btn-primary"/></a>
                            </div>
                        @endforeach
                        </form>
                    </div>
                </div>
            </div>
        </div>

<script>
    var result1 = $("#status").val();
    $("#status").on("change", function () {
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