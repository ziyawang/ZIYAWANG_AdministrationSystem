@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="{{asset('css/member.css ')}}"/>
    <div id="breadcrumb" style="position:relative">
        <a href="{{asset('data/index')}}" title="数据分析" class="tip-bottom"><i class="icon-home"></i>数据分析</a>
        <a href="#" class="current">数据分析</a>
    </div>
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                            <span class="icon">
                                <i class="icon-align-justify"></i>
                            </span>
                    <h5>数据分析</h5>
                </div>
                <div  class="container-fluid">
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                {{--<th>ID</th>--}}
                                <th>手机号</th>
                              {{--  <th>IP</th>--}}
                                <th>登录次数</th>
                               <th>最后登录时间</th>
                                <th>角色</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($datas as $data)
                                <tr>
                               {{-- <td>{{$data->RecordID}}</td>--}}
                                <td style="text-align:center">{{$data->phonenumber}}</td>
                               {{--  <td>{{$data->IP}}</td>--}}
                                <td style="text-align:center">{{$data->counts}}</td>
                                <td style="text-align:center">{{$data->lastLogin}}</td>
                                @if($data->role==1)
                                    <td>服务方</td>
                                @elseif($data->role==2)
                                    <td>发布方</td>
                                @else
                                    <td>注册</td>
                                @endif
                                <td>
                                    <a href="{{url('data/detail/'.$data->phonenumber)}}">查看详情</a>
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