<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CheckController extends Controller
{
    public function index()
    {
        $datas = DB::table("T_P_PROJECTINFO")
            ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")
            ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")
            ->select("T_P_PROJECTINFO.*","users.phonenumber","T_P_PROJECTTYPE.TypeName")
            ->orderBy("T_P_PROJECTINFO.ProjectID", "desc")->get();
        return view("members/check/index", compact("datas"));
    }

    public function detail($id)
    {
        $datas = DB::table("T_P_PROJECTINFO")
            ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")
            ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")
            ->select("T_P_PROJECTINFO.*","users.phonenumber","T_P_PROJECTTYPE.TypeName")
            ->where("T_P_PROJECTINFO.ProjectID",$id)
            ->orderBy("T_P_PROJECTINFO.ProjectID", "desc")->get();
       
        return view("members/check/detail", compact('datas'));
    }
}