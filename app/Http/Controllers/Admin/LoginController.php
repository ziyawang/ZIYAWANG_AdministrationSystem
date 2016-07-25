<?php

namespace App\Http\Controllers\Admin;

use App\AsUser;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    //登录页面
    public function index()
    {
       session(["user"=>null]);
        return view("login/login");
    }
    //判断登录
    public function login(){
        if(!empty($_POST['email']) && !empty($_POST['password'])){
            $password=md5($_POST['password']);
            $data=DB::table("t_as_user")->where(["Email"=>$_POST['email'],"PassWord"=>$password,"Status"=>1])
                ->get();
            if($data){
               foreach($data as $value){
                   $userId=$value->id;
                   $roleId=$value->RoleID;
                   $pAuths=DB::table("t_as_roleauth")
                       ->leftJoin("t_as_auth","t_as_auth.Auth_ID","=","t_as_roleauth.AuthID")
                       ->where(["Level"=>1,"RoleID"=>$roleId])
                       ->get();
                   $Auths=DB::table("t_as_roleauth")
                       ->leftJoin("t_as_auth","t_as_auth.Auth_ID","=","t_as_roleauth.AuthID")
                       ->where(["Level"=>2,"RoleID"=>$roleId])
                       ->get();
               }
                foreach($pAuths as $pAuth){
                    $id=$pAuth->Auth_ID;
                    $count=DB::table("t_as_roleauth")
                        ->leftJoin("t_as_auth","t_as_auth.Auth_ID","=","t_as_roleauth.AuthID")
                        ->where(["Level"=>2,"RoleID"=>$roleId,"PID"=>$id])
                        ->count();
                    $pAuth->count=$count;
                }
                $pAuths = serialize($pAuths);
                $Auths = serialize($Auths);

               
                session(['user'=>"admin",'pAuths'=>$pAuths,'Auths'=>$Auths,"userId"=>$userId]);
                $projectinfos=DB::table("T_P_PROJECTINFO")->count();
                $users=DB::table("USERS")->count();
                $nowTime=time();
                $lastTime=time()-86400*7;
                var_dump($nowTime);
                var_dump($lastTime);die;
                $lastUser=DB::table("USERS")->whereBetween('created_at', [$lastTime, $nowTime])->count();
                $orders=DB::table("T_P_RUSHPROJECT")->count();
                $hots=DB::table("T_P_RUSHPROJECT")->where("CooperateFlag",0)->count();
                $togethers=DB::table("T_P_RUSHPROJECT")->where("CooperateFlag",1)->count();
                return view("Index/index",compact("Auths","pAuths","users","orders","projectinfos","hots","togethers","lastUser"));
            }else{
                return back()->with('msg',"您输入的账号或者密码有误，请重新输入");
                return view("login/login");
            }

            //return redirect()->action("Admin\IndexController@index");
            }else{
            return back()->with('msg',"请您输入邮箱和密码!");
            return view("login/login");
        }
    }
    //修改密码首页
    public function wordEdit(){
        $id=Session::get("userId");
        $datas=DB::table("t_as_user")->where("id",$id)->get();
        return view("login/wordEdit",compact("datas"));
    }
    //修改密码保存
    public function wordUpdate(){
        $pwd=$_POST['pwd'];
        $pwd2=$_POST['pwd2'];
        if(empty($pwd)){
            return back()->with("msg","*请您输入新的密码!");
            return view("login/wordEdit");
        }
        if(empty($pwd2)){
            return back()->with("msg1","*请您输入确认密码!");
            return view("login/wordEdit");
        }elseif($pwd!=$pwd2){
            return back()->with("msg2","*确认密码与新密码不一致!");
            return view("login/wordEdit");
        }

        $db=DB::table("t_as_user")->where("id",$_POST['userId'])
                                  ->update([
                                      "PassWord"=>md5($pwd),

                                  ]);
        if($db){
            return Redirect::to("/");
        }else{
            return view("login/edit");

        }
    }
}
