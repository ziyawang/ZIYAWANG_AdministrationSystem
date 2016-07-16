<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RefuseController extends Controller
{
    public function index(){

        $datas=DB::table("t_p_rushproject")
            ->leftjoin("t_u_serviceinfo","t_u_serviceinfo.ServiceID","=","t_p_rushproject.ServiceID")
            ->leftjoin("t_p_projectinfo","t_p_rushproject.ProjectID","=","t_p_projectinfo.ProjectID")
            ->leftjoin("t_p_projecttype","t_p_projectinfo.TypeID","=","t_p_projecttype.TypeID")
            ->leftjoin("users","t_p_projectinfo.UserID","=","users.userid")
            ->select("t_p_rushproject.*","t_u_serviceinfo.ServiceName","t_p_projecttype.TypeName","users.phonenumber")
            ->where("CooperateFlag",2)
            ->orderBy("RushProID","desc")
            ->get();
        return view("together/refuse/index",compact("datas"));
    }
    
    public function detail($id){
        $datas=DB::table("t_p_rushproject")
            ->leftjoin("t_u_serviceinfo","t_u_serviceinfo.ServiceID","=","t_p_rushproject.ServiceID")
            ->leftjoin("t_p_projectinfo","t_p_rushproject.ProjectID","=","t_p_projectinfo.ProjectID")
            ->leftjoin("t_p_projecttype","t_p_projectinfo.TypeID","=","t_p_projecttype.TypeID")
            ->leftjoin("users","t_p_projectinfo.UserID","=","users.userid")
            ->select("t_p_rushproject.*","t_u_serviceinfo.ServiceName","t_p_projecttype.TypeName","users.phonenumber")
            ->where("t_p_rushproject.RushProID",$id)
            ->get();
        return view("together/refuse/index",compact("datas"));
    }
}
