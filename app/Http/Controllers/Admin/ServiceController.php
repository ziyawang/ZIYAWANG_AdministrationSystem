<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

class ServiceController extends Controller
{
    //服务方列表
    public function index(){
        $stateWhere=$typeNameWhere=$provinceWhere=array();
        if(isset($_POST['_token'])){
                $state=$_POST['state'];
                $typeName=$_POST['typeName'];
                $province=$_POST['province'];
                $provinceWhere=$_POST['province']!="全国" ? array("ServiceArea","like","%.$province.%") : array();
                $typeNameWhere=$_POST['typeName']!=0 ? array("T_U_SERVICEINFO.ServiceType","like","%".$typeName."%") : array();
                $stateWhere=$_POST['state']!=3 ? array("T_P_SERVICECERTIFY.State"=>$state) :array();
            if($_POST['typeName']!=0){
                  if($_POST['province']!="全国"){
                      $datas=DB::table("T_U_SERVICEINFO")
                          ->leftjoin("T_P_SERVICECERTIFY","T_U_SERVICEINFO.ServiceID","=","T_P_SERVICECERTIFY.ServiceID")
                          ->select("T_U_SERVICEINFO.*","T_P_SERVICECERTIFY.State","T_P_SERVICECERTIFY.Remark")
                          ->where("ServiceArea","like","%".$province."%" )
                          ->where( "T_U_SERVICEINFO.ServiceType","like","%".$typeName."%")
                          ->where( $stateWhere)
                          ->orderBy("T_U_SERVICEINFO.ServiceID","desc")->paginate(20);
                  }else{
                      $datas=DB::table("T_U_SERVICEINFO")
                          ->leftjoin("T_P_SERVICECERTIFY","T_U_SERVICEINFO.ServiceID","=","T_P_SERVICECERTIFY.ServiceID")
                          ->select("T_U_SERVICEINFO.*","T_P_SERVICECERTIFY.State","T_P_SERVICECERTIFY.Remark")
                          ->where( "T_U_SERVICEINFO.ServiceType","like","%".$typeName."%")
                          ->where( $stateWhere)
                          ->orderBy("T_U_SERVICEINFO.ServiceID","desc")->paginate(20);
                  }

            }else {
                if ($_POST['province'] != "全国") {
                    $datas = DB::table("T_U_SERVICEINFO")
                        ->leftjoin("T_P_SERVICECERTIFY", "T_U_SERVICEINFO.ServiceID", "=", "T_P_SERVICECERTIFY.ServiceID")
                        ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark")
                        ->where("ServiceArea", "like", "%".$province."%")
                        ->where($stateWhere)
                        ->orderBy("T_U_SERVICEINFO.ServiceID", "desc")->paginate(20);
                }else{
                    $datas = DB::table("T_U_SERVICEINFO")
                        ->leftjoin("T_P_SERVICECERTIFY", "T_U_SERVICEINFO.ServiceID", "=", "T_P_SERVICECERTIFY.ServiceID")
                        ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark")
                        ->where($stateWhere)
                        ->orderBy("T_U_SERVICEINFO.ServiceID", "desc")->paginate(20);
                }
            }
                $db=array();
                foreach ($datas as $data){
                    $serviceTypes=$data->ServiceType;
                    $serviceType=explode(",",$serviceTypes);

                    $types=DB::table("T_P_PROJECTTYPE")->select("TypeName")
                        ->whereIn("TypeID",$serviceType)
                        ->get();
                    $arr=array();
                    foreach($types as $value){
                        $arr[]=$value->TypeName;
                    }
                    $type=implode(",",$arr);
                    $data->ServiceType=$type;
                    $db[]=$data;
                }
                $results=DB::table("T_P_PROJECTTYPE")->get();
                return view("members/service/index",compact('datas','db',"results","state","typeName","province"));
        }
         $datas=DB::table("T_U_SERVICEINFO")
             ->leftjoin("T_P_SERVICECERTIFY","T_U_SERVICEINFO.ServiceID","=","T_P_SERVICECERTIFY.ServiceID")
             ->select("T_U_SERVICEINFO.*","T_P_SERVICECERTIFY.State","T_P_SERVICECERTIFY.Remark")
             ->orderBy("T_U_SERVICEINFO.ServiceID","desc")->paginate(20);

            $db=array();
            foreach ($datas as $data){
                $serviceTypes=$data->ServiceType;
                $serviceType=explode(",",$serviceTypes);

                $types=DB::table("T_P_PROJECTTYPE")->select("TypeName")
                    ->whereIn("TypeID",$serviceType)
                    ->get();
                $arr=array();
                foreach($types as $value){
                    $arr[]=$value->TypeName;
                }
                $type=implode(",",$arr);
                $data->ServiceType=$type;
                $db[]=$data;
            }
            $results=DB::table("T_P_PROJECTTYPE")->get();
            return view("members/service/index",compact('datas','db',"results"));
    }

    //服务方详情
    public function detail($id){
        $array=DB::table("T_U_SERVICEINFO")
            ->leftjoin("T_P_SERVICECERTIFY","T_U_SERVICEINFO.ServiceID","=","T_P_SERVICECERTIFY.ServiceID")
            ->where("T_U_SERVICEINFO.ServiceID",$id)
            ->get();
        $datas=array();
        foreach ($array as $data){
            $serviceTypes=$data->ServiceType;
            $serviceType=explode(",",$serviceTypes);

            $types=DB::table("T_P_PROJECTTYPE")->select("TypeName")
                ->whereIn("TypeID",$serviceType)
                ->get();
            $arr=array();
            foreach($types as $value){
                $arr[]=$value->TypeName;
            }
            $type=implode(",",$arr);
            $data->ServiceType=$type;
            $datas[]=$data;
        }
      
        return view("members/service/detail",compact('datas',"id"));
    }
    //导出
    public function export(){
        set_time_limit(0);
        ini_set('memory_limit', '512M');
        $stateWhere=$typeNameWhere=$provinceWhere=array();
            $state=$_GET['state'];
            $typeName=$_GET['type'];
            $province=$_GET['province'];
            $provinceWhere=$_GET['province']!="全国" ? array("ServiceArea","like","%.$province.%") : array();
            $typeNameWhere=$_GET['type']!=0 ? array("T_U_SERVICEINFO.ServiceType","like","%".$typeName."%") : array();
            $stateWhere=$_GET['state']!=3 ? array("T_P_SERVICECERTIFY.State"=>$state) :array();
            if($_GET['type']!=0){
                if($_GET['province']!="全国"){
                    $datas=DB::table("T_U_SERVICEINFO")
                        ->leftjoin("T_P_SERVICECERTIFY","T_U_SERVICEINFO.ServiceID","=","T_P_SERVICECERTIFY.ServiceID")
                        ->select("T_U_SERVICEINFO.*","T_P_SERVICECERTIFY.State","T_P_SERVICECERTIFY.Remark")
                        ->where("ServiceArea","like","%".$province."%" )
                        ->where( "T_U_SERVICEINFO.ServiceType","like","%".$typeName."%")
                        ->where( $stateWhere)
                       ->get();
                }else{
                    $datas=DB::table("T_U_SERVICEINFO")
                        ->leftjoin("T_P_SERVICECERTIFY","T_U_SERVICEINFO.ServiceID","=","T_P_SERVICECERTIFY.ServiceID")
                        ->select("T_U_SERVICEINFO.*","T_P_SERVICECERTIFY.State","T_P_SERVICECERTIFY.Remark")
                        ->where( "T_U_SERVICEINFO.ServiceType","like","%".$typeName."%")
                        ->where( $stateWhere)
                        ->get();
                }

            }else {
                if ($_GET['province'] != "全国") {
                    $datas = DB::table("T_U_SERVICEINFO")
                        ->leftjoin("T_P_SERVICECERTIFY", "T_U_SERVICEINFO.ServiceID", "=", "T_P_SERVICECERTIFY.ServiceID")
                        ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark")
                        ->where("ServiceArea", "like", "%".$province."%")
                        ->where($stateWhere)
                        ->get();
                }else{
                    $datas = DB::table("T_U_SERVICEINFO")
                        ->leftjoin("T_P_SERVICECERTIFY", "T_U_SERVICEINFO.ServiceID", "=", "T_P_SERVICECERTIFY.ServiceID")
                        ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark")
                        ->where($stateWhere)
                        ->get();
                }
            }
            $db=array();
            foreach ($datas as $data){
                $serviceTypes=$data->ServiceType;
                $serviceType=explode(",",$serviceTypes);

                $types=DB::table("T_P_PROJECTTYPE")->select("TypeName")
                    ->whereIn("TypeID",$serviceType)
                    ->get();
                $arr=array();
                foreach($types as $value){
                    $arr[]=$value->TypeName;
                }
                $type=implode(",",$arr);
                $data->ServiceType=$type;
                $db[]=$data;
            }
        require_once '../vendor/PHPExcel.class.php';
        require_once '../vendor/PHPExcel/IOFactory.php';
        require_once '../vendor/PHPExcel/Reader/Excel5.php';

        $phpExcel = new \PHPExcel();
        //var_dump($phpExcel);die;
        $excel_name = '资芽网服务方信息' . date("Y-m-d", time());
        $phpExcel->setActiveSheetIndex(0);
        $phpExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $phpExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);

        $phpExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '公司')
            ->setCellValue('B1', '联系方式')
            ->setCellValue('C1', '地址')
            ->setCellValue('D1', '服务类型')
           ->setCellValue('E1', '服务地区')
           ->setCellValue('F1', '审核状态');
        foreach ($datas as $key => $data) {
            if ($data->State == 0) {
                $status = "拒审核";
            } elseif ($data->State == 1) {
                $status = "待审核";
            } else {
                $status = "已审核";
            }
            $i = $key + 2;
            $phpExcel->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $data->ServiceName)
                ->setCellValue('B' . $i, $data->ConnectPhone)
                ->setCellValue('C' . $i, $data->ServiceLocation)
                ->setCellValue('D' . $i, $data->ServiceType)
                ->setCellValue('E' . $i, $data->ServiceArea)
                ->setCellValue('F' . $i, $status);
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
    //保存编辑的信息
    public function update(){
        $result=DB::table("T_P_SERVICECERTIFY")->where("ServiceID",$_POST['id'])->update([
            "State"=>$_POST['state'],
            "Remark"=>$_POST['remark'],
            'updated_at'=>date("Y-m-d H:i:s", time())
        ]);
        if( $result){
            return Redirect::to("service/index");
        }else{
            return Redirect::to("service/detail/".$_POST['id']);
        }
    }

    //服务方上传图片
    public function upload(){
        $file = Input::file('Filedata');
        $clientName = $file->getClientOriginalName();//获取文件名
        $tmpName = $file->getFileName();//获取临时文件名
        $realPath = $file->getRealPath();//缓存文件的绝对路径
        $extension = $file->getClientOriginalExtension();//获取文件的后缀
        $mimeType = $file->getMimeType();//文件类型
        $newName = time(). mt_rand(1000,9999). '.'. $extension;//新文件名
        $path = $file->move(dirname(base_path()).'/ziyaupload/images/services/',$newName);//移动绝对路径
        $filePath = '/services/'.$newName;//存入数据库的相对路径
        return $filePath;
    }
    //服务方图片删除处理
    public function handle(){
        $id=$_POST['data'];
        $title=$_POST['title'];
        $db=DB::table("T_U_SERVICEINFO")->where("ServiceID",$id)->update([
            $title=>0,
            'updated_at'=>date("Y-m-d H:i:s", time())
        ]);
        if($db){
           $data= array("state"=>1);
        }else{
            $data=array("state"=>0);
        }
        return json_encode($data);
    }
    //服务方图片上传插入数据库
    public function editHandle(){
        $id=$_POST['id'];
        $data=$_POST['data'];
        $title=$_POST['title'];
        $db=DB::table("T_U_SERVICEINFO")->where("ServiceID",$id)->update([
            $title=>$data,
            'updated_at'=>date("Y-m-d H:i:s", time())
        ]);
        if($db){
            $res=array("state"=>1);
        }else{
            $res=array("state"=>0);
        }
        return json_encode($res);
    }
 }
