@extends('layouts.master')

@section('content')
<style type="text/css">
        .form-actions {
            padding: 0px 20px 20px;
            margin-top: 20px;
            margin-bottom: 20px;
            background-color: #f5f5f5;
            border-top: 0px solid #e5e5e5;
            *zoom: 1;
        }
    </style>
    <div id="breadcrumb">
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 新闻</a>
        <a href="#" class="current">新闻列表</a>
        <a href="{{url('news/add')}}" class="pull-right"> <button class="btn btn-success">添加新闻</button></a>
    </div>
    <div class="widget-content nopadding">
        <form class="form-horizontal" method="post" action="{{asset('news/index')}}" name="basic_validate"  novalidate="novalidate" />
        <table  class="table table-bordered table-striped">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <td>
                <div class="control-group">
                    <label class="control-label">新闻标题</label>
                    <div class="controls" >
                       <input type="text" name="newsTitle" class="span4">
                    </div>
                </div>
            </td>
            <td>
                <div class="form-actions">
                    <input type="submit" value="搜索" class="btn btn-primary" />
                </div>
            </td>
        </table>
        </form>
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
                    <th>状态</th>
                    <th>发布时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($datas as $data)
                        <tr>
                            <td width="60" height="50"><img  src="{{'Http://img.ziyawang.cn'.$data->NewsLogo}}"/></td>
                            <td>{{$data->NewsTitle}}</td>
                            <td>{{$data->Brief}}</td>
                            <td>{{$data->NewsAuthor}}</td>
                            <td>{{$data->Flag}}</td>
                            <td>{{$data->PublishTime}}</td>
                            <td>
                                <a class="btn btn-primary" href="{{url('news/update/'.$data->NewsID)}}"><i class="icon-pencil icon-white"></i></a>
                                <a class="btn btn-danger" href="{{url('news/delete/'.$data->NewsID)}}" onclick="return confirm('确定将此记录删除?')"><i class="icon-remove icon-white"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination alternate" style="margin:0 auto">
            {!! $datas->render() !!}
        </div>
    </div>

@endsection