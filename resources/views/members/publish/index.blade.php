@extends('layouts.master')

@section('content')
    <div id="breadcrumb" style="position:relative">
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>会员</a>
        <a href="#" class="current">发布方列表</a>
        <a href="{{url('publish/export')}}"> <div class=" btn btn-primary " style="position:absolute;right:0;bottom:0;">导出当前页</div></a>
    </div>
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>姓名</th>
                    <th>注册手机</th>
                    <th>注册时间</th>
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
                        @if($data->Status==0)
                            <td><p style="color:dodgerblue;margin:0 auto">冻结</p></td>
                        @else
                           <td><p  style="color:dodgerblue">解冻</p></td>
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
        {{--{!! $datas->render() !!}--}}

        <div class="pagination alternate">
            {!! $datas->render() !!}
        </div>

    </div>

    @endsection
            <!-- TODO: Current Tasks -->


