<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    //展示角色 
    public function index(){
        $datas=DB::table("t_as_role")->orderBy("id","desc")
            ->where("status",1)
            ->paginate(20);
        return view("systems/auth/index",compact("datas"));
    }
   //展示权限
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
    //保存分配的权限
    public  function  edit(){
        if(empty($_POST['ids'])){
            return back()->with("msg","请您选择所要分配的权限");
            return view("auth/assign");
        }
        $RoleId=$_POST['id'];
        $ids=$_POST['ids'];
        $result=DB::table("t_as_roleauth")->where('RoleID',$RoleId)->get();
        if(!empty($result)){
            DB::table("t_as_roleauth")->where("RoleID",$RoleId)->delete();
        }
        foreach ($ids as $id){
            $db=DB::table("t_as_roleauth")->insert([
                "RoleID"=>$RoleId,
                "AuthID"=>$id,
                 'created_at'=>date("Y-m-d H:i:s", time()),
                 'updated_at'=>date("Y-m-d H:i:s", time())
            ]);
        }
        if($db){
            return Redirect::to("auth/index");
        }
    }
}
