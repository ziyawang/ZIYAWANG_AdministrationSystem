<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{
    //视频管理
    //人员管理列表
    public function index(){

        // $data=DB::table("t_AS_user")->get();
        return view("news/video/index");
    }
    //添加人员
    public function insert(){

    }
    //编辑人员信息
    public function update(){

    }
    //删除人员信息
    public function delete(){

    }

}
