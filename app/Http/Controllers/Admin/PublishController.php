<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PublishController extends Controller
{
    public  function index(){
        $datas=DB::table("users")->orderBy("userid","desc")->get();
//        var_dump($datas);
//        die;
        return view("members/publish/index",compact("datas"));
    }

    public function  detail($id){
        $db=DB::table("users")->where("userid",$id)->get();
       /* var_dump($data);
        die;*/
        return view("members/publish/detail",compact('db'));

    }
}
