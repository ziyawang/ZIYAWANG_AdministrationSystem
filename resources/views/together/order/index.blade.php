@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="{{asset('css/news.css ')}}"/>
    <div id="breadcrumb" >
        <a href="#" title="订单管理" class="tip-bottom"><i class="icon-home"></i>订单管理</a>
        <a href="#" class="current">订单列表</a>
        <a href="#" class="pull-right" id="export">
            <div class="btn btn-primary" >导出</div>
        </a>
    </div>
    <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{asset('order/index')}}" name="basic_validate"  novalidate="novalidate" />
                <table  class="table table-bordered table-striped">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <td>
                    <div class="control-group">
                        <label class="control-label">类型</label>
                        <div class="controls" >
                            <select  name="typeName" id="typeName"/>
                                <option value="0">---全部---</option>
                            @foreach($results as $result)
                                <option value="{{$result->TypeID}}" @if(!empty($typeName) && $typeName==$result->TypeID) selected="selected" @endif>{{$result->TypeName}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    </td>
                    <td>
                    <div class="form-actions">
                        <input type="submit" value="搜索" class="btn btn-success" />
                    </div>
                    </td>
                </table>
            </form>
        </div>
<script>
    $(function(){
       var type = $('#typeName').val();
        var url = 'http://admin.ziyawang.com/order/export?type='+type;
        $('#export').attr('href',url);
    });
</script>
    <div class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>服务类型</th>
                    <th>发布方</th>
                    <th>处置方名称</th>
                    <th>下单时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td style="text-align: center">{{$data->ProjectID}}</td>
                        <td style="text-align: center">{{$data->TypeName}}</td>
                        <td style="text-align: center">{{$data->phonenumber}}</td>
                        <td style="text-align: center">{{$data->ServiceName}}</td>
                        <td style="text-align: center">{{$data->RushTime}}</td>
                        <td style="text-align: center"><a href="{{url('order/detail/'.$data->RushProID)}}">查看</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination alternate">
            {!! $datas->render() !!}
        </div>

    </div>
@endsection
        <!-- TODO: Current Tasks -->
