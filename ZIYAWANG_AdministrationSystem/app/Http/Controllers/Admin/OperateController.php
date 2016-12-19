<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class OperateController extends Controller
{
    //上传轮播图
    public function index()
    {
        $results = DB::table("T_P_PROJECTTYPE")->get();
        return view("operate/banner/index", compact("results"));
    }

    //保存上传的轮播图信息
    public function save()
    {
        if ($_POST['type'] == 1) {
            $type = $_POST['typeName'];
        } else {
            $type = 0;
        }
        $db = DB::table("T_P_BANNER")->insert([
            "TypeID" => $_POST['type'],
            "type" => $type,
            "BannerLink" => $_POST['bannerLink'],
            "detailID" => $_POST['detailId'],
            "created_at" => date("Y-m-d H:i:s", time()),
        ]);
        if ($db) {
            return back()->with("msg", "上传成功");
        } else {
            return back()->with("msg", "上传失败,请您重新上传");
        }
    }

    //轮播图上传图片
    public function upload()
    {
        $file = Input::file('Filedata');
        $clientName = $file->getClientOriginalName();//获取文件名
        $tmpName = $file->getFileName();//获取临时文件名
        $realPath = $file->getRealPath();//缓存文件的绝对路径
        $extension = $file->getClientOriginalExtension();//获取文件的后缀
        $mimeType = $file->getMimeType();//文件类型
        $newName = time() . mt_rand(1000, 9999) . '.' . $extension;//新文件名
//       $path = $file->move(base_path().'/public/upload/images/',$newName);//移动绝对路径
//       $filePath = '/upload/images/'.$newName;//存入数据库的相对路径
        $path = $file->move(dirname(base_path()) . '/ziyaupload/images/operates/', $newName);//移动绝对路径
        $filePath = '/operates/' . $newName;//存入数据库的相对路径
        return $filePath;
    }

    //用户举报反馈
    public function report(){
        $ids = array(889, 1095, 44);
        $datas = DB::table("T_U_REPORT")
            ->leftJoin("users", "users.userid", "=", "T_U_REPORT.UserID")
            ->select("users.username", "users.phonenumber", "T_U_REPORT.*")
            ->whereNotIn("T_U_REPORT.UserID", $ids)
            ->where("T_U_REPORT.UserID","<>",0)
            ->orderBy("T_U_REPORT.created_at","desc")
            ->paginate(20);
        foreach ($datas as $data) {
            if ($data->Type == 1) {
                $data->Type = "信息";
            } else {
                $data->Type = "服务";
            }
            if ($data->UserID == 0) {
                $data->username = "游客";
            }
        }
        return view("operate/banner/report", compact("datas"));
    }

    //处理举报的问题
    public function handle(){
        $id=$_POST['id'];
        $result = DB::table("T_U_REPORT")->where("ID", $id)->update([
            "Remark" => 1,
            "Result"=>$_POST['result']
        ]);
        if ($result) {
            return 1;
        }

    }

    //ajax获取处理举报的结果
    public function getDate(){
        $id=$_POST['id'];
        $results=DB::table("T_U_REPORT")->select("Result")->where("ID", $id)->get();
        $result=array();
        foreach ($results as $value){
            $result['data']=$value->Result;
        }
        if($results){
            return $result;
        }
    }
}