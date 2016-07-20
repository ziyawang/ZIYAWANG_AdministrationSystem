@extends('layouts.master')
@section('content')
    <div id="breadcrumb" >
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>订单</a>
        <a href="#" class="current">订单列表</a>

        {{--<input class="span4" type="text">--}}
        {{--<input class="span4" type="text">--}}
        {{--<div class="span4 pull-right">--}}
            {{--<button class="btn btn-success">Send</button>--}}
            {{--<button class="btn btn-success">Send</button>--}}
        {{--</div>--}}
        {{--<div id="s2id_autogen1" class="select2-container">--}}

            {{--<div class="select2-drop select2-with-searchbox select2-drop-active select2-offscreen" style="display: block;">--}}
            {{--</div>--}}
            {{--<select style="display: none;">--}}
                {{--<option>First option </option>--}}
                {{--<option>Second option </option>--}}
                {{--<option>Third option </option>--}}
                {{--<option>Fourth option </option>--}}
                {{--<option>Fifth option </option>--}}
                {{--<option>Sixth option </option>--}}
                {{--<option>Seventh option </option>--}}
                {{--<option>Eighth option </option>--}}
            {{--</select>--}}
        {{--</div>--}}

        {{--<form action="{{url('order/index')}}" method="post" style="height: 30px;float: left;">--}}
            {{--<input type="hidden" name="_token" value="{{ csrf_token() }}"/>--}}
            {{--<select class="input-sm" name="type" style="height:20px;border:10px solid red">--}}
                {{--<option selected="selected">请选择类型</option>--}}
                {{--<option>资产拍卖</option>--}}
                {{--<option>委外催收</option>--}}
                {{--<option>资产包转让</option>--}}
            {{--</select>--}}
            {{--<select class="select2-choice" name="status">--}}
                {{--<option selected="selected">请选择订单状态</option>--}}
                {{--<option>资产拍卖</option>--}}
                {{--<option>委外催收</option>--}}
                {{--<option>资产包转让</option>--}}
            {{--</select>--}}
            {{--<input type="submit" value="搜索">--}}
        {{--</form>--}}

        <div>
            <div>
                <input type="text" placeholder="编号,发布方名称，处置方名称" class="search1"/>
            </div>
            <div class="search">
                搜索
            </div>
            {{--<input type="button" value="搜索" style="heigh t: 25px">--}}
        </div>
        <a href="{{url('order/export')}}">
            <div class=" btn btn-primary " >导出当前页</div>
        </a>
    </div>
    {{--<div class="container-fluid">--}}
        <div class="widget-content nopadding">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box nopadding">
            </div>

        </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>订单号</th>
                    <th>服务类型</th>
                    <th>发布方</th>
                    <th>处置方名称</th>
                    <th>下单时间</th>
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
                        <td><a href="{{url('order/detail/'.$data->RushProID)}}">查看</a></td>
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
