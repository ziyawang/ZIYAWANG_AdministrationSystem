<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PublishController extends Controller
{
    //发不方列表
    public  function index(){
        $stateWhere=$typeNameWhere=array();
        if(isset($_POST["_token"])){
            $state=$_POST['state'];
            $typeName=$_POST['typeName'];
            $typeNameWhere=$_POST['typeName']!=0 ? array("T_P_PROJECTTYPE.TypeID"=>$_POST['typeName']) : array();
            $stateWhere=$_POST['state']!=2 ? array("Status"=>$state) :array();
            $results=DB::table("T_P_PROJECTTYPE")->get();
            $datas=DB::table("users")->leftJoin("T_P_PROJECTINFO","users.userid","=","T_P_PROJECTINFO.UserID")
                ->leftJoin("T_P_PROJECTTYPE","T_P_PROJECTTYPE.TypeID","=","T_P_PROJECTINFO.TypeID")
                ->select("users.*","T_P_PROJECTTYPE.TypeName")
                ->where($stateWhere)->where($typeNameWhere)->orderBy("created_at","desc")->paginate(20);
            return view("members/publish/index",compact("datas","state","results","typeName"));

        }
        $datas=DB::table("users")->leftJoin("T_P_PROJECTINFO","users.userid","=","T_P_PROJECTINFO.UserID")
                ->leftJoin("T_P_PROJECTTYPE","T_P_PROJECTTYPE.TypeID","=","T_P_PROJECTINFO.TypeID")
                ->select("users.*","T_P_PROJECTTYPE.TypeName")
               ->orderBy("created_at","desc")->paginate(20);
        $results=DB::table("T_P_PROJECTTYPE")->get();
        return view("members/publish/index",compact("datas","results"));
    }
    //详情
    public function  detail($id){
        $db=DB::table("users")->where("userid",$id)->get();

        return view("members/publish/detail",compact('db'));

    }

    //导出
    public function export(){
            set_time_limit(0);
            ini_set('memory_limit', '512M');
            $stateWhere=$typeNameWhere=array();
            $typeName=$_GET['type'];
            $state=$_GET['state'];

            $state=$_GET['state'];
            $typeName=$_GET['type'];
            $typeNameWhere=$_GET['type']!=0 ? array("T_P_PROJECTTYPE.TypeID"=>$_GET['type']) : array();
            $stateWhere=$_GET['state']!=2 ? array("Status"=>$state) :array();
            $results=DB::table("T_P_PROJECTTYPE")->get();
            $datas=DB::table("users")->leftJoin("T_P_PROJECTINFO","users.userid","=","T_P_PROJECTINFO.UserID")
                ->leftJoin("T_P_PROJECTTYPE","T_P_PROJECTTYPE.TypeID","=","T_P_PROJECTINFO.TypeID")
                ->select("users.*","T_P_PROJECTTYPE.TypeName")
                ->where($stateWhere)->where($typeNameWhere)
                ->get();
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
    //发布方编辑信息保存
    public function update(){

        $db= DB::table("users")->where("userid",$_POST['id'])->update([
            "Status"=>$_POST['status'],
            "Remark"=>$_POST["remark"],
             'updated_at'=>date("Y-m-d H:i:s", time()),
        ]);
        if($db){
             return Redirect::to("publish/index");
        }else{
           return Redirect::to("publish/detail/".$_POST['id']);
        }
    }
 

}
