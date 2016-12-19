<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class CountController extends Controller
{
    //统计分析中的有关信息的数据
    public function  index(){
        if(isset($_GET) && !empty($_GET)){
            $value=$_GET["value"];
            $longTime=$_GET['longTime'];
            $shortTime=$_GET['shortTime'];
            $province=$_GET['province'];
        }else{
            $value=30;
            $longTime=1;
            $shortTime=1;
            $province="全国";
        }

        return view("count/index",compact("value","longTime","shortTime","province"));
    }
    
    //资芽信息地区分布的数据
    public function mapCounts(){
        $mapMessages=array();
        $typeCounts=array();
        $maps=array( "北京", "上海","广东","江苏","山东","浙江","河南","河北","辽宁","四川","湖北","湖南","福建","安徽","陕西","天津","江西","广西","重庆","吉林","云南","山西","新疆","贵州","甘肃","海南","宁夏","青海","西藏","黑龙江","内蒙古" );
        $typeMessages=DB::table("T_P_PROJECTTYPE")->select("TypeName","TypeID")->whereNotIn("TypeID",[5,7,8,11])->get();
        foreach($typeMessages as $value){
            $typeName=$value->TypeName;
            foreach ($maps as $map){
                $mapCounts=DB::table("T_P_PROJECTINFO")->where("TypeID",$value->TypeID)->where("ProArea","like",'%'.$map.'%')->where("CertifyState",1)->count();
                if($mapCounts>0){
                    $typeCounts[$map]=$mapCounts;
                }
            }
            $mapMessages[$typeName]=$typeCounts;
        }
        return json_encode($mapMessages);
    }
    
    //ajax请求数据
    public  function numMoneyCount(){
        $province=$_POST["province"];
        $shortTime=$_POST['shortTime'];
        $longTime=$_POST['longTime'];
        $value=$_POST['value'];
        $types=DB::table("T_P_PROJECTTYPE")->select("TypeID","TypeName")->whereNotIn("TypeID",[5,7,8,11])->get();
        $counts=array();
        foreach ($types as $type){
            $typeId=$type->TypeID;
            $typeName=$type->TypeName;
            if($typeId<10){
                $chart="T_P_SPEC0".$typeId;
            }else{
                $chart="T_P_SPEC".$typeId;
            }
            if($value==30){
                if($province=="全国"){
                    $datas=DB::table("T_P_PROJECTINFO")->where("TypeID",$typeId)->where("CertifyState",1)->count();
                    $totalCounts=DB::table("T_P_PROJECTINFO")->where("CertifyState",1)->count();
                    $moneyDatas=DB::table("T_P_PROJECTINFO")
                        ->leftJoin($chart,$chart.".ProjectID","=","T_P_PROJECTINFO.ProjectID")
                        ->where("T_P_PROJECTINFO.TypeID",$typeId)
                        ->where("CertifyState",1)
                        ->get();
                }else{
                    $datas=DB::table("T_P_PROJECTINFO")->where("TypeID",$typeId)->where("CertifyState",1)->where("ProArea","like","%".$province."%")->count();
                    $totalCounts=DB::table("T_P_PROJECTINFO")->where("CertifyState",1)->where("ProArea","like","%".$province."%")->count();
                    $moneyDatas=DB::table("T_P_PROJECTINFO")
                        ->leftJoin($chart,$chart.".ProjectID","=","T_P_PROJECTINFO.ProjectID")
                        ->where("T_P_PROJECTINFO.TypeID",$typeId)
                        ->where("CertifyState",1)
                        ->where("T_P_PROJECTINFO.ProArea","like","%".$province."%")
                        ->get();
                }
            }else{
                $shortTime=$_POST['shortTime'];
                $longTimes=strtotime($_POST['longTime'])+24*60*60;
                $longTime=date("Y-m-d",$longTimes);
                if($province=="全国"){
                    $datas=DB::table("T_P_PROJECTINFO")->where("TypeID",$typeId)->where("CertifyState",1)->whereBetween("created_at",[$shortTime,$longTime])->count();
                    $totalCounts=DB::table("T_P_PROJECTINFO")->where("CertifyState",1)->whereBetween("created_at",[$shortTime,$longTime])->count();
                    $moneyDatas=DB::table("T_P_PROJECTINFO")
                        ->leftJoin($chart,$chart.".ProjectID","=","T_P_PROJECTINFO.ProjectID")
                        ->where("T_P_PROJECTINFO.TypeID",$typeId)
                        ->where("CertifyState",1)
                        ->whereBetween("T_P_PROJECTINFO.created_at",[$shortTime,$longTime])
                        ->get();
                }else{
                    $datas=DB::table("T_P_PROJECTINFO")->where("TypeID",$typeId)->where("CertifyState",1)->whereBetween("created_at",[$shortTime,$longTime])->where("ProArea","like","%".$province."%")->count();
                    $totalCounts=DB::table("T_P_PROJECTINFO")->where("CertifyState",1)->whereBetween("created_at",[$shortTime,$longTime])->where("ProArea","like","%".$province."%")->count();
                    $moneyDatas=DB::table("T_P_PROJECTINFO")
                        ->leftJoin($chart,$chart.".ProjectID","=","T_P_PROJECTINFO.ProjectID")
                        ->where("T_P_PROJECTINFO.TypeID",$typeId)
                        ->where("CertifyState",1)
                        ->whereBetween("T_P_PROJECTINFO.created_at",[$shortTime,$longTime])
                        ->where("ProArea","like","%".$province."%")
                        ->get();
                }
            }
            $totalMoney=0;
            foreach($moneyDatas as $moneyData){
                if(!empty($moneyData->TotalMoney)){
                    $totalMoney=$totalMoney + $moneyData->TotalMoney;
                }else{
                    $totalMoney=0;
                }
            }

            $counts["distribute"][$typeName]["number"]=$datas;
            $counts["distribute"][$typeName]["money"]=$totalMoney;
            $totalsMoney=0;
            foreach ($counts["distribute"] as $count){
                $totalsMoney=$totalsMoney+$count['money'];
            }
            $counts["total"]["信息总量"]=$totalCounts;
            $counts["total"]["金额总量"]=$totalsMoney;
            
            

        }
        return json_encode($counts);
    }
    
    //服务方统计
    public function serCount(){
        
    }
}
