<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    //获取log内容,并在后台展示
    public  function index(){
        $this->lastData();
        $date=date("Ymd",time());
        $path='/var/www/html/ziyaapi/storage/logs/data/'.$date.'.log';
       // $contents=unserialize($contents);
        $fp = fopen($path, "r");
        if($fp){
            $contents=array();
            for($i=1;! feof($fp);$i++) {
              $content=unserialize(fgets($fp));
                $contents[]=$content;
            }
        }else{
            echo "打开文件失败";
        }
        fclose($fp);
       // var_dump($contents);die;
        foreach ($contents as $value){
          // var_dump($value['phonenumber']);die;
            if($value){
                $time=date("Y-m-d H:i:s",$value['time']);
                $counts=DB::table("T_M_RECORD")->where(['PhoneNumber'=>$value['phonenumber'],"LoginTime"=>$time])->count();
                if(!$counts){
                    $results=DB::table("T_M_RECORD")->insert([
                        "PhoneNumber"=>$value['phonenumber'],
                        "LoginTime"=>$time,
                        "IP"=>$value['ip']
                    ]);
                }
            }
        }
        $results=DB::table("T_M_RECORD")->select("PhoneNumber")->get();
        $dbs=array();
        foreach($results as $result){
            $phoneNumber=$result->PhoneNumber;
            if(in_array($phoneNumber,$dbs)){
                continue;
            }else{
                $dbs[]=$phoneNumber;
            }
        }
        $datas=DB::table("users")->whereIn("phonenumber",$dbs)->paginate(20);
        foreach ($dbs as $db){
            $counts=DB::table("T_M_RECORD")->where("PhoneNumber",$db)->count();
            $lastLogin=DB::table("T_M_RECORD")->select("LoginTime")->where("PhoneNumber",$db)->orderBy("LoginTime","desc")->take(1)->get();
            foreach ($lastLogin as $value){
                $lastLogin=$value->LoginTime;
            }
            foreach($datas as $data){
                if($data->phonenumber==$db){
                    $data->counts=$counts;
                    $data->lastLogin=$lastLogin;
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
        }
        return view("data/index",compact("datas"));

    }

    //上一天的数据
    public function lastData(){
        $date=date("Ymd",time()-60*60*24);
        $path='/var/www/html/ziyaapi/storage/logs/data/'.$date.'.log';
        // $contents=unserialize($contents);
        $fp = fopen($path, "r");
        if($fp){
            $contents=array();
            for($i=1;! feof($fp);$i++) {
                $content=unserialize(fgets($fp));
                $contents[]=$content;
            }
        }else{
            echo "打开文件失败";
        }
        fclose($fp);
        // var_dump($contents);die;
        foreach ($contents as $value){
            // var_dump($value['phonenumber']);die;
            if($value){
                $time=date("Y-m-d H:i:s",$value['time']);
                $counts=DB::table("T_M_RECORD")->where(['PhoneNumber'=>$value['phonenumber'],"LoginTime"=>$time])->count();
                if(!$counts){
                    $results=DB::table("T_M_RECORD")->insert([
                        "PhoneNumber"=>$value['phonenumber'],
                        "LoginTime"=>$time,
                        "IP"=>$value['ip']
                    ]);
                }
            }
        }
    }
    
    //用户登录平台的详细行为
    public  function detail($phoneNumber){
        $datas=DB::table("T_M_RECORD")->where("PhoneNumber",$phoneNumber)->orderBy("LoginTime","desc")->paginate(20);
        return view("data/detail",compact("datas"));
    }

}
