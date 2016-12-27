<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class StarController extends Controller
{
    //服务方认证人员的展示
    public  function index(){
        $datas=DB::table("T_U_STAR")
                    ->leftJoin("T_CONFIG_STAR","T_U_STAR.StarID","=","T_CONFIG_STAR.StarID")
                    ->leftJoin("T_U_SERVICEINFO","T_U_SERVICEINFO.UserID","=","T_U_STAR.UserID")
                    ->select("T_U_SERVICEINFO.ServiceName","T_U_SERVICEINFO.ConnectPhone","T_U_STAR.*","T_CONFIG_STAR.StarID")
                    ->whereIn("State",[1,2,3])
                    ->orderBy("T_U_STAR.created_at","desc")
                    ->paginate(20);
        return view ("members/star/index",compact("datas"));
    }

    //服务方认证详情页审核
    public  function detail($starPayId){
        $starPayIds=$starPayId;
        $datas=DB::table("T_U_STAR")
                    ->leftJoin("T_CONFIG_STAR","T_U_STAR.StarID","=","T_CONFIG_STAR.StarID")
                    ->leftJoin("T_U_SERVICEINFO","T_U_SERVICEINFO.UserID","=","T_U_STAR.UserID")
                    ->select("T_U_SERVICEINFO.ServiceName","T_U_SERVICEINFO.ConnectPhone","T_U_STAR.*","T_CONFIG_STAR.StarID")
                    ->where("StarPayID",$starPayIds)
                    ->get();
        foreach ($datas as $data){
            $resources=$data->Resource;
            $resource=explode(",",$resources);
            $starId=$data->StarID;
        }
        if($starId=="3"){
            return view("members/star/detail_02",compact("datas","starPayIds"));
        }else{
            $number=1;
            $pictureArr=array();
            foreach ($resource as $value){
                $picture="PictureDes".$number;
                $pictureArr[$picture]=$value;
                $number++;
            }

            $PictureDes1=!empty($pictureArr['PictureDes1']) ? $pictureArr['PictureDes1'] : "";
            $PictureDes2=!empty($pictureArr['PictureDes2']) ? $pictureArr['PictureDes2'] : "";
            $PictureDes3=!empty($pictureArr['PictureDes3']) ? $pictureArr['PictureDes3'] : "";
            return view("members/star/detail_01",compact("datas","starPayIds","PictureDes1","PictureDes2","PictureDes3"));
        }
    }

    //保存服务方认证详情的
    public  function  save(){
        $starPayId=$_POST['starPayIds'];
        $state=$_POST['state'];
        $starIds=DB::table("T_U_STAR")->where("StarPayID",$starPayId)->get();
        foreach ($starIds as $value ){
            $starId=$value->StarID;
            $userId=$value->UserID;
        }
        if($starId=="3"){
            $result=DB::table("T_U_STAR")->where("StarPayID",$starPayId)->update([
                "Resource"=>$_POST['Resource'],
                "OrderNumber"=>"KT".substr(time(),4).mt_rand(1000,9999),
                "State"=>$state,
            ]);
        }else if($starId=="1"){
            $result=DB::table("T_U_STAR")->where("StarPayID",$starPayId)->update([
                "Resource"=>"",
                "OrderNumber"=>"KT".substr(time(),4).mt_rand(1000,9999),
                "State"=>$state,
            ]);
        }else {
            $PictureArr["PictureDes1"]=!empty($_POST['PictureDes1']) ? $_POST['PictureDes1'] : "";
            $PictureArr["PictureDes2"]=!empty($_POST['PictureDes2']) ? $_POST['PictureDes2'] : "";
            $PictureArr["PictureDes3"]=!empty($_POST['PictureDes3']) ? $_POST['PictureDes3'] : "";
            $resource=implode(",",$PictureArr);
            $result=DB::table("T_U_STAR")->where("StarPayID",$starPayId)->update([
                "Resource"=>$resource,
                "State"=>$state,
            ]);
        }
        if($result){
            $starIdArr=array();
            $StarIDs=DB::table("T_U_STAR")->select("StarID")->where("UserID",$userId)->where("State",2)->get();
            foreach ($StarIDs as $value){
                $starIdArr[]=$value->StarID;
            }
            $level=implode(",",$starIdArr);
            $res=DB::table("T_U_SERVICEINFO")->where("UserID",$userId)->update([
                "Level"=>$level
            ]);
            return redirect("star/index");
        }else{
            return back()->with("msg","您修改失败,请重新修改");
        }

    }

    //服务方视频认证上传视频
    public function bigupload(){
        $file = Input::file('Filedata');
        $clientName = $file->getClientOriginalName();//获取文件名
        $tmpName = $file->getFileName();//获取临时文件名
        $realPath = $file->getRealPath();//缓存文件的绝对路径
        $extension = $file->getClientOriginalExtension();//获取文件的后缀
        $mimeType = $file->getMimeType();//文件类型
        $newName = time(). mt_rand(1000,9999). '.'. $extension;//新文件名
//       $path = $file->move(base_path().'/public/upload/images/',$newName);//移动绝对路径
//       $filePath = '/upload/images/'.$newName;//存入数据库的相对路径
        $path = $file->move(dirname(base_path()).'/ziyaupload/videos/',$newName);//移动绝对路径
        $filePath = '/'.$newName;//存入数据库的相对路径
        return $filePath;
    }

}
