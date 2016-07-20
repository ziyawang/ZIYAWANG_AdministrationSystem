<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function index(){
        $datas=DB::table("t_as_role")->orderBy("id","desc")
            ->where("status",1)
            ->paginate(20);
        return view("systems/auth/index",compact("datas"));
    }
   
    public function assign($id){
        $result=DB::table("t_as_roleauth")->where('RoleID',$id)->get();
        if(!empty($result)){
            $authIds=DB::table("t_as_roleauth")->select("AuthID")->where("RoleID",$id)->get();

            foreach($authIds as $value){
                $AuthId=$value->AuthID;
                $authId[]=$AuthId;
            }
        }
        $tpAuths=DB::table("t_as_auth")->where("Level",1)->get();
        $tAuths=DB::table("t_as_auth")->where("Level",2)->get();
        return view("systems/auth/assign",compact("authId","tpAuths","tAuths","id"));
    }

    public  function  edit(){
        $RoleId=$_POST['id'];
        $ids=$_POST['ids'];
        $result=DB::table("t_as_roleauth")->where('RoleID',$RoleId)->get();
        if(!empty($result)){
            DB::table("t_as_roleauth")->where("RoleID",$RoleId)->delete();
        }
        foreach ($ids as $id){
            $db=DB::table("t_as_roleauth")->insert([
                "RoleID"=>$RoleId,
                "AuthID"=>$id
            ]);
        }
        if($db){
            return Redirect::to("auth/index");
        }
    }
}
