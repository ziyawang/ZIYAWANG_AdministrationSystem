@extends('layouts.master')

@section('content')
    <div id="breadcrumb" style="position:relative">
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>合作</a>
        <a href="#" class="current">订单列表</a>
        <a href="{{url('order/export')}}"> <div class=" btn btn-primary " style="position:absolute;right:0;bottom:0;">搜索</div></a>
        <a href="{{url('order/export')}}"> <div class=" btn btn-primary " style="position:absolute;right:0;bottom:0;">导出当前页</div></a>
    </div>
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>订单号</th>
                    <th>服务类型</th>
                    <th>发布方</th>
                    <th>处置方名称</th>
                    <th>下单时间</th>
                    <th>订单状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td>{{$data->RushProID}}</td>
                        <td>{{$data->TypeName}}</td>
                        <td>{{$data->phonenumber}}</td>
                        <td>{{$data->ServiceName}}</td>
                        <td>{{$data->RushTime}}</td>
                        @if($data->CooperateFlag==0)
                            <td><p style="color: #149bdf">拒审核</p></td>
                        @elseif($data->CooperateFlag==1)
                            <td><p style="color: #149bdf">待审核</p></td>
                        @else
                            <td><p style="color: #149bdf">已审核</p></td>
                        @endif
                        <td><a href="{{url('order/detail/'.$data->RushProID)}}">查看</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{--{!! $datas->render() !!}--}}
        <script type="text/javascript">
            alert("123");
            </script>
        <>

    </div>

    @endsection
            <!-- TODO: Current Tasks -->
