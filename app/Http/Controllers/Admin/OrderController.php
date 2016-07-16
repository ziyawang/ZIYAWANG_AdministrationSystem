<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    public  function index(){

        $datas=DB::table("t_p_rushproject")
            ->leftjoin("t_u_serviceinfo","t_u_serviceinfo.ServiceID","=","t_p_rushproject.ServiceID")
            ->leftjoin("t_p_projectinfo","t_p_rushproject.ProjectID","=","t_p_projectinfo.ProjectID")
            ->leftjoin("t_p_projecttype","t_p_projectinfo.TypeID","=","t_p_projecttype.TypeID")
            ->leftjoin("users","t_p_projectinfo.UserID","=","users.userid")
            ->select("t_p_rushproject.*","t_u_serviceinfo.ServiceName","t_p_projecttype.TypeName","users.phonenumber")
            ->where("CooperateFlag",1)
            ->orderBy("RushProID","desc")
            ->get();
        //var_dump($datas);die;
        return  view("together/order/index",compact("datas"));
    }
    public function detail($id){
        $datas=DB::table("t_p_rushproject")
            ->leftjoin("t_u_serviceinfo","t_u_serviceinfo.ServiceID","=","t_p_rushproject.ServiceID")
            ->leftjoin("t_p_projectinfo","t_p_rushproject.ProjectID","=","t_p_projectinfo.ProjectID")
            ->leftjoin("t_p_projecttype","t_p_projectinfo.TypeID","=","t_p_projecttype.TypeID")
            ->leftjoin("users","t_p_projectinfo.UserID","=","users.userid")
            ->select("t_p_rushproject.*","t_u_serviceinfo.ServiceName","t_p_projecttype.TypeName","users.phonenumber")
            ->where("t_p_rushproject.RushProID",$id)
            ->get();

        return view("together/order/detail",compact("datas"));
    }

    public  function export(){
        set_time_limit(0);
        ini_set('memory_limit', '512M');
        $datas=DB::table("t_p_rushproject")
            ->leftjoin("t_u_serviceinfo","t_u_serviceinfo.ServiceID","=","t_p_rushproject.ServiceID")
            ->leftjoin("t_p_projectinfo","t_p_rushproject.ProjectID","=","t_p_projectinfo.ProjectID")
            ->leftjoin("t_p_projecttype","t_p_projectinfo.TypeID","=","t_p_projecttype.TypeID")
            ->leftjoin("users","t_p_projectinfo.UserID","=","users.userid")
            ->select("t_p_rushproject.*","t_u_serviceinfo.ServiceName","t_p_projecttype.TypeName","users.phonenumber")
            ->where("CooperateFlag",1)
            ->orderBy("RushProID","desc")
            ->get();
//var_dump($_SERVER['DOCUMENT_ROOT']);die;
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

       foreach ($datas as $key=>$data){
           if($data->CooperateFlag==0){
               $status="拒审核";
           }elseif($data->CooperateFlag==1){
               $status="待审核";
           }else{
               $status="已审核";
           }
           $i=$key+2;
           $phpExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i,$data->TypeName)//订单号
                    ->setCellValue('B'.$i,$data->phonenumber)
                    ->setCellValue('C'.$i,$data->ServiceName)
                    ->setCellValue('D'.$i,$data->RushTime)
                    ->setCellValue('E'.$i, $status);
               }
        $objWriter =\PHPExcel_IOFactory::createWriter($phpExcel, 'Excel5');
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
//设置http协议，下载支持
        header("Content-Type:application/force-download");
//设置下载的内容是excel
        header("Content-Type:application/vnd.ms-execl");
//把下载的内容设置为8机制流内容
        header("Content-Type:application/octet-stream");
//设置http协议，下载支持
        header("Content-Type:application/download");
//下载excel名字的定义
        header('Content-Disposition:attachment;filename='.$excel_name.".xls");
//内容设置为二进制形式传输
        header("Content-Transfer-Encoding:binary");
//把excel文件直接提供为下载形式

        $objWriter->save('php://output');
    }

}
