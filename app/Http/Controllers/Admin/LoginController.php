<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    //登录
    public function index()
    {
        return view("login/login");
    }
    public function login(){

        if(!empty($_POST)){
            return view("Index/index");
            //return redirect()->action("Admin\IndexController@index");
        }
    }
}
