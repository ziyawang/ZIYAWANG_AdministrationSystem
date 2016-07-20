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
        $datas=DB::table("T_N_NEWSINFO")->where('flag',"<>",2)->get();
        return view("news/news/index",compact('datas'));
    }
    //添加新闻
    public function add(){
        return view("news/news/add");
    }

    //保存添加新闻
    public function save($type){

        $db=DB::table("t_n_newsinfo")->insert([
            'NewsTitle'=>$_POST['title'],
            'NewsContent'=>$_POST['content'],
            'Brief'=>$_POST['description'],
            'NewsLogo'=>$_POST['newslogo'],
            'Flag'=>$type,
            'PublishTime'=>date("Y-m-d H:i:s", time()),
            'created_at'=>date("Y-m-d H:i:s", time())
        ]);

        return redirect("news/index");
    }

    //保存编辑新闻
    public function saveupdate($type){
        
        $db=DB::table("T_N_NEWSINFO")->where('NewsID',$_POST['newsid'])->update([
            'NewsTitle'=>$_POST['title'],
            'NewsContent'=>$_POST['content'],
            'Brief'=>$_POST['description'],
            'NewsLogo'=>$_POST['newslogo'],
            'Flag'=>$type,
            'PublishTime'=>date("Y-m-d H:i:s", time()),
            'updated_at'=>date("Y-m-d H:i:s", time())
        ]);

        return redirect("news/index");
    }

    //编辑新闻信息
    public function update($id){

        $datas=DB::table("T_N_NEWSINFO")->where('newsid',$id)->first();

        return view("news/news/update",compact('datas'));
    }
    //删除新闻信息
    public function delete($id){
        DB::table('T_N_NEWSINFO')->where('newsid',$id)->update([
            'Flag'=>2,
            'updated_at'=>date("Y-m-d H:i:s", time())]);
        return redirect("news/index");
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
