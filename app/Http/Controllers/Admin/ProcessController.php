<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProcessController extends Controller
{
    //项目跟进列表页
    public  function index(){
        $id=Session::get("userId");
        $authArr=array(1,11);
        if(in_array($id,$authArr)){
            if(!empty($_POST)){
                if($_POST['typeName'] != 0 ){
                    $typeNameWhere=explode(",",$_POST['typeName']);
                }else{
                    $typeNameWhere=array(1,6,12,16,17,18,19,20,21,22);
                }
                $department=!empty($_POST['department']) ? $_POST['department'] : "";
                $serviceName=!empty($_POST['serviceName']) ? $_POST['serviceName'] : "";
                $typeName=!empty($_POST['typeName']) ? $_POST['typeName'] : "";
                $departmentWhere=($_POST['department']!="全部")? array("T_AS_USER.Department"=>$_POST['department']) : array();
                if(!empty($_POST['serviceName'])){
                        $datas=DB::table("T_P_PROJECTINFO")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_P_PROJECTINFO.Responsible")
                            ->leftJoin("T_P_SERVICE","T_P_SERVICE.ProjectID","=","T_P_PROJECTINFO.ProjectID")
                            ->leftJoin("T_P_PROJECTTYPE","T_P_PROJECTTYPE.TypeID","=","T_P_PROJECTINFO.TypeID")
                            ->select("T_P_PROJECTINFO.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id","T_P_PROJECTTYPE.TypeName","T_P_SERVICE.SerName")
                            ->where("T_P_PROJECTINFO.CertifyState",4)
                            ->where("T_P_PROJECTINFO.Title","like","%".$_POST['serviceName']."%")
                            ->whereIn("T_P_PROJECTINFO.TypeId",$typeNameWhere)
                            ->where($departmentWhere)
                            ->orderBy("created_at","desc")
                            ->paginate(20);
                    }else{
                    $datas=DB::table("T_P_PROJECTINFO")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_P_PROJECTINFO.Responsible")
                            ->leftJoin("T_P_SERVICE","T_P_SERVICE.ProjectID","=","T_P_PROJECTINFO.ProjectID")
                            ->leftJoin("T_P_PROJECTTYPE","T_P_PROJECTTYPE.TypeID","=","T_P_PROJECTINFO.TypeID")
                            ->select("T_P_PROJECTINFO.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id","T_P_PROJECTTYPE.TypeName","T_P_SERVICE.SerName")
                            ->where("T_P_PROJECTINFO.CertifyState",4)
                            ->whereIn("T_P_PROJECTINFO.TypeId",$typeNameWhere)
                            ->where($departmentWhere)
                            ->orderBy("created_at","desc")
                            ->paginate(20);
                    }
            }else if(!empty($_GET)){
                $department=!empty($_GET['department']) ? $_POST['department'] : "";
                $serviceName=!empty($_GET['serviceName']) ? $_GET['serviceName'] : "";
                $typeName=!empty($_GET['typeName']) ? $_GET['typeName'] : "";
                if($_GET['typeName'] != 0 ){
                    $typeNameWhere=explode(",",$_GET['typeName']);
                }else{
                    $typeNameWhere=array(1,6,12,16,17,18,19,20,21,22);
                }
                $departmentWhere=($_GET['department']!="全部")? array("T_AS_USER.Department"=>$_GET['department']) : array();
                if(!empty($_GET['serviceName'])){
                    $datas=DB::table("T_P_PROJECTINFO")
                        ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_P_PROJECTINFO.Responsible")
                        ->leftJoin("T_P_SERVICE","T_P_SERVICE.ProjectID","=","T_P_PROJECTINFO.ProjectID")
                        ->leftJoin("T_P_PROJECTTYPE","T_P_PROJECTTYPE.TypeID","=","T_P_PROJECTINFO.TypeID")
                        ->select("T_P_PROJECTINFO.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id","T_P_PROJECTTYPE.TypeName","T_P_SERVICE.SerName")
                        ->where("T_P_PROJECTINFO.CertifyState",4)
                        ->where("T_P_PROJECTINFO.Title","like","%".$_GET['serviceName']."%")
                        ->whereIn("T_P_PROJECTINFO.TypeId",$typeNameWhere)
                        ->where($departmentWhere)
                        ->orderBy("created_at","desc")
                        ->paginate(20);
                    }else{
                    $datas=DB::table("T_P_PROJECTINFO")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_P_PROJECTINFO.Responsible")
                            ->leftJoin("T_P_SERVICE","T_P_SERVICE.ProjectID","=","T_P_PROJECTINFO.ProjectID")
                            ->leftJoin("T_P_PROJECTTYPE","T_P_PROJECTTYPE.TypeID","=","T_P_PROJECTINFO.TypeID")
                            ->select("T_P_PROJECTINFO.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id","T_P_PROJECTTYPE.TypeName","T_P_SERVICE.SerName")
                            ->where("T_P_PROJECTINFO.CertifyState",4)
                            ->whereIn("T_P_PROJECTINFO.TypeId",$typeNameWhere)
                            ->where($departmentWhere)
                            ->orderBy("created_at","desc")
                            ->paginate(20);
                    }

                }else{
                $typeIds=array(1,6,12,16,17,18,19,20,21,22);
                $datas=DB::table("T_P_PROJECTINFO")
                    ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_P_PROJECTINFO.Responsible")
                    ->leftJoin("T_P_SERVICE","T_P_SERVICE.ProjectID","=","T_P_PROJECTINFO.ProjectID")
                    ->leftJoin("T_P_PROJECTTYPE","T_P_PROJECTTYPE.TypeID","=","T_P_PROJECTINFO.TypeID")
                    ->select("T_P_PROJECTINFO.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id","T_P_PROJECTTYPE.TypeName","T_P_SERVICE.SerName")
                    ->where("T_P_PROJECTINFO.CertifyState",4)
                    ->whereIn("T_P_PROJECTINFO.TypeId",$typeIds)
                    ->orderBy("created_at","desc")
                    ->paginate(20);
                    $department="";
                    $serviceName="";
                    $typeName="";
            }
            $departs=DB::table("T_AS_USER")->where("Status",1)->whereIn("Department",['信息开发部',"渠道开发部","投资事业部"])->pluck("Department");
            $Departments=array();
            foreach ($departs as $value){
                if(!in_array($value,$Departments)){
                    $Departments[]=$value;
                }
            }

        }else{
            if(!empty($_POST)){
                $parts=DB::table("T_AS_USER")->where("Status",1)->where("id",$id)->pluck("Department");
                $department=$parts[0];
                $Name=$id;
                $serviceName=!empty($_POST['serviceName']) ? $_POST['serviceName'] : "";
                $typeName=!empty($_POST['typeName']) ? $_POST['typeName'] : "";
                if($_POST['typeName'] != 0 ){
                    $typeNameWhere=explode(",",$_POST['typeName']);
                }else{
                    $typeNameWhere=array(1,6,12,16,17,18,19,20,21,22);
                }
             /*   $NameWhere=($_POST['Name']!=0) ? array("T_AS_USER.id"=>$_POST['Name']) : array();
                $departmentWhere=($_POST['department']!="全部")? array("T_AS_USER.Department"=>$_POST['department']) : array();*/
                if(!empty($_POST['serviceName'])){
                    $datas=DB::table("T_P_PROJECTINFO")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_P_PROJECTINFO.Responsible")
                            ->leftJoin("T_P_SERVICE","T_P_SERVICE.ProjectID","=","T_P_PROJECTINFO.ProjectID")
                            ->leftJoin("T_P_PROJECTTYPE","T_P_PROJECTTYPE.TypeID","=","T_P_PROJECTINFO.TypeID")
                            ->select("T_P_PROJECTINFO.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id","T_P_PROJECTTYPE.TypeName","T_P_SERVICE.SerName")
                            ->where("T_P_PROJECTINFO.CertifyState",4)
                            ->where("T_P_PROJECTINFO.Title","like","%".$_POST['serviceName']."%")
                            ->whereIn("T_P_PROJECTINFO.TypeId",$typeNameWhere)
                            ->where("T_AS_USER.Department",$department)
                            ->orderBy("created_at","desc")
                            ->paginate(20);
                    }else{
                    $datas=DB::table("T_P_PROJECTINFO")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_P_PROJECTINFO.Responsible")
                            ->leftJoin("T_P_SERVICE","T_P_SERVICE.ProjectID","=","T_P_PROJECTINFO.ProjectID")
                            ->leftJoin("T_P_PROJECTTYPE","T_P_PROJECTTYPE.TypeID","=","T_P_PROJECTINFO.TypeID")
                            ->select("T_P_PROJECTINFO.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id","T_P_PROJECTTYPE.TypeName","T_P_SERVICE.SerName")
                            ->where("T_P_PROJECTINFO.CertifyState",4)
                            ->whereIn("T_P_PROJECTINFO.TypeId",$typeNameWhere)
                            ->where("T_AS_USER.Department",$department)
                            ->orderBy("created_at","desc")
                            ->paginate(20);
                    }
                }else if(!empty($_GET)){
                $parts=DB::table("T_AS_USER")->where("Status",1)->where("id",$id)->pluck("Department");
                $department=$parts[0];
                $Name=$id;
                $serviceName=!empty($_GET['serviceName']) ? $_GET['serviceName'] : "";
                $typeName=!empty($_GET['typeName']) ? $_GET['typeName'] : "";
                if($_GET['typeName'] != 0 ){
                    $typeNameWhere=explode(",",$_GET['typeName']);
                }else{
                    $typeNameWhere=array(1,6,12,16,17,18,19,20,21,22);
                }
                if(!empty($_GET['serviceName'])){
                    $datas=DB::table("T_P_PROJECTINFO")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_P_PROJECTINFO.Responsible")
                            ->leftJoin("T_P_SERVICE","T_P_SERVICE.ProjectID","=","T_P_PROJECTINFO.ProjectID")
                            ->leftJoin("T_P_PROJECTTYPE","T_P_PROJECTTYPE.TypeID","=","T_P_PROJECTINFO.TypeID")
                            ->select("T_P_PROJECTINFO.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id","T_P_PROJECTTYPE.TypeName","T_P_SERVICE.SerName")
                            ->where("T_P_PROJECTINFO.CertifyState",4)
                            ->where("T_P_PROJECTINFO.Title","like","%".$_POST['serviceName']."%")
                            ->whereIn("T_P_PROJECTINFO.TypeId",$typeNameWhere)
                            ->where("T_AS_USER.Department",$department)
                            ->orderBy("created_at","desc")
                            ->paginate(20);
                    }else{
                    $datas=DB::table("T_P_PROJECTINFO")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_P_PROJECTINFO.Responsible")
                            ->leftJoin("T_P_SERVICE","T_P_SERVICE.ProjectID","=","T_P_PROJECTINFO.ProjectID")
                            ->leftJoin("T_P_PROJECTTYPE","T_P_PROJECTTYPE.TypeID","=","T_P_PROJECTINFO.TypeID")
                            ->select("T_P_PROJECTINFO.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id","T_P_PROJECTTYPE.TypeName","T_P_SERVICE.SerName")
                            ->where("T_P_PROJECTINFO.CertifyState",4)
                            ->whereIn("T_P_PROJECTINFO.TypeId",$typeNameWhere)
                            ->where("T_AS_USER.Department",$department)
                            ->orderBy("created_at","desc")
                            ->paginate(20);
                    }
                }else{
                $parts=DB::table("T_AS_USER")->where("Status",1)->where("id",$id)->pluck("Department");
                $department=$parts[0];
                $Name=$id;
                $serviceName="";
                $typeName="";
                $typeIds=array(1,6,12,16,17,18,19,20,21,22);
                $datas=DB::table("T_P_PROJECTINFO")
                    ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_P_PROJECTINFO.Responsible")
                    ->leftJoin("T_P_SERVICE","T_P_SERVICE.ProjectID","=","T_P_PROJECTINFO.ProjectID")
                    ->leftJoin("T_P_PROJECTTYPE","T_P_PROJECTTYPE.TypeID","=","T_P_PROJECTINFO.TypeID")
                    ->select("T_P_PROJECTINFO.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id","T_P_PROJECTTYPE.TypeName","T_P_SERVICE.SerName")
                    ->where("T_P_PROJECTINFO.CertifyState",4)
                    ->whereIn("T_P_PROJECTINFO.TypeId",$typeIds)
                    ->orderBy("created_at","desc")
                    ->paginate(20);
            }
            $departs=DB::table("T_AS_USER")->where("Status",1)->where("id",$id)->pluck("Department");
            $Departments=array();
            foreach ($departs as $value){
                if(!in_array($value,$Departments)){
                    $Departments[]=$value;
                }
            }
        }
        $result=array();

        foreach ($datas as $key=>$data){
            if(!in_array($data,$result)){
                    $result[]=$data;
            }else{
                unset($datas[$key]);
            }
        }
        return view("process.index",compact("datas","Departments","department","typeName","serviceName"));
    }
    //添加项目
    public  function add(){
        $typeName=$_GET['typeName'];
        $Names=DB::table("T_AS_USER")->select("Name","id")->where("Status",1)->whereIn("Department",['信息开发部',"渠道开发部","投资事业部"])->get();
        switch($typeName){
            case "资产包":
                return view("process/add_1",compact("typeName","Names"));
            break;
            case "融资信息":
                return view("process/add_6",compact("typeName","Names"));
                break;
            case "固定资产":
                return view("process/add_12",compact("typeName","Names"));
                break;
            case "企业商账":
                return view("process/add_18",compact("typeName","Names"));
                break;
            case "个人债权":
                return view("process/add_19",compact("typeName","Names"));
                break;
            case "法拍资产":
                return view("process/add_20",compact("typeName","Names"));
                break;
        }
    }
    
    //保存添加的项目
    public  function  saveAdd(){
        $typeArr=array("资产包","企业商账","个人债权");
        if(in_array($_POST['typeName'],$typeArr)){
            switch ($_POST['typeName']){
                case "资产包":
                    $typeId="1";
                break;
                case "企业商账":
                    $typeId="18";
                    break;
                case "个人债权":
                    $typeId="19";
                    break;
            }
        }else{
            $typeId=$_POST['AssetType'];
        }
        $proLabel=!empty($_POST['ProLabel']) ? implode(",",$_POST['ProLabel']): "";
        $projectId=DB::table("T_P_PROJECTINFO")->insertGetId([
            "ProArea"=>!empty($_POST['ProArea']) ? $_POST['ProArea'] : "",
            "WordDes"=>!empty($_POST['wordDes']) ? $_POST['wordDes'] : "",
            "PictureDes1"=>!empty($_POST['PictureDes1']) ? $_POST['PictureDes1'] : "",
            "PictureDes2"=>!empty($_POST['PictureDes2']) ? $_POST['PictureDes2'] : "",
            "PictureDes3"=>!empty($_POST['PictureDes3']) ? $_POST['PictureDes3'] : "",
            "PictureDes4"=>!empty($_POST['PictureDes4']) ? $_POST['PictureDes4'] : "",
            "PictureDes5"=>!empty($_POST['PictureDes5']) ? $_POST['PictureDes5'] : "",
            "ConnectPerson"=>!empty($_POST['ConnectPerson']) ? $_POST['ConnectPerson'] : "",
            "ConnectPhone"=>!empty($_POST['ConnectPhone']) ? $_POST['ConnectPhone'] : "",
            "Responsible"=>!empty($_POST['Responsible']) ? $_POST['Responsible'] : "",
            "StarLevel"=>!empty($_POST['starLevel']) ? $_POST['starLevel'] : "",
            "CertifyState"=>4,
            "ProLabel"=>$proLabel,
            "Title"=>!empty($_POST['Title']) ? $_POST['Title'] : "",
            "PublishTime"=>date("Y-m-d H:i:s",time()),
            "TypeID"=>$typeId,
            "created_at"=>date("Y-m-d H:i:s",time()),
            "updated_at"=>date("Y-m-d H:i:s",time())
        ]);
      
        switch($typeId){
            case "1":
                $pawns=!empty($_POST['Pawn']) ? $_POST['Pawn'] : "";
                if(!empty($pawns)){
                    $pawn=implode(",",$pawns);
                }else{
                    $pawn="";
                }
                $res=DB::table("T_P_SPEC01")->insert([
                    "Identity"=>!empty($_POST['Identity']) ? $_POST['Identity'] : "",
                    "FromWhere"=>!empty($_POST['FromWhere']) ? $_POST['FromWhere'] : "",
                    "TotalMoney"=>!empty($_POST['TotalMoney']) ? $_POST['TotalMoney'] : "",
                    "TransferMoney"=>!empty($_POST['TransferMoney']) ? $_POST['TransferMoney'] : "",
                    "AssetType"=>!empty($_POST['AssetType']) ? $_POST['AssetType'] : "",
                    "Money"=>!empty($_POST['Money']) ? $_POST['Money'] : "",
                    "Rate"=>!empty($_POST['Rate']) ? $_POST['Rate'] : "",
                    "Counts"=>!empty($_POST['Counts']) ? $_POST['Counts'] : "",
                    "Report"=>!empty($_POST['Report']) ? $_POST['Report'] : "",
                    "Pawn"=>$pawn,
                    "TypeID"=>1,
                    "ProjectID"=>$projectId,
                ]);
                break;
            case "6":
                $assetType="股权融资";
                $res=DB::table("T_P_SPEC06")->insert([
                    "Identity"=>!empty($_POST['Identity']) ? $_POST['Identity'] : "",
                    "AssetType"=>$assetType,
                    "TotalMoney"=>!empty($_POST['Money']) ? $_POST['Money'] : "",
                    "Rate"=>!empty($_POST['Rate']) ? $_POST['Rate'] : "",
                    "Status"=>!empty($_POST['Status']) ? $_POST['Status'] : "",
                    "Belong"=>!empty($_POST['Belong']) ? $_POST['Belong'] : "",
                    "Usefor"=>!empty($_POST['Usefor']) ? $_POST['Usefor'] : "",
                    "TypeID"=>6,
                    "ProjectID"=>$projectId,
                ]);
                break;
            case "12":
                $assetType="房产";
                $res=DB::table("T_P_SPEC12")->insert([
                    "Identity"=> !empty($_POST['Identity']) ? $_POST['Identity'] : "",
                    "AssetType"=>$assetType,
                    "TransferMoney"=>  !empty($_POST['TransferMoney']) ? $_POST['TransferMoney'] : "",
                    "Type"=> !empty($_POST['Type']) ? $_POST['Type'] : "",
                    "Usefor"=>!empty($_POST['Usefor']) ? $_POST['Usefor'] : "",
                    "Area"=>!empty($_POST['Area']) ? $_POST['Area'] : "",
                    "Year"=>!empty($_POST['Year']) ? $_POST['Year'] : "",
                    "TransferType"=>!empty($_POST['TransferType']) ? $_POST['TransferType'] : "",
                    "MarketPrice"=>!empty($_POST['MarketPrice']) ? $_POST['MarketPrice'] : "",
                    "Credentials"=>!empty($_POST['Credentials']) ? $_POST['Credentials'] : "",
                    "Dispute"=>!empty($_POST['Dispute']) ? $_POST['Dispute'] : "",
                    "Debt"=>!empty($_POST['Debt']) ? $_POST['Debt'] : "",
                    "Guaranty"=>!empty($_POST['Guaranty']) ? $_POST['Guaranty'] : "",
                    "Property"=>!empty($_POST['Property']) ? $_POST['Property'] : "",
                    "TypeID"=>12,
                    "ProjectID"=>$projectId,
                ]);
                break;
            case "16":
                $assetType="土地";
                $res=DB::table("T_P_SPEC16")->insert([
                    "Identity"=>!empty($_POST['Identity']) ? $_POST['Identity'] : "",
                    "AssetType"=>$assetType,
                    "TransferMoney"=>!empty($_POST['TransferMoney']) ? $_POST['TransferMoney'] : "",
                    "Usefor"=>!empty($_POST['Usefor']) ? $_POST['Usefor'] : "",
                    "Area"=>!empty($_POST['Area']) ? $_POST['Area'] : "",
                    "Year"=>!empty($_POST['Year']) ? $_POST['Year'] : "",
                    "TransferType"=>!empty($_POST['TransferType']) ? $_POST['TransferType'] : "",
                    "Credentials"=>!empty($_POST['Credentials']) ? $_POST['Credentials'] : "",
                    "Dispute"=>!empty($_POST['Dispute']) ? $_POST['Dispute'] : "",
                    "Debt"=>!empty($_POST['Debt']) ? $_POST['Debt'] : "",
                    "Guaranty"=>!empty($_POST['Guaranty']) ? $_POST['Guaranty'] : "",
                    "Property"=>!empty($_POST['Property']) ? $_POST['Property'] : "",
                    "TypeID"=>16,
                    "ProjectID"=>$projectId,
                ]);
                break;
            case "17":
                $assetType="债权融资";
                $res=DB::table("T_P_SPEC17")->insert([
                    "Identity"=>!empty($_POST['Identity']) ? $_POST['Identity'] : "",
                    "AssetType"=>$assetType,
                    "Money"=>!empty($_POST['Money']) ? $_POST['Money'] : "",
                    "Month"=>!empty($_POST['Month']) ? $_POST['Month'] : "",
                    "Type"=>!empty($_POST['Type']) ? $_POST['Type'] : "",
                    "TypeID"=>17,
                    "ProjectID"=>$projectId,
                ]);
                break;
            case "18":
                $res=DB::table("T_P_SPEC18")->insert([
                    "Identity"=>!empty($_POST['Identity']) ? $_POST['Identity'] : "",
                    "AssetType"=>!empty($_POST['AssetType']) ? $_POST['AssetType'] : "",
                    "Money"=>!empty($_POST['Money']) ? $_POST['Money'] : "",
                    "Law"=>!empty($_POST['Law']) ? $_POST['Law'] : "",
                    "UnLaw"=>!empty($_POST['UnLaw']) ? $_POST['UnLaw'] : "",
                    "Month"=>!empty($_POST['Month']) ? $_POST['Month'] : "",
                    "Nature"=>!empty($_POST['Nature']) ? $_POST['Nature'] : "",
                    "Status"=>!empty($_POST['Status']) ? $_POST['Status'] : "",
                    "Guaranty"=>!empty($_POST['Guaranty']) ? $_POST['Guaranty'] : "",
                    "State"=>!empty($_POST['State']) ? $_POST['State'] : "",
                    "Industry"=>!empty($_POST['Industry']) ? $_POST['Industry'] : "",
                    "TypeID"=>18,
                    "ProjectID"=>$projectId,
                ]);
                break;
                break;
            case "19":
                $res=DB::table("T_P_SPEC19")->insert([
                    "Identity"=>!empty($_POST['Identity']) ? $_POST['Identity'] : "",
                    "TotalMoney"=>!empty($_POST['TotalMoney']) ? $_POST['TotalMoney'] : "",
                    "Law"=>!empty($_POST['Law']) ? $_POST['Law'] : "",
                    "UnLaw"=>!empty($_POST['UnLaw']) ? $_POST['UnLaw'] : "",
                    "Month"=>!empty($_POST['Month']) ? $_POST['Month'] : "",
                    "DebteeLocation"=>!empty($_POST['DebteeLocation']) ? $_POST['DebteeLocation'] : "",
                    "Guaranty"=>!empty($_POST['Guaranty']) ? $_POST['Guaranty'] : "",
                    "Property"=>!empty($_POST['Property']) ? $_POST['Property'] : "",
                    "Connect"=>!empty($_POST['Connect']) ? $_POST['Connect'] : "",
                    "Pay"=>!empty($_POST['Pay']) ? $_POST['Pay'] : "",
                    "Credentials"=>!empty($_POST['Credentials']) ? $_POST['Credentials'] : "",
                    "TypeID"=>19,
                    "ProjectID"=>$projectId,
                ]);
                break;
            case "20":
                $assetType="房产";
                $res=DB::table("T_P_SPEC20")->insert([
                    "AssetType"=>$assetType,
                    "Area"=>!empty($_POST['Area']) ? $_POST['Area'] : "",
                    "Nature"=>!empty($_POST['Nature']) ? $_POST['Nature'] : "",
                    "Money"=>!empty($_POST['Money']) ? $_POST['Money'] : "",
                    "Year"=>!empty($_POST['Year']) ? $_POST['Year'] : "",
                    "State"=>!empty($_POST['State']) ? $_POST['State'] : "",
                    "Court"=>!empty($_POST['Court']) ? $_POST['Court'] : "",
                    "TypeID"=>20,
                    "ProjectID"=>$projectId,
                ]);
                break;
            case "21":
                $assetType="土地";
                $res=DB::table("T_P_SPEC21")->insert([
                    "AssetType"=>$assetType,
                    "Area"=>!empty($_POST['Area']) ? $_POST['Area'] : "",
                    "Nature"=>!empty($_POST['Nature']) ? $_POST['Nature'] : "",
                    "Money"=>!empty($_POST['Money']) ? $_POST['Money'] : "",
                    "Year"=>!empty($_POST['Year']) ? $_POST['Year'] : "",
                    "State"=>!empty($_POST['State']) ? $_POST['State'] : "",
                    "Court"=>!empty($_POST['Court']) ? $_POST['Court'] : "",
                    "TypeID"=>21,
                    "ProjectID"=>$projectId,
                ]);
                break;
            case "22":
                $assetType="汽车";
                $res=DB::table("T_P_SPEC22")->insert([
                    "AssetType"=>$assetType,
                    "Brand"=>!empty($_POST['Brand']) ? $_POST['Brand'] : "",
                    "Money"=>!empty($_POST['Money']) ? $_POST['Money'] : "",
                    "Year"=>!empty($_POST['Year']) ? $_POST['Year'] : "",
                    "State"=>!empty($_POST['State']) ? $_POST['State'] : "",
                    "Court"=>!empty($_POST['Court']) ? $_POST['Court'] : "",
                    "TypeID"=>22,
                    "ProjectID"=>$projectId,
                ]);
                break;
        }
        foreach ($_POST['Name'] as $val){
            $serRes=DB::table("T_P_SERVICE")->insert([
                "SerName"=>!empty($_POST['SerName']) ? $_POST['SerName'] : "",
                "Name"=>!empty($val[0]) ? $val[0] : "",
                "PhoneNumber"=>!empty($val[1]) ? $val[1] : "",
                "ProjectID"=>$projectId,
                "created_at"=>date("Y-m-d H:i:s",time()),
                "updated_at"=>date("Y-m-d H:i:s",time())
            ]);
        }

        foreach($_POST['Events'] as $value){
            $processRes=DB::table("T_P_PROCESS")->insert([
                "Events"=>!empty($value[1]) ? $value[1] : "",
                "Remark"=>!empty($value[2]) ? $value[2] : "",
                "Time"=>!empty($value[0]) ? $value[0] : "",
                "ProjectID"=>$projectId,
                "created_at"=>date("Y-m-d H:i:s",time()),
                "updated_at"=>date("Y-m-d H:i:s",time())
            ]);

        }
        if($serRes &&$processRes){
            return redirect("process/index");
        }else{
            return back()->with("msg","添加失败,请您重新添加!");
        }
    }
    //信息详情
    public function detail($projectId,$typeId){
        $Names=DB::table("T_P_SERVICE")->where("ProjectID",$projectId)->get();
        $ServiceNames=DB::table("T_P_SERVICE")->where("ProjectID",$projectId)->take(1)->pluck("SerName");
        $auths=DB::table("T_AS_USER")->select("Name","id")->where("Status",1)->whereIn("Department",['信息开发部',"渠道开发部","投资事业部"])->get();
        $Events=DB::table("T_P_PROCESS")->where("ProjectID",$projectId)->get();
        switch($typeId){
            case "1":
                $datas=DB::table("T_P_PROJECTINFO")
                    ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_P_PROJECTINFO.Responsible")
                    ->leftJoin("T_P_PROJECTTYPE","T_P_PROJECTTYPE.TypeID","=","T_P_PROJECTINFO.TypeID")
                    ->leftJoin("T_P_SPEC01", "T_P_PROJECTINFO.ProjectID", "=", "T_P_SPEC01.ProjectID")
                    ->where("T_P_PROJECTINFO.ProjectID",$projectId)
                    ->get();

                foreach($datas as $data){
                    $proLabel=$data->ProLabel;
                    $proLabels=explode(",",$proLabel);
                    if(!empty($data->Pawn)){
                        $pawnStr=$data->Pawn;
                        $pawn=explode(",",$pawnStr);
                    }
                }
                $typeNames=DB::table("T_P_PROJECTTYPE")->where("TypeID",$typeId)->pluck("TypeName");
                $typeName=$typeNames[0];
                return view("process/detail_1",compact("datas","Names","Events","typeName","pawn","proLabels","auths","projectId","typeId","ServiceNames"));
            break;
            case "6":
                $datas=DB::table("T_P_PROJECTINFO")
                    ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_P_PROJECTINFO.Responsible")
                    ->leftJoin("T_P_PROJECTTYPE","T_P_PROJECTTYPE.TypeID","=","T_P_PROJECTINFO.TypeID")
                    ->leftJoin("T_P_SPEC06", "T_P_PROJECTINFO.ProjectID", "=", "T_P_SPEC06.ProjectID")
                    ->where("T_P_PROJECTINFO.ProjectID",$projectId)
                    ->get();
                foreach($datas as $data){
                    $proLabel=$data->ProLabel;
                    $proLabels=explode(",",$proLabel);
                }
                $typeNames=DB::table("T_P_PROJECTTYPE")->where("TypeID",$typeId)->pluck("TypeName");
                $typeName=$typeNames[0];

                return view("process/detail_6",compact("datas","Names","Events","typeName","auths","projectId","typeId","proLabels","ServiceNames"));
            break;
            case "12":
                $datas=DB::table("T_P_PROJECTINFO")
                    ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_P_PROJECTINFO.Responsible")
                    ->leftJoin("T_P_PROJECTTYPE","T_P_PROJECTTYPE.TypeID","=","T_P_PROJECTINFO.TypeID")
                    ->leftJoin("T_P_SPEC12", "T_P_PROJECTINFO.ProjectID", "=", "T_P_SPEC12.ProjectID")
                    ->where("T_P_PROJECTINFO.ProjectID",$projectId)
                    ->get();
                foreach($datas as $data){
                    $proLabel=$data->ProLabel;
                    $proLabels=explode(",",$proLabel);
                }
                $typeNames=DB::table("T_P_PROJECTTYPE")->where("TypeID",$typeId)->pluck("TypeName");
                $typeName=$typeNames[0];
                return view("process/detail_12",compact("datas","Names","Events","typeName","auths","projectId","typeId","proLabels","ServiceNames"));
            break;
            case "16":
                $datas=DB::table("T_P_PROJECTINFO")
                    ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_P_PROJECTINFO.Responsible")
                    ->leftJoin("T_P_PROJECTTYPE","T_P_PROJECTTYPE.TypeID","=","T_P_PROJECTINFO.TypeID")
                    ->leftJoin("T_P_SPEC16", "T_P_PROJECTINFO.ProjectID", "=", "T_P_SPEC16.ProjectID")
                    ->where("T_P_PROJECTINFO.ProjectID",$projectId)
                    ->get();
                foreach($datas as $data){
                    $proLabel=$data->ProLabel;
                    $proLabels=explode(",",$proLabel);
                }
                $typeNames=DB::table("T_P_PROJECTTYPE")->where("TypeID",$typeId)->pluck("TypeName");
                $typeName=$typeNames[0];
                return view("process/detail_12",compact("datas","Names","Events","typeName","auths","projectId","typeId","proLabels","ServiceNames"));
            break;
            case "17":
                $datas=DB::table("T_P_PROJECTINFO")
                    ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_P_PROJECTINFO.Responsible")
                    ->leftJoin("T_P_PROJECTTYPE","T_P_PROJECTTYPE.TypeID","=","T_P_PROJECTINFO.TypeID")
                    ->leftJoin("T_P_SPEC17", "T_P_PROJECTINFO.ProjectID", "=", "T_P_SPEC17.ProjectID")
                    ->where("T_P_PROJECTINFO.ProjectID",$projectId)
                    ->get();
                foreach($datas as $data){
                    $proLabel=$data->ProLabel;
                    $proLabels=explode(",",$proLabel);
                }
                $typeNames=DB::table("T_P_PROJECTTYPE")->where("TypeID",$typeId)->pluck("TypeName");
                $typeName=$typeNames[0];
                return view("process/detail_6",compact("datas","Names","Events","typeName","auths","projectId","typeId","proLabels","ServiceNames"));
            break;
            case "18":
                $datas=DB::table("T_P_PROJECTINFO")
                    ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_P_PROJECTINFO.Responsible")
                    ->leftJoin("T_P_PROJECTTYPE","T_P_PROJECTTYPE.TypeID","=","T_P_PROJECTINFO.TypeID")
                    ->leftJoin("T_P_SPEC18", "T_P_PROJECTINFO.ProjectID", "=", "T_P_SPEC18.ProjectID")
                    ->where("T_P_PROJECTINFO.ProjectID",$projectId)
                    ->get();
                foreach($datas as $data){
                    $proLabel=$data->ProLabel;
                    $proLabels=explode(",",$proLabel);
                }
                $typeNames=DB::table("T_P_PROJECTTYPE")->where("TypeID",$typeId)->pluck("TypeName");
                $typeName=$typeNames[0];
                return view("process/detail_18",compact("datas","Names","Events","typeName","auths","projectId","typeId","proLabels","ServiceNames"));
            break;
            case "19":
                $datas=DB::table("T_P_PROJECTINFO")
                    ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_P_PROJECTINFO.Responsible")
                    ->leftJoin("T_P_PROJECTTYPE","T_P_PROJECTTYPE.TypeID","=","T_P_PROJECTINFO.TypeID")
                    ->leftJoin("T_P_SPEC19", "T_P_PROJECTINFO.ProjectID", "=", "T_P_SPEC19.ProjectID")
                    ->where("T_P_PROJECTINFO.ProjectID",$projectId)
                    ->get();
                foreach($datas as $data){
                    $proLabel=$data->ProLabel;
                    $proLabels=explode(",",$proLabel);
                }
                $typeNames=DB::table("T_P_PROJECTTYPE")->where("TypeID",$typeId)->pluck("TypeName");
                $typeName=$typeNames[0];
                return view("process/detail_19",compact("datas","Names","Events","typeName","auths","projectId","typeId","proLabels","ServiceNames"));
            break;
            case "20":
                $datas=DB::table("T_P_PROJECTINFO")
                    ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_P_PROJECTINFO.Responsible")
                    ->leftJoin("T_P_PROJECTTYPE","T_P_PROJECTTYPE.TypeID","=","T_P_PROJECTINFO.TypeID")
                    ->leftJoin("T_P_SPEC20", "T_P_PROJECTINFO.ProjectID", "=", "T_P_SPEC20.ProjectID")
                    ->where("T_P_PROJECTINFO.ProjectID",$projectId)
                    ->get();
                /*foreach($datas as $data){
                    $proLabel=$data->ProLabel;
                    $proLabels=explode(",",$proLabel);
                }*/
                $typeNames=DB::table("T_P_PROJECTTYPE")->where("TypeID",$typeId)->pluck("TypeName");
                $typeName=$typeNames[0];
                return view("process/detail_20",compact("datas","Names","Events","typeName","auths","projectId","typeId","ServiceNames"));
            break;
            case "21":
                $datas=DB::table("T_P_PROJECTINFO")
                    ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_P_PROJECTINFO.Responsible")
                    ->leftJoin("T_P_PROJECTTYPE","T_P_PROJECTTYPE.TypeID","=","T_P_PROJECTINFO.TypeID")
                    ->leftJoin("T_P_SPEC21", "T_P_PROJECTINFO.ProjectID", "=", "T_P_SPEC21.ProjectID")
                    ->where("T_P_PROJECTINFO.ProjectID",$projectId)
                    ->get();
                /*foreach($datas as $data){
                    $proLabel=$data->ProLabel;
                    $proLabels=explode(",",$proLabel);
                }*/
                $typeNames=DB::table("T_P_PROJECTTYPE")->where("TypeID",$typeId)->pluck("TypeName");
                $typeName=$typeNames[0];
                return view("process/detail_20",compact("datas","Names","Events","typeName","auths","projectId","typeId","ServiceNames"));
            break;
            case "22":
                $datas=DB::table("T_P_PROJECTINFO")
                    ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_P_PROJECTINFO.Responsible")
                    ->leftJoin("T_P_PROJECTTYPE","T_P_PROJECTTYPE.TypeID","=","T_P_PROJECTINFO.TypeID")
                    ->leftJoin("T_P_SPEC22", "T_P_PROJECTINFO.ProjectID", "=", "T_P_SPEC22.ProjectID")
                    ->where("T_P_PROJECTINFO.ProjectID",$projectId)
                    ->get();
              /*  foreach($datas as $data){
                    $proLabel=$data->ProLabel;
                    $proLabels=explode(",",$proLabel);
                }*/
                $typeNames=DB::table("T_P_PROJECTTYPE")->where("TypeID",$typeId)->pluck("TypeName");
                $typeName=$typeNames[0];
                return view("process/detail_20",compact("datas","Names","Events","typeName","auths","projectId","typeId","ServiceNames"));
            break;

        }
    }

    //项目信息编辑保存
    public  function  saveUpdate(){
        $projectId=$_POST['projectId'];
        $typeId=$_POST['typeId'];

        $proLabel=!empty($_POST['ProLabel']) ? implode(",",$_POST['ProLabel']): "";
        $projectIds=DB::table("T_P_PROJECTINFO")->where("ProjectID",$_POST['projectId'])->update([
            "ProArea"=>!empty($_POST['ProArea']) ? $_POST['ProArea'] : "",
            "WordDes"=>!empty($_POST['wordDes']) ? $_POST['wordDes'] : "",
            "PictureDes1"=>!empty($_POST['PictureDes1']) ? $_POST['PictureDes1'] : "",
            "PictureDes2"=>!empty($_POST['PictureDes2']) ? $_POST['PictureDes2'] : "",
            "PictureDes3"=>!empty($_POST['PictureDes3']) ? $_POST['PictureDes3'] : "",
            "PictureDes4"=>!empty($_POST['PictureDes4']) ? $_POST['PictureDes4'] : "",
            "PictureDes5"=>!empty($_POST['PictureDes5']) ? $_POST['PictureDes5'] : "",
            "ConnectPerson"=>!empty($_POST['ConnectPerson']) ? $_POST['ConnectPerson'] : "",
            "ConnectPhone"=>!empty($_POST['ConnectPhone']) ? $_POST['ConnectPhone'] : "",
            "Responsible"=>!empty($_POST['Responsible']) ? $_POST['Responsible'] : "",
            "StarLevel"=>!empty($_POST['starLevel']) ? $_POST['starLevel'] : "",
            "CertifyState"=>4,
            "ProLabel"=>$proLabel,
            "Title"=>!empty($_POST['Title']) ? $_POST['Title'] : "",
            "PublishTime"=>date("Y-m-d H:i:s",time()),
            "TypeID"=>$typeId,
            "created_at"=>date("Y-m-d H:i:s",time()),
            "updated_at"=>date("Y-m-d H:i:s",time())
        ]);

        switch($typeId){
            case "1":
                $pawns=!empty($_POST['Pawn']) ? $_POST['Pawn'] : "";
                if(!empty($pawns)){
                    $pawn=implode(",",$pawns);
                }else{
                    $pawn="";
                }
                $res=DB::table("T_P_SPEC01")->where("ProjectID",$_POST['projectId'])->update([
                    "Identity"=>!empty($_POST['Identity']) ? $_POST['Identity'] : "",
                    "FromWhere"=>!empty($_POST['FromWhere']) ? $_POST['FromWhere'] : "",
                    "TotalMoney"=>!empty($_POST['TotalMoney']) ? $_POST['TotalMoney'] : "",
                    "TransferMoney"=>!empty($_POST['TransferMoney']) ? $_POST['TransferMoney'] : "",
                    "AssetType"=>!empty($_POST['AssetType']) ? $_POST['AssetType'] : "",
                    "Money"=>!empty($_POST['Money']) ? $_POST['Money'] : "",
                    "Rate"=>!empty($_POST['Rate']) ? $_POST['Rate'] : "",
                    "Counts"=>!empty($_POST['Counts']) ? $_POST['Counts'] : "",
                    "Report"=>!empty($_POST['Report']) ? $_POST['Report'] : "",
                    "Pawn"=>$pawn,
                    "TypeID"=>1,
                    "ProjectID"=>$projectId,
                ]);
                break;
            case "6":
                $assetType="股权融资";
                $res=DB::table("T_P_SPEC06")->where("ProjectID",$_POST['projectId'])->update([
                    "Identity"=>!empty($_POST['Identity']) ? $_POST['Identity'] : "",
                    "AssetType"=>$assetType,
                    "TotalMoney"=>!empty($_POST['Money']) ? $_POST['Money'] : "",
                    "Rate"=>!empty($_POST['Rate']) ? $_POST['Rate'] : "",
                    "Status"=>!empty($_POST['Status']) ? $_POST['Status'] : "",
                    "Belong"=>!empty($_POST['Belong']) ? $_POST['Belong'] : "",
                    "Usefor"=>!empty($_POST['Usefor']) ? $_POST['Usefor'] : "",
                    "TypeID"=>6,
                    "ProjectID"=>$projectId,
                ]);
                break;
            case "12":
                $assetType="房产";
                $res=DB::table("T_P_SPEC12")->where("ProjectID",$_POST['projectId'])->update([
                    "Identity"=> !empty($_POST['Identity']) ? $_POST['Identity'] : "",
                    "AssetType"=>$assetType,
                    "TransferMoney"=>  !empty($_POST['TransferMoney']) ? $_POST['TransferMoney'] : "",
                    "Type"=> !empty($_POST['Type']) ? $_POST['Type'] : "",
                    "Usefor"=>!empty($_POST['Usefor']) ? $_POST['Usefor'] : "",
                    "Area"=>!empty($_POST['Area']) ? $_POST['Area'] : "",
                    "Year"=>!empty($_POST['Year']) ? $_POST['Year'] : "",
                    "TransferType"=>!empty($_POST['TransferType']) ? $_POST['TransferType'] : "",
                    "MarketPrice"=>!empty($_POST['MarketPrice']) ? $_POST['MarketPrice'] : "",
                    "Credentials"=>!empty($_POST['Credentials']) ? $_POST['Credentials'] : "",
                    "Dispute"=>!empty($_POST['Dispute']) ? $_POST['Dispute'] : "",
                    "Debt"=>!empty($_POST['Debt']) ? $_POST['Debt'] : "",
                    "Guaranty"=>!empty($_POST['Guaranty']) ? $_POST['Guaranty'] : "",
                    "Property"=>!empty($_POST['Property']) ? $_POST['Property'] : "",
                    "TypeID"=>12,
                    "ProjectID"=>$projectId,
                ]);
                break;
            case "16":
                $assetType="土地";
                $res=DB::table("T_P_SPEC16")->where("ProjectID",$_POST['projectId'])->update([
                    "Identity"=>!empty($_POST['Identity']) ? $_POST['Identity'] : "",
                    "AssetType"=>$assetType,
                    "TransferMoney"=>!empty($_POST['TransferMoney']) ? $_POST['TransferMoney'] : "",
                    "Usefor"=>!empty($_POST['Usefor']) ? $_POST['Usefor'] : "",
                    "Area"=>!empty($_POST['Area']) ? $_POST['Area'] : "",
                    "Year"=>!empty($_POST['Year']) ? $_POST['Year'] : "",
                    "TransferType"=>!empty($_POST['TransferType']) ? $_POST['TransferType'] : "",
                    "Credentials"=>!empty($_POST['Credentials']) ? $_POST['Credentials'] : "",
                    "Dispute"=>!empty($_POST['Dispute']) ? $_POST['Dispute'] : "",
                    "Debt"=>!empty($_POST['Debt']) ? $_POST['Debt'] : "",
                    "Guaranty"=>!empty($_POST['Guaranty']) ? $_POST['Guaranty'] : "",
                    "Property"=>!empty($_POST['Property']) ? $_POST['Property'] : "",
                    "TypeID"=>16,
                    "ProjectID"=>$projectId,
                ]);
                break;
            case "17":
                $assetType="债权融资";
                $res=DB::table("T_P_SPEC17")->where("ProjectID",$_POST['projectId'])->update([
                    "Identity"=>!empty($_POST['Identity']) ? $_POST['Identity'] : "",
                    "AssetType"=>$assetType,
                    "Money"=>!empty($_POST['Money']) ? $_POST['Money'] : "",
                    "Month"=>!empty($_POST['Month']) ? $_POST['Month'] : "",
                    "Type"=>!empty($_POST['Type']) ? $_POST['Type'] : "",
                    "TypeID"=>17,
                    "ProjectID"=>$projectId,
                ]);
                break;
            case "18":
                $res=DB::table("T_P_SPEC18")->where("ProjectID",$_POST['projectId'])->update([
                    "Identity"=>!empty($_POST['Identity']) ? $_POST['Identity'] : "",
                    "AssetType"=>!empty($_POST['AssetType']) ? $_POST['AssetType'] : "",
                    "Money"=>!empty($_POST['Money']) ? $_POST['Money'] : "",
                    "Law"=>!empty($_POST['Law']) ? $_POST['Law'] : "",
                    "UnLaw"=>!empty($_POST['UnLaw']) ? $_POST['UnLaw'] : "",
                    "Month"=>!empty($_POST['Month']) ? $_POST['Month'] : "",
                    "Nature"=>!empty($_POST['Nature']) ? $_POST['Nature'] : "",
                    "Status"=>!empty($_POST['Status']) ? $_POST['Status'] : "",
                    "Guaranty"=>!empty($_POST['Guaranty']) ? $_POST['Guaranty'] : "",
                    "State"=>!empty($_POST['State']) ? $_POST['State'] : "",
                    "Industry"=>!empty($_POST['Industry']) ? $_POST['Industry'] : "",
                    "TypeID"=>18,
                    "ProjectID"=>$projectId,
                ]);
                break;
                break;
            case "19":
                $res=DB::table("T_P_SPEC19")->where("ProjectID",$_POST['projectId'])->update([
                    "Identity"=>!empty($_POST['Identity']) ? $_POST['Identity'] : "",
                    "TotalMoney"=>!empty($_POST['TotalMoney']) ? $_POST['TotalMoney'] : "",
                    "Law"=>!empty($_POST['Law']) ? $_POST['Law'] : "",
                    "UnLaw"=>!empty($_POST['UnLaw']) ? $_POST['UnLaw'] : "",
                    "Month"=>!empty($_POST['Month']) ? $_POST['Month'] : "",
                    "DebteeLocation"=>!empty($_POST['DebteeLocation']) ? $_POST['DebteeLocation'] : "",
                    "Guaranty"=>!empty($_POST['Guaranty']) ? $_POST['Guaranty'] : "",
                    "Property"=>!empty($_POST['Property']) ? $_POST['Property'] : "",
                    "Connect"=>!empty($_POST['Connect']) ? $_POST['Connect'] : "",
                    "Pay"=>!empty($_POST['Pay']) ? $_POST['Pay'] : "",
                    "Credentials"=>!empty($_POST['Credentials']) ? $_POST['Credentials'] : "",
                    "TypeID"=>19,
                    "ProjectID"=>$projectId,
                ]);
                break;
            case "20":
                $assetType="房产";
                $res=DB::table("T_P_SPEC20")->where("ProjectID",$_POST['projectId'])->update([
                    "AssetType"=>$assetType,
                    "Area"=>!empty($_POST['Area']) ? $_POST['Area'] : "",
                    "Nature"=>!empty($_POST['Nature']) ? $_POST['Nature'] : "",
                    "Money"=>!empty($_POST['Money']) ? $_POST['Money'] : "",
                    "Year"=>!empty($_POST['Year']) ? $_POST['Year'] : "",
                    "State"=>!empty($_POST['State']) ? $_POST['State'] : "",
                    "Court"=>!empty($_POST['Court']) ? $_POST['Court'] : "",
                    "TypeID"=>20,
                    "ProjectID"=>$projectId,
                ]);
                break;
            case "21":
                $assetType="土地";
                $res=DB::table("T_P_SPEC21")->where("ProjectID",$_POST['projectId'])->update([
                    "AssetType"=>$assetType,
                    "Area"=>!empty($_POST['Area']) ? $_POST['Area'] : "",
                    "Nature"=>!empty($_POST['Nature']) ? $_POST['Nature'] : "",
                    "Money"=>!empty($_POST['Money']) ? $_POST['Money'] : "",
                    "Year"=>!empty($_POST['Year']) ? $_POST['Year'] : "",
                    "State"=>!empty($_POST['State']) ? $_POST['State'] : "",
                    "Court"=>!empty($_POST['Court']) ? $_POST['Court'] : "",
                    "TypeID"=>21,
                    "ProjectID"=>$projectId,
                ]);
                break;
            case "22":
                $assetType="汽车";
                $res=DB::table("T_P_SPEC22")->where("ProjectID",$_POST['projectId'])->update([
                    "AssetType"=>$assetType,
                    "Brand"=>!empty($_POST['Brand']) ? $_POST['Brand'] : "",
                    "Money"=>!empty($_POST['Money']) ? $_POST['Money'] : "",
                    "Year"=>!empty($_POST['Year']) ? $_POST['Year'] : "",
                    "State"=>!empty($_POST['State']) ? $_POST['State'] : "",
                    "Court"=>!empty($_POST['Court']) ? $_POST['Court'] : "",
                    "TypeID"=>22,
                    "ProjectID"=>$projectId,
                ]);
                break;
        }
        if(!empty($_POST["Name"]) && !empty($_POST['Events'])){
            $serDel=DB::table("T_P_SERVICE")->where("ProjectID",$_POST['projectId'])->delete();
            $ProDel=DB::table("T_P_PROCESS")->where("ProjectID",$_POST['projectId'])->delete();
            foreach ($_POST['Name'] as $val){
                $serRes=DB::table("T_P_SERVICE")->insert([
                    "SerName"=>!empty($_POST['SerName']) ? $_POST['SerName'] : "",
                    "Name"=>!empty($val[0]) ? $val[0] : "",
                    "PhoneNumber"=>!empty($val[1]) ? $val[1] : "",
                    "ProjectID"=>$_POST['projectId'],
                    "created_at"=>date("Y-m-d H:i:s",time()),
                    "updated_at"=>date("Y-m-d H:i:s",time())
                ]);
            }

            foreach($_POST['Events'] as $value){
                $processRes=DB::table("T_P_PROCESS")->insert([
                    "Events"=>!empty($value[1]) ? $value[1] : "",
                    "Remark"=>!empty($value[2]) ? $value[2] : "",
                    "Time"=>!empty($value[0]) ? $value[0] : "",
                    "ProjectID"=>$_POST['projectId'],
                    "created_at"=>date("Y-m-d H:i:s",time()),
                    "updated_at"=>date("Y-m-d H:i:s",time())
                ]);
            }
            if($serRes &&$processRes){
                return redirect("process/index");
            }else{
                return back()->with("msg","添加失败,请您重新添加!");
            }

        }else{
            return redirect("process/index");
        }


    }

    //删除项目
    public function delete($projectId){
        $result=DB::table("T_P_PROJECTINFO")->where("ProjectId",$projectId)->update([
            "CertifyState"=>3
        ]);
        
        if($result){
            return redirect("process/index");
        }
    }
}
