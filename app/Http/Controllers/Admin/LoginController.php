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
        return view("login/login");
    }
    public function login(){

        if(!empty($_POST)){
            $password=md5($_POST['password']);
            $data=DB::table("t_as_user")->where("Email",$_POST['email'])
                ->orWhere('PassWord',$password)
                ->get();
            if($data){

            return view("Index/index");
            }else{
                return back()->with('msg',"您输入的账号或者密码有误，请重新输入");
                return view("login/login");
            }

            //return redirect()->action("Admin\IndexController@index");
            }
    }
}
