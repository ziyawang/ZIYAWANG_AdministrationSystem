<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class NewsController extends Controller
{
    //新闻列表
    public function index(){
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
            'Brief'=>$_POST['description'],
            'NewsLogo'=>$_POST['newslogo'],
            'created_at'=>date("Y-m-d H:i:s", time())
        ]);

        //dd($datas);
        return redirect("news/index");
    }

    //编辑新闻信息
    public function update(){
        return view("news/news/update");
    }
    //删除新闻信息
    public function delete(){
        return view("news/news/delete");
    }

    public function upload(){

        $file = Input::file('Filedata');
        $clientName = $file->getClientOriginalName();//获取文件名
        $tmpName = $file->getFileName();//获取临时文件名
        $realPath = $file->getRealPath();//缓存文件的绝对路径
        $extension = $file->getClientOriginalExtension();//获取文件的后缀
        $mimeType = $file->getMimeType();//文件类型
        $newName = date('Ymd'). mt_rand(1000,9999). '.'. $extension;//新文件名
        $path = $file->move(base_path().'/public/upload/images/',$newName);//移动绝对路径
        $filePath = '/upload/images/'.$newName;//存入数据库的相对路径

        return $filePath;
    }
}
