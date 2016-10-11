@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="{{asset('css/member.css ')}}"/>
    <style>
        .red{
            color: red;
        }
    </style>
    <div id="breadcrumb" style="position:relative">
        <a href="{{asset('talk/index')}}" title="融云信息" class="tip-bottom"><i class="icon-home"></i>融云信息</a>
        <a href="#" class="current">选择发送人</a>
    </div>
    @if(session("msg"))
        <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>{{session("msg")}}</strong>
        </div>
    @endif
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                            <span class="icon">
                                <i class="icon-align-justify"></i>
                            </span>
                    <h5>选择发送人</h5>
                </div>
                <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="{{asset('talk/index')}}" name="basic_validate"  novalidate="novalidate" />
                        <table  class="table table-bordered table-striped">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <td>
                                <div class="control-group">
                                    <label class="control-label">编号</label>
                                    <div class="controls " >
                                        @if(!empty($usersId))
                                            <input type="text" name="usersId"  id="usersId" value="{{$usersId}}"  style="width:100px"/>
                                        @else
                                            <input type="text" name="usersId" id="usersId" value="" style="width:100px"/>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="control-group">
                                    <label class="control-label checkState">手机号</label>
                                    <div class="controls selectBox" >
                                      @if(!empty($phoneNumber))
                                            <input type="text" name="phoneNumber" id="phoneNumber" value="{{$phoneNumber}}"  style="width:100px" />
                                       @else
                                            <input type="text" name="phoneNumber" id="phoneNumber" value=""   style="width:100px"/>
                                       @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="control-group">
                                    <label class="control-label">当前状态</label>
                                    <div class="controls" >
                                        <select  name="state" id="state"/>
                                        <option value="0" @if(isset($state) && $state==0) selected="selected" @endif>全部</option>
                                        <option value="1" @if(isset($state) && $state==1) selected="selected" @endif>已聊</option>
                                        </select>
                                    </div>
                                </div>
                            </td>
                            <td class="tdSearch">
                                <div class="form-actions searchBox checkSearch">
                                    <input type="submit" value="搜索" class="btn btn-success" />
                                </div>
                            </td>
                        </table>
                        </form>
                    </div>
                    <div  class="container-fluid">
                        <div class="widget-content nopadding">
                            <table class="table table-bordered table-striped">
                                @if(!empty($projectId))
                                <input type="hidden" name="projectID" id="projectID" value="{{$projectId}}">
                                    @else
                                    <input type="hidden" name="projectID" id="projectID" value="">
                                @endif
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>手机号</th>
                                    <th>注册时间</th>
                                    <th>角色</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datas as $data)
                                    <tr>
                                        <td>{{$data->userid}}</td>
                                        <td>{{$data->phonenumber}}</td>
                                        <td>{{$data->created_at}}</td>
                                        @if($data->role==1)
                                            <td>服务方</td>
                                        @elseif($data->role==2)
                                            <td>发布方</td>
                                        @else
                                            <td>注册</td>
                                        @endif
                                        <td class="talkMessage"  >
                                            <a href="{{url('talk/message/'.$data->userid)}}" id="project_{{$data->userid}}" >查看聊天记录</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="pagination alternate">
                            {!! $datas->appends(["phonenumber"=>$phoneNumber,"userid"=>$usersId,"state"=>$state])->render() !!}
                        </div>
                        <script>
                            $(function(){
                                $(".talkMessage a").on("focus",function(){
                                    var urlName=$(this).attr("href");
                                    var number=urlName.lastIndexOf('/');
                                    var id=urlName.substring(number+1);
                                    $.ajax({
                                        url:"{{asset('talk/ajaxData')}}",
                                        data:{data:id,_token:"{{ csrf_token() }}"},
                                        dataType:"json",
                                        type:"post",
                                        success:function(msg){

                                        }
                                    })
                                });
                                var projectId=$("#projectID").val();
                                if(projectId){
                                    $("#"+projectId).addClass('red')
                                }
                            })
                        </script>
                    </div>
 @endsection
