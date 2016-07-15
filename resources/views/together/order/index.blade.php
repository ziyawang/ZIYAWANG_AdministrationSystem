@extends('layouts.master')

@section('content')
    <div id="breadcrumb" style="position:relative">
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
        <a href="#" class="current">订单列表</a>
        <a href="{{url('system/add')}}"> <div class=" btn btn-primary " style="position:absolute;right:0;bottom:0;">导出当前页</div></a>
    </div>
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>订单号</th>
                    <th>服务类型</th>
                    <th>发布方名称</th>
                    <th>处置方名称</th>
                    <th>成交金额</th>
                    <th>下单时间</th>
                    <th>订单状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                {{--@foreach($datas as $data)--}}
                    <tr>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td>6</td>
                        @if(0)
                            <td><p style="color: #149bdf">拒审核</p></td>
                        @elseif(1)
                            <td><p style="color: #149bdf">待审核</p></td>
                        @else
                            <td><p style="color: #149bdf">已审核</p></td>
                        @endif
                        <td>7</td>
                        <td><a href="{{url('order/detail/2')}}">查看</a></td>
                    </tr>
                {{--@endforeach--}}
                </tbody>
            </table>
        </div>
        {{--{!! $datas->render() !!}--}}


    </div>

    @endsection
            <!-- TODO: Current Tasks -->
