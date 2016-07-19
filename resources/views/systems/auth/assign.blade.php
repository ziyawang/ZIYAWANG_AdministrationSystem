@extends('layouts.master')

@section('content')
    <div id="breadcrumb" style="position:relative">
        <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 系统</a>
        <a href="#" class="current">分配权限</a>
    </div>
    <div  class="container-fluid">
        <form class="form-horizontal" method="post" action="{{asset('auth/edit')}}" name="basic_validate"  novalidate="novalidate" />
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{$id}}">
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped with-check">
                <thead>
                <tr>
                    <th>一级权限</th>
                    <th>二级权限</th>

                </tr>
                </thead>
                <tbody>
                @foreach($tpAuths as $tpAuth)
                    <tr>
                        <td><input type="checkbox"  name="ids[]" value="{{$tpAuth->Auth_ID}}" @if(in_array($tpAuth->Auth_ID,$authId)) checked="checked" @endif/>{{$tpAuth->AuthName}}</td>

                        <td>
                            @foreach($tAuths as $tAuth)
                                @if($tAuth->PID==$tpAuth->Auth_ID)
                           <input type="checkbox"  name="ids[]" value="{{$tAuth->Auth_ID}}"  @if(in_array($tAuth->Auth_ID,$authId)) checked="checked" @endif/> {{$tAuth->AuthName}}
                                @endif
                           @endforeach
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <div class="form-actions">
            <input type="submit"  id="submit" value="确认" class="btn btn-primary" />
        </div>
        </form>
    </div>


    @endsection
            <!-- TODO: Current Tasks -->