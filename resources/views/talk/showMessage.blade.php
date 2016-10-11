@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="{{asset('css/talk.css ')}}"/>
    <div id="breadcrumb">
        <a data-original-title="Go to Home" id="talkMessage" class="tip-bottom"><i class="icon-home"></i>融云信息</a>
        <a href="#" class="current">聊天记录</a>
    </div>
    <input type="hidden" name="showMessageUrl" id="showMessageUrl" value="{{$showMessageUrl}}">
    <script>
        $("#talkMessage").on("click",function(){
            var showMessageUrl=$("#showMessageUrl").val()
            var url=showMessageUrl;
            $("#talkMessage").attr('href',url);
        })
    </script>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box widget-chat">
                    <div class="widget-title">
					<span class="icon">
						<i class="icon-comment"></i>
					</span>
                        <h5>聊天内容</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <div class="chat-content panel-left">
                            <div class="chat-messages" id="chat-messages">
                                <div id="chat-messages-inner">
                                    @foreach($messages as $message)
                                        @if($message['fromUserId']==$fromUserId && !empty($message['content']) )
                                            @foreach($frominfos as $frominfo)
                                            <p style="display: block;" id="msg-1" class="user-neytiri">
                                                <img src="{{'http://images.ziyawang.com'.$frominfo['UserPicture']}}" alt="" >
                                            <span class="msg-block">
                                                <strong>{{$frominfo['phonenumber']}}</strong>
                                                <span class="time">{{$message['dateTime']}}</span>
                                                @if($message['classname']=="RC:ImgMsg")
                                                 {{--  <img src="http://images.ziyawang.com/user/14714151099883.jpg" alt="" >--}}
                                                <img src="{{'http://talk.ziyawang.com/images'.$message['content']}}">
                                                @elseif($message['classname']=="RC:VcMsg")
                                                    <span class="msg">
                                                        <audio src="{{'http://talk.ziyawang.com/voices'.$message['content']}}" controls="controls"></audio>
                                                    </span>
                                                @else
                                                    <span class="msg">{{$message['content']}}</span>
                                                @endif

                                            </span>
                                            </p>
                                            @endforeach
                                        @else
                                            @if(!empty($message['content']))
                                            @foreach($targetinfos as $targetinfo)
                                            <p style="display: block;" id="msg-2" class="user-cartoon-man">
                                                <img src="{{'http://images.ziyawang.com'.$targetinfo['UserPicture']}}" alt="">
                                                <span class="msg-block">
                                                <strong>{{$targetinfo['phonenumber']}}</strong>
                                                 <span class="time">{{$message['dateTime']}}</span>
                                                    @if($message['classname']=="RC:ImgMsg")
                                                        <span class="msg">
                                                           {{-- <img src="http://images.ziyawang.com/user/14714151099883.jpg" alt="" >--}}
                                                            <img src="{{'http://talk.ziyawang.com/images'.$message['content']}}">
                                                        </span>
                                                    @elseif($message['classname']=="RC:VcMsg")
                                                        <span class="msg">
                                                            <audio src="{{'http://talk.ziyawang.com/voices'.$message['content']}}" controls="controls"></audio>
                                                    </span>
                                                    @else
                                                        <span class="msg">{{$message['content']}}</span>
                                                    @endif
                                                </span>
                                            </p>
                                            @endforeach
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="chat-users panel-right">
                            <div class="panel-title"><h5> Users</h5></div>
                            <div class="panel-content nopadding">
                                <ul class="contact-list">
                                    <input type="hidden" id="fromUserId" name="fromUserId" value="{{$fromUserId}}">
                                    @if($system==1)
                                        <li id="Msg_0" class="online new">
                                            <a href="#">
                                            <input type="hidden" name="userid" value="0"/>
                                                <img alt="" src="http://images.ziyawang.com/user/kefu.png">
                                                <span>客服</span>
                                            </a>
                                        </li>
                                    @endif
                                    @foreach($datas as $data)
                                        @foreach($data as $value)
                                            <li id="Msg_{{$value['userid']}}" class="online new"><a href="">
                                                    <input type="hidden" name="userid" value="{{$value['userid']}}">
                                                    <img alt="" src="{{'http://images.ziyawang.com'.$value['UserPicture']}}">
                                                    <span>{{$value['phonenumber']}}</span>
                                                </a>
                                            </li>
                                            <script type="text/javascript">
                                                $("#Msg_{{$value['userid']}}").on("click",function(){
                                                    var targetId= $("#Msg_{{$value['userid']}}").children(":first").children(":first").val();
                                                    var fromUserId=$("#fromUserId").val();
                                                    //var url="http://admin.ziyawang.cn/talk/showMessage/"+targetId+"/"+fromUserId;
                                                    var url="http://admin.ziyawang.com/talk/showMessage/"+targetId+"/"+fromUserId;
                                                    $("#Msg_{{$value['userid']}}").children(":first").attr("href",url);
                                                })
                                            </script>
                                        @endforeach
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $("#Msg_0").on("click",function(){
            var targetId=$(this).children(":first").children(":first").val();
            var fromUserId=$("#fromUserId").val();
           // var url="http://admin.ziyawang.cn/talk/showMessage/"+targetId+"/"+fromUserId;
            var url="http://admin.ziyawang.com/talk/showMessage/"+targetId+"/"+fromUserId;
            $("#Msg_0").children(":first").attr('href',url);
        });
    </script>
@endsection