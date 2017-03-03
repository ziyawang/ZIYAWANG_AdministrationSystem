<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class exportController extends Controller
{
    //数据展示首页
    public function index()
    {
        if (isset($_POST['_token'])) {
            $typeName = $_POST['typeName'];
            //$typeNameWhere = $_POST['typeName'] != 0 ? array("T_P_PROJECTINFO.TypeID" => $typeName) : array();
            if($typeName != 0 ){
                $typeNameWhere=explode(",",$typeName);
            }else{
                $typeNameWhere=array(1,6,12,16,17,18,19,20,21,22);
            }
            $datas = DB::table("T_P_PROJECTINFO")
                ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")
                ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")
                ->leftjoin("T_P_PROJECTCERTIFY", "T_P_PROJECTCERTIFY.ProjectID", "=", "T_P_PROJECTINFO.ProjectID")
                ->select("T_P_PROJECTINFO.*", "users.phonenumber", "T_P_PROJECTTYPE.TypeName", "T_P_PROJECTCERTIFY.Remark", "T_P_PROJECTCERTIFY.State", "T_P_PROJECTTYPE.TypeID", "users.userid")
                ->whereIn("T_P_PROJECTINFO.TypeID",$typeNameWhere)
                ->where("T_P_PROJECTCERTIFY.State", "1")
                ->where("T_P_PROJECTINFO.CertifyState", "<>", 3)
                ->orderBy("T_P_PROJECTINFO.ProjectID", "desc")->paginate(20);
            $number = 1;
            foreach ($datas as $data) {
                $channel = $data->Channel;
                switch ($channel) {
                    case "PC":
                        $data->Channel = "电脑";
                        break;
                    case "IOS":
                        $data->Channel = "苹果";
                        break;
                    case "ANDROID":
                        $data->Channel = "安卓";
                        break;
                }
                $projectId = $data->ProjectID;
                $data->number = $number;
                $counts = DB::table("T_P_RUSHPROJECT")->where("ProjectID", $projectId)->where("CooperateFlag", 0)->count();
                $data->counts = $counts;
                $number++;
            }
            $results = DB::table("T_P_PROJECTTYPE")->get();
            return view("export/index", compact("datas", "results", "typeName"));
        }
        if (!empty($_GET)) {
            $typeName = $_GET['typeName'];
           /* $typeNameWhere = $_GET['typeName'] != 0 ? array("T_P_PROJECTINFO.TypeID" => $typeName) : array();*/
            if($typeName != 0 ){
                $typeNameWhere=explode(",",$typeName);
            }else{
                $typeNameWhere=array(1,6,12,16,17,18,19,20,21,22);
            }
            $datas = DB::table("T_P_PROJECTINFO")
                ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")
                ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")
                ->leftjoin("T_P_PROJECTCERTIFY", "T_P_PROJECTCERTIFY.ProjectID", "=", "T_P_PROJECTINFO.ProjectID")
                ->select("T_P_PROJECTINFO.*", "users.phonenumber", "T_P_PROJECTTYPE.TypeName", "T_P_PROJECTCERTIFY.Remark", "T_P_PROJECTCERTIFY.State", "T_P_PROJECTTYPE.TypeID", "users.userid")
                ->whereIn("T_P_PROJECTINFO.TypeID",$typeNameWhere)
                ->where("T_P_PROJECTINFO.CertifyState", "<>", 3)
                ->where("T_P_PROJECTCERTIFY.State", "1")
                ->orderBy("T_P_PROJECTINFO.ProjectID", "desc")->paginate(20);
            $number = 1;
            foreach ($datas as $data) {
                $channel = $data->Channel;
                switch ($channel) {
                    case "PC":
                        $data->Channel = "电脑";
                        break;
                    case "IOS":
                        $data->Channel = "苹果";
                        break;
                    case "ANDROID":
                        $data->Channel = "安卓";
                        break;
                }
                $projectId = $data->ProjectID;
                $data->number = $number;
                $counts = DB::table("T_P_RUSHPROJECT")->where("ProjectID", $projectId)->where("CooperateFlag", 0)->count();
                $data->counts = $counts;
                $number++;
            }
            $results = DB::table("T_P_PROJECTTYPE")->get();
            return view("export/index", compact("datas", "results", "typeName"));
        }
        $typeName = 0;
        $province = "全国";
        $datas = DB::table("T_P_PROJECTINFO")
            ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")
            ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")
            ->leftjoin("T_P_PROJECTCERTIFY", "T_P_PROJECTCERTIFY.ProjectID", "=", "T_P_PROJECTINFO.ProjectID")
            ->select("T_P_PROJECTINFO.*", "users.phonenumber", "T_P_PROJECTTYPE.TypeName", "T_P_PROJECTCERTIFY.Remark", "T_P_PROJECTCERTIFY.State", "T_P_PROJECTTYPE.TypeID", "users.userid")
            ->where("T_P_PROJECTINFO.CertifyState", "<>", 3)
            ->orderBy("T_P_PROJECTINFO.ProjectID", "desc")->paginate(20);
        $number = 1;
        foreach ($datas as $data) {
            $channel = $data->Channel;
            switch ($channel) {
                case "PC":
                    $data->Channel = "电脑";
                    break;
                case "IOS":
                    $data->Channel = "苹果";
                    break;
                case "ANDROID":
                    $data->Channel = "安卓";
                    break;
            }
            $projectId = $data->ProjectID;
            $data->number = $number;
            $counts = DB::table("T_P_RUSHPROJECT")->where("ProjectID", $projectId)->where("CooperateFlag", 0)->count();
            $data->counts = $counts;
            $number++;
        }
        $results = DB::table("T_P_PROJECTTYPE")->get();
        return view("export/index", compact("datas", "results", "typeName"));
    }

    //根据类型导出所需数据
    public function export()
    {
        set_time_limit(0);
        ini_set('memory_limit', '512M');

        $typeName = $_GET['type'];
        if($typeName==0){
            return back()->with("msg","请您选择其中一种类型");
        }
        $types = DB::table("T_P_PROJECTTYPE")->select("TypeID", "TypeName")->whereIn("TypeID", [1,6,12,16,17,18,19,20,21,22])->get();
        $counts = array();
        foreach ($types as $type) {
            if ($typeName < 10) {
                $chart = "T_P_SPEC0" . $typeName;
            } else {
                $chart = "T_P_SPEC" . $typeName;
            }
            $datas = DB::table("T_P_PROJECTINFO")
                ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")
                ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")
                ->leftjoin("T_P_PROJECTCERTIFY", "T_P_PROJECTCERTIFY.ProjectID", "=", "T_P_PROJECTINFO.ProjectID")
                ->leftJoin($chart,$chart.".ProjectID","=","T_P_PROJECTINFO.ProjectID")
                ->select("T_P_PROJECTINFO.*", "users.phonenumber", "T_P_PROJECTTYPE.TypeName", "T_P_PROJECTCERTIFY.Remark", "T_P_PROJECTCERTIFY.State",$chart.".*")
                ->where("T_P_PROJECTINFO.TypeID",$typeName)
                ->where("T_P_PROJECTCERTIFY.State", "1")
                ->where("CertifyState", "<>", 3)
                ->get();
            foreach ($datas as $data) {
                $channel = $data->Channel;
                $publisher=$data->Publisher;
                switch ($channel) {
                    case "PC":
                        $data->Channel = "电脑";
                        break;
                    case "IOS":
                        $data->Channel = "苹果";
                        break;
                    case "ANDROID":
                        $data->Channel = "安卓";
                        break;
                }
                switch($publisher){
                    case 0:
                        $data->Publisher="自然发布";
                        break;
                    case 1:
                        $data->Publisher="委托发布";
                        break;
                }
                $publishState=$data->PublishState;
                if($publishState==0){
                    $data->PublishState="未合作";
                }else{
                    $data->PublishState="已合作";
                }
                $member=$data->Member;
                switch($member){
                    case 0:
                        $data->Member="普通信息";
                        break;
                    case 1:
                        $data->Member="VIP";
                        break;
                    case 2:
                        $data->Member="收费信息";
                        break;
                }


                $projectId = $data->ProjectID;
                $counts = DB::table("T_P_RUSHPROJECT")->where("ProjectID", $projectId)->where("CooperateFlag", 0)->count();
                $data->counts = $counts;

            }
            require_once '../vendor/PHPExcel.class.php';
            require_once '../vendor/PHPExcel/IOFactory.php';
            require_once '../vendor/PHPExcel/Reader/Excel5.php';

            $phpExcel = new \PHPExcel();
            //var_dump($phpExcel);die;
            $excel_name = '资芽网审核发布信息' . date("Y-m-d", time());
            $phpExcel->setActiveSheetIndex(0);
            $phpExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
            $phpExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
            switch($typeName) {
                case 1:
                    $phpExcel->setActiveSheetIndex(0)
                        ->setCellValue('A1', '联系方式')
                        ->setCellValue('B1', '发布时间')
                        ->setCellValue('C1', '地址')
                        ->setCellValue('D1', '信息类型')
                        ->setCellValue('E1', '浏览次数')
                        ->setCellValue('F1', '收藏次数')
                        ->setCellValue('G1', '约谈次数')
                        ->setCellValue('H1', '发布渠道')
                        ->setCellValue('I1', '发布方式')
                        ->setCellValue('J1', '信息等级')
                        ->setCellValue('K1', '合作状态')
                        ->setCellValue('L1', '资产包类型')
                        ->setCellValue('M1', '来源')
                        ->setCellValue('N1', '总价(单位/万)')
                        ->setCellValue('O1', '转让价(单位/万)');
                    foreach ($datas as $key => $data) {
                        $i = $key + 2;
                        $phpExcel->setActiveSheetIndex(0)
                            ->setCellValue('A' . $i, "'" . $data->phonenumber)
                            ->setCellValue('B' . $i, $data->PublishTime)
                            ->setCellValue('C' . $i, $data->ProArea)
                            ->setCellValue('D' . $i, $data->TypeName)
                            ->setCellValue('E' . $i, $data->ViewCount)
                            ->setCellValue('F' . $i, $data->CollectionCount)
                            ->setCellValue('G' . $i, $data->counts)
                            ->setCellValue('H' . $i, $data->Channel)
                            ->setCellValue('I' . $i, $data->Publisher)
                            ->setCellValue('J' . $i, $data->Member)
                            ->setCellValue('K' . $i, $data->PublishState)
                            ->setCellValue('L' . $i, $data->AssetType)
                            ->setCellValue('M' . $i, $data->FromWhere)
                            ->setCellValue('N' . $i, $data->TotalMoney)
                            ->setCellValue('O' . $i, $data->TransferMoney);
                    }
                    break;
                case 6:
                    $phpExcel->setActiveSheetIndex(0)
                        ->setCellValue('A1', '联系方式')
                        ->setCellValue('B1', '发布时间')
                        ->setCellValue('C1', '地址')
                        ->setCellValue('D1', '信息类型')
                        ->setCellValue('E1', '浏览次数')
                        ->setCellValue('F1', '收藏次数')
                        ->setCellValue('G1', '约谈次数')
                        ->setCellValue('H1', '发布渠道')
                        ->setCellValue('I1', '发布方式')
                        ->setCellValue('J1', '信息等级')
                        ->setCellValue('K1', '合作状态')
                        ->setCellValue('L1', '类型')
                        ->setCellValue('M1', '金额(单位/万)')
                        ->setCellValue('N1', '转让率(%)')
                        ->setCellValue('O1', '状态')
                        ->setCellValue('P1', '所属行业');
                    foreach ($datas as $key => $data) {
                        $i = $key + 2;
                        $phpExcel->setActiveSheetIndex(0)
                            ->setCellValue('A' . $i, "'" . $data->phonenumber)
                            ->setCellValue('B' . $i, $data->PublishTime)
                            ->setCellValue('C' . $i, $data->ProArea)
                            ->setCellValue('D' . $i, $data->TypeName)
                            ->setCellValue('E' . $i, $data->ViewCount)
                            ->setCellValue('F' . $i, $data->CollectionCount)
                            ->setCellValue('G' . $i, $data->counts)
                            ->setCellValue('H' . $i, $data->Channel)
                            ->setCellValue('I' . $i, $data->Publisher)
                            ->setCellValue('J' . $i, $data->Member)
                            ->setCellValue('K' . $i, $data->PublishState)
                            ->setCellValue('L' . $i, $data->AssetType)
                            ->setCellValue('M' . $i, $data->TotalMoney)
                            ->setCellValue('N' . $i, $data->Rate)
                            ->setCellValue('O' . $i, $data->Status)
                            ->setCellValue('P' . $i, $data->Belong);
                    }
                    break;
                case 12:
                    $phpExcel->setActiveSheetIndex(0)
                        ->setCellValue('A1', '联系方式')
                        ->setCellValue('B1', '发布时间')
                        ->setCellValue('C1', '地址')
                        ->setCellValue('D1', '信息类型')
                        ->setCellValue('E1', '浏览次数')
                        ->setCellValue('F1', '收藏次数')
                        ->setCellValue('G1', '约谈次数')
                        ->setCellValue('H1', '发布渠道')
                        ->setCellValue('I1', '发布方式')
                        ->setCellValue('J1', '信息等级')
                        ->setCellValue('K1', '合作状态')
                        ->setCellValue('L1', '类型')
                        ->setCellValue('M1', '市场价(单位/万)')
                        ->setCellValue('N1', '转让价(单位/万)');

                    foreach ($datas as $key => $data) {
                        $i = $key + 2;
                        $phpExcel->setActiveSheetIndex(0)
                            ->setCellValue('A' . $i, "'" . $data->phonenumber)
                            ->setCellValue('B' . $i, $data->PublishTime)
                            ->setCellValue('C' . $i, $data->ProArea)
                            ->setCellValue('D' . $i, $data->TypeName)
                            ->setCellValue('E' . $i, $data->ViewCount)
                            ->setCellValue('F' . $i, $data->CollectionCount)
                            ->setCellValue('G' . $i, $data->counts)
                            ->setCellValue('H' . $i, $data->Channel)
                            ->setCellValue('I' . $i, $data->Publisher)
                            ->setCellValue('J' . $i, $data->Member)
                            ->setCellValue('K' . $i, $data->PublishState)
                            ->setCellValue('L' . $i, $data->AssetType)
                            ->setCellValue('M' . $i, $data->MarketPrice)
                            ->setCellValue('N' . $i, $data->TransferMoney);
                    }
                    break;
                case 16:
                    $phpExcel->setActiveSheetIndex(0)
                        ->setCellValue('A1', '联系方式')
                        ->setCellValue('B1', '发布时间')
                        ->setCellValue('C1', '地址')
                        ->setCellValue('D1', '信息类型')
                        ->setCellValue('E1', '浏览次数')
                        ->setCellValue('F1', '收藏次数')
                        ->setCellValue('G1', '约谈次数')
                        ->setCellValue('H1', '发布渠道')
                        ->setCellValue('I1', '发布方式')
                        ->setCellValue('J1', '信息等级')
                        ->setCellValue('K1', '合作状态')
                        ->setCellValue('L1', '类型')
                        ->setCellValue('M1', '转让价(单位/万)');
                    foreach ($datas as $key => $data) {
                        $i = $key + 2;
                        $phpExcel->setActiveSheetIndex(0)
                            ->setCellValue('A' . $i, "'" . $data->phonenumber)
                            ->setCellValue('B' . $i, $data->PublishTime)
                            ->setCellValue('C' . $i, $data->ProArea)
                            ->setCellValue('D' . $i, $data->TypeName)
                            ->setCellValue('E' . $i, $data->ViewCount)
                            ->setCellValue('F' . $i, $data->CollectionCount)
                            ->setCellValue('G' . $i, $data->counts)
                            ->setCellValue('H' . $i, $data->Channel)
                            ->setCellValue('I' . $i, $data->Publisher)
                            ->setCellValue('J' . $i, $data->Member)
                            ->setCellValue('K' . $i, $data->PublishState)
                            ->setCellValue('L' . $i, $data->AssetType)
                            ->setCellValue('M' . $i, $data->TransferMoney);
                    }
                    break;
                case 17:
                    $phpExcel->setActiveSheetIndex(0)
                        ->setCellValue('A1', '联系方式')
                        ->setCellValue('B1', '发布时间')
                        ->setCellValue('C1', '地址')
                        ->setCellValue('D1', '信息类型')
                        ->setCellValue('E1', '浏览次数')
                        ->setCellValue('F1', '收藏次数')
                        ->setCellValue('G1', '约谈次数')
                        ->setCellValue('H1', '发布渠道')
                        ->setCellValue('I1', '发布方式')
                        ->setCellValue('J1', '信息等级')
                        ->setCellValue('K1', '合作状态')
                        ->setCellValue('L1', '类型')
                        ->setCellValue('M1', '担保方式')
                        ->setCellValue('N1', '融资金额(万)')
                        ->setCellValue('O1', '使用期限(月)');
                    foreach ($datas as $key => $data) {
                        $i = $key + 2;
                        $phpExcel->setActiveSheetIndex(0)
                            ->setCellValue('A' . $i, "'" . $data->phonenumber)
                            ->setCellValue('B' . $i, $data->PublishTime)
                            ->setCellValue('C' . $i, $data->ProArea)
                            ->setCellValue('D' . $i, $data->TypeName)
                            ->setCellValue('E' . $i, $data->ViewCount)
                            ->setCellValue('F' . $i, $data->CollectionCount)
                            ->setCellValue('G' . $i, $data->counts)
                            ->setCellValue('H' . $i, $data->Channel)
                            ->setCellValue('I' . $i, $data->Publisher)
                            ->setCellValue('J' . $i, $data->Member)
                            ->setCellValue('K' . $i, $data->PublishState)
                            ->setCellValue('L' . $i, $data->AssetType)
                            ->setCellValue('M' . $i, $data->Type)
                            ->setCellValue('N' . $i, $data->Money)
                            ->setCellValue('O' . $i, $data->Month);
                    }
                    break;
                case 18:
                    $phpExcel->setActiveSheetIndex(0)
                        ->setCellValue('A1', '联系方式')
                        ->setCellValue('B1', '发布时间')
                        ->setCellValue('C1', '地址')
                        ->setCellValue('D1', '信息类型')
                        ->setCellValue('E1', '浏览次数')
                        ->setCellValue('F1', '收藏次数')
                        ->setCellValue('G1', '约谈次数')
                        ->setCellValue('H1', '发布渠道')
                        ->setCellValue('I1', '发布方式')
                        ->setCellValue('J1', '信息等级')
                        ->setCellValue('K1', '合作状态')
                        ->setCellValue('L1', '商账类型')
                        ->setCellValue('M1', '债权金额(单位/万)')
                        ->setCellValue('N1', '过期时间')
                        ->setCellValue('O1', '企业性质');
                    foreach ($datas as $key => $data) {
                        $i = $key + 2;
                        $phpExcel->setActiveSheetIndex(0)
                            ->setCellValue('A' . $i, "'" . $data->phonenumber)
                            ->setCellValue('B' . $i, $data->PublishTime)
                            ->setCellValue('C' . $i, $data->ProArea)
                            ->setCellValue('D' . $i, $data->TypeName)
                            ->setCellValue('E' . $i, $data->ViewCount)
                            ->setCellValue('F' . $i, $data->CollectionCount)
                            ->setCellValue('G' . $i, $data->counts)
                            ->setCellValue('H' . $i, $data->Channel)
                            ->setCellValue('I' . $i, $data->Publisher)
                            ->setCellValue('J' . $i, $data->Member)
                            ->setCellValue('K' . $i, $data->PublishState)
                            ->setCellValue('L' . $i, $data->AssetType)
                            ->setCellValue('M' . $i, $data->Money)
                            ->setCellValue('N' . $i, $data->Month)
                            ->setCellValue('O' . $i, $data->Nature);

                    }
                    break;
                case 19:
                    $phpExcel->setActiveSheetIndex(0)
                        ->setCellValue('A1', '联系方式')
                        ->setCellValue('B1', '发布时间')
                        ->setCellValue('C1', '地址')
                        ->setCellValue('D1', '信息类型')
                        ->setCellValue('E1', '浏览次数')
                        ->setCellValue('F1', '收藏次数')
                        ->setCellValue('G1', '约谈次数')
                        ->setCellValue('H1', '发布渠道')
                        ->setCellValue('I1', '发布方式')
                        ->setCellValue('J1', '信息等级')
                        ->setCellValue('K1', '合作状态')
                        ->setCellValue('L1', '总金额(单位/万)')
                        ->setCellValue('M1', '逾期时间');
                    foreach ($datas as $key => $data) {
                        $i = $key + 2;
                        $phpExcel->setActiveSheetIndex(0)
                            ->setCellValue('A' . $i, "'" . $data->phonenumber)
                            ->setCellValue('B' . $i, $data->PublishTime)
                            ->setCellValue('C' . $i, $data->ProArea)
                            ->setCellValue('D' . $i, $data->TypeName)
                            ->setCellValue('E' . $i, $data->ViewCount)
                            ->setCellValue('F' . $i, $data->CollectionCount)
                            ->setCellValue('G' . $i, $data->counts)
                            ->setCellValue('H' . $i, $data->Channel)
                            ->setCellValue('I' . $i, $data->Publisher)
                            ->setCellValue('J' . $i, $data->Member)
                            ->setCellValue('K' . $i, $data->PublishState)
                            ->setCellValue('L' . $i, $data->TotalMoney)
                            ->setCellValue('M' . $i, $data->Month);

                    }
                    break;
                case 20:
                    $phpExcel->setActiveSheetIndex(0)
                        ->setCellValue('A1', '联系方式')
                        ->setCellValue('B1', '发布时间')
                        ->setCellValue('C1', '地址')
                        ->setCellValue('D1', '信息类型')
                        ->setCellValue('E1', '浏览次数')
                        ->setCellValue('F1', '收藏次数')
                        ->setCellValue('G1', '约谈次数')
                        ->setCellValue('H1', '发布渠道')
                        ->setCellValue('I1', '发布方式')
                        ->setCellValue('J1', '信息等级')
                        ->setCellValue('K1', '合作状态')
                        ->setCellValue('L1', '类型')
                        ->setCellValue('M1', '面积')
                        ->setCellValue('N1', '性质')
                        ->setCellValue('O1', '起拍价(单位/万)')
                        ->setCellValue('P1', '拍卖阶段');
                    foreach ($datas as $key => $data) {
                        $i = $key + 2;
                        $phpExcel->setActiveSheetIndex(0)
                            ->setCellValue('A' . $i, "'" . $data->phonenumber)
                            ->setCellValue('B' . $i, $data->PublishTime)
                            ->setCellValue('C' . $i, $data->ProArea)
                            ->setCellValue('D' . $i, $data->TypeName)
                            ->setCellValue('E' . $i, $data->ViewCount)
                            ->setCellValue('F' . $i, $data->CollectionCount)
                            ->setCellValue('G' . $i, $data->counts)
                            ->setCellValue('H' . $i, $data->Channel)
                            ->setCellValue('I' . $i, $data->Publisher)
                            ->setCellValue('J' . $i, $data->Member)
                            ->setCellValue('K' . $i, $data->PublishState)
                            ->setCellValue('L' . $i, $data->AssetType)
                            ->setCellValue('M' . $i, $data->Area)
                            ->setCellValue('N' . $i, $data->Nature)
                            ->setCellValue('O' . $i, $data->Money)
                            ->setCellValue('P' . $i, $data->State);
                    }
                    break;
                case 21:
                    $phpExcel->setActiveSheetIndex(0)
                        ->setCellValue('A1', '联系方式')
                        ->setCellValue('B1', '发布时间')
                        ->setCellValue('C1', '地址')
                        ->setCellValue('D1', '信息类型')
                        ->setCellValue('E1', '浏览次数')
                        ->setCellValue('F1', '收藏次数')
                        ->setCellValue('G1', '约谈次数')
                        ->setCellValue('H1', '发布渠道')
                        ->setCellValue('I1', '发布方式')
                        ->setCellValue('J1', '信息等级')
                        ->setCellValue('K1', '合作状态')
                        ->setCellValue('L1', '类型')
                        ->setCellValue('M1', '面积')
                        ->setCellValue('N1', '性质')
                        ->setCellValue('O1', '起拍价(单位/万)')
                        ->setCellValue('P1', '拍卖阶段');
                    foreach ($datas as $key => $data) {
                        $i = $key + 2;
                        $phpExcel->setActiveSheetIndex(0)
                            ->setCellValue('A' . $i, "'" . $data->phonenumber)
                            ->setCellValue('B' . $i, $data->PublishTime)
                            ->setCellValue('C' . $i, $data->ProArea)
                            ->setCellValue('D' . $i, $data->TypeName)
                            ->setCellValue('E' . $i, $data->ViewCount)
                            ->setCellValue('F' . $i, $data->CollectionCount)
                            ->setCellValue('G' . $i, $data->counts)
                            ->setCellValue('H' . $i, $data->Channel)
                            ->setCellValue('I' . $i, $data->Publisher)
                            ->setCellValue('J' . $i, $data->Member)
                            ->setCellValue('K' . $i, $data->PublishState)
                            ->setCellValue('L' . $i, $data->AssetType)
                            ->setCellValue('M' . $i, $data->Area)
                            ->setCellValue('N' . $i, $data->Nature)
                            ->setCellValue('O' . $i, $data->Money)
                            ->setCellValue('P' . $i, $data->State);
                    }
                    break;
                case 22:
                    $phpExcel->setActiveSheetIndex(0)
                        ->setCellValue('A1', '联系方式')
                        ->setCellValue('B1', '发布时间')
                        ->setCellValue('C1', '地址')
                        ->setCellValue('D1', '信息类型')
                        ->setCellValue('E1', '浏览次数')
                        ->setCellValue('F1', '收藏次数')
                        ->setCellValue('G1', '约谈次数')
                        ->setCellValue('H1', '发布渠道')
                        ->setCellValue('I1', '发布方式')
                        ->setCellValue('J1', '信息等级')
                        ->setCellValue('K1', '合作状态')
                        ->setCellValue('L1', '类型')
                        ->setCellValue('M1', '车牌号')
                        ->setCellValue('N1', '起拍价(单位/万)')
                        ->setCellValue('P1', '拍卖中');
                    foreach ($datas as $key => $data) {
                        $i = $key + 2;
                        $phpExcel->setActiveSheetIndex(0)
                            ->setCellValue('A' . $i, "'" . $data->phonenumber)
                            ->setCellValue('B' . $i, $data->PublishTime)
                            ->setCellValue('C' . $i, $data->ProArea)
                            ->setCellValue('D' . $i, $data->TypeName)
                            ->setCellValue('E' . $i, $data->ViewCount)
                            ->setCellValue('F' . $i, $data->CollectionCount)
                            ->setCellValue('G' . $i, $data->counts)
                            ->setCellValue('H' . $i, $data->Channel)
                            ->setCellValue('I' . $i, $data->Publisher)
                            ->setCellValue('J' . $i, $data->Member)
                            ->setCellValue('K' . $i, $data->PublishState)
                            ->setCellValue('L' . $i, $data->AssetType)
                            ->setCellValue('M' . $i, $data->Brand)
                            ->setCellValue('N' . $i, $data->Money)
                            ->setCellValue('P' . $i, $data->State);
                    }
                    break;

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
}
