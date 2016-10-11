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
        $types=DB::table("T_P_PROJECTTYPE")->select("TypeID")->get();
        $counts=array();
        foreach ($types as $type){
            $typeId=$type->TypeID;
            $datas=DB::table("T_P_PROJECTINFO")->where("TypeID",$typeId)->where("CertifyState",1)->count();
            $totalCounts=DB::table("T_P_PROJECTINFO")->count();
            $counts[$typeId]=$datas;

        }
       
        return view("count/index",compact("counts"));
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
}
