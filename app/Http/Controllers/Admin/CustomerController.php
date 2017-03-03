<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    //客户列表
    public  function  index(){
        $id=Session::get("userId");
        $authArr=array(1,11,17,18);
        if(in_array($id,$authArr)){
            if(!empty($_POST)){
                $department=!empty($_POST['department']) ? $_POST['department'] : "";
                $Name=!empty($_POST['Name']) ? $_POST['Name'] : "";
                $serviceName=!empty($_POST['serviceName']) ? $_POST['serviceName'] : "";
                $typeName=!empty($_POST['typeName']) ? $_POST['typeName'] : "";
                $NameWhere=($_POST['Name']!=0) ? array("T_AS_USER.id"=>$_POST['Name']) : array();
                $departmentWhere=($_POST['department']!="全部")? array("T_AS_USER.Department"=>$_POST['department']) : array();
                if($_POST['typeName']!="全部"){
                    if(!empty($_POST['serviceName'])){
                        $datas=DB::table("T_U_CUSTOMER")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                            ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                            ->where("DeleteFlag",0)
                            ->where("T_U_CUSTOMER.serviceType","like","%".$_POST['typeName']."%")
                            ->where("T_U_CUSTOMER.CustomerName","like","%".$_POST['serviceName']."%")
                            ->where($NameWhere)
                            ->where($departmentWhere)
                            ->orderBy("created_at","desc")
                            ->paginate(20);
                        $counts=DB::table("T_U_CUSTOMER")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                            ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                            ->where("DeleteFlag",0)
                            ->where("T_U_CUSTOMER.serviceType","like","%".$_POST['typeName']."%")
                            ->where("T_U_CUSTOMER.CustomerName","like","%".$_POST['serviceName']."%")
                            ->where($NameWhere)
                            ->where($departmentWhere)
                            ->count();
                    }else{
                        $datas=DB::table("T_U_CUSTOMER")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                            ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                            ->where("DeleteFlag",0)
                            ->where("T_U_CUSTOMER.serviceType","like","%".$_POST['typeName']."%")
                            ->where($NameWhere)
                            ->where($departmentWhere)
                            ->orderBy("created_at","desc")
                            ->paginate(20);
                        $counts=DB::table("T_U_CUSTOMER")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                            ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                            ->where("DeleteFlag",0)
                            ->where("T_U_CUSTOMER.serviceType","like","%".$_POST['typeName']."%")
                            ->where($NameWhere)
                            ->where($departmentWhere)
                            ->count();
                    }
                }else{
                    if(!empty($_POST['serviceName'])){
                        $datas=DB::table("T_U_CUSTOMER")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                            ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                            ->where("DeleteFlag",0)
                            ->where("T_U_CUSTOMER.CustomerName","like","%".$_POST['serviceName']."%")
                            ->where($NameWhere)
                            ->where($departmentWhere)
                            ->orderBy("created_at","desc")
                            ->paginate(20);
                        $counts=DB::table("T_U_CUSTOMER")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                            ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                            ->where("DeleteFlag",0)
                            ->where("T_U_CUSTOMER.CustomerName","like","%".$_POST['serviceName']."%")
                            ->where($NameWhere)
                            ->where($departmentWhere)
                            ->count();
                    }else{
                        $datas=DB::table("T_U_CUSTOMER")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                            ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                            ->where("DeleteFlag",0)
                            ->where($NameWhere)
                            ->where($departmentWhere)
                            ->orderBy("created_at","desc")
                            ->paginate(20);
                        $counts=DB::table("T_U_CUSTOMER")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                            ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                            ->where("DeleteFlag",0)
                            ->where($NameWhere)
                            ->where($departmentWhere)
                            ->count();
                    }
                }
                $number=$counts;
                foreach ($datas as $val){
                    $val->Number=$number;
                    $number--;
                }
            }else if(!empty($_GET)){
               /* dd($_GET);*/
                $department=!empty($_GET['department']) ? $_GET['department'] : "";
                $Name=!empty($_GET['Name']) ? $_GET['Name'] : "";
                $serviceName=!empty($_GET['serviceName']) ? $_GET['serviceName'] : "";
                $typeName=!empty($_GET['typeName']) ? $_GET['typeName'] : "";
                $NameWhere=($_GET['Name']!=0) ? array("T_AS_USER.id"=>$_GET['Name']) : array();
                $departmentWhere=($_GET['department']!="全部")? array("T_AS_USER.Department"=>$_GET['department']) : array();
                if($_GET['typeName']!="全部"){
                    if(!empty($_GET['serviceName'])){
                        $datas=DB::table("T_U_CUSTOMER")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                            ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                            ->where("DeleteFlag",0)
                            ->where("T_U_CUSTOMER.serviceType","like","%".$_GET['typeName']."%")
                            ->where("T_U_CUSTOMER.CustomerName","like","%".$_GET['serviceName']."%")
                            ->where($NameWhere)
                            ->where($departmentWhere)
                            ->orderBy("created_at","desc")
                            ->paginate(20);
                        $counts=DB::table("T_U_CUSTOMER")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                            ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                            ->where("DeleteFlag",0)
                            ->where("T_U_CUSTOMER.serviceType","like","%".$_GET['typeName']."%")
                            ->where("T_U_CUSTOMER.CustomerName","like","%".$_GET['serviceName']."%")
                            ->where($NameWhere)
                            ->where($departmentWhere)
                            ->count();
                           
                    }else{
                        $datas=DB::table("T_U_CUSTOMER")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                            ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                            ->where("DeleteFlag",0)
                            ->where("T_U_CUSTOMER.serviceType","like","%".$_GET['typeName']."%")
                            ->where($NameWhere)
                            ->where($departmentWhere)
                            ->orderBy("created_at","desc")
                            ->paginate(20);
                        $counts=DB::table("T_U_CUSTOMER")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                            ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                            ->where("DeleteFlag",0)
                            ->where("T_U_CUSTOMER.serviceType","like","%".$_GET['typeName']."%")
                            ->where($NameWhere)
                            ->where($departmentWhere)
                            ->count();
                    }
                }else{
                    if(!empty($_GET['serviceName'])){
                        $datas=DB::table("T_U_CUSTOMER")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                            ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                            ->where("DeleteFlag",0)
                            ->where("T_U_CUSTOMER.CustomerName","like","%".$_GET['serviceName']."%")
                            ->where($NameWhere)
                            ->where($departmentWhere)
                            ->orderBy("created_at","desc")
                            ->paginate(20);
                        $counts=DB::table("T_U_CUSTOMER")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                            ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                            ->where("DeleteFlag",0)
                            ->where("T_U_CUSTOMER.CustomerName","like","%".$_GET['serviceName']."%")
                            ->where($NameWhere)
                            ->where($departmentWhere)
                            ->count();
                    }else{
                        $datas=DB::table("T_U_CUSTOMER")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                            ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                            ->where("DeleteFlag",0)
                            ->where($NameWhere)
                            ->where($departmentWhere)
                            ->orderBy("created_at","desc")
                            ->paginate(20);
                        $counts=DB::table("T_U_CUSTOMER")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                            ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                            ->where("DeleteFlag",0)
                            ->where($NameWhere)
                            ->where($departmentWhere)
                            ->count();
                    }
                }
                $number=$counts-20*($_GET['page']-1);
                foreach ($datas as $val){
                    $val->Number=$number;
                    $number--;
                }
            }else{
                $department="全部";
                $Name="";
                $serviceName="";
                $typeName="全部";
                $datas=DB::table("T_U_CUSTOMER")
                    ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                    ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                    ->where("DeleteFlag",0)
                    ->orderBy("created_at","desc")
                    ->paginate(20);
                $counts=DB::table("T_U_CUSTOMER")
                    ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                    ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                    ->where("DeleteFlag",0)
                    ->count();
                $number=$counts;
                foreach ($datas as $val){
                    $val->Number=$number;
                    $number--;
                }
            }
            $departs=DB::table("T_AS_USER")->where("Status",1)->whereIn("Department",['信息开发部',"渠道开发部","投资事业部"])->pluck("Department");
            $Departments=array();
            foreach ($departs as $value){
                if(!in_array($value,$Departments)){
                    $Departments[]=$value;
                }
            }
            $Names=DB::table("T_AS_USER")->select("Name","id")->where("Status",1)->whereIn("Department",['信息开发部',"渠道开发部","投资事业部"])->get();
        }else{
            if(!empty($_POST)){
                $parts=DB::table("T_AS_USER")->where("Status",1)->where("id",$id)->pluck("Department");
                $department=$parts[0];
                $Name=$id;
                $serviceName=!empty($_POST['serviceName']) ? $_POST['serviceName'] : "";
                $typeName=!empty($_POST['typeName']) ? $_POST['typeName'] : "";
                $NameWhere=($_POST['Name']!=0) ? array("T_AS_USER.id"=>$_POST['Name']) : array();
                $departmentWhere=($_POST['department']!="全部")? array("T_AS_USER.Department"=>$_POST['department']) : array();
                if($_POST['typeName']!="全部"){
                    if(!empty($_POST['serviceName'])){
                        $datas=DB::table("T_U_CUSTOMER")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                            ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                            ->where("DeleteFlag",0)
                            ->where("T_U_CUSTOMER.serviceType","like","%".$_POST['typeName']."%")
                            ->where("T_U_CUSTOMER.CustomerName","like","%".$_POST['serviceName']."%")
                            ->where("T_AS_USER.Department",$department)
                            ->where("T_AS_USER.id",$id)
                            ->orderBy("created_at","desc")
                            ->paginate(20);
                        $counts=DB::table("T_U_CUSTOMER")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                            ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                            ->where("DeleteFlag",0)
                            ->where("T_U_CUSTOMER.serviceType","like","%".$_POST['typeName']."%")
                            ->where("T_U_CUSTOMER.CustomerName","like","%".$_POST['serviceName']."%")
                            ->where("T_AS_USER.Department",$department)
                            ->where("T_AS_USER.id",$id)
                            ->count();
                    }else{
                        $datas=DB::table("T_U_CUSTOMER")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                            ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                            ->where("DeleteFlag",0)
                            ->where("T_U_CUSTOMER.serviceType","like","%".$_POST['typeName']."%")
                            ->where("T_AS_USER.Department",$department)
                            ->where("T_AS_USER.id",$id)
                            ->orderBy("created_at","desc")
                            ->paginate(20);
                        $counts=DB::table("T_U_CUSTOMER")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                            ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                            ->where("DeleteFlag",0)
                            ->where("T_U_CUSTOMER.serviceType","like","%".$_POST['typeName']."%")
                            ->where("T_AS_USER.Department",$department)
                            ->where("T_AS_USER.id",$id)
                            ->count();
                    }
                }else{
                    if(!empty($_POST['serviceName'])){
                        $datas=DB::table("T_U_CUSTOMER")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                            ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                            ->where("DeleteFlag",0)
                            ->where("T_U_CUSTOMER.CustomerName","like","%".$_POST['serviceName']."%")
                            ->where("T_AS_USER.Department",$department)
                            ->where("T_AS_USER.id",$id)
                            ->orderBy("created_at","desc")
                            ->paginate(20);
                        $counts=DB::table("T_U_CUSTOMER")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                            ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                            ->where("DeleteFlag",0)
                            ->where("T_U_CUSTOMER.CustomerName","like","%".$_POST['serviceName']."%")
                            ->where("T_AS_USER.Department",$department)
                            ->where("T_AS_USER.id",$id)
                            ->count();
                    }else{
                        $datas=DB::table("T_U_CUSTOMER")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                            ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                            ->where("DeleteFlag",0)
                            ->where("T_AS_USER.Department",$department)
                            ->where("T_AS_USER.id",$id)
                            ->orderBy("created_at","desc")
                            ->paginate(20);
                        $counts=DB::table("T_U_CUSTOMER")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                            ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                            ->where("DeleteFlag",0)
                            ->where("T_AS_USER.Department",$department)
                            ->where("T_AS_USER.id",$id)
                            ->count();
                    }
                }
                $number=$counts;
                foreach ($datas as $val){
                    $val->Number=$number;
                    $number--;
                }
            }else if(!empty($_GET)){
                $parts=DB::table("T_AS_USER")->where("Status",1)->where("id",$id)->pluck("Department");
                $department=$parts[0];
                $Name=$id;
                $serviceName=!empty($_GET['serviceName']) ? $_GET['serviceName'] : "";
                $typeName=!empty($_GET['typeName']) ? $_GET['typeName'] : "";
                $NameWhere=($_GET['Name']!=0) ? array("T_AS_USER.id"=>$_GET['Name']) : array();
                $departmentWhere=($_GET['department']!="全部")? array("T_AS_USER.Department"=>$_GET['department']) : array();
                if($_GET['typeName']!="全部"){
                    if(!empty($_GET['serviceName'])){
                        $datas=DB::table("T_U_CUSTOMER")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                            ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                            ->where("DeleteFlag",0)
                            ->where("T_U_CUSTOMER.serviceType","like","%".$_GET['typeName']."%")
                            ->where("T_U_CUSTOMER.CustomerName","like","%".$_GET['serviceName']."%")
                            ->where("T_AS_USER.Department",$department)
                            ->where("T_AS_USER.id",$id)
                            ->orderBy("created_at","desc")
                            ->paginate(20);
                        $counts=DB::table("T_U_CUSTOMER")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                            ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                            ->where("DeleteFlag",0)
                            ->where("T_U_CUSTOMER.serviceType","like","%".$_GET['typeName']."%")
                            ->where("T_U_CUSTOMER.CustomerName","like","%".$_GET['serviceName']."%")
                            ->where("T_AS_USER.Department",$department)
                            ->where("T_AS_USER.id",$id)
                            ->count();
                    }else{
                        $datas=DB::table("T_U_CUSTOMER")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                            ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                            ->where("DeleteFlag",0)
                            ->where("T_U_CUSTOMER.serviceType","like","%".$_GET['typeName']."%")
                            ->where("T_AS_USER.Department",$department)
                            ->where("T_AS_USER.id",$id)
                            ->orderBy("created_at","desc")
                            ->paginate(20);
                        $counts=DB::table("T_U_CUSTOMER")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                            ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                            ->where("DeleteFlag",0)
                            ->where("T_U_CUSTOMER.serviceType","like","%".$_GET['typeName']."%")
                            ->where("T_AS_USER.Department",$department)
                            ->where("T_AS_USER.id",$id)
                            ->count();
                    }
                }else{
                    if(!empty($_GET['serviceName'])){
                        $datas=DB::table("T_U_CUSTOMER")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                            ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                            ->where("DeleteFlag",0)
                            ->where("T_U_CUSTOMER.CustomerName","like","%".$_GET['serviceName']."%")
                            ->where("T_AS_USER.Department",$department)
                            ->where("T_AS_USER.id",$id)
                            ->orderBy("created_at","desc")
                            ->paginate(20);
                        $counts=DB::table("T_U_CUSTOMER")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                            ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                            ->where("DeleteFlag",0)
                            ->where("T_U_CUSTOMER.CustomerName","like","%".$_GET['serviceName']."%")
                            ->where("T_AS_USER.Department",$department)
                            ->where("T_AS_USER.id",$id)
                            ->count();
                    }else{
                        $datas=DB::table("T_U_CUSTOMER")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                            ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                            ->where("DeleteFlag",0)
                            ->where("T_AS_USER.Department",$department)
                            ->where("T_AS_USER.id",$id)
                            ->orderBy("created_at","desc")
                            ->paginate(20);
                        $counts=DB::table("T_U_CUSTOMER")
                            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                            ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                            ->where("DeleteFlag",0)
                            ->where("T_AS_USER.Department",$department)
                            ->where("T_AS_USER.id",$id)
                            ->count();
                    }
                }
                $number=$counts-20*($_GET['page']-1);
                foreach ($datas as $val){
                    $val->Number=$number;
                    $number--;
                }
            }else{
                $parts=DB::table("T_AS_USER")->where("Status",1)->where("id",$id)->pluck("Department");
                $department=$parts[0];
                $Name=$id;
                $serviceName="";
                $typeName="";
                $datas=DB::table("T_U_CUSTOMER")
                    ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                    ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                    ->where("DeleteFlag",0)
                    ->where("T_AS_USER.Department",$department)
                    ->where("T_AS_USER.id",$id)
                    ->orderBy("created_at","desc")
                    ->paginate(20);
                $counts=DB::table("T_U_CUSTOMER")
                    ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
                    ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
                    ->where("DeleteFlag",0)
                    ->where("T_AS_USER.Department",$department)
                    ->where("T_AS_USER.id",$id)
                    ->count();
                $number=$counts;
                foreach ($datas as $val){
                    $val->Number=$number;
                    $number--;
                }
            }
            $departs=DB::table("T_AS_USER")->where("Status",1)->where("id",$id)->pluck("Department");
            $Departments=array();
            foreach ($departs as $value){
                if(!in_array($value,$Departments)){
                    $Departments[]=$value;
                }
            }
            $Names=DB::table("T_AS_USER")->select("Name","id")->where("Status",1)->where("id",$id)->get();
        }

        return view("customer.index",compact("datas","Departments","Names","department","Name","typeName","serviceName"));
    }
    
    //添加客户信息
    public  function  add(){
        return view("customer.add");

    }
    //保存添加上的客户信息
    public  function  saveAdd(){
      
        if(!empty($_POST['CustomerNeed'])){
            $customerNeed=implode(";",$_POST['CustomerNeed']);
        }else{
            $customerNeed="";
        }
        if(!empty($_POST['ServiceType'])){
            $serviceType=implode(",",$_POST['ServiceType']);
        }else{
            $serviceType="";
        }
        $PictureArr=array();
        $PictureArr["PictureDes1"]=!empty($_POST['PictureDes1']) ? $_POST['PictureDes1'] : null;
        $PictureArr["PictureDes2"]=!empty($_POST['PictureDes2']) ? $_POST['PictureDes2'] : null;
        $PictureArr["PictureDes3"]=!empty($_POST['PictureDes3']) ? $_POST['PictureDes3'] : null;
        $PictureArr["PictureDes4"]=!empty($_POST['PictureDes4']) ? $_POST['PictureDes4'] : null;
        $PictureArr["PictureDes5"]=!empty($_POST['PictureDes5']) ? $_POST['PictureDes5'] : null;
        if(!empty($PictureArr)){
            $arr=array();
            foreach ($PictureArr as $value){
                if(!empty($value)){
                    $arr[]=$value;
                }
            }
            $pictureDes1=implode(",",$arr);
        }else{
            $pictureDes1="";
        }
        if(!empty($_POST['ProArea'])){
            $proArea=implode(",",$_POST['ProArea']);
        }else{
            $proArea="";
        }
        $accendantId=Session::get("userId");
        $result=DB::table("T_U_CUSTOMER")->insertGetId([
            "CustomerName"=>!empty($_POST['CustomerName']) ? $_POST['CustomerName'] : "",
            "Adress"=>!empty($_POST['Adress']) ? $_POST['Adress'] : "",
            "Size"=>!empty($_POST['Size']) ? $_POST['Size'] : "",
            "Money"=>!empty($_POST['Money']) ? $_POST['Money'] : "",
            "Describe"=>!empty($_POST['Describe']) ? $_POST['Describe'] : "",
            "ServiceType"=>$serviceType,
            "ProArea"=>$proArea,
            "PictureDes1"=>$pictureDes1,
            "WorkSpeed"=>!empty($_POST['WorkSpeed']) ? $_POST['WorkSpeed'] : "",
            "Speed"=>"",
            "CustLevel"=>!empty($_POST['CustLevel']) ? $_POST['CustLevel'] : "",
            "CustType"=>!empty($_POST['CustType']) ? $_POST['CustType'] : "",
            "Level"=>!empty($_POST['Level']) ? $_POST['Level'] : "",
            "AccendantID"=>$accendantId,
            "AssetList"=>!empty($_POST['AssetList']) ? $_POST['AssetList'] : "",
            "CustomerNeed"=>$customerNeed,
            "created_at"=>date("Y-m-d H:i:s",time()),
            "updated_at"=>date("Y-m-d H:i:s",time()),
        ]);
        if($result){
            if(!empty($_POST['addperson'])){
                foreach ($_POST['addperson'] as $value){
                    $adds=explode(",",$value);
                    $addArr=array();
                    foreach ($adds as $val ){
                        $add=explode(":",$val);
                        $addkeys=array();
                        $addkeys[$add[0]]=$add[1];
                        $addArr=array_merge($addArr,$addkeys);
                    }
                    $keyRes=DB::table("T_U_KEY")->insert([
                        "KeyName"=>!empty($addArr['KeyName']) ? $addArr['KeyName'] : "",
                        "KeySex"=>!empty($addArr['KeySex']) ? $addArr['KeySex'] : "",
                        "KeyAge"=>!empty($addArr['KeyAge']) ? $addArr['KeyAge'] : "",
                        "KeyWork"=>!empty($addArr['KeyWork']) ? $addArr['KeyWork'] : "",
                        "Birthday"=>!empty($addArr['Birthday']) ? $addArr['Birthday'] : "",
                        "PhoneNumber"=>!empty($addArr['PhoneNumber']) ? $addArr['PhoneNumber'] : "",
                        "Email"=>!empty($addArr['Email']) ? $addArr['Email'] : "" ,
                        "Chart"=>!empty($addArr['Chart']) ? $addArr['Chart'] : "",
                        "CustomerID"=>$result,
                        "created_at"=>date("Y-m-d H:i:s",time()),
                        "updated_at"=>date("Y-m-d H:i:s",time()),
                    ]);
                }
                if($result && $keyRes){
                    return redirect("customer/index");
                }else{
                    return back()->with("msg","添加客户失败,请您重新添加");
                }
            }else{
                if($result){
                    return redirect("customer/index");
                }else{
                    return back()->with("msg","添加客户失败,请您重新添加");
                }
            }
        }else{
            return back()->with("msg","添加客户失败,请您重新添加");
        }
    }

    //刪除客戶信息
    public  function delete($customer){
        $res=DB::table("T_U_CUSTOMER")->where("CustomerID",$customer)->update([
            "DeleteFlag"=>1,
            "updated_at"=>date("Y-m-d H:i:s",time()),
        ]);
        if($res){
            return redirect("customer/index");
        }

    }
    
    //客户公司中添加关键人
    public  function  addKey(){
        return view("customer/addKey");
    }
    
    //保存维护人添加的客户公司的关键人
    public  function saveKey(){
       $arr1=array();
        $arr2=array();
        foreach ($_POST as $value){
            $arr1[]=$value;
        }
    }

    //客户档案的详情页
    public  function  detail($customerId){
        $results=DB::table("T_U_CUSTOMER")
            ->leftJoin("T_AS_USER","T_AS_USER.id","=","T_U_CUSTOMER.AccendantID")
            ->select("T_U_CUSTOMER.*","T_AS_USER.Name","T_AS_USER.Department","T_AS_USER.id")
            ->where("DeleteFlag",0)
            ->where("T_U_CUSTOMER.CustomerID",$customerId)
            ->get();
        foreach ($results as $data){
            $data->ServiceType=explode(",",$data->ServiceType);
            $data->CustomerNeed=explode(";",$data->CustomerNeed);
            $data->ProArea=explode(",",$data->ProArea);
            if(!empty($data->PictureDes1)){
                $pictures=explode(",",$data->PictureDes1);
                $counts=count($pictures);
                foreach ($pictures as $val){
                    if($counts-1>=0){
                        $count=$counts;
                        $photos="PictureDes".$count;
                        $data->$photos=$val;
                    }
                    $counts=$counts-1;
                }
                $data->PictureDes1=isset($data->PictureDes1) ? $data->PictureDes1 : "";
                $data->PictureDes2=isset($data->PictureDes2) ? $data->PictureDes2 : "";
                $data->PictureDes3=isset($data->PictureDes3) ? $data->PictureDes3 : "";
                $data->PictureDes4=isset($data->PictureDes4) ? $data->PictureDes4 : "";
                $data->PictureDes5=isset($data->PictureDes5) ? $data->PictureDes5 : "";
            }else{
                $data->PictureDes1="";
                $data->PictureDes2="";
                $data->PictureDes3="";
                $data->PictureDes4="";
                $data->PictureDes5="";
            }
        }
        $keys=DB::table("T_U_KEY")->where("T_U_KEY.CustomerID",$customerId)->get();
        return view("customer/detail",compact("results","keys","customerId"));
    }

    //保存编辑的信息
    public  function  saveUpdate(){

        $accendantId=Session::get("userId");
        $authArr=array(1,11,17);
        if(in_array($accendantId,$authArr)){
            return redirect("customer/index");
        }
        $customerId=$_POST['customerId'];
        if(!empty($_POST['CustomerNeed'])){
            $customerNeed=implode(";",$_POST['CustomerNeed']);
        }else{
            $customerNeed="";
        }
        if(!empty($_POST['ServiceType'])){
            $serviceType=implode(",",$_POST['ServiceType']);
        }else{
            $serviceType="";
        }
        $PictureArr=array();
        $PictureArr["PictureDes1"]=!empty($_POST['PictureDes1']) ? $_POST['PictureDes1'] : null;
        $PictureArr["PictureDes2"]=!empty($_POST['PictureDes2']) ? $_POST['PictureDes2'] : null;
        $PictureArr["PictureDes3"]=!empty($_POST['PictureDes3']) ? $_POST['PictureDes3'] : null;
        $PictureArr["PictureDes4"]=!empty($_POST['PictureDes4']) ? $_POST['PictureDes4'] : null;
        $PictureArr["PictureDes5"]=!empty($_POST['PictureDes5']) ? $_POST['PictureDes5'] : null;
     if(!empty($PictureArr)){
         $arr=array();
         foreach ($PictureArr as $value){
             if(!empty($value)){
                 $arr[]=$value;
             }
         }
         $pictureDes1=implode(",",$arr);
     }else{
         $pictureDes1="";
     }

        if(!empty($_POST['ProArea'])){
            $proArea=implode(",",$_POST['ProArea']);
        }else{
            $proArea="";
        }
        $result=DB::table("T_U_CUSTOMER")->where("CustomerID",$customerId)->update([
            "CustomerName"=>!empty($_POST['CustomerName']) ? $_POST['CustomerName'] : "",
            "Adress"=>!empty($_POST['Adress']) ? $_POST['Adress'] : "",
            "Size"=>!empty($_POST['Size']) ? $_POST['Size'] : "",
            "Money"=>!empty($_POST['Money']) ? $_POST['Money'] : "",
            "Describe"=>!empty($_POST['Describe']) ? $_POST['Describe'] : "",
            "ServiceType"=>$serviceType,
            "ProArea"=>$proArea,
            "PictureDes1"=>$pictureDes1,
            "WorkSpeed"=>!empty($_POST['WorkSpeed']) ? $_POST['WorkSpeed'] : "",
            "Speed"=>"",
            "CustLevel"=>!empty($_POST['CustLevel']) ? $_POST['CustLevel'] : "",
            "CustType"=>!empty($_POST['CustType']) ? $_POST['CustType'] : "",
            "Level"=>!empty($_POST['Level']) ? $_POST['Level'] : "",
            "AccendantID"=>$accendantId,
            "CustomerNeed"=>$customerNeed,
            "updated_at"=>date("Y-m-d H:i:s",time()),
        ]);

        if(isset($_POST['addperson'])) {
            foreach ($_POST['addperson'] as $value) {
                $adds = explode(",", $value);
                $addArr = array();
                foreach ($adds as $val) {
                    $add = explode(":", $val);
                    $addkeys = array();
                    $addkeys[$add[0]] = $add[1];
                    $addArr = array_merge($addArr, $addkeys);
                }
                $keyRes = DB::table("T_U_KEY")->insert([
                    "KeyName"=>!empty($addArr['KeyName']) ? $addArr['KeyName'] : "",
                    "KeySex"=>!empty($addArr['KeySex']) ? $addArr['KeySex'] : "",
                    "KeyAge"=>!empty($addArr['KeyAge']) ? $addArr['KeyAge'] : "",
                    "KeyWork"=>!empty($addArr['KeyWork']) ? $addArr['KeyWork'] : "",
                    "Birthday"=>!empty($addArr['Birthday']) ? $addArr['Birthday'] : "",
                    "PhoneNumber"=>!empty($addArr['PhoneNumber']) ? $addArr['PhoneNumber'] : "",
                    "Email"=>!empty($addArr['Email']) ? $addArr['Email'] : "" ,
                    "Chart"=>!empty($addArr['Chart']) ? $addArr['Chart'] : "",
                    "CustomerID"=>$customerId,
                    "updated_at"=>date("Y-m-d H:i:s",time()),
                ]);
            }
        }
        if(!empty($_POST['saveperson'])){
            foreach($_POST['saveperson'] as $key=>$value){
                $updateRes=DB::table("T_U_KEY")->where("KeyID",$key)->update([
                    "KeyName"=>!empty($value['KeyName']) ? $value['KeyName'] : "",
                    "KeySex"=>!empty($value['KeySex']) ? $value['KeySex'] : "",
                    "KeyAge"=>!empty($value['KeyAge']) ? $value['KeyAge'] : "",
                    "KeyWork"=>!empty($value['KeyWork']) ? $value['KeyWork'] : "",
                    "Birthday"=>!empty($value['Birthday']) ? $value['Birthday'] : "",
                    "PhoneNumber"=>!empty($value['PhoneNumber']) ? $value['PhoneNumber'] : "",
                    "Email"=>!empty($value['Email']) ? $value['Email'] : "" ,
                    "Chart"=>!empty($value['Chart']) ? $value['Chart'] : "",
                    "CustomerID"=>$customerId,
                    "updated_at"=>date("Y-m-d H:i:s",time()),
                ]);
            }
            if($updateRes){
                return redirect("customer/index");
            }else{
                return back()->with("msg","添加客户失败,请您重新添加");
            }
        }else{
            if($result){
                return redirect("customer/index");
            }
        }
    }
}
