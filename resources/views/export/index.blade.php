@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="{{asset('css/member.css ')}}"/>
    @if(session("msg"))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>{{session("msg")}}</strong>
        </div>
    @endif
    <div id="breadcrumb" style="position:relative">
        <a href="#" title="导出报表" class="tip-bottom"><i class="icon-home"></i>导出报表</a>
        <a href="#" class="current">信息列表</a>
        <a href="#" class="pull-right" id="export"> <div class="btn btn-primary " >导出</div></a>
    </div>
    <div class="widget-content nopadding">
        <form class="form-horizontal" method="post" action="{{asset('export/index')}}" name="basic_validate"  novalidate="novalidate" />
        <table  class="table table-bordered table-striped">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <td>
                <div class="control-group">
                    <label class="control-label checkState">类型</label>
                    <div class="controls selectBox" >
                        <select  name="typeName" id="typeName"/>
                            <option value="0">---全部---</option>
                            <option value="1" @if($typeName=="1") selected="selected" @endif>资产包</option>
                            <option value="6" @if($typeName=="6") selected="selected" @endif>融资信息</option>
                            <option value="17" @if($typeName=="17") selected="selected" @endif>融资信息</option>
                            <option value="12" @if($typeName=="12") selected="selected" @endif>固定资产</option>
                            <option value="16" @if($typeName=="16") selected="selected" @endif>固定资产</option>
                            <option value="18" @if($typeName=="18") selected="selected" @endif>企业商账</option>
                            <option value="19" @if($typeName=="19") selected="selected" @endif>个人债权</option>
                            <option value="20" @if($typeName=="20") selected="selected" @endif>法拍资产</option>
                            <option value="21" @if($typeName=="21") selected="selected" @endif>法拍资产</option>
                            <option value="22" @if($typeName=="22") selected="selected" @endif>法拍资产</option>
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
    <script>
        $(function(){
            var type = $('#typeName').val();
            var url = 'http://admin.ziyawang.com/export/export?type='+type;
            $('#export').attr('href',url);
        });
    </script>
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped checkTable">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>ID</th>
                    <th>联系方式</th>
                    <th>发布时间</th>
                    <th>地址</th>
                    <th>信息类型</th>
                    <th>约谈次数</th>
                    <th>浏览次数</th>
                    <th>收藏次数</th>
                    <th>发布渠道</th>
                    <th>审核状态</th>
                    <th>备注</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td>{{$data->number}}</td>
                        <td>{{$data->ProjectID}}</td>
                        <td>{{$data->phonenumber}}</td>
                        <td>{{$data->PublishTime}}</td>
                        <td>{{$data->ProArea}}</td>
                        <td>{{$data->TypeName}}</td>
                        <td><a href="{{asset("rush/detail/".$data->ProjectID)}}">{{$data->counts}}</a></td>
                        <td><a href="{{asset("check/viewDetail/".$data->ProjectID)}}">{{$data->ViewCount}}</a></td>
                        <td><a href="{{asset("check/collectDetail/".$data->ProjectID)}}">{{$data->CollectionCount}}</a></td>
                        <td>{{$data->Channel}}</td>
                        @if($data->State==0)
                            <td><p style="color: #149bdf">待审核</p></td>
                        @elseif($data->State==1)
                            <td><p style="color: #149bdf">已审核</p></td>
                        @else
                            <td><p style="color: #149bdf">拒审核</p></td>
                        @endif
                        <td>{{$data->Remark}}</td>
                        <td><a href="{{url('check/detail/'.$data->ProjectID.'/'.$data->TypeID)}}">查看</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination alternate">
            {!! $datas->appends(["typeName"=>$typeName])->render() !!}
        </div>
    </div>
    @endsection
            <!-- TODO: Current Tasks -->
