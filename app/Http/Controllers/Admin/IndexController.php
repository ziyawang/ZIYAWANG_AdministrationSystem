<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    //后台首页
    public function index(){
        $nowTime=date("Y-m-d",time());
        $lastTime=date("Y-m-d",time()-86400*7);
        $lastUser=DB::table("USERS")->whereBetween('created_at', [$lastTime, $nowTime])->count();
        $hots=DB::table("T_P_RUSHPROJECT")->where("CooperateFlag",0)->count();
        $togethers=DB::table("T_P_RUSHPROJECT")->where("CooperateFlag",1)->count();
        $projectinfos=DB::table("T_P_PROJECTINFO")->count();
        $users=DB::table("USERS")->count();
        $orders=DB::table("T_P_RUSHPROJECT")->count();
        return view("Index/index",compact("users","orders","projectinfos","hots","togethers","lastUser"));
    }
}
