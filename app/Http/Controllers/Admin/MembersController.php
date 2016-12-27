<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MembersController extends Controller
{
    //会员列表的展示
    public function index()
    {
        $datas = DB::table("T_U_MEMBER")
            ->leftJoin("T_U_SERVICEINFO", "T_U_MEMBER.UserID", "=", "T_U_SERVICEINFO.UserID")
            ->leftJoin("T_CONFIG_MEMBER", "T_CONFIG_MEMBER.MemberID", "=", "T_U_MEMBER.MemberID")
            ->where("PayFlag", 1)
            ->where("Over",0)
            ->where("T_U_MEMBER.Userid","<>",889)
            ->orderBy("StartTime", "desc")
            ->paginate(20);
        foreach ($datas as $data) {
            $channel = $data->Channel;
            switch ($channel) {
                case "wx":
                    $channel = "微信App";
                    break;
                case "wx_pub_qr":
                    $channel = "微信PC扫码";
                    break;
                case "alipay":
                    $channel = "支付宝App";
                    break;
                case "alipay_pc_direct":
                    $channel = "支付宝PC";
                    break;
                case "upacp":
                    $channel = "银联App";
                    break;
                case "upacp_pc":
                    $channel = "银联PC";
                    break;
                case "iap":
                    $channel = "苹果app";
                    break;
            }
            $data->Channel=$channel;
        }
        return view("members/member/index", compact("datas"));
    }

    //会员充值
    public  function  recharge(){
        $memberId=$_GET['memberId'];
        $serviceId=$_GET['serviceId'];
        return view("members/member/recharge",compact("memberId","serviceId"));
    }
    //保存会员充值
    public function saveRecharge(){
           $userIds=DB::table("T_U_SERVICEINFO")->select("UserID")->where("ServiceID",$_POST['serviceId'])->get();
            foreach ($userIds as $value){
                $userId=$value->UserID;
            }
        $starts=DB::table("T_U_MEMBER")->select("EndTime")->where("MemberID",$_POST['memberId'])->where("UserID",$userId)->take(1)->orderBy("created_at","desc")->get();
        if(!empty($starts)){
            foreach ($starts as $val){
                $start=$val->EndTime;
            }
            if(strtotime($start)<strtotime($_POST['StartTime'])){
                $start=$_POST['StartTime'];
            }
        }else{
            $start=$_POST['StartTime'];
        }

        $month=intval($_POST['Time']);
        $startTime=strtotime($start);
        $endTime=date("Y-m-d H:i:s",strtotime("+$month months",$startTime));
        $orderNo = 'KT' . substr(time(),4) . mt_rand(1000,9999);
        $result=DB::table("T_U_MEMBER")->insert([
            "PayMoney"=>$_POST['PayMoney']*100,
             "MemberID"=>$_POST['memberId'],
             "Month"=>$_POST['Time'],
             "StartTime"=>$start,
             "EndTime"=>$endTime,
             "Channel"=>"",
             "IP"=>"",
            "BackNumber"=>"",
            "OrderNumber"=> $orderNo,
            "PayFlag"=>1,
            "Over"=>0,
            "UserID"=>$userId,
            "created_at"=>date("Y-m-d H:i:s", time())
        ]);
    }
}
