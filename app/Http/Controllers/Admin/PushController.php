<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class PushController extends Controller{
        public  function index(){
            return view("push/index");
        }
    public function save(){
        $db=DB::table("T_M_MESSAGETEXT")->insertGetId([
            "Title"=>$_POST['title'],
            "Text"=>$_POST['contant']
        ]);
//        if($db){
//
//        }
    }

    public function receive(){
          if(isset($_POST['_token'])){
              if(!empty($_POST['serviceName'])){
                  if(!empty($_POST['connectPhone'])){
                      $datas=DB::table("T_P_SERVICEINFO")
                          ->leftJoin("T_P_SERVICECERTIFY","T_P_SERVICEINFO.ServiceID","=","T_P_SERVICECERTIFY.ServiceID")
                          ->select("T_P_SERVICEINFO.ServiceName,T_P_SERVICEINFO.ConnectPhone")
                          ->where("T_P_SERVICECERTIFY.State",1)
                          ->where("T_P_SERVICEINFO.ServiceName","like","%".$_POST['serviceName']."%")
                          ->where("T_P_SERVICEINFO.ConnectPhone","like","%".$_POST['serviceName']."%")
                          ->paginate(20);
                  }else{
                      $datas=DB::table("T_P_SERVICEINFO")
                          ->leftJoin("T_P_SERVICECERTIFY","T_P_SERVICEINFO.ServiceID","=","T_P_SERVICECERTIFY.ServiceID")
                          ->select("T_P_SERVICEINFO.ServiceName,T_P_SERVICEINFO.ConnectPhone")
                          ->where("T_P_SERVICECERTIFY.State",1)
                          ->where("T_P_SERVICEINFO.ServiceName","like","%".$_POST['serviceName']."%")
                          ->paginate(20);
                  }
              }else{
                  if(!empty($_POST['connectPhone'])){
                      $datas=DB::table("T_P_SERVICEINFO")
                          ->leftJoin("T_P_SERVICECERTIFY","T_P_SERVICEINFO.ServiceID","=","T_P_SERVICECERTIFY.ServiceID")
                          ->select("T_P_SERVICEINFO.ServiceName,T_P_SERVICEINFO.ConnectPhone")
                          ->where("T_P_SERVICECERTIFY.State",1)
                          ->where("T_P_SERVICEINFO.ConnectPhone","like","%".$_POST['serviceName']."%")
                          ->paginate(20);
                  }else{
                      $datas=DB::table("T_P_SERVICEINFO")
                          ->leftJoin("T_P_SERVICECERTIFY","T_P_SERVICEINFO.ServiceID","=","T_P_SERVICECERTIFY.ServiceID")
                          ->select("T_P_SERVICEINFO.ServiceName,T_P_SERVICEINFO.ConnectPhone")
                          ->paginate(20);
                  }
              }
          }
        return view("push/recrive",compact("datas"));
     
    }
}
