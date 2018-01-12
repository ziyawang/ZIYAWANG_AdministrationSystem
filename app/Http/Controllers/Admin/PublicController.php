<?php

namespace App\Http\Controllers\Admin;

use App\UploadHandler;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class PublicController extends Controller
{
    //公共的上传图片的方法
    public function upload()
    {
        error_reporting(E_ALL | E_STRICT);
        require_once("./FileUpload/server/php/UploadHandler.php");
        $uploadHandler = new UploadHandler(["upload_dir" => dirname(base_path()) . "/ziyaupload/images/user/", "upload_url" => dirname(base_path()) . "/ziyaupload/images/user/"]);
    }

    //新版本的数据的迁移
    public function change()
    {
        set_time_limit(0);
        //选取固产转让中的非法拍资产的土地和房产
        $fixes = DB::table("T_P_SPEC12")
            ->leftjoin("T_P_PROJECTINFO", "T_P_PROJECTINFO.ProjectID", "=", "T_P_SPEC12.ProjectID")
            ->select("T_P_PROJECTINFO.TypeID", "T_P_PROJECTINFO.ProjectID", "T_P_SPEC12.*", "T_P_PROJECTINFO.CertifyState")
            ->where("T_P_SPEC12.AssetType", "<>", "法拍资产")
            ->whereIn("T_P_SPEC12.Corpore", ["土地", "房产"])
            ->where("CertifyState", 1)
            ->get();
        //分别将选出的土地和房产插入T_P_SPEC16和T_P_SPEC_12中
        foreach ($fixes as $fixe) {
            if ($fixe->Corpore == "房产") {
                $res = DB::table("T_P_SPEC_12")->insert([
                    "Identity" => "",
                    "AssetType" => "房产",
                    "TransferMoney" => $fixe->TransferMoney,
                    "Type" => "",
                    "Usefor" => "",
                    "Area" => "",
                    "Year" => "",
                    "TransferType" => "",
                    "MarketPrice" => "",
                    "Credentials" => "",
                    "Dispute" => "",
                    "Debt" => "",
                    "Guaranty" => "",
                    "Property" => "",
                    "TypeID" => 12,
                    "ProjectID" => $fixe->ProjectID
                ]);
            } else {
                $typeIds = DB::table("T_P_PROJECTINFO")->where("ProjectID", $fixe->ProjectID)->update([
                    "TypeID" => 16
                ]);
                $res = DB::table("T_P_SPEC16")->insert([
                    "Identity" => "",
                    "AssetType" => "土地",
                    "TransferMoney" => $fixe->TransferMoney,
                    "Usefor" => "",
                    "Area" => "",
                    "Year" => "",
                    "TransferType" => "",
                    "Credentials" => "",
                    "Dispute" => "",
                    "Debt" => "",
                    "Guaranty" => "",
                    "Property" => "",
                    "TypeID" => 16,
                    "ProjectID" => $fixe->ProjectID
                ]);
            }
        }
        var_dump("迁移固产转让中的土地成功");

        //选取固产转让中的法拍资产的土地，房产，汽车
        $fores = DB::table("T_P_SPEC12")
            ->leftjoin("T_P_PROJECTINFO", "T_P_PROJECTINFO.ProjectID", "=", "T_P_SPEC12.ProjectID")
            ->select("T_P_PROJECTINFO.TypeID", "T_P_PROJECTINFO.ProjectID", "T_P_SPEC12.*", "T_P_PROJECTINFO.CertifyState")
            ->where("T_P_SPEC12.AssetType", "法拍资产")
            ->whereIn("T_P_SPEC12.Corpore", ["土地", "房产", "汽车"])
            ->where("CertifyState", 1)
            ->get();
        //将选出的数据按房产,土地,汽车插入T_P_SPEC20,T_P_SPEC21,T_P_SPEC22,
        foreach ($fores as $fore) {
            if ($fore->Corpore == "房产") {
                $typeIds = DB::table("T_P_PROJECTINFO")->where("ProjectID", $fore->ProjectID)->update([
                    "TypeID" => 20
                ]);
                $res = DB::table("T_P_SPEC20")->insert([
                    "AssetType" => "房产",
                    "Area" => "",
                    "Nature" => "",
                    "Money" => $fore->TransferMoney,
                    "Year" => "",
                    "State" => "",
                    "Court" => "",
                    "TypeID" => 20,
                    "ProjectID" => $fore->ProjectID
                ]);
            } elseif ($fore->Corpore == "土地") {
                $typeIds = DB::table("T_P_PROJECTINFO")->where("ProjectID", $fore->ProjectID)->update([
                    "TypeID" => 21
                ]);
                $res = DB::table("T_P_SPEC21")->insert([
                    "AssetType" => "土地",
                    "Area" => "",
                    "Nature" => "",
                    "Money" => $fore->TransferMoney,
                    "Year" => "",
                    "State" => "",
                    "Court" => "",
                    "TypeID" => 21,
                    "ProjectID" => $fore->ProjectID
                ]);
            } else {
                $typeIds = DB::table("T_P_PROJECTINFO")->where("ProjectID", $fore->ProjectID)->update([
                    "TypeID" => 22
                ]);
                $res = DB::table("T_P_SPEC22")->insert([
                    "AssetType" => "汽车",
                    "Brand" => "",
                    "Money" => $fore->TransferMoney,
                    "Year" => "",
                    "State" => "",
                    "Court" => "",
                    "TypeID" => 22,
                    "ProjectID" => $fore->ProjectID
                ]);
            }
        }
        var_dump("迁移固产转让中的法拍资产成功");

        //融资信息迁移，选取股权，抵押，质押
        $finances = DB::table("T_P_PROJECTINFO")
            ->leftJoin("T_P_SPEC06", "T_P_SPEC06.ProjectID", "=", "T_P_PROJECTINFO.ProjectID")
            ->select("T_P_PROJECTINFO.TypeID", "T_P_PROJECTINFO.ProjectID", "T_P_SPEC06.*", "T_P_PROJECTINFO.CertifyState")
            ->whereIn("T_P_SPEC06.AssetType", ["股权", "抵押", "质押"])
            ->where("T_P_PROJECTINFO.CertifyState", 1)
            ->get();
        foreach ($finances as $finance) {
            if ($finance->AssetType == "股权") {
                $res = DB::table("T_P_SPEC_06")->insert([
                    "Identity" => "",
                    "AssetType" => "股权融资",
                    "TotalMoney" => $finance->TotalMoney,
                    "Rate" => $finance->Rate,
                    "Status" => "",
                    "Belong" => "",
                    "Usefor" => "",
                    "TypeID" => 6,
                    "ProjectID" => $finance->ProjectID,
                ]);
            } else {
                $typeIds = DB::table("T_P_PROJECTINFO")->where("ProjectID", $finance->ProjectID)->update([
                    "TypeID" => 17
                ]);
                $res = DB::table("T_P_SPEC17")->insert([
                    "Identity" => "",
                    "AssetType" => "债权融资",
                    "Money" => $finance->TotalMoney,
                    "Month" => "",
                    "Type" => $finance->AssetType,
                    "TypeID" => 17,
                    "ProjectID" => $finance->ProjectID,
                ]);
            }
        }
        var_dump("迁移融资信息成功");

        //从委外催收中获取个人债权和企业商账
        $datas = DB::table("T_P_PROJECTINFO")
            ->leftJoin("T_P_SPEC02", "T_P_SPEC02.ProjectID", "=", "T_P_PROJECTINFO.ProjectID")
            ->whereIn("T_P_SPEC02.AssetType", ["个人债权", "企业商账"])
            ->where("T_P_PROJECTINFO.CertifyState", 1)
            ->get();
        foreach ($datas as $data) {
            if ($data->AssetType == "企业商账") {
                $typeIds = DB::table("T_P_PROJECTINFO")->where("ProjectID", $data->ProjectID)->update([
                    "TypeID" => 18,
                ]);
                if ($data->Status == "已诉讼") {
                    $law = $data->Rate;
                    $unLaw = "";
                } else {
                    $law = "";
                    $unLaw = $data->Rate;
                }
                $res = DB::table("T_P_SPEC18")->insert([
                    "Identity" => "",
                    "AssetType" => "",
                    "Money" => $data->TotalMoney,
                    "Law" => !empty($law) ? $law : "",
                    "UnLaw" => !empty($unLaw) ? $unLaw : "",
                    "Month" => "",
                    "Nature" => "",
                    "Status" => "",
                    "Guaranty" => "",
                    "State" => "",
                    "Industry" => "",
                    "TypeID" => 18,
                    "ProjectID" => $data->ProjectID
                ]);
            } else {
                $typeIds = DB::table("T_P_PROJECTINFO")->where("ProjectID", $data->ProjectID)->update([
                    "TypeID" => 19,
                ]);
                if ($data->Status == "已诉讼") {
                    $law = $data->Rate;
                    $unLaw = "";
                } else {
                    $law = "";
                    $unLaw = $data->Rate;
                }
                $res = DB::table("T_P_SPEC19")->insert([
                    "Identity" => "",
                    "TotalMoney" => $data->TotalMoney,
                    "Law" => !empty($law) ? $law : "",
                    "UnLaw" => !empty($unLaw) ? $unLaw : "",
                    "Month" => "",
                    "DebteeLocation" => "",
                    "Guaranty" => "",
                    "Property" => "",
                    "Connect" => "",
                    "Pay" => "",
                    "Credentials" => "",
                    "TypeID" => 19,
                    "ProjectID" => $data->ProjectID,
                ]);
            }
        }
        var_dump("从委外催收中迁移个人债权和企业商账成功");

        //从债权转让中迁移个人债权和企业商帐
        $individuals = DB::table("T_P_SPEC14")
            ->leftJoin("T_P_PROJECTINFO", "T_P_SPEC14.ProjectID", "=", "T_P_PROJECTINFO.ProjectID")
            ->whereIn("T_P_SPEC14.AssetType", ["个人债权", "企业商账"])
            ->where("T_P_PROJECTINFO.CertifyState", 1)
            ->get();
        foreach ($individuals as $individual) {
            if ($individual->AssetType == "企业商账") {
                $typeIds = DB::table("T_P_PROJECTINFO")->where("ProjectID", $individual->ProjectID)->update([
                    "TypeID" => 18,
                ]);
                $res = DB::table("T_P_SPEC18")->insert([
                    "Identity" => "",
                    "AssetType" => "",
                    "Money" => $individual->TotalMoney,
                    "Law" => "",
                    "UnLaw" => "",
                    "Month" => "",
                    "Nature" => "",
                    "Status" => "",
                    "Guaranty" => "",
                    "State" => "",
                    "Industry" => "",
                    "TypeID" => 18,
                    "ProjectID" => $individual->ProjectID
                ]);
            } else {
                $typeIds = DB::table("T_P_PROJECTINFO")->where("ProjectID", $individual->ProjectID)->update([
                    "TypeID" => 19,
                ]);
                $res = DB::table("T_P_SPEC19")->insert([
                    "Identity" => "",
                    "TotalMoney" => $individual->TotalMoney,
                    "Law" => "",
                    "UnLaw" => "",
                    "Month" => "",
                    "DebteeLocation" => "",
                    "Guaranty" => "",
                    "Property" => "",
                    "Connect" => "",
                    "Pay" => "",
                    "Credentials" => "",
                    "TypeID" => 19,
                    "ProjectID" => $individual->ProjectID,
                ]);
            }
        }
        var_dump("从债权转让中迁移个人债权和企业商账成功");


    }

    //新版本数据的更改
    public function update()
    {
        $finances = DB::table("T_P_PROJECTINFO")
            ->leftJoin("T_P_SPEC06OLD", "T_P_SPEC06OLD.ProjectID", "=", "T_P_PROJECTINFO.ProjectID")
            ->select("T_P_PROJECTINFO.TypeID", "T_P_PROJECTINFO.ProjectID", "T_P_SPEC06OLD.*", "T_P_PROJECTINFO.CertifyState")
            ->whereNotIn("T_P_SPEC06OLD.AssetType", ["股权", "抵押", "质押"])
            ->where("T_P_PROJECTINFO.CertifyState", 1)
            ->get();
        foreach ($finances as $finance) {

            $typeIds = DB::table("T_P_PROJECTINFO")->where("ProjectID", $finance->ProjectID)->update([
                "TypeID" => 100,
            ]);
        }
        var_dump("从T_P_SPEC06OLD数据修改成功");

        //从T_P_SPEC12OLD中修改数据
        $fores = DB::table("T_P_SPEC12OLD")
            ->leftjoin("T_P_PROJECTINFO", "T_P_PROJECTINFO.ProjectID", "=", "T_P_SPEC12OLD.ProjectID")
            ->select("T_P_PROJECTINFO.TypeID", "T_P_PROJECTINFO.ProjectID", "T_P_SPEC12OLD.*", "T_P_PROJECTINFO.CertifyState")
            ->where("T_P_SPEC12OLD.AssetType", "法拍资产")
            ->whereNotIn("T_P_SPEC12OLD.Corpore", ["土地", "房产", "汽车"])
            ->where("CertifyState", 1)
            ->get();
        //将选出的数据按房产,土地,汽车插入T_P_SPEC20,T_P_SPEC21,T_P_SPEC22,
        foreach ($fores as $fore) {
            $typeIds = DB::table("T_P_PROJECTINFO")->where("ProjectID", $fore->ProjectID)->update([
                "TypeID" => 100,
            ]);

        }

        var_dump("从T_P_SPEC12OLD数据修改成功1");

        //修改
        $datas = DB::table("T_P_SPEC12OLD")
            ->leftjoin("T_P_PROJECTINFO", "T_P_PROJECTINFO.ProjectID", "=", "T_P_SPEC12OLD.ProjectID")
            ->select("T_P_PROJECTINFO.TypeID", "T_P_PROJECTINFO.ProjectID", "T_P_SPEC12OLD.*", "T_P_PROJECTINFO.CertifyState")
            ->where("T_P_SPEC12OLD.AssetType", "<>", "法拍资产")
            ->whereNotIn("T_P_SPEC12OLD.Corpore", ["土地", "房产"])
            ->where("CertifyState", 1)
            ->get();
        //将选出的数据按房产,土地,汽车插入T_P_SPEC20,T_P_SPEC21,T_P_SPEC22,
        foreach ($datas as $data) {
            $typeIds = DB::table("T_P_PROJECTINFO")->where("ProjectID", $data->ProjectID)->update([
                "TypeID" => 100,
            ]);

        }

        var_dump("从T_P_SPEC12OLD数据修改成功2");

    }

    //赠送芽币
    public  function active(){
        $users=User::select("userid","Account")->whereNotId("userid", [889, 1095,679,46])->get();
        dd($users);
        try{
            foreach ($users as $user){
                $orderNo = 'ZS' . substr(time(),4) . mt_rand(1000,9999);
                $account=$user->Account+100;
                $userId=$user->userid;
                User::where("userid",$userId)->update([
                    "Account"=>$account,
                    "updated_at"=>date("Y-m-d H:i:s",time())
                ]);
               DB::table("T_U_MONEY")->insert([
                   "UserID"=>$userId,
                   "Type"=>1,
                   "OrderNumber"=>$orderNo,
                   "Money"=>100,
                   "RealMoney"=>1000,
                   "Account"=>$account,
                   "ProjectID"=>0,
                   "Flag"=>1,
                   "BackNumber"=>"",
                   "created_at"=>date("Y-m-d H:i:s",time()),
                   "timestamp"=>time(),
                   "IP"=>"124.239.176.59",
                   "channel"=>"",
                   "Operates"=>"活动赠送100芽币",
                   "DelFlag"=>0,
                   "VideoID"=>0,
                   "paper"=>0
               ]);
            }
        }catch(Exception $e){
            throw $e;
        }
        if(!isset($e)){
            dd("成功");
        }else{}
        dd("失败");

    }
}
