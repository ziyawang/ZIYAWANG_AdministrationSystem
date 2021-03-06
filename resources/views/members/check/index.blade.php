@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="{{asset('css/member.css ')}}"/>
    <div id="breadcrumb" style="position:relative">
        <a href="#" title="信息审核" class="tip-bottom"><i class="icon-home"></i>信息审核</a>
        <a href="#" class="current">审核列表</a>
        <a href="#" class="pull-right" id="export"> <div class="btn btn-primary " >导出</div></a>
    </div>
    <div class="widget-content nopadding">
        <form class="form-horizontal" method="post" action="{{asset('check/index')}}" name="basic_validate"  novalidate="novalidate" />
        <table  class="table table-bordered table-striped">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <td>
                <div class="control-group">
                    <label class="control-label checkState" >审核状态</label>
                    <div class="controls selectBox" >
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
                    <label class="control-label checkState">ID</label>
                    <div class="controls selectBox" >
                        @if(!empty($projectId))
                            <input type="text" name="projectId" id="projectId" value="{{$projectId}}"  style="width:80px" />
                        @else
                            <input type="text" name="projectId" id="projectId" value=""   style="width:80px"/>
                        @endif
                    </div>
                </div>
            </td>
           {{-- <td>
                <div class="control-group">
                    <label class="control-label checkState" >信息状态</label>
                    <div class="controls selectBox" >
                        <select  name="CooperateState" id="CooperateState"/>
                        <option value="3">--全部--<option>
                        <option value="1" @if(isset($CooperateState) && $CooperateState==1) selected="selected" @endif>合作中</option>
                        <option value="0" @if(isset($CooperateState) && $CooperateState==0) selected="selected" @endif>未合作</option>
                        <option value="2" @if(isset($CooperateState) && $CooperateState==2) selected="selected" @endif>已合作</option>
                        </select>
                    </div>
                </div>
            </td>--}}
            <td>
                <div class="control-group">
                    <label class="control-label checkState" >信息等级</label>
                    <div class="controls selectBox" >
                        <select  name="member" id="member"/>
                        <option value="3">--全部--<option>
                        <option value="1" @if(isset($member) && $member==1) selected="selected" @endif>vip信息</option>
                        <option value="0" @if(isset($member) && $member==0) selected="selected" @endif>普通信息</option>
                        <option value="2" @if(isset($member) && $member==2) selected="selected" @endif>收费信息</option>
                        </select>
                    </div>
                </div>
            </td>
            <td>
                <div class="control-group">
                    <label class="control-label checkState">手机号</label>
                    <div class="controls selectBox" >
                        @if(!empty($phoneNumber))
                            <input type="text" name="phoneNumber" id="phoneNumber" value="{{$phoneNumber}}"  style="width:100px" />
                        @else
                            <input type="text" name="phoneNumber" id="phoneNumber" value=""   style="width:100px"/>
                        @endif
                    </div>
                </div>
            </td>
            <td>
                <div class="control-group">
                    <label class="control-label checkState">类型</label>
                    <div class="controls selectBox" >
                       {{-- @foreach($results as $result)
                            <option value="{{$result->TypeID}}" @if(!empty($typeName) && $typeName==$result->TypeID) selected="selected" @endif>{{$result->TypeName}}</option>
                        @endforeach--}}
                        <select  name="typeName" id="typeName"/>
                            <option value="0">---全部---</option>
                            <option value="1" @if($typeName=="1") selected="selected" @endif>资产包</option>
                            <option value="6,17" @if($typeName=="6,17") selected="selected" @endif>融资信息</option>
                            <option value="12,16" @if($typeName=="12,16") selected="selected" @endif>固定资产</option>
                            <option value="18" @if($typeName=="18") selected="selected" @endif>企业商账</option>
                            <option value="19" @if($typeName=="19") selected="selected" @endif>个人债权</option>
                            <option value="20,21,22" @if($typeName=="20,21,22") selected="selected" @endif>法拍资产</option>
                        </select>
                    </div>
                </div>
            </td>
            <td>
                <div class="control-group">
                    <label class="control-label checkState">服务地区</label>
                    <div class="controls selectBox" >
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
            <td class="tdSearch">
                <div class="form-actions searchBox checkSearch">
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
            var phoneNumber=$("#phoneNumber").val();
            var member=$("#member").val();
            var url = 'http://admin.ziyawang.com/check/export?type='+type+"&province="+province+"&state="+state+"&phoneNumber="+phoneNumber+"&member="+member;
            $('#export').attr('href',url);
        });
    </script>
    <div  class="container-fluid">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped checkTable">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>ID</th>
                    <th>联系人</th>
                    <th>注册号</th>
                    <th>联系号</th>
                    <th>发布时间</th>
                    <th>地址</th>
                    <th>信息类型</th>
                    <th>约谈次数</th>
                    <th>浏览次数</th>
                    <th>收藏次数</th>
                    <th>发布渠道</th>
                    <th>芽币</th>
                    <th>合作状态</th>
                    <th>审核状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td>{{$data->number}}</td>
                        <td>{{$data->ProjectID}}</td>
                        @if(!empty($data->ConnectPerson))
                        <td>{{$data->ConnectPerson}}</td>
                        @else
                            <td></td>
                        @endif
                        <td>{{$data->phonenumber}}</td>
                        <td>{{$data->ConnectPhone}}</td>
                        <td>{{$data->PublishTime}}</td>
                        <td>{{$data->ProArea}}</td>
                        <td>{{$data->TypeName}}</td>
                        <td><a href="{{asset("rush/detail/".$data->ProjectID)}}">{{$data->counts}}</a></td>
                        <td><a href="{{asset("check/viewDetail/".$data->ProjectID)}}">{{$data->ViewCount}}</a></td>
                        <td><a href="{{asset("check/collectDetail/".$data->ProjectID)}}">{{$data->CollectionCount}}</a></td>
                        <td>{{$data->Channel}}</td>
                        <td>{{$data->Price}}</td>
                        @if($data->CooperateState==0)
                            <td><p style="color: #149bdf">未合作</p></td>
                        @elseif($data->CooperateState==1)
                            <td><p style="color: #149bdf">合作中</p></td>
                        @else
                            <td><p style="color: #149bdf">已合作</p></td>
                        @endif
                        @if($data->State==0)
                            <td><p style="color: #149bdf">待审核</p></td>
                        @elseif($data->State==1)
                            <td><p style="color: #149bdf">已审核</p></td>
                        @else
                            <td><p style="color: #149bdf">拒审核</p></td>
                        @endif
                        <td><a href="{{url('check/detail/'.$data->ProjectID.'/'.$data->TypeID)}}">查看</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination alternate">
            {!! $datas->appends(["state"=>$state,"province"=>$province,"typeName"=>$typeName,"phoneNumber"=>$phoneNumber,"member"=>$member])->render() !!}
        </div>
    </div>
    @endsection
            <!-- TODO: Current Tasks -->
