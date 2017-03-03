@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="{{asset('css/member.css ')}}"/>
    <div id="breadcrumb" style="position:relative">
        <a href="#" title="测评列表" class="tip-bottom"><i class="icon-home"></i>测评列表</a>
        <a href="#" class="current">测评列表</a>
        {{--<a href="#" class="pull-right" id="export"> <div class="btn btn-primary " >导出</div></a>--}}
    </div>
    <div class="widget-content nopadding">
        <form class="form-horizontal" method="post" action="{{asset('check/index')}}" name="basic_validate"  novalidate="novalidate" />
        <table  class="table table-bordered table-striped">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <td>
                <div class="control-group">
                    <label class="control-label checkState" >做题数量</label>
                    <div class="controls selectBox" >
                        <select  name="count" id="count"/>
                        <option value="0">全部<option>
                        <option value="1" @if( $count==1) selected="selected" @endif>1</option>
                        <option value="2" @if($count==2) selected="selected" @endif>2</option>
                        <option value="3" @if( $count==3) selected="selected" @endif>3</option>
                        <option value="4" @if( $count==4) selected="selected" @endif>4</option>
                        <option value="5" @if($count==5) selected="selected" @endif>5</option>
                        <option value="6" @if( $count==6) selected="selected" @endif>6</option>
                        <option value="7" @if( $count==7) selected="selected" @endif>7</option>
                        <option value="8" @if($count==8) selected="selected" @endif>8</option>
                        <option value="9" @if( $count==9) selected="selected" @endif>9</option>
                        <option value="10" @if( $count==10) selected="selected" @endif>10</option>
                        <option value="11" @if($count==11) selected="selected" @endif>11</option>
                        <option value="12" @if( $count==12) selected="selected" @endif>12</option>
                        <option value="13" @if( $count==13) selected="selected" @endif>13</option>
                        <option value="14" @if($count==14) selected="selected" @endif>14</option>
                        <option value="15" @if( $count==15) selected="selected" @endif>15</option>
                        <option value="16" @if( $count==16) selected="selected" @endif>16</option>
                        <option value="17" @if($count==17) selected="selected" @endif>17</option>
                        <option value="18" @if( $count==18) selected="selected" @endif>18</option>
                        <option value="19" @if( $count==19) selected="selected" @endif>19</option>
                        <option value="20" @if($count==20) selected="selected" @endif>20</option>
                        <option value="21" @if( $count==21) selected="selected" @endif>21</option>
                        <option value="22" @if( $count==22) selected="selected" @endif>22</option>
                        <option value="23" @if($count==23) selected="selected" @endif>23</option>
                        <option value="24" @if( $count==24) selected="selected" @endif>24</option>
                        <option value="25" @if( $count==25) selected="selected" @endif>25</option>
                        </select>
                    </div>
                </div>
            </td>
        </table>
        </form>
    </div>
  {{--  <script>
        $(function(){
            var type = $('#typeName').val();
            var province=$("#province").val();
            var state=$("#state").val();
            var phoneNumber=$("#phoneNumber").val();
            var member=$("#member").val();
            var url = 'http://admin.ziyawang.com/check/export?type='+type+"&province="+province+"&state="+state+"&phoneNumber="+phoneNumber+"&member="+member;
            $('#export').attr('href',url);
        });
    </script>--}}
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped checkTable">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>姓名</th>
                    <th>电话</th>
                    <th>身份证</th>
                    <th>企业名称</th>
                    <th>金额(单位/万元)</th>
                    <th>地址</th>
                    <th>类型</th>
                    <th>身份</th>
                    <th>分数</th>
                    <th>做题数目</th>
                    <th>测试渠道</th>
                    <th>测试时间</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td>{{$data->number}}</td>
                        <td>{{$data->Name}}</td>
                        <td>{{$data->PhoneNumber}}</td>
                        <td>{{$data->IDNumber}}</td>
                        <td>{{$data->CompanyName}}</td>
                        <td>{{$data->Money}}</td>
                        <td>{{$data->Area}}</td>
                        <td>{{$data->AssetType}}</td>
                        <td>{{$data->Type}}</td>
                        <td>{{$data->Score}}</td>
                        <td>{{$data->Count}}</td>
                        @if($data->Channel=="ANDROID")
                            <td>Android</td>
                        @else
                            <td>{{$data->Channel}}</td>
                        @endif
                        <td>{{$data->TestTime}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination alternate">
            {!! $datas->appends(["count"=>$count])->render() !!}
        </div>
        <script>
            $(function(){
                $("#count").on("change",function(){
                    var count =$("#count").val();
                    location.href="{{asset('test/ajaxChoose')}}"+"?count="+count;
                })
            })
        </script>
    </div>
    @endsection
            <!-- TODO: Current Tasks -->
