@extends('layouts.master')

@section('content')
    <div id="breadcrumb" style="position:relative">
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>会员</a>
        <a href="#" class="current">审核列表</a>
        <a href="{{url('check/export')}}"> <div class=" btn btn-primary " style="position:absolute;right:0;bottom:0;">导出当前页</div></a>
    </div>
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead>

                <tr>
                    <th>ID</th>
                    <th>联系方式</th>
                    <th>发布时间</th>
                    <th>地址</th>
                    <th>服务类型</th>
                    <th>审核状态</th>
                    <th>备注</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td>{{$data->ProjectID}}</td>
                        <td>{{$data->phonenumber}}</td>
                        <td>{{$data->PublishTime}}</td>
                        <td>{{$data->ProArea}}</td>
                        <td>{{$data->TypeName}}</td>
                        @if($data->PublishState==0)
                            <td><p style="color: #149bdf">拒审核</p></td>
                        @elseif($data->PublishState==0)
                            <td><p style="color: #149bdf">待审核</p></td>
                        @else
                            <td><p style="color: #149bdf">已审核</p></td>
                        @endif
                        <td>8</td>
                        <td><a href="{{url('check/detail/'.$data->ProjectID)}}">查看</a></td>
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
