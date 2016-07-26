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
        if(isset($_POST["_token"])){
            $datas=DB::table("T_N_NEWSINFO")->where("Flag","<>",2)->where("NewsTitle","like","%".$_POST['newsTitle']."%")->paginate(20);
            return view("news/news/index",compact('datas'));
        }
        $datas=DB::table("t_n_newsinfo")->where('Flag',"<>",2)->paginate(20);
        return view("news/news/index",compact('datas'));
    }
    //添加新闻
    public function add(){
        $datas=DB::table("T_CONFIG_TYPE")->where("module",1)->get();
        return view("news/news/add",compact("datas"));
    }

    //保存添加新闻
    public function save($type){
        $db=DB::table("t_n_newsinfo")->insertGetId([
            'NewsTitle'=>$_POST['title'],
            'NewsContent'=>$_POST['content'],
            'Brief'=>$_POST['description'],
            'NewsLogo'=>$_POST['newslogo'],
            'Flag'=>$type,
            'created_at'=>date("Y-m-d H:i:s", time()),
            
        ]);
        $types=$_POST['type'];
        foreach($types as $value){
            DB::table("T_CONFIG_ITEMTYPE")->insert([
                "MoudleID"=>$db,
                "TypeID"=>$value,
                "Moudle"=>1
            ]);
        }
        return redirect("news/index");
    }

    //保存编辑新闻
    public function saveupdate($type){
        $db=DB::table("t_n_newsinfo")->where('newsid',$_POST['newsid'])->update([
            'NewsTitle'=>$_POST['title'],
            'NewsContent'=>$_POST['content'],
            'Brief'=>$_POST['description'],
            'NewsLogo'=>$_POST['newslogo'],
            'Flag'=>$type,
            'updated_at'=>date("Y-m-d H:i:s", time())
        ]);
        $types=$_POST['type'];
         $count=DB::table("T_CONFIG_ITEMTYPE")->where("MoudleID",$_POST['newsid'])->count();
         if($count!=0){
            DB::table("T_CONFIG_ITEMTYPE")->where("MoudleID",$_POST['newsid'])->delete();
        }
        foreach($types as $value){
            $result=DB::table("T_CONFIG_ITEMTYPE")->insert([
                "MoudleID"=>$_POST['newsid'],
                "TypeID"=>$value,
                "Moudle"=>1
            ]);
        }

        return redirect("news/index");
    }

    //编辑新闻信息
    public function update($id){

        $datas=DB::table("t_n_newsinfo")->where('newsid',$id)->first();
        $results=DB::table("T_CONFIG_ITEMTYPE")->select("TypeID")->where("MoudleID",$id)->get();
        foreach ($results as $result){
            $count[]=$result->TypeID;
        }
        $types=DB::table("T_CONFIG_TYPE")->where("module",1)->get();
        return view("news/news/update",compact('datas',"count","types"));
    }
    //删除新闻信息
    public function delete($id){
        DB::table('T_N_NEWSINFO')->where('NewsID',$id)->update([
            'Flag'=>2,
            'updated_at'=>date("Y-m-d H:i:s", time())]);
        DB::table("T_CONFIG_ITEMTYPE")->where("MoudleID",$id)->delete();
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
//       $path = $file->move(base_path().'/public/upload/images/',$newName);//移动绝对路径
//       $filePath = '/upload/images/'.$newName;//存入数据库的相对路径
        $path = $file->move(dirname(base_path()).'/upload/images/news/',$newName);//移动绝对路径
        $filePath = '/images/news/'.$newName;//存入数据库的相对路径
        return $filePath;
    }
}
