@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12 center" style="text-align: center;">
                <ul class="stat-boxes">
                    <li>
                        <div class="left peity_bar_good"><span>2,4,9,7,12,10,12</span>+20%</div>
                        <div class="right">
                            <strong>{{$users}}</strong>
                            总注册
                        </div>
                    </li>
                    <li>
                        <div class="left peity_bar_neutral"><span>20,15,18,14,10,9,9,9</span>0%</div>
                        <div class="right">
                            <strong>{{$lastUser}}</strong>
                            上周注册
                        </div>
                    </li>
                    <li>
                        <div class="left peity_bar_bad"><span>3,5,9,7,12,20,10</span>-50%</div>
                        <div class="right">
                            <strong>{{$orders}}</strong>
                            总服务商
                        </div>
                    </li>
                    <li>
                        <div class="left peity_line_good"><span>12,6,9,23,14,10,17</span>+70%</div>
                        <div class="right">
                            <strong>{{$orders}}</strong>
                            过去一周
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="alert alert-info">
                    Welcome in the <strong>Unicorn Admin Theme</strong>. Don't forget to check all the pages!
                    <a href="#" data-dismiss="alert" class="close">×</a>
                </div>
                <div class="widget-box">
                    <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span><h5>Site Statistics</h5><div class="buttons"><a href="#" class="btn btn-mini"><i class="icon-refresh"></i> Update stats</a></div></div>
                    <div class="widget-content">
                        <div class="row-fluid">
                            <div class="span4">
                                <ul class="site-stats">
                                    <li><i class="icon-user"></i> <strong>{{$projectinfos}}</strong> <small>信息条数</small></li>
                                    <li><i class="icon-arrow-right"></i> <strong>16</strong> <small>上周发布</small></li>
                                    <li class="divider"></li>
                                    <li><i class="icon-shopping-cart"></i> <strong>{{$orders}}</strong> <small>总订单</small></li>
                                    <li><i class="icon-tag"></i> <strong>{{$hots}}</strong> <small>抢单中</small></li>
                                    <li><i class="icon-repeat"></i> <strong>{{$togethers}}</strong> <small>已合作</small></li>
                                </ul>
                            </div>
                            <div class="span8">
                                <div class="chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/excanvas.min.js')}}"></script>
    <script src="{{asset('js/jquery.flot.min.js')}}"></script>
    <script src="{{asset('js/jquery.flot.resize.min.js')}}"></script>
    <script src="{{asset('js/jquery.peity.min.js')}}"></script>
    <script src="{{asset('js/fullcalendar.min.js')}}"></script>
    <script src="{{asset('js/unicorn.dashboard.js')}}"></script>
@endsection
    <!-- TODO: Current Tasks -->
