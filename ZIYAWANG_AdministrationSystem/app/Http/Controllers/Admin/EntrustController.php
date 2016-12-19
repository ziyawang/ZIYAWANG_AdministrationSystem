<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EntrustController extends Controller
{
    //委托发布列表
    public  function  index(){
        $datas=DB::table("T_U_ENTRUST")->orderBy("EntrustTime","desc")->paginate(20);
        return view("members/entrust/index",compact('datas'));
    }

    //ajax改变handleFlag的值
    public  function  change(){
        $id=$_POST['id'];
        $result=DB::table("T_U_ENTRUST")->where("ID",$id)->update([
            "HandleFlag"=>1,
            "HandleTime"=>date("Y-m-d H:m:s",time())
        ]);
        if($result){
            return 1;
        }else{
            return 0;
        }
    }
}
