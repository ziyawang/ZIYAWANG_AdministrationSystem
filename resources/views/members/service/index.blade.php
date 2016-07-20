@extends('layouts.master')

@section('content')
    <div id="breadcrumb" style="position:relative">
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>服务方</a>
        <a href="#" class="current">服务方列表</a>
        <a href="{{url('service/export')}}" class="pull-right"> <div class=" btn btn-primary ">导出当前页</div></a>
    </div>
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>公司名称</th>
                    <th>联系方式</th>
                    <th>地址</th>
                    <th>服务类型</th>
                    <th>服务地区</th>
                    <th>公司介绍</th>
                    <th>审核状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td>{{$data->ServiceID}}</td>
                        <td>{{$data->ServiceName}}</td>
                        <td>{{$data->ConnectPhone}}</td>
                        <td>{{$data->ServiceLocation}}</td>
                        <td>{{$data->ServiceType}}</td>
                        <td>{{$data->ServiceArea}}</td>
                        <td>{{$data->ServiceIntroduction}}</td>
                        @if($data->State==2)
                            <td><p style="color: #149bdf">拒审核</p></td>
                            @elseif($data->State==0)
                            <td><p style="color: #149bdf">待审核</p></td>
                            @else
                            <td><p style="color: #149bdf">已审核</p></td>
                            @endif

                        <td><a href="{{url('service/detail/'.$data->ServiceID)}}">查看</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination alternate" >
            {!! $datas->render() !!}
        </div>

    </div>

    @endsection
            <!-- TODO: Current Tasks -->
