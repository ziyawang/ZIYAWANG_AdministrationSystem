@extends('layouts.master')

@section('content')
    <div id="breadcrumb" style="position:relative">
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
        <a href="#" class="current">发布方列表</a>
        <a href="{{url('system/add')}}"> <div class=" btn btn-primary " style="position:absolute;right:0;bottom:0;">添加</div></a>
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
                {{--@foreach($datas as $data)--}}
                    <tr>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td>6</td>
                        <td>7</td>
                      
                    </tr>
                {{--@endforeach--}}
                </tbody>
            </table>
        </div>
        {{--{!! $datas->render() !!}--}}


    </div>

    @endsection
            <!-- TODO: Current Tasks -->
