@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="{{asset('css/member.css ')}}"/>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('layer/layer/layer.js')}}"></script>
    <div id="breadcrumb" style="position:relative">
        <a href="{{asset('data/index')}}" title="举报反馈" class="tip-bottom"><i class="icon-home"></i>举报反馈</a>
        <a href="#" class="current">举报反馈</a>
    </div>
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                   <th>举报人</th>
                    <th>手机号</th>
                    <th>举报类型</th>
                    <th>举报内容</th>
                    <th>举报问题</th>
                    <th>举报渠道</th>
                    <th>举报时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td style="text-align:center">{{$data->username}}</td>
                        <td style="text-align:center">{{$data->phonenumber}}</td>
                        <td style="text-align:center">{{$data->Type}}</td>
                        @if($data->Type=="信息")
                            @if($data->Member==0 && $data->CertifyState==1)
                                <td style="text-align:center"><a href="http://ziyawang.com/project/{{$data->TypeID}}/{{$data->ItemID}}"  target="_block">{{$data->ItemID}}</a></td>
                            @else
                                <td style="text-align:center"><a href="#" onclick='getError(this)'>{{$data->ItemID}}</a></td>
                            @endif
                        @else
                            <td style="text-align:center"><a href="http://ziyawang.com/service/{{$data->TypeID}}/{{$data->ItemID}}"  target="_block">{{$data->ItemID}}</a></td>
                        @endif
                        <td style="text-align:center">{{$data->Content}}</td>
                        @if($data->Channel=="PC")
                        <td style="text-align:center">电脑</td>
                        @elseif($data->Channel=="IOS")
                            <td style="text-align:center">苹果</td>
                        @else
                            <td style="text-align:center">安卓</td>
                        @endif
                        <td style="text-align:center">{{$data->created_at}}</td>
                        <td style="text-align: center">
                            @if($data->Remark==1)
                                <a class="btn btn-primary"id="handled_{{$data->ID}}" >已处理</a>
                           @else
                                <a class="btn btn-danger"  {{--href="{{asset('operate/handle/'.$data->ID)}}"--}} id="handle_{{$data->ID}}" style="text-align: center">处理</a>
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
            $(".btn.btn-danger").on("click",function(){
                var ids=$(this).attr("id");
                var Id=ids.substr(7);
                layer.prompt({title: '请输入处理结果', formType: 2}, function(text, index){
                    layer.close(index);
                    $.ajax({
                        url:"{{asset('operate/handle')}}",
                        data:{"result":text,"id":Id},
                        dateType:"json",
                        type:"post",
                        success:function(msg){
                            if(msg==1){
                                location.href="{{asset('operate/report')}}"
                            }
                        }
                    })

                });
            });
            $(".btn.btn-primary").on("click",function(){
                var ids=$(this).attr("id");
                var Id=ids.substr(8);
                $.ajax({
                    url:"{{asset('operate/getDate')}}",
                    data:{"id":Id},
                    dateType:"json",
                    type:"post",
                    success:function(msg){
                        var msgResult=msg.data;
                        layer.alert(msgResult);
                        }
                    });
                });
            function getError(e) {
                alert("该信息已被处理,暂不能查看.");
            }
        </script>
    </div>
@endsection