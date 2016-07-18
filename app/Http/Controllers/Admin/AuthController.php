<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function index(){
        $datas=DB::table("t_as_role")->where("Status",1)->get();
        return view("systems/auth/index",compact("datas"));
    }
    public function getAuth(){
        $id=$_POST['roleId'];
        $authIds=DB::table("t_as_roleauth")->select("AuthID")->where("RoleID",$id)->get();
        $tpAuth=DB::table("t_as_auth")->where("Level",0)->get();
        $tAuth=DB::table("t_as_auth")->where("Level",1)->get();
        $data=array(
                "authIds"=>$authIds,
                "tpAuth"=>$tpAuth,
                "tAuth"=>$tAuth
        );
        return json_encode("data");
    }
}
