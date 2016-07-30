<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    //订单列表
    public function index()
    {
        if(isset($_POST['_token']) && !empty($_POST['typeName'])){
            $typeName=$_POST['typeName'];
            $results=DB::table("T_P_PROJECTTYPE")->get();
            $datas = DB::table("T_P_RUSHPROJECT")
                ->leftjoin("T_U_SERVICEINFO", "T_U_SERVICEINFO.ServiceID", "=", "T_P_RUSHPROJECT.ServiceID")
                ->leftjoin("T_P_PROJECTINFO", "T_P_RUSHPROJECT.ProjectID", "=", "T_P_PROJECTINFO.ProjectID")
                ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")
                ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")
                ->select("T_P_RUSHPROJECT.*", "T_U_SERVICEINFO.ServiceName", "T_P_PROJECTTYPE.TypeName", "users.phonenumber")
                ->where("CooperateFlag", 1)
                ->where("T_P_PROJECTTYPE.TypeID",$typeName)
                ->orderBy("RushProID", "desc")
                ->paginate(20);
            //var_dump($datas);die;
            return view("together/order/index", compact("datas","results","typeName"));
        }
        $results=DB::table("T_P_PROJECTTYPE")->get();
        $datas = DB::table("T_P_RUSHPROJECT")
            ->leftjoin("T_U_SERVICEINFO", "T_U_SERVICEINFO.ServiceID", "=", "T_P_RUSHPROJECT.ServiceID")
            ->leftjoin("T_P_PROJECTINFO", "T_P_RUSHPROJECT.ProjectID", "=", "T_P_PROJECTINFO.ProjectID")
            ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")
            ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")
            ->select("T_P_RUSHPROJECT.*", "T_U_SERVICEINFO.ServiceName", "T_P_PROJECTTYPE.TypeName", "users.phonenumber")
            ->where("CooperateFlag", 1)
            ->orderBy("RushProID", "desc")
            ->paginate(20);
        //var_dump($datas);die;
        return view("together/order/index", compact("datas","results"));
    }
    //订单详情
    public function detail($id)
    {
        $datas = DB::table("T_P_RUSHPROJECT")
            ->leftjoin("T_U_SERVICEINFO", "T_U_SERVICEINFO.ServiceID", "=", "T_P_RUSHPROJECT.ServiceID")
            ->leftjoin("T_P_PROJECTINFO", "T_P_RUSHPROJECT.ProjectID", "=", "T_P_PROJECTINFO.ProjectID")
            ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")
            ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")
            ->select("T_P_RUSHPROJECT.*", "T_U_SERVICEINFO.ServiceName", "T_P_PROJECTTYPE.TypeName", "users.phonenumber")
            ->where("T_P_RUSHPROJECT.RushProID", $id)
            ->get();

        return view("together/order/detail", compact("datas","id"));
    }
    //导出订单
    public function export(){
            set_time_limit(0);
            ini_set('memory_limit', '512M');
            $typeName=$_GET['type'];
            if($typeName!=0){
                $datas = DB::table("T_P_RUSHPROJECT")
                        ->leftjoin("T_U_SERVICEINFO", "T_U_SERVICEINFO.ServiceID", "=", "T_P_RUSHPROJECT.ServiceID")
                        ->leftjoin("T_P_PROJECTINFO", "T_P_RUSHPROJECT.ProjectID", "=", "T_P_PROJECTINFO.ProjectID")
                        ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")
                        ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")
                        ->select("T_P_RUSHPROJECT.*", "T_U_SERVICEINFO.ServiceName", "T_P_PROJECTTYPE.TypeName", "users.phonenumber")
                        ->where("CooperateFlag", 1)
                        ->where("T_P_PROJECTTYPE.TypeID",$typeName)
                        ->get();
               }else{
                   $datas = DB::table("T_P_RUSHPROJECT")
                        ->leftjoin("T_U_SERVICEINFO", "T_U_SERVICEINFO.ServiceID", "=", "T_P_RUSHPROJECT.ServiceID")
                        ->leftjoin("T_P_PROJECTINFO", "T_P_RUSHPROJECT.ProjectID", "=", "T_P_PROJECTINFO.ProjectID")
                        ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")
                        ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")
                        ->select("T_P_RUSHPROJECT.*", "T_U_SERVICEINFO.ServiceName", "T_P_PROJECTTYPE.TypeName", "users.phonenumber")
                        ->where("CooperateFlag", 1)
                        ->get();
               }


             
            require_once '../vendor/PHPExcel.class.php';
            require_once '../vendor/PHPExcel/IOFactory.php';
            require_once '../vendor/PHPExcel/Reader/Excel5.php';

            $phpExcel = new \PHPExcel();
            //var_dump($phpExcel);die;
            $excel_name = '资芽网订单' . date("Y-m-d", time());
            $phpExcel->setActiveSheetIndex(0);
            $phpExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
            $phpExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);

            $phpExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', '服务类型')
                ->setCellValue('B1', '发布方')
                ->setCellValue('C1', '处置方名称')
                ->setCellValue('D1', '下单时间')
                ->setCellValue('E1', '订单状态');

            foreach ($datas as $key => $data) {
                if ($data->CooperateFlag == 0) {
                    $status = "拒审核";
                } elseif ($data->CooperateFlag == 1) {
                    $status = "待审核";
                } else {
                    $status = "已审核";
                }
                $i = $key + 2;
                $phpExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $data->TypeName)//订单号
                    ->setCellValue('B' . $i, $data->phonenumber)
                    ->setCellValue('C' . $i, $data->ServiceName)
                    ->setCellValue('D' . $i, $data->RushTime)
                    ->setCellValue('E' . $i, $status);
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

 

}
