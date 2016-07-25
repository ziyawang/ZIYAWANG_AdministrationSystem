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
                    <th>状态</th>
                    <th>发布时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($datas as $data)
                        <tr>
                            <td width="60" height="50"><img  src=""/></td>
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
    </div>
    {{--<script type="text/javascript">

        function deletenews(para){
            var f = document.getElementsByTagName("form")[0];
            f.action=f.action+"/"+para;
            alert(f.action);
        }
    </script>--}}
@endsection