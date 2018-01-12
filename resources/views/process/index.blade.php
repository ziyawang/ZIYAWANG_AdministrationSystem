@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="{{asset('css/member.css ')}}"/>
    <div id="breadcrumb" style="position:relative">
        <a href="#" title="项目列表" class="tip-bottom"><i class="icon-home"></i>项目列表</a>
        <a href="#" class="current">项目列表</a>
        <a href="http://admin.ziyawang.com/process/add?typeName=资产包" class="pull-right" id="export"> <div class="btn btn-primary " >添加</div></a>
    </div>
    <div class="widget-content nopadding">
        <form class="form-horizontal" method="post" action="{{asset('process/index')}}" name="basic_validate"  novalidate="novalidate" />
        <table  class="table table-bordered table-striped servicerTable">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <td>
                <div class="control-group">
                    <label class="control-label checkState">项目类型</label>
                    <div class="controls selectBox" >
                        <select  name="typeName" id="typeName"/>
                        <option value="0">---全部---</option>
                        <option value="1" @if(!empty($typeName) &&$typeName=="1") selected="selected" @endif>资产包</option>
                        <option value="6,17" @if(!empty($typeName) &&$typeName=="6,17") selected="selected" @endif>融资信息</option>
                        <option value="12,16" @if(!empty($typeName) &&$typeName=="12,16") selected="selected" @endif>固定资产</option>
                        <option value="18" @if(!empty($typeName) &&$typeName=="18") selected="selected" @endif>企业商账</option>
                        <option value="19" @if(!empty($typeName) &&$typeName=="19") selected="selected" @endif>个人债权</option>
                        <option value="20,21,22" @if(!empty($typeName) &&$typeName=="20,21,22") selected="selected" @endif>法拍资产</option>
                        </select>
                    </div>
                </div>
            </td>
            </td>
            <td>
                <div class="control-group">
                    <label class="control-label checkState">项目名称</label>
                    <div class="controls selectBox" >
                        @if(!empty($serviceName))
                            <input type="text" name="serviceName"  id="serviceName" value="{{$serviceName}}"  style="width:100px"/>
                        @else
                            <input type="text" name="serviceName" id="serviceName" value="" style="width:100px"/>
                        @endif
                    </div>
                </div>
            </td>
            <td>
                <div class="control-group">
                    <label class="control-label checkState">部门</label>
                    <div class="controls selectBox" >
                        <select  name="department" id="department"/>
                        <option value="全部" class="select1">---全部---</option>
                        @foreach($Departments as $Department)
                            <option value="{{$Department}}" @if(!empty($department) && $department=="$Department") selected="selected" @endif>{{$Department}}</option>
                            @endforeach
                            </select>
                    </div>
                </div>
            </td>
            <td class="tdSearch">
                <div class="form-actions searchBox">
                    <input type="submit" value="搜索" class="btn btn-success" />
                </div>
            </td>
        </table>
        </form>
    </div>
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped checkTable">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>项目类型</th>
                    <th>项目名称</th>
                    <th>动态</th>
                    <th>项目负责人</th>
                    <th>所属部门</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td>{{$data->Number}}</td>
                        <td>{{$data->TypeName}}</td>
                        <td>{{$data->Title}}</td>
                        <td>{{$data->created_at}}</td>
                        <td>{{$data->Name}}</td>
                        <td>{{$data->Department}}</td>
                        <td>
                            <a href="{{url('process/detail/'.$data->ProjectID."/".$data->TypeID)}}">查看</a>
                            <a href="{{url('process/delete/'.$data->ProjectID)}}" onclick="return confirm('确定将此记录删除?')">删除</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination alternate">
            {!! $datas->appends(["typeName"=>$typeName,"serviceName"=>$serviceName,"department"=>$department])->render() !!}
        </div>
    </div>
    @endsection
            <!-- TODO: Current Tasks -->