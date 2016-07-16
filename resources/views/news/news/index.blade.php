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
                    <th>新闻封面</th>
                    <th>标题</th>
                    <th>新闻概要</th>
                    <th>作者</th>
                    <th>发布时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($datas as $data)
                        <tr>
                            <td width="60" height="50"><img  src="{{$data->NewsLogo}}"/></td>
                            <td>{{$data->NewsTitle}}</td>
                            <td>{{$data->Brief}}</td>
                            <td>{{$data->NewsAuthor}}</td>
                            <td>{{$data->PublishTime}}</td>
                            <td>
                                <a href="{{url('news/update/')}}">编辑</a>
                                <a href="{{url('news/delete/')}} onclick="return delete()">删除</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection