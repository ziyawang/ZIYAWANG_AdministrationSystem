<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CheckController extends Controller
{
    public function index()
    {
        $datas = DB::table("T_P_PROJECTINFO")
            ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")
            ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")
            ->select("T_P_PROJECTINFO.*","users.phonenumber","T_P_PROJECTTYPE.TypeName")
            ->orderBy("T_P_PROJECTINFO.ProjectID", "desc")->paginate(2);
        return view("members/check/index", compact("datas"));
    }

    public function detail($id)
    {
        $datas = DB::table("T_P_PROJECTINFO")
            ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")
            ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")
            ->select("T_P_PROJECTINFO.*","users.phonenumber","T_P_PROJECTTYPE.TypeName")
            ->where("T_P_PROJECTINFO.ProjectID",$id)
            ->orderBy("T_P_PROJECTINFO.ProjectID", "desc")->get();
       
        return view("members/check/detail", compact('datas'));
    }

    public function export()
    {
        set_time_limit(0);
        ini_set('memory_limit', '512M');
        $datas = DB::table("T_P_PROJECTINFO")
            ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")
            ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")
            ->select("T_P_PROJECTINFO.*","users.phonenumber","T_P_PROJECTTYPE.TypeName")
            ->orderBy("T_P_PROJECTINFO.ProjectID", "desc")
            ->get();
//var_dump($_SERVER['DOCUMENT_ROOT']);die;获取根目录
        require_once '../vendor/PHPExcel.class.php';
        require_once '../vendor/PHPExcel/IOFactory.php';
        require_once '../vendor/PHPExcel/Reader/Excel5.php';

        $phpExcel = new \PHPExcel();
        //var_dump($phpExcel);die;
        $excel_name = '资芽网审核发布信息' . date("Y-m-d", time());
        $phpExcel->setActiveSheetIndex(0);
        $phpExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $phpExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);

        $phpExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '联系方式')
            ->setCellValue('B1', '发布时间')
            ->setCellValue('C1', '地址')
            ->setCellValue('D1', '服务类型')
            ->setCellValue('E1', '审核状态');
        foreach ($datas as $key => $data) {
            if ($data->PublishState == 0) {
                $status = "拒审核";
            } elseif ($data->PublishState== 1) {
                $status = "待审核";
            } else {
                $status = "已审核";
            }
            $i = $key + 2;
            $phpExcel->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $data->phonenumber)
                ->setCellValue('B' . $i, $data->PublishTime)
                ->setCellValue('C' . $i, $data->ProArea)
                ->setCellValue('D' . $i, $data->TypeName)
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

    public function update(){
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