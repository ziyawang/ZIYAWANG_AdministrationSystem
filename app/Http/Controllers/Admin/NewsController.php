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
        //$datas=News::all();

        $datas=DB::table("t_n_newsinfo")->get();
        //dd($datas);
        return view("news/news/index",compact('datas'));
    }
    //添加新闻
    public function add(){
        return view("news/news/add");
    }

    //添加新闻
    public function save(){
        $db=DB::table("t_n_newsinfo")->insert([
            'NewsTitle'=>$_POST['title'],
            'NewsContent'=>$_POST['content'],
            'NewsLabel'=>$_POST['description']
        ]);
        return view("news/news/index");
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
