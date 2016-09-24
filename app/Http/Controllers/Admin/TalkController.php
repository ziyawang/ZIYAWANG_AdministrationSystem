<?php

namespace App\Http\Controllers\Admin;

use App\History;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class TalkController extends Controller
{
    //获取发送人的信息
    public function index(){
        if(!empty($_POST)){
            $phoneNumber=$_POST['phoneNumber'];
            $usersId=$_POST['usersId'];
            $state=$_POST['state'];
            $userIdWhere=!empty($_POST['usersId']) ? array("userid"=>$usersId) : array();
           if($state==1){
               $results=History::select("fromUserId")->get()->toArray();
               $dbs=array();
               foreach ($results as $result){
                   $fromUserId=$result['fromUserId'];
                   if(in_array($fromUserId,$dbs)){
                       continue;
                   }else{
                       $dbs[]=$fromUserId;
                   }
               }
               $datas=DB::table("users")->where("Status",0)
                            ->where($userIdWhere)
                            ->where("phonenumber","like","%".$phoneNumber."%")
                            ->whereIn("userid",$dbs)
                            ->orderBy("userid","desc")->paginate(20);
               foreach($datas as $data){
                   $userId=$data->userid;
                   $results=DB::table("T_U_SERVICEINFO")->where('userid',$userId)->count();
                   $pubs=DB::table("T_P_PROJECTINFO")->where("userid",$userId)->count();
                   if($results>0){
                       $data->role=1;
                   }else if($pubs>0 && $results==0 ){
                       $data->role=2;
                   }else{
                       $data->role=0;
                   }
               }

           }else{
                $datas=DB::table("users")->where("Status",0)
                            ->where($userIdWhere)
                            ->where("phonenumber","like","%".$phoneNumber."%")
                            ->orderBy("userid","desc")->paginate(20);
               foreach($datas as $data){
                   $userId=$data->userid;
                   $results=DB::table("T_U_SERVICEINFO")->where('userid',$userId)->count();
                   $pubs=DB::table("T_P_PROJECTINFO")->where("userid",$userId)->count();
                   if($results>0){
                       $data->role=1;
                   }else if($pubs>0 && $results==0 ){
                       $data->role=2;
                   }else{
                       $data->role=0;
                   }
               }
           }
            return view("talk/index",compact("datas","phoneNumber","usersId","state"));
        }

        if(!empty($_GET)){
            $phoneNumber=$_GET['phonenumber'];
            $usersId=$_GET["userid"];
            $state=$_GET['state'];
            $userIdWhere=!empty($_GET['userid']) ? array("userid"=>$usersId) : array();
            if($state==1){
                $results=History::select("fromUserId")->get()->toArray();
                $dbs=array();
                foreach ($results as $result){
                    $fromUserId=$result['fromUserId'];
                    if(in_array($fromUserId,$dbs)){
                        continue;
                    }else{
                        $dbs[]=$fromUserId;
                    }
                }
                $datas=DB::table("users")->where("Status",0)
                        ->where($userIdWhere)
                        ->where("phonenumber","like","%".$phoneNumber."%")
                        ->whereIn("userid",$dbs)
                        ->orderBy("userid","desc")->paginate(20);
                foreach($datas as $data){
                    $userId=$data->userid;
                    $results=DB::table("T_U_SERVICEINFO")->where('userid',$userId)->count();
                    $pubs=DB::table("T_P_PROJECTINFO")->where("userid",$userId)->count();
                    if($results>0){
                        $data->role=1;
                    }else if($pubs>0 && $results==0 ){
                        $data->role=2;
                    }else{
                        $data->role=0;
                    }
                }
            }else{
                $datas=DB::table("users")->where("Status",0)
                        ->where($userIdWhere)
                        ->where("phonenumber","like","%".$phoneNumber."%")
                        ->orderBy("userid","desc")->paginate(20);
                foreach($datas as $data){
                    $userId=$data->userid;
                    $results=DB::table("T_U_SERVICEINFO")->where('userid',$userId)->count();
                    $pubs=DB::table("T_P_PROJECTINFO")->where("userid",$userId)->count();
                    if($results>0){
                        $data->role=1;
                    }else if($pubs>0 && $results==0 ){
                        $data->role=2;
                    }else{
                        $data->role=0;
                    }
                }
            }
            return view("talk/index",compact("datas","phoneNumber","usersId","state"));
        }
            $phoneNumber="";
            $usersId="";
            $state=0;
            $datas=DB::table("users")->where("Status",0)->orderBy("userid","desc")->paginate(20);
        foreach($datas as $data){
            $userId=$data->userid;
            $results=DB::table("T_U_SERVICEINFO")->where('userid',$userId)->count();
            $pubs=DB::table("T_P_PROJECTINFO")->where("userid",$userId)->count();
            if($results>0){
                $data->role=1;
            }else if($pubs>0 && $results==0 ){
                $data->role=2;
            }else{
                $data->role=0;
            }
        }
            return view("talk/index",compact("datas","phoneNumber","usersId","state"));

    }

    //获取发送人对应的收信人
    public function message($id){
        $fromUserId=$id;
        $results=History::select()->where("fromUserId",$fromUserId)->get()->toArray();
        if(empty($results)){
           return back()->with("msg","该用户暂时没有聊天记录");
       }
        $arrs=array();
        foreach($results as $result){
            $targetId=$result['targetId'];
            if(in_array($targetId,$arrs)){
                continue;
            }
            $arrs[]=$targetId;
        }
        $datas=array();
        foreach($arrs as $arr ){
            if(in_array(0,$arrs)){
                $system=1;
            }else{
                $system=0;
            }
            if($arr!=0){
                $recode=User::select("userid","UserPicture","phonenumber")->where("userid",$arr)->get()->toArray();
                $datas[]=$recode;
            }
        }
     
        return view ("talk/message",compact("datas","system","fromUserId"));
    }

    //获取发信人和收信人的聊天记录
    public function showMessage($targetIds,$fromUserIds){
        $fromUserId=$fromUserIds;
        $frominfos=User::select("phonenumber","UserPicture")->where("userid",$fromUserId)->get()->toArray();
        if($targetIds!=0){
            $targetinfos=User::select("phonenumber","UserPicture")->where("userid",$targetIds)->get()->toArray();
        }else{
            $targetinfos=array(
                array("phonenumber"=>"客服","UserPicture"=>"/user/kefu.png")
            );
        }
        $results=History::select()->where("fromUserId",$fromUserId)->get()->toArray();
        $arrs=array();
        foreach($results as $result){
            $targetId=$result['targetId'];
            if(in_array($targetId,$arrs)){
                continue;
            }
            $arrs[]=$targetId;
        }
        $datas=array();
        foreach($arrs as $arr ){
            if(in_array(0,$arrs)){
                $system=1;
            }else{
                $system=0;
            }
            if($arr!=0){
                $recode=User::select("userid","UserPicture","phonenumber")->where("userid",$arr)->get()->toArray();
                $datas[]=$recode;
            }
        }
        $historys=History::select("classname","content","dateTime","fromUserId")->where(["fromUserId"=>$fromUserIds,"targetId"=>$targetIds])
                            ->orWhere(["fromUserId"=>$targetIds,"targetId"=>$fromUserIds])
                            ->orderBy("dateTime")
                            ->get()
                            ->toArray();
            $messages=array();
            foreach($historys as $key=>$message){
                if($message['classname']=="RC:ImgMsg" || $message['classname']=="RC:VcMsg" ){
                    $message['content']=strrchr($message['content'],"/");
                }
                $messages[]=$message;
        }
        return view ("talk/showMessage",compact("datas","system","fromUserId","messages","targetId","frominfos","targetinfos"));
       
    }
    
}
