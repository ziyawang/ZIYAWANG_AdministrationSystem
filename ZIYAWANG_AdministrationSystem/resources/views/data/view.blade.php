@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="{{asset('css/member.css ')}}"/>
    <div id="breadcrumb" style="position:relative">
        <a href="{{asset('data/index')}}" title="数据分析" class="tip-bottom"><i class="icon-home"></i>数据分析</a>
        <a href="#" class="current">浏览详情</a>
    </div>
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>

                    <th>浏览内容</th>
                    <th>类型</th>
                    <th>IP</th>
                    <th>浏览时间</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        @if($data->Type==1)
                            <td style="text-align:center"><a href="http://ziyawang.com/project/{{$data->ItemID}}">{{$data->ItemID}}</a></td>
                        @elseif($data->Type==2)
                            <td style="text-align:center"><a href="http://ziyawang.com/video/{{$data->ItemID}}">{{$data->ItemID}}</a></td>
                        @elseif($data->Type==3)
                            <td style="text-align:center"><a href="http://ziyawang.com/news/{{$data->ItemID}}">{{$data->ItemID}}</a></td>
                        @else
                            <td style="text-align:center"><a href="http://ziyawang.com/service/{{$data->ItemID}}">{{$data->ItemID}}</a></td>
                        @endif
                        @if($data->Type==1)
                            <td style="text-align:center">信息</td>
                        @elseif($data->Type==2)
                            <td style="text-align:center">视频</td>
                        @elseif($data->Type==3)
                            <td style="text-align:center">新闻</td>
                            @else
                            <td style="text-align:center">服务</td>
                        @endif
                        <td style="text-align:center">{{$data->IP}}</td>
                        <td style="text-align:center">{{$data->created_at}}</td>
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