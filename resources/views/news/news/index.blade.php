@extends('layouts.master')

@section('content')
    <div id="breadcrumb">
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 新闻</a>
        <a href="#" class="current">新闻列表</a>
        <a href="{{url('news/add')}}" class="pull-right"> <button class="btn btn-success">添加新闻</button></a>
    </div>
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>标题</th>
                    <th>简介</th>
                    <th>新闻封面</th>
                    <th>发布时间</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($datas as $data)
                        <tr>
                            <td>{{$data->NewsTitle}}</td>
                            <td>{{$data->Brief}}</td>
                            <td>{{$data->NewsLogo}}</td>
                            <td>{{$data->NewsContent}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection