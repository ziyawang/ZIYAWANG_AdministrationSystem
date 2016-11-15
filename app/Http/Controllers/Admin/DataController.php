<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    //获取log内容,并在后台展示
    public function index(){
        $path = '/var/www/html/ziyaapi/storage/logs/data/login.log';
        $fp = fopen($path, "r");
        if ($fp) {
            $contents = array();
            for ($i = 1; !feof($fp); $i++) {
                $content = unserialize(fgets($fp));
                $contents[] = $content;
            }

        } else {
            echo "打开文件失败";
        }
        fclose($fp);
        file_put_contents($path,"");
        foreach ($contents as $value) {
            if ($value) {
                $time = date("Y-m-d H:i:s", $value['time']);
                $counts = DB::table("T_M_RECORD")->where(['PhoneNumber' => $value['phonenumber'], "LoginTime" => $time])->count();
                if (!$counts) {
                    $inserts = DB::table("T_M_RECORD")->insert([
                        "PhoneNumber" => $value['phonenumber'],
                        "LoginTime" => $time,
                        "IP" => $value['ip'],
                        "Channel"=>$value['channel']
                    ]);
                }
            }
        }
        if(isset($_POST['_token'])){
            if(!empty($_POST["longTime"]) && !empty($_POST['shortTime'])){
                $longTimes=strtotime($_POST['longTime'])+24*60*60;
                $longTime=date("Y-m-d",$longTimes);
                $shortTime=$_POST['shortTime'];
                $results = DB::table("T_M_RECORD")->select("PhoneNumber","RecordID")->whereBetween("LoginTime",[$shortTime,$longTime])->orderBy("LoginTime","desc")->get();
                $longTime=$_POST['longTime'];
            }else{
                $longTime="";
                $shortTime="";
                $results = DB::table("T_M_RECORD")->select("PhoneNumber","RecordID")->orderBy("LoginTime","desc")->get();
            }
        } elseif(!empty($_GET)){
            if(!empty($_GET['longTime']) && !empty($_GET['shortTime'])){
                $longTimes=strtotime($_GET['longTime'])+24*60*60;
                $longTime=date("Y-m-d",$longTimes);
                $shortTime=$_GET['shortTime'];
                $results = DB::table("T_M_RECORD")->select("PhoneNumber","RecordID")->whereBetween("LoginTime",[$shortTime,$longTime])->orderBy("LoginTime","desc")->get();
                $longTime=$_GET['longTime'];
            }else{
                $longTime="";
                $shortTime="";
                $results = DB::table("T_M_RECORD")->select("PhoneNumber","RecordID")->orderBy("LoginTime","desc")->get();
             }
        }else{
            $longTime="";
            $shortTime="";
            $results = DB::table("T_M_RECORD")->select("PhoneNumber","RecordID")->orderBy("LoginTime","desc")->get();
        }

            $dbs = array();
            $recordIds=array();
            foreach ($results as $result) {
                $phoneNumber = $result->PhoneNumber;
                if (!in_array($phoneNumber, $dbs)) {
                    $dbs[] = $phoneNumber;
                    $recordIds[]=$result->RecordID;
                }
            }
            if(isset($_POST['_token'])){
                $serviceName=!empty($_POST['serviceName']) ? $_POST['serviceName'] : "";
                if(!empty($_POST['serviceName'])){
                    $datas = DB::table("T_M_RECORD")
                        ->leftJoin("users","users.phonenumber","=","T_M_RECORD.PhoneNumber")
                        ->leftJoin("T_U_SERVICEINFO","users.userid","=","T_U_SERVICEINFO.UserID")
                        ->select("users.username","users.phonenumber","T_U_SERVICEINFO.ServiceName","users.userid","T_U_SERVICEINFO.ServiceType","users.created_at","T_M_RECORD.*")
                        ->where("ServiceName","like","%".$serviceName."%")
                        ->whereIn("RecordID",  $recordIds)
                        ->orderBy("LoginTime","desc")
                        ->paginate(20);
                }else{
                    $datas = DB::table("T_M_RECORD")
                        ->leftJoin("users","users.phonenumber","=","T_M_RECORD.PhoneNumber")
                        ->leftJoin("T_U_SERVICEINFO","users.userid","=","T_U_SERVICEINFO.UserID")
                        ->select("users.username","users.phonenumber","T_U_SERVICEINFO.ServiceName","users.userid","T_U_SERVICEINFO.ServiceType","users.created_at","T_M_RECORD.*")
                        ->whereIn("RecordID",  $recordIds)
                        ->orderBy("LoginTime","desc")
                        ->paginate(20);
                }
            }elseif(!empty($_GET)){
                $serviceName=!empty($_GET['serviceName']) ? $_GET['serviceName'] : "";
                if(!empty($_GET['serviceName'])){
                    $datas = DB::table("T_M_RECORD")
                        ->leftJoin("users","users.phonenumber","=","T_M_RECORD.PhoneNumber")
                        ->leftJoin("T_U_SERVICEINFO","users.userid","=","T_U_SERVICEINFO.UserID")
                        ->select("users.username","users.phonenumber","T_U_SERVICEINFO.ServiceName","users.userid","T_U_SERVICEINFO.ServiceType","users.created_at","T_M_RECORD.*")
                        ->where('serviceName',"like","%".$serviceName."%")
                        ->whereIn("RecordID",  $recordIds)
                        ->orderBy("LoginTime","desc")
                        ->paginate(20);
                }else{
                    $serviceName="";
                    $datas = DB::table("T_M_RECORD")
                        ->leftJoin("users","users.phonenumber","=","T_M_RECORD.PhoneNumber")
                        ->leftJoin("T_U_SERVICEINFO","users.userid","=","T_U_SERVICEINFO.UserID")
                        ->select("users.username","users.phonenumber","T_U_SERVICEINFO.ServiceName","users.userid","T_U_SERVICEINFO.ServiceType","users.created_at","T_M_RECORD.*")
                        ->whereIn("RecordID",  $recordIds)
                        ->orderBy("LoginTime","desc")
                        ->paginate(20);
                }
            }else{
                $serviceName="";
                $datas = DB::table("T_M_RECORD")
                    ->leftJoin("users","users.phonenumber","=","T_M_RECORD.PhoneNumber")
                    ->leftJoin("T_U_SERVICEINFO","users.userid","=","T_U_SERVICEINFO.UserID")
                    ->select("users.username","users.phonenumber","T_U_SERVICEINFO.ServiceName","users.userid","T_U_SERVICEINFO.ServiceType","users.created_at","T_M_RECORD.*")
                    ->whereIn("RecordID",  $recordIds)
                    ->orderBy("LoginTime","desc")
                    ->paginate(20);
            }

            foreach ($dbs as $db) {
                if(!empty($shortTime) && !empty($longTime)){
                    $Time=date("Y-m-d",strtotime($longTime)+24*60*60);
                    $counts = DB::table("T_M_RECORD")->where("PhoneNumber", $db)->whereBetween("LoginTime",[$shortTime,$Time])->count();
                    $longTime=$longTime;
                }else{
                    $counts = DB::table("T_M_RECORD")->where("PhoneNumber", $db)->count();
                }

                foreach ($datas as $data) {
                    if ($data->phonenumber == $db) {
                        $data->counts = $counts;
                        $userId = $data->userid;
                        $results = DB::table("T_U_SERVICEINFO")->where('userid', $userId)->count();
                        $pubs = DB::table("T_P_PROJECTINFO")->where("userid", $userId)->count();
                        if ($results > 0) {
                            $data->role = 1;
                            $serviceTypes = $data->ServiceType;
                            $serviceType = explode(",", $serviceTypes);
                            $types = DB::table("T_P_PROJECTTYPE")->select("SerName")
                                    ->whereIn("TypeID", $serviceType)
                                    ->get();
                                $arr = array();
                                foreach ($types as $value) {
                                    $arr[] = $value->SerName;
                                }
                                $type = implode(",", $arr);
                                $data->ServiceType = $type;
                        } else if ($pubs > 0 && $results == 0) {
                            $data->role = 2;
                        } else {
                            $data->role = 0;
                        }
                    }
                }
            }
        return view("data/index", compact("datas","longTime","shortTime","serviceName"));
    }
    //上一天的数据
    public function view($userid)
        {
            $path = '/var/www/html/ziyaapi/storage/logs/data/check.log';
            $fp = fopen($path, "r");
            if ($fp) {
                $contents = array();
                for ($i = 1; !feof($fp); $i++) {
                    $content = unserialize(fgets($fp));
                    $contents[] = $content;
                }

            } else {
                echo "打开文件失败";
            }
            fclose($fp);
            file_put_contents($path,"");
            foreach ($contents as $value) {
                if ($value) {
                    $time = date("Y-m-d H:i:s", $value['time']);
                    $counts = DB::table("T_M_VIEW")->where(["UserID" => $value['userid'], "created_at" => $time])->count();
                    if (!$counts) {
                        $inserts = DB::table("T_M_VIEW")->insert([
                            "UserID" => $value['userid'],
                            "Type"=>$value['type'],
                            "ItemID"=>$value['itemid'],
                            "IP" => $value['ip'],
                            "created_at"=>$time
                        ]);
                    }
                }
            }
            $datas=DB::table("T_M_VIEW")->where("UserID",$userid)->orderBy("created_at","desc")->paginate(20);
            return view("data/view",compact('datas'));
            
            
        }
    
    //用户登录平台的详细行为
    public function detail($phoneNumber,$longTime,$shortTime){
        $longTimes=date("Y-m-d",strtotime($longTime)+24*60*60);
        $shortTimes=$shortTime;
            $datas = DB::table("T_M_RECORD")
                ->where("PhoneNumber", $phoneNumber)
                ->whereBetween("LoginTime",[$shortTimes,$longTimes])
                ->orderBy("LoginTime", "desc")
                ->paginate(20);
            return view("data/detail", compact("datas"));
        }
    //用户登录平台的详细行为
    public function countDetail($phoneNumber){
        $datas = DB::table("T_M_RECORD")
            ->where("PhoneNumber", $phoneNumber)
            ->orderBy("LoginTime", "desc")
            ->paginate(20);
        return view("data/detail", compact("datas"));
    }
    
    //用户行为中部分数据的导出功能
    public function export(){
        if(!empty($_GET)){
            if(!empty($_GET['longTime']) && !empty($_GET['shortTime'])){
                $longTimes=strtotime($_GET['longTime'])+24*60*60;
                $longTime=date("Y-m-d",$longTimes);
                $shortTime=$_GET['shortTime'];
                $results = DB::table("T_M_RECORD")->select("PhoneNumber","RecordID")->whereBetween("LoginTime",[$shortTime,$longTime])->orderBy("LoginTime","desc")->get();

            }else{
                $longTime="";
                $shortTime="";
                $results = DB::table("T_M_RECORD")->select("PhoneNumber","RecordID")->orderBy("LoginTime","desc")->get();
            }
        }else{
            $longTime="";
            $shortTime="";
            $results = DB::table("T_M_RECORD")->select("PhoneNumber","RecordID")->orderBy("LoginTime","desc")->get();
        }


        $recordIds=array();
        foreach ($results as $result) {
            $recordIds[]=$result->RecordID;
        }
        if(isset($_POST['_token'])){
            $serviceName=!empty($_POST['serviceName']) ? $_POST['serviceName'] : "";
            if(!empty($_POST['serviceName'])){
                $datas = DB::table("T_M_RECORD")
                    ->leftJoin("users","users.phonenumber","=","T_M_RECORD.PhoneNumber")
                    ->leftJoin("T_U_SERVICEINFO","users.userid","=","T_U_SERVICEINFO.UserID")
                    ->select("users.username","users.phonenumber","T_U_SERVICEINFO.ServiceName","users.userid","T_U_SERVICEINFO.ServiceType","users.created_at","T_M_RECORD.*")
                    ->where("ServiceName","like","%".$serviceName."%")
                    ->whereIn("RecordID",$recordIds)
                    ->orderBy("LoginTime","desc")
                    ->get();
            }else{
                $datas = DB::table("T_M_RECORD")
                    ->leftJoin("users","users.phonenumber","=","T_M_RECORD.PhoneNumber")
                    ->leftJoin("T_U_SERVICEINFO","users.userid","=","T_U_SERVICEINFO.UserID")
                    ->select("users.username","users.phonenumber","T_U_SERVICEINFO.ServiceName","users.userid","T_U_SERVICEINFO.ServiceType","users.created_at","T_M_RECORD.*")
                   ->whereIn("RecordID",$recordIds)
                    ->orderBy("LoginTime","desc")
                    ->get();
            }
        }elseif(!empty($_GET)){
            $serviceName=!empty($_GET['serviceName']) ? $_GET['serviceName'] : "";
            if(!empty($_GET['serviceName'])){
                $datas = DB::table("T_M_RECORD")
                    ->leftJoin("users","users.phonenumber","=","T_M_RECORD.PhoneNumber")
                    ->leftJoin("T_U_SERVICEINFO","users.userid","=","T_U_SERVICEINFO.UserID")
                    ->select("users.username","users.phonenumber","T_U_SERVICEINFO.ServiceName","users.userid","T_U_SERVICEINFO.ServiceType","users.created_at","T_M_RECORD.*")
                    ->where('serviceName',"like","%".$serviceName."%")
                    ->whereIn("RecordID",$recordIds)
                    ->orderBy("LoginTime","desc")
                    ->get();
            }else{
                $serviceName="";
                $datas = DB::table("T_M_RECORD")
                    ->leftJoin("users","users.phonenumber","=","T_M_RECORD.PhoneNumber")
                    ->leftJoin("T_U_SERVICEINFO","users.userid","=","T_U_SERVICEINFO.UserID")
                    ->select("users.username","users.phonenumber","T_U_SERVICEINFO.ServiceName","users.userid","T_U_SERVICEINFO.ServiceType","users.created_at","T_M_RECORD.*")
                    ->whereIn("RecordID",$recordIds)
                    ->orderBy("LoginTime","desc")
                    ->get();
            }
        }else{
            $serviceName="";
            $datas = DB::table("T_M_RECORD")
                ->leftJoin("users","users.phonenumber","=","T_M_RECORD.PhoneNumber")
                ->leftJoin("T_U_SERVICEINFO","users.userid","=","T_U_SERVICEINFO.UserID")
                ->select("users.username","users.phonenumber","T_U_SERVICEINFO.ServiceName","users.userid","T_U_SERVICEINFO.ServiceType","users.created_at","T_M_RECORD.*")
                ->whereIn("RecordID",$recordIds)
                ->orderBy("LoginTime","desc")
                ->get();
        }



            foreach ($datas as $data) {
                $userId = $data->userid;
                    $results = DB::table("T_U_SERVICEINFO")->where('userid', $userId)->count();
                    $pubs = DB::table("T_P_PROJECTINFO")->where("userid", $userId)->count();
                    if ($results > 0) {
                        $data->role = 1;
                        $serviceTypes = $data->ServiceType;
                        $serviceType = explode(",", $serviceTypes);
                        $types = DB::table("T_P_PROJECTTYPE")->select("SerName")
                            ->whereIn("TypeID", $serviceType)
                            ->get();
                        $arr = array();
                        foreach ($types as $value) {
                            $arr[] = $value->SerName;
                        }
                        $type = implode(",", $arr);
                        $data->ServiceType = $type;
                    } else if ($pubs > 0 && $results == 0) {
                        $data->role = 2;
                    } else {
                        $data->role = 0;
                    }

            }

        require_once '../vendor/PHPExcel.class.php';
        require_once '../vendor/PHPExcel/IOFactory.php';
        require_once '../vendor/PHPExcel/Reader/Excel5.php';

        $phpExcel = new \PHPExcel();
        //var_dump($phpExcel);die;
        $excel_name = '资芽网用户行为信息' . date("Y-m-d", time());
        $phpExcel->setActiveSheetIndex(0);
        $phpExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $phpExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $phpExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $phpExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $phpExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '注册手机')
            ->setCellValue('B1', '角色')
            ->setCellValue('C1', '公司名称')
            ->setCellValue('D1', '服务类型')
            ->setCellValue('E1', '注册时间')
            ->setCellValue('F1', '登录时间');
        foreach ($datas as $key => $data) {
            if($data->role==1){
                $role="服务方";
            }elseif($data->role==2){
                $role='发布方';
            }else{
                $role="注册";
            }
            $i = $key + 2;
            $phpExcel->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $data->phonenumber)
                ->setCellValue('B' . $i, $role)
                ->setCellValue('C' . $i, $data->ServiceName)
                ->setCellValue('D' . $i, $data->ServiceType)
                ->setCellValue('E' . $i, $data->created_at)
                ->setCellValue('F' . $i, $data->LoginTime);

        }
        $objWriter = \PHPExcel_IOFactory::createWriter($phpExcel, 'Excel5');
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
        header("Content-Type:application/force-download");
        header("Content-Type:application/vnd.ms-execl");
        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");
        header('Content-Disposition:attachment;filename=' . $excel_name . ".xls");
        header("Content-Transfer-Encoding:binary");
        $objWriter->save('php://output');
    }
    //用户反馈信息展示
    public function returnBack(){
        $datas=DB::table("T_U_FEEDBACK")
            ->leftJoin("users","T_U_FEEDBACK.userid","=","users.userid")
            ->orderBy("FBTime","desc")
            ->paginate(20);
        foreach($datas as $data){
            $userId=$data->userid;
            $results=DB::table("T_U_SERVICEINFO")->where('userid',$userId)->count();
            $pubs=DB::table("T_P_PROJECTINFO")->where("userid",$userId)->count();
            if($results>0){
                $data->role=1;
            }else if($pubs>0 && $results==0 ){
                $data->role=2;
            }else{
                $data->role=0;
            }
        }
        return view("data/returnBack",compact("datas"));
    }

    //ajax获取用户登录的数据
    public function getCounts()
    {
        $longTime = $_POST['longTime'];
        $shortTime = $_POST['shortTime'];
        $longTimes=date("Y-m-d",strtotime($longTime)+24*60*60);
        if (empty($longTime) && empty($longTime)) {
            $allCount = DB::table("T_M_RECORD")->count();
            $pcCount = DB::table("T_M_RECORD")->where("Channel", "PC")->count();
            $androadCount = DB::table("T_M_RECORD")->where("Channel", "ANDROID")->count();
            $iosCount = DB::table("T_M_RECORD")->where("Channel", "IOS")->count();
            $count["allCount"] = $allCount;
            $count['pcCount'] = $pcCount;
            $count['androadCount'] = $androadCount;
            $count['iosCount'] = $iosCount;
            return json_encode($count);
        } else {
            $allCount = DB::table("T_M_RECORD")->whereBetween("LoginTime", [$shortTime, $longTimes])->count();
            $pcCount = DB::table("T_M_RECORD")->where("Channel", "PC")->whereBetween("LoginTime", [$shortTime, $longTimes])->count();
            $androadCount = DB::table("T_M_RECORD")->where("Channel", "ANDROID")->whereBetween("LoginTime", [$shortTime, $longTimes])->count();
            $iosCount = DB::table("T_M_RECORD")->where("Channel", "IOS")->whereBetween("LoginTime", [$shortTime, $longTimes])->count();
            $count["allCount"] = $allCount;
            $count['pcCount'] = $pcCount;
            $count['androadCount'] = $androadCount;
            $count['iosCount'] = $iosCount;
            return json_encode($count);
        }

    }
}