<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class CheckController extends Controller
{   //审核信息展示
    public function index(){
        if(isset($_POST['_token'])){
            $state=$_POST['state'];
            $typeName=$_POST['typeName'];
            $province=$_POST['province'];
            $provinceWhere=$_POST['province']!="全国" ? array("ProArea"=>$province) : array();
            $typeNameWhere=$_POST['typeName']!=0 ? array("T_P_PROJECTINFO.TypeID"=>$typeName) : array();
            $stateWhere=$_POST['state']!=3 ? array("T_P_PROJECTCERTIFY.State"=>$state) : array();
            if($_POST['province']!="全国"){
                $datas = DB::table("T_P_PROJECTINFO")
                    ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")
                    ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")
                    ->leftjoin("T_P_PROJECTCERTIFY","T_P_PROJECTCERTIFY.ProjectID","=","T_P_PROJECTINFO.ProjectID")
                    ->select("T_P_PROJECTINFO.*","users.phonenumber","T_P_PROJECTTYPE.TypeName","T_P_PROJECTCERTIFY.Remark","T_P_PROJECTCERTIFY.State","T_P_PROJECTTYPE.TypeID")
                    ->where("ProArea","like","%".$province."%")
                    ->where( $typeNameWhere)
                    ->where( $stateWhere)
                    ->orderBy("T_P_PROJECTINFO.ProjectID", "desc")->paginate(20);
            }else{
                $datas = DB::table("T_P_PROJECTINFO")
                    ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")
                    ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")
                    ->leftjoin("T_P_PROJECTCERTIFY","T_P_PROJECTCERTIFY.ProjectID","=","T_P_PROJECTINFO.ProjectID")
                    ->select("T_P_PROJECTINFO.*","users.phonenumber","T_P_PROJECTTYPE.TypeName","T_P_PROJECTCERTIFY.Remark","T_P_PROJECTCERTIFY.State","T_P_PROJECTTYPE.TypeID")
                    ->where( $typeNameWhere)
                    ->where( $stateWhere)
                    ->orderBy("T_P_PROJECTINFO.ProjectID", "desc")->paginate(20);
            }

            $results=DB::table("T_P_PROJECTTYPE")->get();
            return view("members/check/index", compact("datas","results","state","typeName","province"));
        }

        $datas = DB::table("T_P_PROJECTINFO")
            ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")
            ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")
            ->leftjoin("T_P_PROJECTCERTIFY","T_P_PROJECTCERTIFY.ProjectID","=","T_P_PROJECTINFO.ProjectID")
            ->select("T_P_PROJECTINFO.*","users.phonenumber","T_P_PROJECTTYPE.TypeName","T_P_PROJECTCERTIFY.Remark","T_P_PROJECTCERTIFY.State","T_P_PROJECTTYPE.TypeID")
            ->orderBy("T_P_PROJECTINFO.ProjectID", "desc")->paginate(20);
            $results=DB::table("T_P_PROJECTTYPE")->get();
        return view("members/check/index", compact("datas","results"));
    }
  //审核信息详情
    public function detail($id,$typeId){
        switch ($typeId){
            case "1":
                    $datas = DB::table("T_P_PROJECTINFO")
                        ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")
                        ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")
                        ->leftJoin("T_P_SPEC01","T_P_PROJECTINFO.ProjectID","=","T_P_SPEC01.ProjectID")
                        ->select("T_P_PROJECTINFO.*","users.phonenumber","T_P_PROJECTTYPE.TypeName","T_P_SPEC01.*")
                        ->where("T_P_PROJECTINFO.ProjectID",$id)
                        ->get();
                       return view("members/check/detail", compact('datas',"id"));
            break;
            case "2":
                    $datas = DB::table("T_P_PROJECTINFO")
                        ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")
                        ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")
                        ->leftJoin("T_P_SPEC02","T_P_PROJECTINFO.ProjectID","=","T_P_SPEC02.ProjectID")
                        ->select("T_P_PROJECTINFO.*","users.phonenumber","T_P_PROJECTTYPE.TypeName","T_P_SPEC02.*")
                        ->where("T_P_PROJECTINFO.ProjectID",$id)
                        ->get();
                    return view("members/check/releaseinfo_1", compact('datas',"id"));
            break;
            case "3":
                    $datas = DB::table("T_P_PROJECTINFO")
                        ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")
                        ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")
                        ->leftJoin("T_P_SPEC03","T_P_PROJECTINFO.ProjectID","=","T_P_SPEC03.ProjectID")
                        ->select("T_P_PROJECTINFO.*","users.phonenumber","T_P_PROJECTTYPE.TypeName","T_P_SPEC03.*")
                        ->where("T_P_PROJECTINFO.ProjectID",$id)
                        ->get();
                    return view("members/check/releaseinfo_2", compact('datas',"id"));
            break;
            case "4":
                    $datas = DB::table("T_P_PROJECTINFO")
                        ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")
                        ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")
                        ->leftJoin("T_P_SPEC04","T_P_PROJECTINFO.ProjectID","=","T_P_SPEC04.ProjectID")
                        ->select("T_P_PROJECTINFO.*","users.phonenumber","T_P_PROJECTTYPE.TypeName","T_P_SPEC04.*")
                        ->where("T_P_PROJECTINFO.ProjectID",$id)
                        ->get();
                    return view("members/check/releaseinfo_3", compact('datas',"id"));
            break;
            case "5":
                    $datas = DB::table("T_P_PROJECTINFO")
                        ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")
                        ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")
                        ->leftJoin("T_P_SPEC05","T_P_PROJECTINFO.ProjectID","=","T_P_SPEC05.ProjectID")
                        ->select("T_P_PROJECTINFO.*","users.phonenumber","T_P_PROJECTTYPE.TypeName","T_P_SPEC05.*")
                        ->where("T_P_PROJECTINFO.ProjectID",$id)
                        ->get();
                    return view("members/check/releaseinfo_4", compact('datas',"id"));
            break;
            case "6":
                $datas = DB::table("T_P_PROJECTINFO")
                    ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")
                    ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")
                    ->leftJoin("T_P_SPEC06","T_P_PROJECTINFO.ProjectID","=","T_P_SPEC06.ProjectID")
                    ->select("T_P_PROJECTINFO.*","users.phonenumber","T_P_PROJECTTYPE.TypeName","T_P_SPEC06.*")
                    ->where("T_P_PROJECTINFO.ProjectID",$id)
                    ->get();
                return view("members/check/releaseinfo_5", compact('datas',"id"));
            break;
            case "9":
                $datas = DB::table("T_P_PROJECTINFO")
                    ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")
                    ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")
                    ->leftJoin("T_P_SPEC09","T_P_PROJECTINFO.ProjectID","=","T_P_SPEC09.ProjectID")
                    ->select("T_P_PROJECTINFO.*","users.phonenumber","T_P_PROJECTTYPE.TypeName","T_P_SPEC09.*")
                    ->where("T_P_PROJECTINFO.ProjectID",$id)
                    ->get();
                return view("members/check/releaseinfo_6", compact('datas',"id"));
            break;
            case "10":
                $datas = DB::table("T_P_PROJECTINFO")
                    ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")
                    ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")
                    ->leftJoin("T_P_SPEC10","T_P_PROJECTINFO.ProjectID","=","T_P_SPEC10.ProjectID")
                    ->select("T_P_PROJECTINFO.*","users.phonenumber","T_P_PROJECTTYPE.TypeName","T_P_SPEC10.*")
                    ->where("T_P_PROJECTINFO.ProjectID",$id)
                    ->get();
                return view("members/check/releaseinfo_7", compact('datas',"id"));
            break;
            case "12":
                $datas = DB::table("T_P_PROJECTINFO")
                    ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")
                    ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")
                    ->leftJoin("T_P_SPEC12","T_P_PROJECTINFO.ProjectID","=","T_P_SPEC12.ProjectID")
                    ->select("T_P_PROJECTINFO.*","users.phonenumber","T_P_PROJECTTYPE.TypeName","T_P_SPEC12.*")
                    ->where("T_P_PROJECTINFO.ProjectID",$id)
                    ->get();
                return view("members/check/releaseinfo_8", compact('datas',"id"));
            break;
            case "13":
                $datas = DB::table("T_P_PROJECTINFO")
                    ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")
                    ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")
                    ->leftJoin("T_P_SPEC13","T_P_PROJECTINFO.ProjectID","=","T_P_SPEC13.ProjectID")
                    ->select("T_P_PROJECTINFO.*","users.phonenumber","T_P_PROJECTTYPE.TypeName","T_P_SPEC13.*")
                    ->where("T_P_PROJECTINFO.ProjectID",$id)
                    ->get();
                return view("members/check/releaseinfo_9", compact('datas',"id"));
            break;
            case "14":
                $datas = DB::table("T_P_PROJECTINFO")
                    ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")
                    ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")
                    ->leftJoin("T_P_SPEC14","T_P_PROJECTINFO.ProjectID","=","T_P_SPEC14.ProjectID")
                    ->select("T_P_PROJECTINFO.*","users.phonenumber","T_P_PROJECTTYPE.TypeName","T_P_SPEC14.*")
                    ->where("T_P_PROJECTINFO.ProjectID",$id)
                    ->get();
                return view("members/check/releaseinfo_10", compact('datas',"id"));
            break;

        }

    }
    //导出
    public function export()
    {
        set_time_limit(0);
        ini_set('memory_limit', '512M');
            $state=$_GET['state'];
            $typeName=$_GET['type'];
            $province=$_GET['province'];
            $provinceWhere=$_GET['province']!="全国" ? array("ProArea"=>$province) : array();
            $typeNameWhere=$_GET['type']!=0 ? array("T_P_PROJECTINFO.TypeID"=>$typeName) : array();
            $stateWhere=$_GET['state']!=3 ? array("T_P_PROJECTCERTIFY.State"=>$state) :array();
            $datas = DB::table("T_P_PROJECTINFO")
                ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")
                ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")
                ->leftjoin("T_P_PROJECTCERTIFY","T_P_PROJECTCERTIFY.ProjectID","=","T_P_PROJECTINFO.ProjectID")
                ->select("T_P_PROJECTINFO.*","users.phonenumber","T_P_PROJECTTYPE.TypeName","T_P_PROJECTCERTIFY.Remark","T_P_PROJECTCERTIFY.State")
                ->where($provinceWhere)
                ->where( $typeNameWhere)
                ->where( $stateWhere)
                ->get();

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
                ->setCellValue('A' . $i, "'".$data->phonenumber)
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
    //编辑信息详情
    public function update(){
        $db=DB::table("T_P_PROJECTINFO")->where("T_P_PROJECTINFO.ProjectID",$_POST['id'])
            ->update([
                "CertifyState"=>$_POST['state'],
                'updated_at'=>date("Y-m-d H:i:s", time())
            ]);
        $remark= !empty($_POST['remark']) ? $_POST['remark'] : "";
        $result=DB::table("T_P_PROJECTCERTIFY")->where("ProjectID",$_POST['id'])->update([
            "state"=>$_POST['state'],
            "Remark"=>$remark,
            'updated_at'=>date("Y-m-d H:i:s", time())
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
        $newName = time(). mt_rand(1000,9999). '.'. $extension;//新文件名
//       $path = $file->move(base_path().'/public/upload/images/',$newName);//移动绝对路径
//       $filePath = '/upload/images/'.$newName;//存入数据库的相对路径
        $path = $file->move(dirname(base_path()).'/ziyaupload/images/checks/',$newName);//移动绝对路径
        $filePath = '/checks/'.$newName;//存入数据库的相对路径
        return $filePath;
    }
    //审核删除照片
    public function handle(){
        $id=$_POST['data'];
        $title=$_POST['title'];
        $db=DB::table("T_P_PROJECTINFO")->where("ProjectID",$id)->update([
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
    //处理上传的照片
    public function editHandle(){
        $id=$_POST['id'];
        $data=$_POST['data'];
        $title=$_POST['title'];
        $db=DB::table("T_P_PROJECTINFO")->where("ProjectID",$id)->update([
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