@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="{{asset('css/member.css ')}}"/>
    <div id="breadcrumb" style="position:relative">
        <a href="#" title="客户列表" class="tip-bottom"><i class="icon-home"></i>客户列表</a>
        <a href="#" class="current">客户列表</a>
        <a href="{{url('customer/add')}}" class="pull-right" id="export"> <div class="btn btn-primary " >添加</div></a>
    </div>
 <div class="widget-content nopadding">
           <form class="form-horizontal" method="post" action="{{asset('customer/index')}}" name="basic_validate"  novalidate="novalidate" />
        <table  class="table table-bordered table-striped servicerTable">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <td>
                <div class="control-group">
                    <label class="control-label checkState">类型</label>
                    <div class="controls selectBox" >
                        <select  name="typeName" id="typeName"/>
                        <option value="全部" class="select1">---全部---</option>
                        <option value="收购资产包" @if(!empty($typeName) && $typeName=="收购资产包") selected="selected" @endif>收购资产包</option>
                        <option value="委外催收" @if(!empty($typeName) && $typeName=="委外催收") selected="selected" @endif>委外催收</option>
                        <option value="法律服务" @if(!empty($typeName) && $typeName=="法律服务") selected="selected" @endif>法律服务</option>
                        <option value="收购固产" @if(!empty($typeName) && $typeName=="收购固产") selected="selected" @endif>收购固产</option>
                        <option value="投融资服务" @if(!empty($typeName) && $typeName=="投融资服务") selected="selected" @endif>投融资服务</option>
                        </select>
                    </div>
                </div>
            </td>
            <td>
                <div class="control-group">
                    <label class="control-label checkState">客户名称</label>
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
            <td>
                <div class="control-group">
                    <label class="control-label checkState">客情维护人</label>
                    <div class="controls selectBox" >
                        <select  name="Name" id="Name"/>
                        <option value="0" class="select1">---全部---</option>
                        @foreach($Names as $name)
                        <option value="{{$name->id}}" @if(!empty($Name) && $Name=="$name->id") selected="selected" @endif>{{$name->Name}}</option>
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
                    <th style="width:20%">客户名称</th>
                    <th>客户类型</th>
                    <th>服务类型</th>
                    <th>所属部门</th>
                    <th>客情维护人</th>
                    <th>动态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td>{{$data->Number}}</td>
                        <td>{{$data->CustomerName}}</td>
                        <td>{{$data->CustType}}</td>
                        <td>{{$data->ServiceType}}</td>
                        <td>{{$data->Department}}</td>
                        <td>{{$data->Name}}</td>
                        <td>{{$data->updated_at}}</td>
                        <td>
                            <a href="{{url('customer/detail/'.$data->CustomerID)}}">查看</a>
                            <a href="{{url('customer/delete/'.$data->CustomerID)}}" onclick="return confirm('确定将此记录删除?')">删除</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination alternate">
            {!! $datas->appends(["typeName"=>$typeName,"serviceName"=>$serviceName,"department"=>$department,"Name"=>$Name])->render() !!}
        </div>
    </div>
    @endsection
            <!-- TODO: Current Tasks -->
