<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MembersController extends Controller
{
    //会员列表的展示
    public function index(){
        if (isset($_GET['payName'])) {
            if ($_GET['payName'] == "全部") {
                $datas = DB::table("T_U_MEMBER")
                    ->leftJoin("T_U_SERVICEINFO", "T_U_MEMBER.UserID", "=", "T_U_SERVICEINFO.UserID")
                    ->leftJoin("T_CONFIG_MEMBER", "T_CONFIG_MEMBER.MemberID", "=", "T_U_MEMBER.MemberID")
                    ->where("PayFlag", 1)
                    //->where("Over", 0)
                    ->whereNotIn("T_U_MEMBER.UserId", [889, 46,116])
                    ->orderBy("StartTime", "desc")
                    ->paginate(20);
                $total = DB::table("T_U_MEMBER")
                    ->leftJoin("T_U_SERVICEINFO", "T_U_MEMBER.UserID", "=", "T_U_SERVICEINFO.UserID")
                    ->leftJoin("T_CONFIG_MEMBER", "T_CONFIG_MEMBER.MemberID", "=", "T_U_MEMBER.MemberID")
                    ->where("PayFlag", 1)
                    // ->where("Over", 0)
                    ->whereNotIn("T_U_MEMBER.UserId", [889, 46,116])
                    ->count();
                $res = DB::table("T_U_MEMBER")
                    ->leftJoin("T_U_SERVICEINFO", "T_U_MEMBER.UserID", "=", "T_U_SERVICEINFO.UserID")
                    ->leftJoin("T_CONFIG_MEMBER", "T_CONFIG_MEMBER.MemberID", "=", "T_U_MEMBER.MemberID")
                    ->where("PayFlag", 1)
                    // ->where("Over", 0)
                    ->whereNotIn("T_U_MEMBER.UserId", [889, 46,116])
                    ->get();
            } else {
                $datas = DB::table("T_U_MEMBER")
                    ->leftJoin("T_U_SERVICEINFO", "T_U_MEMBER.UserID", "=", "T_U_SERVICEINFO.UserID")
                    ->leftJoin("T_CONFIG_MEMBER", "T_CONFIG_MEMBER.MemberID", "=", "T_U_MEMBER.MemberID")
                    ->where("PayFlag", 1)
                   // ->where("Over", 0)
                    ->whereNotIn("T_U_MEMBER.UserId", [889, 46,116])
                    ->where("PayName", $_GET['payName'])
                    ->orderBy("StartTime", "desc")
                    ->paginate(20);
                $total = DB::table("T_U_MEMBER")
                    ->leftJoin("T_U_SERVICEINFO", "T_U_MEMBER.UserID", "=", "T_U_SERVICEINFO.UserID")
                    ->leftJoin("T_CONFIG_MEMBER", "T_CONFIG_MEMBER.MemberID", "=", "T_U_MEMBER.MemberID")
                    ->where("PayFlag", 1)
                    //->where("Over", 0)
                    ->whereNotIn("T_U_MEMBER.UserId", [889, 46,116])
                    ->where("PayName", $_GET['payName'])
                    ->count();
                $res = DB::table("T_U_MEMBER")
                    ->leftJoin("T_U_SERVICEINFO", "T_U_MEMBER.UserID", "=", "T_U_SERVICEINFO.UserID")
                    ->leftJoin("T_CONFIG_MEMBER", "T_CONFIG_MEMBER.MemberID", "=", "T_U_MEMBER.MemberID")
                    ->where("PayFlag", 1)
                   // ->where("Over", 0)
                    ->whereNotIn("T_U_MEMBER.UserId", [889, 46,116])
                    ->where("PayName", $_GET['payName'])
                    ->get();
            }

            if(isset($_GET['page'])){
                $number = $total - 20 * ($_GET['page'] - 1);
            }else{
                $number = $total;
            }
            foreach ($datas as $data) {
                $channel = $data->Channel;
                $data->Total = $number;
                switch ($channel) {
                    case "wx":
                        $channel = "微信App";
                        break;
                    case "wx_pub_qr":
                        $channel = "微信PC扫码";
                        break;
                    case "alipay":
                        $channel = "支付宝App";
                        break;
                    case "alipay_pc_direct":
                        $channel = "支付宝PC";
                        break;
                    case "upacp":
                        $channel = "银联App";
                        break;
                    case "upacp_pc":
                        $channel = "银联PC";
                        break;
                    case "iap":
                        $channel = "苹果app";
                        break;
                    case "zjdk":
                        $channel = "直接打款";
                        break;
                }
                $data->Channel = $channel;
                $number--;
            }

            $money=0;
            foreach ($res as $val){
                $money=$money+$val->PayMoney/100;
            }
            $payName=$_GET['payName'];
            return view("members/member/index", compact("datas", "payName","money"));
        }else{
            $datas = DB::table("T_U_MEMBER")
                ->leftJoin("T_U_SERVICEINFO", "T_U_MEMBER.UserID", "=", "T_U_SERVICEINFO.UserID")
                ->leftJoin("T_CONFIG_MEMBER", "T_CONFIG_MEMBER.MemberID", "=", "T_U_MEMBER.MemberID")
                ->where("PayFlag", 1)
                //->where("Over", 0)
                ->whereNotIn("T_U_MEMBER.UserId", [889, 46,116])
                ->orderBy("StartTime", "desc")
                ->paginate(20);
            $total = DB::table("T_U_MEMBER")
                ->leftJoin("T_U_SERVICEINFO", "T_U_MEMBER.UserID", "=", "T_U_SERVICEINFO.UserID")
                ->leftJoin("T_CONFIG_MEMBER", "T_CONFIG_MEMBER.MemberID", "=", "T_U_MEMBER.MemberID")
                ->where("PayFlag", 1)
               // ->where("Over", 0)
                ->whereNotIn("T_U_MEMBER.UserId", [889, 46,116])
                ->count();
            $number = $total;
            foreach ($datas as $data) {
                $channel = $data->Channel;
                $data->Total = $number;
                switch ($channel) {
                    case "wx":
                        $channel = "微信App";
                        break;
                    case "wx_pub_qr":
                        $channel = "微信PC扫码";
                        break;
                    case "alipay":
                        $channel = "支付宝App";
                        break;
                    case "alipay_pc_direct":
                        $channel = "支付宝PC";
                        break;
                    case "upacp":
                        $channel = "银联App";
                        break;
                    case "upacp_pc":
                        $channel = "银联PC";
                        break;
                    case "iap":
                        $channel = "苹果app";
                        break;
                    case "zjdk":
                        $channel = "直接打款";
                        break;
                }
                $data->Channel = $channel;
                $number--;
            }
            $res = DB::table("T_U_MEMBER")
                ->leftJoin("T_U_SERVICEINFO", "T_U_MEMBER.UserID", "=", "T_U_SERVICEINFO.UserID")
                ->leftJoin("T_CONFIG_MEMBER", "T_CONFIG_MEMBER.MemberID", "=", "T_U_MEMBER.MemberID")
                ->where("PayFlag", 1)
                //->where("Over", 0)
                ->whereNotIn("T_U_MEMBER.UserId", [889, 46,116])
                ->get();
            $money=0;
            foreach ($res as $val){
                $money=$money+$val->PayMoney/100;
            }
            $payName="全部";
            return view("members/member/index", compact("datas", "payName","money"));
        }
    }

    //会员充值
    public  function  recharge(){
        $memberId=$_GET['memberId'];
        $serviceId=$_GET['serviceId'];
        return view("members/member/recharge",compact("memberId","serviceId"));
    }
    //保存会员充值
    public function saveRecharge(){
           $userIds=DB::table("T_U_SERVICEINFO")->select("UserID")->where("ServiceID",$_POST['serviceId'])->get();
            foreach ($userIds as $value){
                $userId=$value->UserID;
            }
        $starts=DB::table("T_U_MEMBER")->select("EndTime")->where("MemberID",$_POST['memberId'])->where("UserID",$userId)->take(1)->orderBy("created_at","desc")->get();
        if(!empty($starts)){
            foreach ($starts as $val){
                $start=$val->EndTime;
            }
            if(strtotime($start)<strtotime($_POST['StartTime'])){
                $start=$_POST['StartTime'];
            }
        }else{
            $start=$_POST['StartTime'];
        }

        $month=intval($_POST['Time']);
        $startTime=strtotime($start);
        $endTime=date("Y-m-d H:i:s",strtotime("+$month months",$startTime));
        $orderNo = 'KT' . substr(time(),4) . mt_rand(1000,9999);
        $result=DB::table("T_U_MEMBER")->insert([
            "PayMoney"=>$_POST['PayMoney']*100,
             "MemberID"=>$_POST['memberId'],
             "Month"=>$_POST['Time'],
             "StartTime"=>$start,
             "EndTime"=>$endTime,
             "Channel"=>"zjdk",
             "IP"=>"",
            "BackNumber"=>"直接打款",
            "OrderNumber"=> $orderNo,
            "PayFlag"=>1,
            "Over"=>0,
            "UserID"=>$userId,
            "created_at"=>date("Y-m-d H:i:s", time())
        ]);
        $accounts=DB::table("users")->where("useid",$userId)->pluck("Account");
        $account=$_POST['PayMoney']+$accounts;
        $order_no='ZS' . substr(time(),4) . mt_rand(1000,9999);
        switch($_POST['memberId']){
            case 1:
                $operate="开通个人债权季度会员，赠送998个芽币";
            break;
            case 2:
                $operate="开通个人债权年度会员，赠送2998个芽币";
                break;
            case 3:
                $operate="开通融资信息季度会员，赠送998个芽币";
                break;
            case 4:
                $operate="开通融资信息年度会员，赠送2998个芽币";
                break;
            case 5:
                $operate="开通固定资产季度会员，赠送6498个芽币";
                break;
            case 6:
                $operate="开通固定资产年度会员，赠送70000个芽币";
                break;
            case 7:
                 $operate="开通资产包季度会员，赠送6498个芽币";
            break;
            case 8:
                 $operate="开通资产包年度会员，赠送70000个芽币";
                break;
            case 9:
                 $operate="开通企业商账季度会员，赠送1498个芽币";
                break;
            case 10:
                 $operate="开通企业商账年度会员，赠送4998个芽币";
                break;

        }
        $val=DB::table("T_U_MONEY")->insert([
                "UserID"=>$userId,
                "Type"=>$_POST['memberId'],
                "OrderNumber"=>$order_no,
                "Money"=>$_POST['PayMoney'],
                "RealMoney"=>0,
                "Account"=>$account,
                "ProjectID"=>0,
                "Flag"=>1,
                "BackNumber"=>"直接打款",
                "created_at"=>date("Y-m-d H:i:s", time()),
                "timestamp"=>strtotime(date("Y-m-d H:i:s", time())),
                "IP"=>"",
                "Channel"=>"zjdk",
                "Operates"=>$operate,
                "DelFlag"=>0,
        ]);
        $editAccount=DB::table("users")->where("userid",$userId)->update([
            "Account"=>$account,
            updated_at=>ate("Y-m-d H:i:s", time())
        ]);
    }
    //会员导出数据
    public function export(){
        set_time_limit(0);
        ini_set('memory_limit', '512M');
        if (isset($_GET['payName'])) {
            if ($_GET['payName'] == "全部") {
                $datas = DB::table("T_U_MEMBER")
                    ->leftJoin("T_U_SERVICEINFO", "T_U_MEMBER.UserID", "=", "T_U_SERVICEINFO.UserID")
                    ->leftJoin("T_CONFIG_MEMBER", "T_CONFIG_MEMBER.MemberID", "=", "T_U_MEMBER.MemberID")
                    ->where("PayFlag", 1)
                    ->where("Over", 0)
                    ->whereNotIn("T_U_MEMBER.UserId", [889, 46,116])
                    ->get();
            } else {
                $datas = DB::table("T_U_MEMBER")
                    ->leftJoin("T_U_SERVICEINFO", "T_U_MEMBER.UserID", "=", "T_U_SERVICEINFO.UserID")
                    ->leftJoin("T_CONFIG_MEMBER", "T_CONFIG_MEMBER.MemberID", "=", "T_U_MEMBER.MemberID")
                    ->where("PayFlag", 1)
                    ->where("Over", 0)
                    ->whereNotIn("T_U_MEMBER.UserId", [889, 46,116])
                    ->where("PayName", $_GET['payName'])
                    ->get();
            }
        }else{
            $datas = DB::table("T_U_MEMBER")
                ->leftJoin("T_U_SERVICEINFO", "T_U_MEMBER.UserID", "=", "T_U_SERVICEINFO.UserID")
                ->leftJoin("T_CONFIG_MEMBER", "T_CONFIG_MEMBER.MemberID", "=", "T_U_MEMBER.MemberID")
                ->where("PayFlag", 1)
                ->where("Over", 0)
                ->whereNotIn("T_U_MEMBER.UserId", [889, 46,116])
                ->get();
        }
        require_once '../vendor/PHPExcel.class.php';
        require_once '../vendor/PHPExcel/IOFactory.php';
        require_once '../vendor/PHPExcel/Reader/Excel5.php';

        $phpExcel = new \PHPExcel();
        //var_dump($phpExcel);die;
        $excel_name = '资芽网会员信息' . date("Y-m-d", time());
        $phpExcel->setActiveSheetIndex(0);
        $phpExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $phpExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);

        $phpExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '公司名称')
            ->setCellValue('B1', '联系电话')
            ->setCellValue('C1', '信息类型')
            ->setCellValue('D1', '会员类型')
            ->setCellValue('E1', '会员费(元)')
            ->setCellValue('F1', '开始时间')
            ->setCellValue('G1', '结束时间')
            ->setCellValue('H1', '支付渠道');
        
        /*  ->setCellValue('I1', '类型')
          ->setCellValue('J1', '标的物')
          ->setCellValue('K1', '转让价')
          ->setCellValue('L1', '详情描述');*/


        foreach ($datas as $key=> $data) {
            $channel = $data->Channel;
            switch ($channel) {
                case "wx":
                    $channel = "微信App";
                    break;
                case "wx_pub_qr":
                    $channel = "微信PC扫码";
                    break;
                case "alipay":
                    $channel = "支付宝App";
                    break;
                case "alipay_pc_direct":
                    $channel = "支付宝PC";
                    break;
                case "upacp":
                    $channel = "银联App";
                    break;
                case "upacp_pc":
                    $channel = "银联PC";
                    break;
                case "iap":
                    $channel = "苹果app";
                    break;
                case "zjdk":
                    $channel = "直接打款";
                    break;
            }
            $data->Channel = $channel;
            if($data->Month==1){
                $data->Month="月度会员";
            }else if($data->Month==3){
                $data->Month="季度会员";
            }else{
                $data->Month="年度会员";
            }
            $i = $key + 2;
            $phpExcel->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $data->ServiceName)
                ->setCellValue('B' . $i, $data->ConnectPhone)
                ->setCellValue('C' . $i, $data->MemberName)
                ->setCellValue('D' . $i, $data->Month)
                ->setCellValue('E' . $i, $data->PayMoney/100)
                ->setCellValue('F' . $i, $data->StartTime)
                ->setCellValue('G' . $i, $data->EndTime)
                ->setCellValue('H' . $i, $data->Channel);
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
