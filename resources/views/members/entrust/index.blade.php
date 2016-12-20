@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="{{asset('css/member.css ')}}"/>
    <div id="breadcrumb" style="position:relative">
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>委托发布</a>
        <a href="#" class="current">列表</a>
    </div>
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped checkTable">
                <thead>
                <tr>
                    <th>联系人</th>
                    <th>联系方式</th>
                    <th>信息类型(委托)</th>
                    <th>渠道</th>
                    <th>委托时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        @if(!empty($data->ConnectPerson))
                            <td>{{$data->ConnectPerson}}</td>
                        @else
                            <td></td>
                        @endif
                        <td>{{$data->ConnectPhone}}</td>
                        <td>{{$data->TypeName}}</td>
                        <td>{{$data->Channel}}</td>
                        <td>{{$data->EntrustTime}}</td>
                        <td>
                            @if($data->HandleFlag==0)
                                <button class="btn btn-primary" id="{{$data->ID}}" >处理</button>
                            @else
                                <button class="btn btn-danger" >已处理</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination alternate">
            {!! $datas->render() !!}
        </div>
    <script>
        $(function(){
            $(".btn.btn-primary").on("click",function(){
                var id=$(this).attr("id");
               $.ajax({
                   url:"{{asset('entrust/change')}}",
                   data:{"id":id},
                   dateType:"json",
                   type:"post",
                   success:function(msg){
                       if(msg==1){
                           location.href="{{asset('entrust/index')}}"
                       }
                   }
               })
            })
        })
    </script>
    </div>
    @endsection
            <!-- TODO: Current Tasks -->
