@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="{{asset('css/news.css ')}}"/>
    <div id="breadcrumb" >
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>抢单</a>
        <a href="#" class="current">抢单列表</a>
        <a href="#" class="pull-right" id="export">
            <div class="btn btn-primary" >导出</div>
        </a>
    </div>
    {{-- <div class="widget-content nopadding">
         <form class="form-horizontal" method="post" action="{{asset('rush/index')}}" name="basic_validate"  novalidate="novalidate" />
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
     </script>--}}
    <div class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>服务方名称</th>
                    <th>联系电话</th>
                    <th>抢单时间</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr class="tr">
                        <td>{{$data->ServiceID}}</td>
                        <td>{{$data->ServiceName}}</td>
                        <td>{{$data->ConnectPhone}}</td>
                        <td>{{$data->RushTime}}</td>
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