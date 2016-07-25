<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class CheckController extends Controller
{
    public function index()
    {
        if(isset($_POST['_token'])){
            $state=$_POST['state'];
            $typeName=$_POST['typeName'];
            $province=$_POST['province'];
            $provinceWhere=$_POST['province']!="全国" ? array("ProArea"=>$province) : array();
            $typeNameWhere=$_POST['typeName']!=0 ? array("T_P_PROJECTINFO.TypeID"=>$typeName) : array();
            $stateWhere=$_POST['state']!=3 ? array("T_P_PROJECTCERTIFY.State"=>$state) :array();
            $datas = DB::table("T_P_PROJECTINFO")
                ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")
                ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")
                ->leftjoin("T_P_PROJECTCERTIFY","T_P_PROJECTCERTIFY.ProjectID","=","T_P_PROJECTINFO.ProjectID")
                ->select("T_P_PROJECTINFO.*","users.phonenumber","T_P_PROJECTTYPE.TypeName","T_P_PROJECTCERTIFY.Remark","T_P_PROJECTCERTIFY.State")
                ->where($provinceWhere)
                ->where( $typeNameWhere)
                ->where( $stateWhere)
                ->orderBy("T_P_PROJECTINFO.ProjectID", "desc")->paginate(20);
            $results=DB::table("T_P_PROJECTTYPE")->get();
            return view("members/check/index", compact("datas","results","state","typeName","province"));
        }

        $datas = DB::table("T_P_PROJECTINFO")
            ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")
            ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")
            ->leftjoin("T_P_PROJECTCERTIFY","T_P_PROJECTCERTIFY.ProjectID","=","T_P_PROJECTINFO.ProjectID")
            ->select("T_P_PROJECTINFO.*","users.phonenumber","T_P_PROJECTTYPE.TypeName","T_P_PROJECTCERTIFY.Remark")
            ->orderBy("T_P_PROJECTINFO.ProjectID", "desc")->paginate(20);
            $results=DB::table("T_P_PROJECTTYPE")->get();
        return view("members/check/index", compact("datas","results"));
    }

    public function detail($id)
    {
        $datas = DB::table("T_P_PROJECTINFO")
            ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")
            ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")
            ->select("T_P_PROJECTINFO.*","users.phonenumber","T_P_PROJECTTYPE.TypeName")
            ->where("T_P_PROJECTINFO.ProjectID",$id)
            ->get();
       
        return view("members/check/detail", compact('datas',"id"));
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
        $db=DB::table("T_P_PROJECTINFO")->where("T_P_PROJECTINFO.ProjectID",$_POST['id'])
            ->update([
                "CertifyState"=>$_POST['state']
            ]);
        $remark= !empty($_POST['remark']) ? $_POST['remark'] : "";
        $result=DB::table("t_p_projectcertify")->where("ProjectID",$_POST['id'])->update([
            "state"=>$_POST['state'],
            "Remark"=>$remark
        ]);
        if($db && $result){
            return Redirect::to("check/index");
        }else{
            return Redirect::to("check/detail/".$_POST['id']);
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
        $newName = date('Ymd'). mt_rand(1000,9999). '.'. $extension;//新文件名
//       $path = $file->move(base_path().'/public/upload/images/',$newName);//移动绝对路径
//       $filePath = '/upload/images/'.$newName;//存入数据库的相对路径
        $path = $file->move(base_path().'/public/upload/imgs/',$newName);//移动绝对路径
        $filePath = '/upload/imgs/'.$newName;//存入数据库的相对路径
        return $filePath;
    }
    public function handle(){
        $id=$_POST['data'];
        $title=$_POST['title'];
        $db=DB::table("T_P_PROJECTINFO")->where("ProjectID",$id)->update([
            $title=>0,
        ]);
        if($db){
            $data= array("state"=>1);
        }else{
            $data=array("state"=>0);
        }
        return json_encode($data);
    }

    public function editHandle(){
        $id=$_POST['id'];
        $data=$_POST['data'];
        $title=$_POST['title'];
        $db=DB::table("T_P_PROJECTINFO")->where("ProjectID",$id)->update([
            $title=>$data,
        ]);
        if($db){
            $res=array("state"=>1);
        }else{
            $res=array("state"=>0);
        }
        return json_encode($res);
    }
}