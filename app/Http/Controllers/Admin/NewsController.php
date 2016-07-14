<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    //新闻列表
    public function index(){

        // $data=DB::table("t_AS_user")->get();
        return view("news/news/index");
    }
    //添加新闻
    public function add(){
        return view("news/news/add");
    }
    //编辑新闻信息
    public function update(){
        return view("news/news/update");
    }
    //删除新闻信息
    public function delete(){
        return view("news/news/delete");
    }
}
