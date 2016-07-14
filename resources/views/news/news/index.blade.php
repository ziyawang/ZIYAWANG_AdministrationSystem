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
                    <th>姓名</th>
                    <th>登录名</th>
                    <th>手机号</th>
                    <th>部门</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Row 1</td>
                        <td>Row 2</td>
                        <td>Row 3</td>
                        <td>Row 4</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection