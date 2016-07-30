@extends('layouts.master')

@section('content')
    <style type="text/css">
        .form-actions {
            padding: 0px 20px 20px;
            margin-top: 20px;
            margin-bottom: 20px;
            background-color: #f5f5f5;
            border-top: 0px solid #e5e5e5;
            *zoom: 1;
        }
        .form-horizontal .form-actions {
            padding-left: 50px;
        }

        .select2-container .select2-choice span {
            display: block;
            margin-right: 45px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
    <div id="breadcrumb" style="position:relative">
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>发布方</a>
        <a href="#" class="current">发布方列表</a>
        <a href="#" class="pull-right" id="export"> <div class=" btn btn-success ">导出</div></a>
    </div>
    <div class="widget-content nopadding">
        <form class="form-horizontal" method="post" action="{{asset('publish/index')}}" name="basic_validate"  novalidate="novalidate" />
        <table  class="table table-bordered table-striped">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <td>
                <div class="control-group">
                    <label class="control-label">当前状态</label>
                    <div class="controls" >
                        <select  name="state" id="state"/>
                        <option value="2">全部<option>
                        <option value="1" @if(isset($state) && $state==1) selected="selected" @endif>冻结</option>
                        <option value="0" @if(isset($state) && $state==0) selected="selected" @endif>正常</option>
                            </select>
                    </div>
                </div>
            </td>
            <td>
                <div class="control-group">
                    <label class="control-label">类型</label>
                    <div class="controls" >
                        <select  name="typeName" id="typeName"/>
                        <option value="0">---全部---</option>
                        @foreach($results as $result)
                            <option value="{{$result->TypeID}}" @if(!empty($typeName) && $typeName==$result->TypeID) selected="selected" @endif>{{$result->TypeName}}</option>
                            @endforeach
                            </select>
                    </div>
                </div>
            </td>
            <td>
                <div class="form-actions">
                    <input type="submit" value="搜索" class="btn btn-success" />
                </div>
            </td>
        </table>
        </form>
    </div>
    <script>
        $(function(){
            var type = $('#typeName').val();
            var state= $("#state").val();
            var url = 'http://admin.ziyawang.com/publish/export?type='+type+"&state="+state;
            $('#export').attr('href',url);
        });
    </script>
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>姓名</th>
                    <th>注册手机</th>
                    <th>注册时间</th>
                    <th>信息类型 </th>
                    <th>当前状态</th>
                    <th>备注</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td>{{$data->userid}}</td>
                        <td>{{$data->username}}</td>
                        <td>{{$data->phonenumber}}</td>
                        <td>{{$data->created_at}}</td>
                        <td>{{$data->TypeName}}</td>
                        @if($data->Status==0)
                            <td><p style="color:dodgerblue;margin:0 auto">正常</p></td>
                        @else
                           <td><p  style="color:dodgerblue">冻结</p></td>
                        @endif
                        <td>{{$data->Remark}}</td>
                        <td>
                            <a href="{{url('publish/detail/'.$data->userid)}}">查看</a>
                        </td>
                      
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination alternate">
            {!! $datas->render() !!}
        </div>

    </div>

    @endsection
            <!-- TODO: Current Tasks -->


