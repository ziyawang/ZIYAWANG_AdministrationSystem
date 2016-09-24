<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RushController extends Controller
{
    //已经被抢单的信息
    public  function index(){
        $datas=DB::table("T_P_RUSHPROJECT")
                    ->leftJoin("T_P_PROJECTINFO","T_P_RUSHPROJECT.ProjectID","=","T_P_PROJECTINFO.ProjectID")
                    ->leftJoin("users","T_P_PROJECTINFO.UserID","=","users.userid")
                    ->leftJoin("T_P_PROJECTTYPE","T_P_PROJECTINFO.TypeID","=","T_P_PROJECTTYPE.TypeID")
                    ->select("T_P_RUSHPROJECT.ProjectID","T_P_PROJECTTYPE.TypeName","users.phonenumber")
                    ->where("T_P_RUSHPROJECT.CooperateFlag",0)
                    ->orderBy("T_P_RUSHPROJECT.ProjectID","desc")
                    ->distinct()
                    ->paginate(20);
        foreach($datas as $result){
            $projectId=$result->ProjectID;
            $counts=DB::table("T_P_RUSHPROJECT")->where("ProjectID",$projectId)->count();
            $result->count=$counts;
        }
        return view("together/rush/index",compact("datas"));

    }
    
    //查看信息的抢单人
    public  function detail($projectId){
        $datas=DB::table("T_P_RUSHPROJECT")
                    ->leftJoin("T_U_SERVICEINFO","T_P_RUSHPROJECT.ServiceID","=","T_U_SERVICEINFO.ServiceID")
                    ->where("ProjectID",$projectId)
                    ->orderBy("RushTime","desc")
                    ->paginate();
        return view("together/rush/detail",compact("datas"));
    }
}
