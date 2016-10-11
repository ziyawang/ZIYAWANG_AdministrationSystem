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
        $this->lastData();
        $date = date("Ymd", time());
        $path = '/var/www/html/ziyaapi/storage/logs/data/' . $date . '.log';
        // $contents=unserialize($contents);
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
        // var_dump($contents);die;
        foreach ($contents as $value) {
            // var_dump($value['phonenumber']);die;
            if ($value) {
                $time = date("Y-m-d H:i:s", $value['time']);
                $counts = DB::table("T_M_RECORD")->where(['PhoneNumber' => $value['phonenumber'], "LoginTime" => $time])->count();
                if (!$counts) {
                    $inserts = DB::table("T_M_RECORD")->insert([
                        "PhoneNumber" => $value['phonenumber'],
                        "LoginTime" => $time,
                        "IP" => $value['ip']
                    ]);
                }
            }
        }
        if(isset($_POST['_token'])){
            if(!empty($_POST["longTime"]) && !empty($_POST['shortTime'])){
                $longTime=$_POST['longTime'];
                $shortTime=$_POST['shortTime'];
                $results = DB::table("T_M_RECORD")->select("PhoneNumber")->whereBetween("LoginTime",[$shortTime,$longTime])->get();
            }else{
                $longTime="";
                $shortTime="";
                $results = DB::table("T_M_RECORD")->select("PhoneNumber")->get();
            }
        } elseif(!empty($_GET)){
            if(!empty($_GET['longTime']) && !empty($_GET['shortTime'])){
                $longTime=$_GET['longTime'];
                $shortTime=$_GET['shortTime'];
                $results = DB::table("T_M_RECORD")->select("PhoneNumber")->whereBetween("LoginTime",[$shortTime,$longTime])->get();
            }else{
                $longTime="";
                $shortTime="";
                $results = DB::table("T_M_RECORD")->select("PhoneNumber")->get();
             }
        }else{
            $longTime="";
            $shortTime="";
            $results = DB::table("T_M_RECORD")->select("PhoneNumber")->get();
        }

            $dbs = array();
            foreach ($results as $result) {
                $phoneNumber = $result->PhoneNumber;
                if (in_array($phoneNumber, $dbs)) {
                    continue;
                } else {
                    $dbs[] = $phoneNumber;
                }
            }
            if(isset($_POST['_token'])){
                $serviceName=!empty($_POST['serviceName']) ? $_POST['serviceName'] : "";
                if(!empty($_POST['serviceName'])){
                    $datas = DB::table("users")
                        ->leftJoin("T_U_SERVICEINFO","users.userid","=","T_U_SERVICEINFO.UserID")
                        ->where("ServiceName","like","%".$serviceName."%")
                        ->whereIn("phonenumber", $dbs)
                        ->paginate(20);
                }else{
                    $datas = DB::table("users")
                        ->leftJoin("T_U_SERVICEINFO","users.userid","=","T_U_SERVICEINFO.UserID")
                        ->whereIn("phonenumber", $dbs)
                        ->paginate(20);
                }
            }elseif(!empty($_GET)){
                $serviceName=!empty($_GET['serviceName']) ? $_GET['serviceName'] : "";
                if(!empty($_GET['serviceName'])){
                    $datas = DB::table("users")
                        ->leftJoin("T_U_SERVICEINFO","users.userid","=","T_U_SERVICEINFO.UserID")
                        ->where('serviceName',"like","%".$serviceName."%")
                        ->whereIn("phonenumber", $dbs)
                        ->paginate(20);
                }else{
                    $serviceName="";
                    $datas = DB::table("users")
                        ->leftJoin("T_U_SERVICEINFO","users.userid","=","T_U_SERVICEINFO.UserID")
                        ->whereIn("phonenumber", $dbs)
                        ->paginate(20);
                }
            }else{
                $serviceName="";
                $datas = DB::table("users")
                    ->leftJoin("T_U_SERVICEINFO","users.userid","=","T_U_SERVICEINFO.UserID")
                    ->whereIn("phonenumber", $dbs)
                    ->paginate(20);
            }

            foreach ($dbs as $db) {
                $counts = DB::table("T_M_RECORD")->where("PhoneNumber", $db)->count();
                $lastLogin = DB::table("T_M_RECORD")->select("LoginTime")->where("PhoneNumber", $db)->orderBy("LoginTime", "desc")->take(1)->get();
                foreach ($lastLogin as $value) {
                    $lastLogin = $value->LoginTime;
                }
                foreach ($datas as $data) {
                    if ($data->phonenumber == $db) {
                        $data->counts = $counts;
                        $data->lastLogin = $lastLogin;
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
    public function lastData()
        {
            $date = date("Ymd", time() - 60 * 60 * 24);
            $path = '/var/www/html/ziyaapi/storage/logs/data/' . $date . '.log';
            // $contents=unserialize($contents);
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
            // var_dump($contents);die;
            foreach ($contents as $value) {
                // var_dump($value['phonenumber']);die;
                if ($value) {
                    $time = date("Y-m-d H:i:s", $value['time']);
                    $counts = DB::table("T_M_RECORD")->where(['PhoneNumber' => $value['phonenumber'], "LoginTime" => $time])->count();
                    if (!$counts) {
                        $results = DB::table("T_M_RECORD")->insert([
                            "PhoneNumber" => $value['phonenumber'],
                            "LoginTime" => $time,
                            "IP" => $value['ip']
                        ]);
                    }
                }
            }
        }
    
    //用户登录平台的详细行为
    public function detail($phoneNumber){
            $datas = DB::table("T_M_RECORD")->where("PhoneNumber", $phoneNumber)->orderBy("LoginTime", "desc")->paginate(20);
            return view("data/detail", compact("datas"));
        }
    
    //用户行为中部分数据的导出功能
    public function export(){
        set_time_limit(0);
        ini_set('memory_limit', '512M');
        $this->lastData();
        $date = date("Ymd", time());
        $path = '/var/www/html/ziyaapi/storage/logs/data/' . $date . '.log';
        // $contents=unserialize($contents);
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
        // var_dump($contents);die;
        foreach ($contents as $value) {
            // var_dump($value['phonenumber']);die;
            if ($value) {
                $time = date("Y-m-d H:i:s", $value['time']);
                $counts = DB::table("T_M_RECORD")->where(['PhoneNumber' => $value['phonenumber'], "LoginTime" => $time])->count();
                if (!$counts) {
                    $inserts = DB::table("T_M_RECORD")->insert([
                        "PhoneNumber" => $value['phonenumber'],
                        "LoginTime" => $time,
                        "IP" => $value['ip']
                    ]);
                }
            }
        }
        if(!empty($_GET)){
            if(!empty($_GET['longTime']) && !empty($_GET['shortTime'])){
                $longTime=$_GET['longTime'];
                $shortTime=$_GET['shortTime'];
                $results = DB::table("T_M_RECORD")->select("PhoneNumber")->whereBetween("LoginTime",[$shortTime,$longTime])->get();
            }else{
                $longTime="";
                $shortTime="";
                $results = DB::table("T_M_RECORD")->select("PhoneNumber")->get();
            }
        }else{
            $longTime="";
           $shortTime="";
           $results = DB::table("T_M_RECORD")->select("PhoneNumber")->get();
        }
        $dbs = array();
        foreach ($results as $result) {
            $phoneNumber = $result->PhoneNumber;
            if (in_array($phoneNumber, $dbs)) {
                continue;
            } else {
                $dbs[] = $phoneNumber;
            }
        }
        if(!empty($_GET)){
            $serviceName=!empty($_GET['serviceName']) ? $_GET['serviceName'] : "";
            if(!empty($_GET['serviceName'])){
                $datas = DB::table("users")
                    ->leftJoin("T_U_SERVICEINFO","users.userid","=","T_U_SERVICEINFO.UserID")
                    ->where('serviceName',"like","%".$serviceName."%")
                    ->whereIn("phonenumber", $dbs)
                    ->get();
            }else{
                $serviceName="";
                $datas = DB::table("users")
                    ->leftJoin("T_U_SERVICEINFO","users.userid","=","T_U_SERVICEINFO.UserID")
                    ->whereIn("phonenumber", $dbs)
                    ->get();
            }
        }else{
            $serviceName="";
            $datas = DB::table("users")
                ->leftJoin("T_U_SERVICEINFO","users.userid","=","T_U_SERVICEINFO.UserID")
                ->whereIn("phonenumber", $dbs)
                ->get();
        }
        foreach ($dbs as $db) {
            $counts = DB::table("T_M_RECORD")->where("PhoneNumber", $db)->count();
            $lastLogin = DB::table("T_M_RECORD")->select("LoginTime")->where("PhoneNumber", $db)->orderBy("LoginTime", "desc")->take(1)->get();
            foreach ($lastLogin as $value) {
                $lastLogin = $value->LoginTime;
            }
            foreach ($datas as $data) {
                if ($data->phonenumber == $db) {
                    $data->counts = $counts;
                    $data->lastLogin = $lastLogin;
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
        $phpExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '注册手机')
            ->setCellValue('B1', '角色')
            ->setCellValue('C1', '公司名称')
            ->setCellValue('D1', '登录次数')
            ->setCellValue('E1', '服务类型')
            ->setCellValue('F1', '最后登录');
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
                ->setCellValue('D' . $i, $data->counts)
                ->setCellValue('E' . $i, $data->ServiceType)
                ->setCellValue('F' . $i, $data->lastLogin);

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
            ->orderBy("FBTime","desc")->paginate(20);
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
}