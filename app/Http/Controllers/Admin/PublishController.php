<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PublishController extends Controller
{
    public  function index(){
        $datas=DB::table("users")->orderBy("userid","desc")->paginate(20);

        return view("members/publish/index",compact("datas"));
    }

    public function  detail($id){
        $db=DB::table("users")->where("userid",$id)->get();
       /* var_dump($data);
        die;*/
        return view("members/publish/detail",compact('db'));

    }


    public function export()
        {
            set_time_limit(0);
            ini_set('memory_limit', '512M');
            $datas=DB::table("users")->orderBy("userid","desc")
                ->get();
//var_dump($_SERVER['DOCUMENT_ROOT']);die;获取根目录
            require_once '../vendor/PHPExcel.class.php';
            require_once '../vendor/PHPExcel/IOFactory.php';
            require_once '../vendor/PHPExcel/Reader/Excel5.php';

            $phpExcel = new \PHPExcel();
            //var_dump($phpExcel);die;
            $excel_name = '资芽网发布方信息' . date("Y-m-d", time());
            $phpExcel->setActiveSheetIndex(0);
            $phpExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
            $phpExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);

            $phpExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', '姓名')
                ->setCellValue('B1', '注册手机')
                ->setCellValue('C1', '注册时间')
                ->setCellValue('D1', '当前状态');
        foreach ($datas as $key => $data) {
                if ($data->Status == 0) {
                    $status = "拒审核";
                } elseif ($data->Status == 1) {
                    $status = "待审核";
                } else {
                    $status = "已审核";
                }
                $i = $key + 2;
                $phpExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $data->username)
                    ->setCellValue('B' . $i, $data->phonenumber)
                    ->setCellValue('C' . $i, $data->created_at)
                    ->setCellValue('D' . $i, $status);
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

        $db= DB::table("users")->where("userid",$_POST['id'])->update([
            "Status"=>$_POST['status'],
            "Remark"=>$_POST["remark"]
        ]);
        if($db){
             return Redirect::to("publish/index");
        }else{
           return Redirect::to("publish/detail/".$_POST['id']);
        }
    }

}
