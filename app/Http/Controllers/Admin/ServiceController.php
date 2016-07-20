<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ServiceController extends Controller
{
    public function index(){
     $datas=DB::table("T_U_SERVICEINFO")
         ->leftjoin("t_p_servicecertify","t_U_SERVICEINFO.ServiceID","=","t_p_servicecertify.ServiceID")
         ->select("t_U_SERVICEINFO.*","t_p_servicecertify.State")
         ->orderBy("t_U_SERVICEINFO.ServiceID","desc")->paginate(1);

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
        return view("members/service/index",compact('datas','db'));
    }


    public function detail($id){
        $array=DB::table("T_U_SERVICEINFO")
            ->leftjoin("t_p_servicecertify","T_U_SERVICEINFO.ServiceID","=","t_p_servicecertify.ServiceID")
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

    public function export()
    {
        set_time_limit(0);
        ini_set('memory_limit', '512M');
        $datas=DB::table("T_U_SERVICEINFO")
            ->leftjoin("t_p_servicecertify","t_U_SERVICEINFO.ServiceID","=","t_p_servicecertify.ServiceID")
            ->select("t_U_SERVICEINFO.*","t_p_servicecertify.State")
            ->orderBy("t_U_SERVICEINFO.ServiceID","desc")
            ->get();
//var_dump($_SERVER['DOCUMENT_ROOT']);die;获取根目录
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
    
    public function update(){
       // var_dump($_POST);die;
        $db=DB::table("T_U_SERVICEINFO")->where("ServiceID",$_POST['id'])
            ->update([

                "ServiceIntroduction"=>$_POST['remark']
            ]);
        $result=DB::table("t_p_servicecertify")->where("ServiceID",$_POST['id'])->update([
            "State"=>$_POST['state'],
        ]);
        if($db && $result){
            return Redirect::to("service/index");
        }else{
            return Redirect::to("service/detail/".$_POST['id']);
        }
    }
}
