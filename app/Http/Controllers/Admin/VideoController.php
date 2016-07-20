<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{
    //视频管理
    public function index(){
        $datas=DB::table("T_V_VIDEOINFO")->where('Flag',"<>",2)->get();
        return view("news/video/index",compact('datas'));
    }
    //添加视频
    public function add(){
        return view("news/video/add");
    }

    //保存添加视频
    public function save($type){

        $db=DB::table("T_V_VIDEOINFO")->insert([
            'VideoTitle'=>$_POST['title'],
            'VideoDes'=>$_POST['description'],
            'VideoLink'=>$_POST['videolink'],
            'VideoLogo'=>$_POST['videologo'],
            'Flag'=>$type,
            'PublishTime'=>date("Y-m-d H:i:s", time()),
            'created_at'=>date("Y-m-d H:i:s", time())
        ]);

        return redirect("video/index");
    }

    //保存编辑视频
    public function saveupdate($type){

        $db=DB::table("T_V_VIDEOINFO")->where('VideoID',$_POST['videoid'])->update([
            'VideoTitle'=>$_POST['title'],
            'VideoDes'=>$_POST['description'],
            'VideoLink'=>$_POST['videolink'],
            'VideoLogo'=>$_POST['videologo'],
            'Flag'=>$type,
            'PublishTime'=>date("Y-m-d H:i:s", time()),
            'updated_at'=>date("Y-m-d H:i:s", time())
        ]);

        return redirect("video/index");
    }
    
    //编辑人员信息
    public function update($id){
        $datas=DB::table("T_V_VIDEOINFO")->where('VideoID',$id)->first();

        return view("news/video/update",compact('datas'));
    }
    //删除人员信息
    public function delete($id){
        DB::table('T_V_VIDEOINFO')->where('VideoID',$id)->update([
            'Flag'=>2,
            'updated_at'=>date("Y-m-d H:i:s", time())]);
        return redirect("video/index");
    }

}
