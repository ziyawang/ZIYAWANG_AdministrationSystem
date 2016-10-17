<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class MoneyController extends Controller
{
    //平台充值记录 金额统计
    public function index(){
       $datas=DB::table("T_U_MONEY")
                ->leftJoin("users","users.userid","=","T_U_MONEY.UserID")
                ->leftJoin("T_U_SERVICEINFO","T_U_SERVICEINFO.UserID","=","T_U_MONEY.UserID")
                ->select("T_U_MONEY.*","users.phonenumber","T_U_SERVICEINFO.ServiceName","users.username","T_U_SERVICEINFO.ServiceID")
                ->where("T_U_MONEY.Type",1)
                ->where("T_U_MONEY.Flag",1)
                ->whereNotIn("T_U_MONEY.UserID",[889,1095])
                ->orderBy("T_U_MONEY.created_at","desc")
                ->paginate(20);
        
        $money=0;
        $realMoney=0;
        $arrayUserIds=array();
        foreach ($datas as $key=>$data){
            $userid=$data->UserID;
            $money=$money+$data->Money;
            $realMoney=$realMoney+$data->RealMoney/100;
            if(!in_array($userid,$arrayUserIds)){
                $arrayUserIds[]=$userid;
                $recordCounts=DB::table("T_U_MONEY")->where("UserID",$userid)->where("T_U_MONEY.Type",1) ->where("T_U_MONEY.Flag",1)->count();
                $data->recordCounts=$recordCounts;
            }else{
                unset($datas[$key]);
            }
        }
        foreach ($datas as$key=> $data) {
            $channel=$data->Channel;
            switch($channel){
                case "wx":
                    $channel="微信App";
                break;
                case "wx_pub_qr":
                    $channel="微信PC扫码";
                    break;
                case "alipay":
                    $channel="支付宝App";
                    break;
                case "alipay_pub_direct":
                    $channel="支付宝PC";
                    break;
                case "upacp":
                    $channel="银联App";
                    break;
                case "upacp_pc":
                    $channel="银联PC";
                    break;
                case "upacp_pc":
                    $channel="苹果";
                    break;
            }
                $data->Channel=$channel;
                $userId = $data->UserID;
                $results = DB::table("T_U_SERVICEINFO")->where('userid', $userId)->count();
                $pubs = DB::table("T_P_PROJECTINFO")->where("userid", $userId)->count();
                if ($results > 0) {
                    $data->role = 1;
                } else if ($pubs > 0 && $results == 0) {
                    $data->role = 2;
                } else {
                    $data->role = 0;
                }

        }
        return view("money/index",compact('datas',"money","realMoney"));
    }

    //平台用户充值和消费记录详情
    public  function detail($userId){
        $userId=$userId;
        $datas=DB::table("T_U_MONEY")
            ->leftJoin("users","users.userid","=","T_U_MONEY.UserID")
            ->leftJoin("T_U_SERVICEINFO","T_U_SERVICEINFO.UserID","=","T_U_MONEY.UserID")
            ->select("T_U_MONEY.*","users.phonenumber","T_U_SERVICEINFO.ServiceName","users.username","T_U_SERVICEINFO.ServiceID")
            ->where("T_U_MONEY.Flag",1)
            ->where("T_U_MONEY.UserID",$userId)
            ->whereNotIn("T_U_MONEY.UserID",[889,1095])
            ->orderBy("T_U_MONEY.created_at","desc")
            ->paginate(20);
        foreach ($datas as$key=> $data) {
            $channel=$data->Channel;
            switch($channel){ 
                case "wx":
                    $channel="微信App";
                    break;
                case "wx_pub_qr":
                    $channel="微信PC扫码";
                    break;
                case "alipay":
                    $channel="支付宝App";
                    break;
                case "alipay_pub_direct":
                    $channel="支付宝PC";
                    break;
                case "upacp":
                    $channel="银联App";
                    break;
                case "upacp_pc":
                    $channel="银联PC";
                    break;
                case "upacp_pc":
                    $channel="苹果";
                    break;
                case "":
                    $channel="";
                    break;
            }
            $data->Channel=$channel;
            $userId = $data->UserID;
            $results = DB::table("T_U_SERVICEINFO")->where('userid', $userId)->count();
            $pubs = DB::table("T_P_PROJECTINFO")->where("userid", $userId)->count();
            if ($results > 0) {
                $data->role = 1;
            } else if ($pubs > 0 && $results == 0) {
                $data->role = 2;
            } else {
                $data->role = 0;
            }

        }
        return view("money/detail",compact('datas'));
    }

    //ajax传输数据
    public function ajax(){
        $value=$_POST['value'];
        switch($value){
            case "7":
                $value=7;
                $longTime=$_POST['longTime'];
                $shortTime=$_POST['shortTime'];
                break;
            case "30":
                $value=30;
                $longTime=$_POST['longTime'];
                $shortTime=$_POST['shortTime'];
                break;
            case "1":
                $value="1";
                $longTime=$_POST['longTime'];
                $shortTime=$_POST['shortTime'];
        }
        $MoneyTotal=array();
        $MoneyTotal["value"]=$value;
        $MoneyTotal["longTime"]=$longTime;
        $MoneyTotal["shortTime"]=$shortTime;
        session(["MoneyTotal"=>$MoneyTotal]);
       if(session('MoneyTotal')){
           return 1;
       }
        
    }
    public  function ajaxData(){
       
        $MoneyTotal=session("MoneyTotal");
        $value=$MoneyTotal['value'];
        if($value==7){
            $chooseTime=time()-7*24*60*60;
            $shortTime=$MoneyTotal['shortTime'];
            $longTime=$MoneyTotal['longTime'];
            $datas=DB::table("T_U_MONEY")
                ->leftJoin("users","users.userid","=","T_U_MONEY.UserID")
                ->leftJoin("T_U_SERVICEINFO","T_U_SERVICEINFO.UserID","=","T_U_MONEY.UserID")
                ->select("T_U_MONEY.*","users.phonenumber","T_U_SERVICEINFO.ServiceName","users.username","T_U_SERVICEINFO.ServiceID")
                ->where("T_U_MONEY.Type",1)
                ->where("T_U_MONEY.Flag",1)
                ->where("timestamp",">",$chooseTime)
                ->whereNotIn("T_U_MONEY.UserID",[889,1095])
                ->orderBy("T_U_MONEY.created_at","desc")
                ->paginate(20);
        }else if($value==30){
            $shortTime=$MoneyTotal['shortTime'];
            $longTime=$MoneyTotal['longTime'];
            $datas=DB::table("T_U_MONEY")
                ->leftJoin("users","users.userid","=","T_U_MONEY.UserID")
                ->leftJoin("T_U_SERVICEINFO","T_U_SERVICEINFO.UserID","=","T_U_MONEY.UserID")
                ->select("T_U_MONEY.*","users.phonenumber","T_U_SERVICEINFO.ServiceName","users.username","T_U_SERVICEINFO.ServiceID")
                ->where("T_U_MONEY.Type",1)
                ->where("T_U_MONEY.Flag",1)
                ->whereNotIn("T_U_MONEY.UserID",[889,1095])
                ->orderBy("T_U_MONEY.created_at","desc")
                ->paginate(20);
        }else{
            $shortTime=strtotime($MoneyTotal['shortTime']);
            $longTime=strtotime($MoneyTotal['longTime'])+24*60*60;
            $datas=DB::table("T_U_MONEY")
                ->leftJoin("users","users.userid","=","T_U_MONEY.UserID")
                ->leftJoin("T_U_SERVICEINFO","T_U_SERVICEINFO.UserID","=","T_U_MONEY.UserID")
                ->select("T_U_MONEY.*","users.phonenumber","T_U_SERVICEINFO.ServiceName","users.username","T_U_SERVICEINFO.ServiceID")
                ->where("T_U_MONEY.Type",1)
                ->where("T_U_MONEY.Flag",1)
                ->whereBetween("timestamp",[$shortTime,$longTime])
                ->whereNotIn("T_U_MONEY.UserID",[889,1095])
                ->orderBy("T_U_MONEY.created_at","desc")
                ->paginate(20);
            $shortTime=($MoneyTotal['shortTime']);
            $longTime=($MoneyTotal['longTime']);
        }
        $money=0;
        $realMoney=0;
        $arrayUserIds=array();
        foreach ($datas as $key=>$data){
            $userid=$data->UserID;
            $money=$money+$data->Money;
            $realMoney=$realMoney+$data->RealMoney/100;
            if(!in_array($userid,$arrayUserIds)){
                $arrayUserIds[]=$userid;
                $recordCounts=DB::table("T_U_MONEY")->where("UserID",$userid)->where("T_U_MONEY.Type",1) ->where("T_U_MONEY.Flag",1)->count();
                $data->recordCounts=$recordCounts;
            }else{
                unset($datas[$key]);
            }
        }
        foreach ($datas as$key=> $data) {
            $channel=$data->Channel;
            switch($channel){
                case "wx":
                    $channel="微信App";
                    break;
                case "wx_pub_qr":
                    $channel="微信PC扫码";
                    break;
                case "alipay":
                    $channel="支付宝App";
                    break;
                case "alipay_pub_direct":
                    $channel="支付宝PC";
                    break;
                case "upacp":
                    $channel="银联App";
                    break;
                case "upacp_pc":
                    $channel="银联PC";
                    break;
                case "upacp_pc":
                    $channel="苹果";
                    break;
            }
            $data->Channel=$channel;
            $userId = $data->UserID;
            $results = DB::table("T_U_SERVICEINFO")->where('userid', $userId)->count();
            $pubs = DB::table("T_P_PROJECTINFO")->where("userid", $userId)->count();
            if ($results > 0) {
                $data->role = 1;
            } else if ($pubs > 0 && $results == 0) {
                $data->role = 2;
            } else {
                $data->role = 0;
            }

        }
        return view("money/index",compact('datas',"money","realMoney","value","shortTime","longTime"));

    }
}
