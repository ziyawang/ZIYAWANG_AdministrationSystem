@extends('layouts.master')

@section('content')
    <style type="text/css">
        .form-actions {
            padding: 0px 20px 20px;
            margin-top: 20px;
            margin-bottom: 20px;
            background-color: #f5f5f5;
            border-top: 0px solid #e5e5e5;
            *zoom: 1;
        }
        .form-horizontal .form-actions {

              margin-right: 100px;
        }

    </style>
    <div id="breadcrumb" style="position:relative">
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>审核</a>
        <a href="#" class="current">审核列表</a>
        <a href="#" class="pull-right" id="export"> <div class="btn btn-success " >导出</div></a>
    </div>
    <div class="widget-content nopadding">
        <form class="form-horizontal" method="post" action="{{asset('check/index')}}" name="basic_validate"  novalidate="novalidate" />
        <table  class="table table-bordered table-striped">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <td>
                <div class="control-group">
                    <label class="control-label">审核状态</label>
                    <div class="controls" >
                        <select  name="state" id="state"/>
                        <option value="3">--全部--<option>
                        <option value="1" @if(isset($state) && $state==1) selected="selected" @endif>已审核</option>
                        <option value="0" @if(isset($state) && $state==0) selected="selected" @endif>待审核</option>
                        <option value="2" @if(isset($state) && $state==2) selected="selected" @endif>拒审核</option>
                        </select>
                    </div>
                </div>
            </td>
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
                <div class="control-group">
                    <label class="control-label">服务地区</label>
                    <div class="controls" >
                        <select  name="province" id="province"/>
                        <option   value="全国" @if(!empty($province) && $province=="全国") selected="selected" @endif>--全国--</option>
                        <option value="北京" @if(!empty($province) && $province=="北京") selected="selected" @endif>北京</option>
                        <option value="上海" @if(!empty($province) && $province=="上海") selected="selected" @endif>上海</option>
                        <option value="广东" @if(!empty($province) && $province=="广东") selected="selected" @endif>广东</option>
                        <option value="江苏" @if(!empty($province) && $province=="江苏") selected="selected" @endif>江苏</option>
                        <option value="山东" @if(!empty($province) && $province=="山东") selected="selected" @endif>山东</option>
                        <option value="浙江" @if(!empty($province) && $province=="浙江") selected="selected" @endif>浙江</option>
                        <option value="河南" @if(!empty($province) && $province=="河南") selected="selected" @endif>河南</option>
                        <option value="河北" @if(!empty($province) && $province=="河北") selected="selected" @endif>河北</option>
                        <option value="辽宁" @if(!empty($province) && $province=="辽宁") selected="selected" @endif>辽宁</option>
                        <option value="四川" @if(!empty($province) && $province=="四川") selected="selected" @endif>四川</option>
                        <option value="湖北" @if(!empty($province) && $province=="湖南") selected="selected" @endif>湖北</option>
                        <option value="湖南" @if(!empty($province) && $province=="湖南") selected="selected" @endif>湖南</option>
                        <option value="福建" @if(!empty($province) && $province=="福建") selected="selected" @endif>福建</option>
                        <option value="安徽" @if(!empty($province) && $province=="安徽") selected="selected" @endif>安徽</option>
                        <option value="陕西" @if(!empty($province) && $province=="陕西") selected="selected" @endif>陕西</option>
                        <option value="天津" @if(!empty($province) && $province=="天津") selected="selected" @endif >天津</option>
                        <option value="江西" @if(!empty($province) && $province=="江西") selected="selected" @endif>江西</option>
                        <option value="广西" @if(!empty($province) && $province=="广西") selected="selected" @endif>广西</option>
                        <option value="重庆" @if(!empty($province) && $province=="重庆") selected="selected" @endif>重庆</option>
                        <option value="吉林" @if(!empty($province) && $province=="吉林") selected="selected" @endif>吉林</option>
                        <option value="云南" @if(!empty($province) && $province=="云南") selected="selected" @endif>云南</option>
                        <option value="山西" @if(!empty($province) && $province=="山西") selected="selected" @endif>山西</option>
                        <option value="新疆" @if(!empty($province) && $province=="新疆") selected="selected" @endif>新疆</option>
                        <option value="贵州" @if(!empty($province) && $province=="贵州") selected="selected" @endif>贵州</option>
                        <option value="甘肃" @if(!empty($province) && $province=="甘肃") selected="selected" @endif>甘肃</option>
                        <option value="海南" @if(!empty($province) && $province=="海南") selected="selected" @endif>海南</option>
                        <option value="宁夏" @if(!empty($province) && $province=="宁夏") selected="selected" @endif>宁夏</option>
                        <option value="青海" @if(!empty($province) && $province=="青海") selected="selected" @endif>青海</option>
                        <option value="西藏" @if(!empty($province) && $province=="西藏") selected="selected" @endif>西藏</option>
                        <option value="黑龙江" @if(!empty($province) && $province=="黑龙江") selected="selected" @endif>黑龙江</option>
                        <option value="内蒙古" @if(!empty($province) && $province=="内蒙古") selected="selected" @endif>内蒙古</option>
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
            var province=$("#province").val();
            var state=$("#state").val();
            var url = 'http://admin.ziyawang.com/check/export?type='+type+"&province="+province+"&state="+state;
            $('#export').attr('href',url);
        });
    </script>
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead>

                <tr>
                    <th>ID</th>
                    <th>联系方式</th>
                    <th>发布时间</th>
                    <th>地址</th>
                    <th>服务类型</th>
                    <th>审核状态</th>
                    <th>备注</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td>{{$data->ProjectID}}</td>
                        <td>{{$data->phonenumber}}</td>
                        <td>{{$data->PublishTime}}</td>
                        <td>{{$data->ProArea}}</td>
                        <td>{{$data->TypeName}}</td>
                        @if($data->State==0)
                            <td><p style="color: #149bdf">待审核</p></td>
                        @elseif($data->State==1)
                            <td><p style="color: #149bdf">已审核</p></td>
                        @else
                            <td><p style="color: #149bdf">拒审核</p></td>
                        @endif
                        <td>{{$data->Remark}}</td>
                        <td><a href="{{url('check/detail/'.$data->ProjectID.'/'.$data->TypeID)}}">查看</a></td>
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
