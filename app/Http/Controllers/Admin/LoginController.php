<?php

namespace App\Http\Controllers\Admin;

use App\AsUser;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class LoginController extends Controller
{
    //登录
    public function index()
    {
//        session(['_token'=>"admin"]);
        return view("login/login");
    }
    public function login(){
        if(!empty($_POST['email']) && !empty($_POST['password'])){
            $password=md5($_POST['password']);
            $data=DB::table("t_as_user")->where(["Email"=>$_POST['email'],"PassWord"=>$password,"Status"=>1])
                ->get();
            if($data){
               foreach($data as $value){
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

               
                session(['user'=>"admin",'pAuths'=>$pAuths,'Auths'=>$Auths]);
              // dd(session()->get('pAuths'));die;
                return view("Index/index",compact("Auths","pAuths"));
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
}
