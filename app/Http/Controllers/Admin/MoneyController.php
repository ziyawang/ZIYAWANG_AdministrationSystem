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
                ->get();
        
        $money=0;
        $realMoney=0;
        $results=DB::table("T_U_MONEY")
            ->where("T_U_MONEY.Type",1)
            ->where("T_U_MONEY.Flag",1)
            ->whereNotIn("T_U_MONEY.UserID",[889,1095])
            ->get();
        foreach ($results as $result){
            $money=$money+$result->Money;
            $realMoney=$realMoney+$result->RealMoney/100;
        }
        $arrayUserIds=array();
        $moneyIds=array();
        foreach ($datas as $key=>$data){
            $userid=$data->UserID;
            if(!in_array($userid,$arrayUserIds)){
                $arrayUserIds[]=$userid;
                $moneyIds[]=$data->MoneyID;
            }
        }
        $dataMoneys=DB::table("T_U_MONEY")
                    ->leftJoin("users","users.userid","=","T_U_MONEY.UserID")
                    ->leftJoin("T_U_SERVICEINFO","T_U_SERVICEINFO.UserID","=","T_U_MONEY.UserID")
                    ->select("T_U_MONEY.*","users.phonenumber","T_U_SERVICEINFO.ServiceName","users.username","T_U_SERVICEINFO.ServiceID")
                    ->where("T_U_MONEY.Type",1)
                    ->where("T_U_MONEY.Flag",1)
                    ->whereIn("T_U_MONEY.MoneyID",$moneyIds)
                    ->whereNotIn("T_U_MONEY.UserID",[889,1095])
                    ->orderBy("T_U_MONEY.created_at","desc")
                    ->paginate(20);
        foreach ($dataMoneys as $key=> $dataMoney) {
            $dataMoneyId=$dataMoney->UserID;
            $recordCounts=DB::table("T_U_MONEY")->where("UserID",$dataMoneyId)->where("T_U_MONEY.Type",1) ->where("T_U_MONEY.Flag",1)->count();
            $personalMoneys=DB::table("T_U_MONEY")->select("Money","RealMoney")->where("UserID",$dataMoneyId)->where("T_U_MONEY.Type",1) ->where("T_U_MONEY.Flag",1)->get();
            $personalMoney=0;
            $realPerMoney=0;
            foreach ($personalMoneys as $value){
                $personalMoney=$personalMoney+$value->Money;
                $realPerMoney=$realPerMoney+$value->RealMoney;
            }
            $dataMoney->personalMoney= $personalMoney;
            $dataMoney->realPerMoney= $realPerMoney;
            $dataMoney->recordCounts=$recordCounts;
            $channel=$dataMoney->Channel;
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
                case "alipay_pc_direct":
                    $channel="支付宝PC";
                    break;
                case "upacp":
                    $channel="银联App";
                    break;
                case "upacp_pc":
                    $channel="银联PC";
                    break;
                case "iap":
                    $channel="苹果";
                    break;
            }
            $dataMoney->Channel=$channel;
                $userId = $dataMoney->UserID;
                $results = DB::table("T_U_SERVICEINFO")->where('userid', $userId)->count();
                $pubs = DB::table("T_P_PROJECTINFO")->where("userid", $userId)->count();
                if ($results > 0) {
                    $dataMoney->role = 1;
                } else if ($pubs > 0 && $results == 0) {
                    $dataMoney->role = 2;
                } else {
                    $dataMoney->role = 0;
                }

        }
        $value="30";
        $shortTime="1";
        $longTime="1";
        return view("money/index",compact('dataMoneys',"money","realMoney","value","shortTime","longTime"));
    }

    //平台用户充值记录详情
    public  function detail($userId,$value,$longTime,$shortTime){
        $userId=$userId;
        $values=$value;
        $longTimes=$longTime;
        $shortTimes=$shortTime;
        if($values==7){
            $chooseTime=time()-7*24*60*60;
            $shortTime=$shortTimes;
            $longTime=$longTimes;
            $datas=DB::table("T_U_MONEY")
                ->leftJoin("users","users.userid","=","T_U_MONEY.UserID")
                ->leftJoin("T_U_SERVICEINFO","T_U_SERVICEINFO.UserID","=","T_U_MONEY.UserID")
                ->select("T_U_MONEY.*","users.phonenumber","T_U_SERVICEINFO.ServiceName","users.username","T_U_SERVICEINFO.ServiceID")
                ->where("T_U_MONEY.Type",1)
                ->where("T_U_MONEY.Flag",1)
                ->where("timestamp",">",$chooseTime)
                ->where("T_U_MONEY.UserID",$userId)
                ->whereNotIn("T_U_MONEY.UserID",[889,1095])
                ->orderBy("T_U_MONEY.created_at","desc")
                ->paginate(20);
        }elseif($values==30){
            $datas=DB::table("T_U_MONEY")
                ->leftJoin("users","users.userid","=","T_U_MONEY.UserID")
                ->leftJoin("T_U_SERVICEINFO","T_U_SERVICEINFO.UserID","=","T_U_MONEY.UserID")
                ->select("T_U_MONEY.*","users.phonenumber","T_U_SERVICEINFO.ServiceName","users.username","T_U_SERVICEINFO.ServiceID")
                ->where("T_U_MONEY.Type",1)
                ->where("T_U_MONEY.Flag",1)
                ->where("T_U_MONEY.UserID",$userId)
                ->whereNotIn("T_U_MONEY.UserID",[889,1095])
                ->orderBy("T_U_MONEY.created_at","desc")
                ->paginate(20);
        }else{
            $shortTime=strtotime($shortTimes);
            $longTime=strtotime($longTimes)+24*60*60;
            $datas=DB::table("T_U_MONEY")
                ->leftJoin("users","users.userid","=","T_U_MONEY.UserID")
                ->leftJoin("T_U_SERVICEINFO","T_U_SERVICEINFO.UserID","=","T_U_MONEY.UserID")
                ->select("T_U_MONEY.*","users.phonenumber","T_U_SERVICEINFO.ServiceName","users.username","T_U_SERVICEINFO.ServiceID")
                ->where("T_U_MONEY.Type",1)
                ->where("T_U_MONEY.Flag",1)
                ->where("T_U_MONEY.UserID",$userId)
                ->whereBetween("timestamp",[$shortTime,$longTime])
                ->whereNotIn("T_U_MONEY.UserID",[889,1095])
                ->orderBy("T_U_MONEY.created_at","desc")
                ->paginate(20);
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
                case "alipay_pc_direct":
                    $channel="支付宝PC";
                    break;
                case "upacp":
                    $channel="银联App";
                    break;
                case "upacp_pc":
                    $channel="银联PC";
                    break;
                case "iap":
                    $channel="苹果app";
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
        $shortTime=$shortTimes;
        $longTime=$longTimes;
        return view("money/detail",compact('datas',"value","shortTime","longTime"));
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
    
    //根据筛选添加获取数据
    public  function ajaxData(){
       if(!empty($_GET)){
           $value=$_GET['value'];
           $shortTimes=$_GET['shortTime'];
           $longTimes=$_GET['longTime'];
       }else{
           $MoneyTotal=session("MoneyTotal");
           $value=$MoneyTotal['value'];
           $shortTimes=$MoneyTotal['shortTime'];
           $longTimes=$MoneyTotal['longTime'];
       }

        if($value==7){
            $chooseTime=time()-7*24*60*60;
            $shortTime=$shortTimes;
            $longTime=$longTimes;
            $datas=DB::table("T_U_MONEY")
                ->leftJoin("users","users.userid","=","T_U_MONEY.UserID")
                ->leftJoin("T_U_SERVICEINFO","T_U_SERVICEINFO.UserID","=","T_U_MONEY.UserID")
                ->select("T_U_MONEY.*","users.phonenumber","T_U_SERVICEINFO.ServiceName","users.username","T_U_SERVICEINFO.ServiceID")
                ->where("T_U_MONEY.Type",1)
                ->where("T_U_MONEY.Flag",1)
                ->where("timestamp",">",$chooseTime)
                ->whereNotIn("T_U_MONEY.UserID",[889,1095])
                ->orderBy("T_U_MONEY.created_at","desc")
                ->get();
            $results=DB::table("T_U_MONEY")
                ->where("T_U_MONEY.Type",1)
                ->where("T_U_MONEY.Flag",1)
                ->where("timestamp",">",$chooseTime)
                ->whereNotIn("T_U_MONEY.UserID",[889,1095])
                ->get();
        }else if($value==30){
            $shortTime=$shortTimes;
            $longTime=$longTimes;
            $datas=DB::table("T_U_MONEY")
                ->leftJoin("users","users.userid","=","T_U_MONEY.UserID")
                ->leftJoin("T_U_SERVICEINFO","T_U_SERVICEINFO.UserID","=","T_U_MONEY.UserID")
                ->select("T_U_MONEY.*","users.phonenumber","T_U_SERVICEINFO.ServiceName","users.username","T_U_SERVICEINFO.ServiceID")
                ->where("T_U_MONEY.Type",1)
                ->where("T_U_MONEY.Flag",1)
                ->whereNotIn("T_U_MONEY.UserID",[889,1095])
                ->orderBy("T_U_MONEY.created_at","desc")
                ->get();
            $results=DB::table("T_U_MONEY")
                ->where("T_U_MONEY.Type",1)
                ->where("T_U_MONEY.Flag",1)
                ->whereNotIn("T_U_MONEY.UserID",[889,1095])
                ->get();

        }else{
            $shortTime=strtotime($shortTimes);
            $longTime=strtotime($longTimes)+24*60*60;
            $datas=DB::table("T_U_MONEY")
                ->leftJoin("users","users.userid","=","T_U_MONEY.UserID")
                ->leftJoin("T_U_SERVICEINFO","T_U_SERVICEINFO.UserID","=","T_U_MONEY.UserID")
                ->select("T_U_MONEY.*","users.phonenumber","T_U_SERVICEINFO.ServiceName","users.username","T_U_SERVICEINFO.ServiceID")
                ->where("T_U_MONEY.Type",1)
                ->where("T_U_MONEY.Flag",1)
                ->whereBetween("timestamp",[$shortTime,$longTime])
                ->whereNotIn("T_U_MONEY.UserID",[889,1095])
                ->orderBy("T_U_MONEY.created_at","desc")
                ->get();
            $results=DB::table("T_U_MONEY")
                ->where("T_U_MONEY.Type",1)
                ->where("T_U_MONEY.Flag",1)
                ->whereBetween("timestamp",[$shortTime,$longTime])
                ->whereNotIn("T_U_MONEY.UserID",[889,1095])
                ->get();
        }
        $money=0;
        $realMoney=0;
        foreach ($results as $result){
            $money=$money+$result->Money;
            $realMoney=$realMoney+$result->RealMoney/100;
        }
        $arrayUserIds=array();
        $moneyIds=array();
        foreach ($datas as $key=>$data){
            $userid=$data->UserID;
            if(!in_array($userid,$arrayUserIds)){
                $arrayUserIds[]=$userid;
                $moneyIds[]=$data->MoneyID;
            }
        }
        $dataMoneys=DB::table("T_U_MONEY")
            ->leftJoin("users","users.userid","=","T_U_MONEY.UserID")
            ->leftJoin("T_U_SERVICEINFO","T_U_SERVICEINFO.UserID","=","T_U_MONEY.UserID")
            ->select("T_U_MONEY.*","users.phonenumber","T_U_SERVICEINFO.ServiceName","users.username","T_U_SERVICEINFO.ServiceID")
            ->where("T_U_MONEY.Type",1)
            ->where("T_U_MONEY.Flag",1)
            ->whereIn("T_U_MONEY.MoneyID",$moneyIds)
            ->whereNotIn("T_U_MONEY.UserID",[889,1095])
            ->orderBy("T_U_MONEY.created_at","desc")
            ->paginate(20);
        foreach ($dataMoneys as $key=> $dataMoney) {
            $dataMoneyId=$dataMoney->UserID;
            if($value==7){
                $recordCounts=DB::table("T_U_MONEY")->where("UserID",$dataMoneyId)->where("T_U_MONEY.Type",1)->where("timestamp",">",$chooseTime)->where("T_U_MONEY.Flag",1)->count();
              $personalMoneys=DB::table("T_U_MONEY")->select("Money","RealMoney")->where("UserID",$dataMoneyId)->where("T_U_MONEY.Type",1)->where("timestamp",">",$chooseTime) ->where("T_U_MONEY.Flag",1)->get();
            }elseif($value==30){
                $recordCounts=DB::table("T_U_MONEY")->where("UserID",$dataMoneyId)->where("T_U_MONEY.Type",1) ->where("T_U_MONEY.Flag",1)->count();
               $personalMoneys=DB::table("T_U_MONEY")->select("Money","RealMoney")->where("UserID",$dataMoneyId)->where("T_U_MONEY.Type",1) ->where("T_U_MONEY.Flag",1)->get();
            }else{
                $personalMoneys=DB::table("T_U_MONEY")->select("Money","RealMoney")->where("UserID",$dataMoneyId)->whereBetween("timestamp",[$shortTime,$longTime])->where("T_U_MONEY.Type",1) ->where("T_U_MONEY.Flag",1)->get();
                $recordCounts=DB::table("T_U_MONEY")->where("UserID",$dataMoneyId)->where("T_U_MONEY.Type",1)->whereBetween("timestamp",[$shortTime,$longTime])->where("T_U_MONEY.Flag",1)->count();
            }
            $dataMoney->recordCounts=$recordCounts;
            $personalMoney=0;
            $realPerMoney=0;
            foreach ($personalMoneys as $values){
                $personalMoney=$personalMoney+$values->Money;
               $realPerMoney=$realPerMoney+$values->RealMoney;
            }
            $dataMoney->personalMoney= $personalMoney;
          $dataMoney->realPerMoney= $realPerMoney;
            $channel=$dataMoney->Channel;
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
                case "alipay_pc_direct":
                    $channel="支付宝PC";
                    break;
                case "upacp":
                    $channel="银联App";
                    break;
                case "upacp_pc":
                    $channel="银联PC";
                    break;
                case "iap":
                    $channel="苹果";
                    break;
            }
            $dataMoney->Channel=$channel;
            $userId = $dataMoney->UserID;
            $results = DB::table("T_U_SERVICEINFO")->where('userid', $userId)->count();
            $pubs = DB::table("T_P_PROJECTINFO")->where("userid", $userId)->count();
            if ($results > 0) {
                $dataMoney->role = 1;
            } else if ($pubs > 0 && $results == 0) {
                $dataMoney->role = 2;
            } else {
                $dataMoney->role = 0;
            }

        }
        $shortTime=$shortTimes;
        $longTime=$longTimes;
        return view("money/index",compact('dataMoneys',"money","realMoney","value","shortTime","longTime"));

    }
    
    //芽币消耗统计
    public  function consume(){
        $datas=DB::table("T_U_MONEY")
            ->leftJoin("T_P_PROJECTINFO","T_P_PROJECTINFO.ProjectID","=","T_U_MONEY.ProjectID")
            ->select("T_U_MONEY.*","T_P_PROJECTINFO.WordDes","T_P_PROJECTINFO.TypeID")
            ->where("T_U_MONEY.Type",2)
            ->whereNotIn("T_U_MONEY.UserID",[889,1095])
            ->orderBy("T_U_MONEY.created_at","desc")
            ->get();
        $money=0;
        $consumeMoney=0;
        $results=DB::table("T_U_MONEY")
            ->where("T_U_MONEY.Type",1)
            ->where("T_U_MONEY.Flag",1)
            ->whereNotIn("T_U_MONEY.UserID",[889,1095])
            ->get();
        $consumes=DB::table("T_U_MONEY")
            ->where("T_U_MONEY.Type",2)
            ->whereNotIn("T_U_MONEY.UserID",[889,1095])
            ->get();
        foreach ($results as $result){
            $money=$money+$result->Money;
        }
        foreach ($consumes as $consume){
            $consumeMoney=$consumeMoney+$consume->Money;
        }
        $arr=array();
        $moneyIds=array();
        foreach ($datas as $key=> $data) {
            $projectId = $data->ProjectID;
            if(!in_array($projectId,$arr)){
                $arr[]=$projectId;
                $moneyIds[]=$data->MoneyID;
            }
        }
        $dataMoneys=DB::table("T_U_MONEY")
            ->leftJoin("T_P_PROJECTINFO","T_P_PROJECTINFO.ProjectID","=","T_U_MONEY.ProjectID")
            ->leftJoin("T_P_PROJECTTYPE","T_P_PROJECTTYPE.TypeID","=","T_P_PROJECTINFO.TypeID")
            ->select("T_U_MONEY.*","T_P_PROJECTINFO.WordDes","T_P_PROJECTTYPE.TypeName","T_P_PROJECTINFO.TypeID")
            ->where("T_U_MONEY.Type",2)
            ->whereIn("T_U_MONEY.MoneyID",$moneyIds)
            ->whereNotIn("T_U_MONEY.UserID",[889,1095])
            ->orderBy("T_U_MONEY.created_at","desc")
            ->paginate(20);
        foreach ($dataMoneys as $dataMoney){
            $projectId= $dataMoney->ProjectID;
            $recordCounts=DB::table("T_U_MONEY")->where("ProjectID",$projectId)->where("Type",2) ->whereNotIn("T_U_MONEY.UserID",[889,1095])->count();
            $dataMoney->recordCounts=$recordCounts;
        }
        $value="30";
        $shortTime="1";
        $longTime="1";
        return view("money/consume",compact('dataMoneys',"money","consumeMoney","value","shortTime","longTime"));

    }
    
    //芽币消耗记录详情
    public  function conDetail($projectId,$value,$longTime,$shortTime){
        $projectId=$projectId;
        $values=$value;
        $longTimes=$longTime;
        $shortTimes=$shortTime;
        if($values==7){
            $chooseTime=time()-7*24*60*60;
            $shortTime=$shortTimes;
            $longTime=$longTimes;
            $datas=DB::table("T_U_MONEY")
                ->leftJoin("users","users.userid","=","T_U_MONEY.UserID")
                ->leftJoin("T_U_SERVICEINFO","T_U_SERVICEINFO.UserID","=","T_U_MONEY.UserID")
                ->select("T_U_MONEY.*","users.phonenumber","T_U_SERVICEINFO.ServiceName","users.username","T_U_SERVICEINFO.ServiceID")
                ->where("T_U_MONEY.Type",2)
                ->where("T_U_MONEY.ProjectID",$projectId)
                ->where("timestamp",">",$chooseTime)
                ->whereNotIn("T_U_MONEY.UserID",[889,1095])
                ->orderBy("T_U_MONEY.created_at","desc")
                ->paginate(20);
        }elseif($values==30){
            $shortTime=$shortTimes;
            $longTime=$longTimes;
            $datas=DB::table("T_U_MONEY")
                ->leftJoin("users","users.userid","=","T_U_MONEY.UserID")
                ->leftJoin("T_U_SERVICEINFO","T_U_SERVICEINFO.UserID","=","T_U_MONEY.UserID")
                ->select("T_U_MONEY.*","users.phonenumber","T_U_SERVICEINFO.ServiceName","users.username","T_U_SERVICEINFO.ServiceID")
                ->where("T_U_MONEY.Type",2)
                ->where("T_U_MONEY.ProjectID",$projectId)
                ->whereNotIn("T_U_MONEY.UserID",[889,1095])
                ->orderBy("T_U_MONEY.created_at","desc")
                ->paginate(20);
        }else{
            $shortTime=strtotime($shortTimes);
            $longTime=strtotime($longTimes)+24*60*60;
            $datas=DB::table("T_U_MONEY")
                ->leftJoin("users","users.userid","=","T_U_MONEY.UserID")
                ->leftJoin("T_U_SERVICEINFO","T_U_SERVICEINFO.UserID","=","T_U_MONEY.UserID")
                ->select("T_U_MONEY.*","users.phonenumber","T_U_SERVICEINFO.ServiceName","users.username","T_U_SERVICEINFO.ServiceID")
                ->where("T_U_MONEY.Type",2)
                ->where("T_U_MONEY.ProjectID",$projectId)
                ->whereBetween("timestamp",[$shortTime,$longTime])
                ->whereNotIn("T_U_MONEY.UserID",[889,1095])
                ->orderBy("T_U_MONEY.created_at","desc")
                ->paginate(20);
        }
        foreach ($datas as$key=> $data) {
            $channel=$data->Channel;
            $projectIds=$data->ProjectID;
            $types=DB::table("T_P_PROJECTINFO")->select("TypeID")->where("ProjectID",$projectIds)->get();
            foreach ($types as $type){
                $data->TypeID=$type->TypeID;
            }
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
                case "alipay_pc_direct":
                    $channel="支付宝PC";
                    break;
                case "upacp":
                    $channel="银联App";
                    break;
                case "upacp_pc":
                    $channel="银联PC";
                    break;
                case "iap":
                    $channel="苹果app";
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
        $shortTime=$shortTimes;
        $longTime=$longTimes;
        return view("money/conDetail",compact('datas',"value","longTime","shortTime"));
    }
    
    //根据筛选条件已消耗的数据
    public function consumeData(){
        if(!empty($_GET)){
            $value=$_GET['value'];
            $shortTimes=$_GET['shortTime'];
            $longTimes=$_GET['longTime'];
        }else{
            $MoneyTotal=session("MoneyTotal");
            $value=$MoneyTotal['value'];
            $shortTimes=$MoneyTotal['shortTime'];
            $longTimes=$MoneyTotal['longTime'];
        }

        if($value==7){
            $chooseTime=time()-7*24*60*60;
            $shortTime=$shortTimes;
            $longTime=$longTimes;
            $datas=DB::table("T_U_MONEY")
                ->leftJoin("T_P_PROJECTINFO","T_P_PROJECTINFO.ProjectID","=","T_U_MONEY.ProjectID")
                ->select("T_U_MONEY.*","T_P_PROJECTINFO.WordDes","T_P_PROJECTINFO.TypeID")
                ->where("T_U_MONEY.Type",2)
                ->where("timestamp",">",$chooseTime)
                ->whereNotIn("T_U_MONEY.UserID",[889,1095])
                ->orderBy("T_U_MONEY.created_at","desc")
                ->get();
            $results=DB::table("T_U_MONEY")
                ->where("T_U_MONEY.Type",1)
                ->where("T_U_MONEY.Flag",1)
                ->where("timestamp",">",$chooseTime)
                ->whereNotIn("T_U_MONEY.UserID",[889,1095])
                ->get();
            $consumes=DB::table("T_U_MONEY")
                ->where("T_U_MONEY.Type",2)
                ->where("timestamp",">",$chooseTime)
                ->whereNotIn("T_U_MONEY.UserID",[889,1095])
                ->get();
        }else if($value==30){
            $shortTime=$shortTimes;
            $longTime=$longTimes;
            $datas=DB::table("T_U_MONEY")
                ->leftJoin("T_P_PROJECTINFO","T_P_PROJECTINFO.ProjectID","=","T_U_MONEY.ProjectID")
                ->select("T_U_MONEY.*","T_P_PROJECTINFO.WordDes","T_P_PROJECTINFO.TypeID")
                ->where("T_U_MONEY.Type",2)
                ->whereNotIn("T_U_MONEY.UserID",[889,1095])
                ->orderBy("T_U_MONEY.created_at","desc")
                ->get();
            $results=DB::table("T_U_MONEY")
                ->where("T_U_MONEY.Type",1)
                ->where("T_U_MONEY.Flag",1)
                ->whereNotIn("T_U_MONEY.UserID",[889,1095])
                ->get();
            $consumes=DB::table("T_U_MONEY")
                ->where("T_U_MONEY.Type",2)
                ->whereNotIn("T_U_MONEY.UserID",[889,1095])
                ->get();

        }else{
            $shortTime=strtotime($shortTimes);
            $longTime=strtotime($longTimes)+24*60*60;
            $datas=DB::table("T_U_MONEY")
                ->leftJoin("T_P_PROJECTINFO","T_P_PROJECTINFO.ProjectID","=","T_U_MONEY.ProjectID")
                ->select("T_U_MONEY.*","T_P_PROJECTINFO.WordDes","T_P_PROJECTINFO.TypeID")
                ->where("T_U_MONEY.Type",2)
                ->whereBetween("timestamp",[$shortTime,$longTime])
                ->whereNotIn("T_U_MONEY.UserID",[889,1095])
                ->orderBy("T_U_MONEY.created_at","desc")
                ->get();
            $results=DB::table("T_U_MONEY")
                ->where("T_U_MONEY.Type",1)
                ->where("T_U_MONEY.Flag",1)
                ->whereBetween("timestamp",[$shortTime,$longTime])
                ->whereNotIn("T_U_MONEY.UserID",[889,1095])
                ->get();
            $consumes=DB::table("T_U_MONEY")
                ->where("T_U_MONEY.Type",2)
                ->whereBetween("timestamp",[$shortTime,$longTime])
                ->whereNotIn("T_U_MONEY.UserID",[889,1095])
                ->get();
        }
        $money=0;
        $consumeMoney=0;
        foreach($consumes as $consume){
            $consumeMoney=$consumeMoney+$consume->Money;
        }
        foreach ($results as $result){
            $money=$money+$result->Money;
        }
        $arrayProIds=array();
        $moneyIds=array();
        foreach ($datas as $key=>$data){
            $projectId=$data->ProjectID;
            if(!in_array($projectId,$arrayProIds)){
                $arrayProIds[]=$projectId;
                $moneyIds[]=$data->MoneyID;
            }
        }
        $dataMoneys=DB::table("T_U_MONEY")
            ->leftJoin("T_P_PROJECTINFO","T_P_PROJECTINFO.ProjectID","=","T_U_MONEY.ProjectID")
            ->leftJoin("T_P_PROJECTTYPE","T_P_PROJECTTYPE.TypeID","=","T_P_PROJECTINFO.TypeID")
            ->select("T_U_MONEY.*","T_P_PROJECTINFO.WordDes","T_P_PROJECTTYPE.TypeName","T_P_PROJECTINFO.TypeID")
            ->where("T_U_MONEY.Type",2)
            ->whereIn("T_U_MONEY.MoneyID",$moneyIds)
            ->whereNotIn("T_U_MONEY.UserID",[889,1095])
            ->orderBy("T_U_MONEY.created_at","desc")
            ->paginate(20);
        foreach ($dataMoneys as $key=> $dataMoney) {
            $projectId = $dataMoney->ProjectID;
            if ($value == 7) {
                $recordCounts = DB::table("T_U_MONEY")->where("ProjectID", $projectId)->where("Type", 2)->where("timestamp", ">", $chooseTime)->whereNotIn("T_U_MONEY.UserID", [889, 1095])->count();
            } elseif ($value == 30) {
                $recordCounts = DB::table("T_U_MONEY")->where("ProjectID", $projectId)->where("Type", 2)->whereNotIn("T_U_MONEY.UserID", [889, 1095])->count();
            } else {
                $recordCounts = DB::table("T_U_MONEY")->where("ProjectID", $projectId)->where("Type", 2)->whereBetween("timestamp", [$shortTime, $longTime])->whereNotIn("T_U_MONEY.UserID", [889, 1095])->count();
            }
            $dataMoney->recordCounts = $recordCounts;
            $channel = $dataMoney->Channel;
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
                    $channel = "苹果";
                    break;
            }
        }
        if(!empty($channel)){
            $dataMoney->Channel=$channel;
        }
        $shortTime=$shortTimes;
        $longTime=$longTimes;
        return view("money/consume",compact('dataMoneys',"money","consumeMoney","value","shortTime","longTime"));
    }
}
