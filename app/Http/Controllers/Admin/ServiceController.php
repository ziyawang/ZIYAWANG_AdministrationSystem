<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

class ServiceController extends Controller
{
    //服务方列表
    public function index()
    {
        $stateWhere = $typeNameWhere = $provinceWhere = array();
        if (isset($_POST['_token'])) {
            $state = $_POST['state'];
            $connectPhone = $_POST['connectPhone'];
            $typeName = $_POST['typeName'];
            $serviceName = $_POST['serviceName'];
            $typeNameWhere = $_POST['typeName'] != 0 ? array("T_U_SERVICEINFO.ServiceType", "like", "%" . $typeName . "%") : array();
            $stateWhere = $_POST['state'] != 3 ? array("T_P_SERVICECERTIFY.State" => $state) : array();
            if ($_POST['typeName'] != 0) {
                if (!empty($connectPhone)) {
                    if (!empty($serviceName)) {
                        $datas = DB::table("T_U_SERVICEINFO")
                            ->leftjoin("T_P_SERVICECERTIFY", "T_U_SERVICEINFO.ServiceID", "=", "T_P_SERVICECERTIFY.ServiceID")
                            ->leftJoin("users","T_U_SERVICEINFO.UserID","=","users.userid")
                            ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark","users.phonenumber","T_P_SERVICECERTIFY.updated_at")
                            ->where("users.phonenumber", "like", "%" . $connectPhone . "%")
                            ->where("T_U_SERVICEINFO.ServiceType", "like", "%0" . $typeName . "%")
                            ->where("T_U_SERVICEINFO.ServiceName", "like", "%" . $serviceName . "%")
                            ->where($stateWhere)
                            ->orderBy("T_U_SERVICEINFO.ServiceID", "desc")->paginate(20);
                    } else {
                        $datas = DB::table("T_U_SERVICEINFO")
                            ->leftjoin("T_P_SERVICECERTIFY", "T_U_SERVICEINFO.ServiceID", "=", "T_P_SERVICECERTIFY.ServiceID")
                            ->leftJoin("users","T_U_SERVICEINFO.UserID","=","users.userid")
                            ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark","users.phonenumber","T_P_SERVICECERTIFY.updated_at")
                           // ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark")
                            ->where("users.phonenumber", "like", "%" . $connectPhone . "%")
                            ->where("T_U_SERVICEINFO.ServiceType", "like", "%0" . $typeName . "%")
                            ->where($stateWhere)
                            ->orderBy("T_U_SERVICEINFO.ServiceID", "desc")->paginate(20);
                    }
                } else {
                    if (!empty($serviceName)) {
                        $datas = DB::table("T_U_SERVICEINFO")
                            ->leftjoin("T_P_SERVICECERTIFY", "T_U_SERVICEINFO.ServiceID", "=", "T_P_SERVICECERTIFY.ServiceID")
                            ->leftJoin("users","T_U_SERVICEINFO.UserID","=","users.userid")
                            ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark","users.phonenumber","T_P_SERVICECERTIFY.updated_at")
                           // ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark")
                            ->where("T_U_SERVICEINFO.ServiceType", "like", "%" . $typeName . "%")
                            ->where("T_U_SERVICEINFO.ServiceName", "like", "%" . $serviceName . "%")
                            ->where($stateWhere)
                            ->orderBy("T_U_SERVICEINFO.ServiceID", "desc")->paginate(20);
                    } else {
                        $datas = DB::table("T_U_SERVICEINFO")
                            ->leftjoin("T_P_SERVICECERTIFY", "T_U_SERVICEINFO.ServiceID", "=", "T_P_SERVICECERTIFY.ServiceID")
                            ->leftJoin("users","T_U_SERVICEINFO.UserID","=","users.userid")
                            ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark","users.phonenumber","T_P_SERVICECERTIFY.updated_at")
                            //->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark")
                            ->where("T_U_SERVICEINFO.ServiceType", "like", "%" . $typeName . "%")
                            ->where($stateWhere)
                            ->orderBy("T_U_SERVICEINFO.ServiceID", "desc")->paginate(20);
                    }
                }
            } else {
                if (!empty($connectPhone)) {
                    if (!empty($serviceName)) {
                        $datas = DB::table("T_U_SERVICEINFO")
                            ->leftjoin("T_P_SERVICECERTIFY", "T_U_SERVICEINFO.ServiceID", "=", "T_P_SERVICECERTIFY.ServiceID")
                            ->leftJoin("users","T_U_SERVICEINFO.UserID","=","users.userid")
                            ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark","users.phonenumber","T_P_SERVICECERTIFY.updated_at")
                            ->where("users.phonenumber", "like", "%" . $connectPhone . "%")
                            ->where($stateWhere)
                            ->where("T_U_SERVICEINFO.ServiceName", "like", "%" . $serviceName . "%")
                            ->orderBy("T_U_SERVICEINFO.ServiceID", "desc")->paginate(20);
                    } else {
                        $datas = DB::table("T_U_SERVICEINFO")
                            ->leftjoin("T_P_SERVICECERTIFY", "T_U_SERVICEINFO.ServiceID", "=", "T_P_SERVICECERTIFY.ServiceID")
                            ->leftJoin("users","T_U_SERVICEINFO.UserID","=","users.userid")
                            ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark","users.phonenumber","T_P_SERVICECERTIFY.updated_at")
                            //->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark")
                            ->where("users.phonenumber", "like", "%" . $connectPhone . "%")
                            ->where($stateWhere)
                            ->orderBy("T_U_SERVICEINFO.ServiceID", "desc")->paginate(20);
                    }
                } else {
                    if (!empty($serviceName)) {
                        $datas = DB::table("T_U_SERVICEINFO")
                            ->leftjoin("T_P_SERVICECERTIFY", "T_U_SERVICEINFO.ServiceID", "=", "T_P_SERVICECERTIFY.ServiceID")
                            ->leftJoin("users","T_U_SERVICEINFO.UserID","=","users.userid")
                            ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark","users.phonenumber","T_P_SERVICECERTIFY.updated_at")
                           // ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark")
                            ->where($stateWhere)
                            ->where("T_U_SERVICEINFO.ServiceName", "like", "%" . $serviceName . "%")
                            ->orderBy("T_U_SERVICEINFO.ServiceID", "desc")->paginate(20);
                    } else {
                        $datas = DB::table("T_U_SERVICEINFO")
                            ->leftjoin("T_P_SERVICECERTIFY", "T_U_SERVICEINFO.ServiceID", "=", "T_P_SERVICECERTIFY.ServiceID")
                            ->leftJoin("users","T_U_SERVICEINFO.UserID","=","users.userid")
                            ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark","users.phonenumber","T_P_SERVICECERTIFY.updated_at")
                            //->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark")
                            ->where($stateWhere)
                            ->orderBy("T_U_SERVICEINFO.ServiceID", "desc")->paginate(20);
                    }
                }
            }
            $db = array();
            $number=1;
            foreach ($datas as $data) {
                $data->number=$number;
                $serviceTypes = $data->ServiceType;
                $serviceType = explode(",", $serviceTypes);
                $types = DB::table("T_P_PROJECTTYPE")->select("SerName")
                    ->whereIn("TypeID", $serviceType)
                    ->get();
                $arr = array();
                foreach ($types as $value) {
                    $arr[] = $value->SerName;
                }
                $type = implode(",", $arr);
                $data->ServiceType = $type;
                $db[] = $data;
                $number++;
            }

            $results = DB::table("T_P_PROJECTTYPE")->get();
            return view("members/service/index", compact('datas', 'db', "results", "state", "typeName", "connectPhone", "serviceName"));
        }
        if (!empty($_GET)) {
            $state = $_GET['State'];
            $typeName = $_GET['typeName'];
            $stateWhere = $_GET['State'] != 3 ? array("T_P_SERVICECERTIFY.State" => $state) : array();
            $connectPhone = $_GET['connectPhone'];
            $serviceName = $_GET['serviceName'];
            if ($typeName != 0) {
                if (!empty($connectPhone)) {
                    if (!empty($serviceName)) {
                        $datas = DB::table("T_U_SERVICEINFO")
                            ->leftjoin("T_P_SERVICECERTIFY", "T_U_SERVICEINFO.ServiceID", "=", "T_P_SERVICECERTIFY.ServiceID")
                            ->leftJoin("users","T_U_SERVICEINFO.UserID","=","users.userid")
                            ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark","users.phonenumber","T_P_SERVICECERTIFY.updated_at")
                            //->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark")
                            ->where("users.phonenumber", "like", "%" . $connectPhone . "%")
                            ->where("T_U_SERVICEINFO.ServiceType", "like", "%" . $typeName . "%")
                            ->where("T_U_SERVICEINFO.ServiceName", "like", "%" . $serviceName . "%")
                            ->where($stateWhere)
                            ->orderBy("T_U_SERVICEINFO.ServiceID", "desc")->paginate(20);
                    } else {
                        $datas = DB::table("T_U_SERVICEINFO")
                            ->leftjoin("T_P_SERVICECERTIFY", "T_U_SERVICEINFO.ServiceID", "=", "T_P_SERVICECERTIFY.ServiceID")
                            ->leftJoin("users","T_U_SERVICEINFO.UserID","=","users.userid")
                            ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark","users.phonenumber","T_P_SERVICECERTIFY.updated_at")
                           // ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark")
                            ->where("users.phonenumber", "like", "%" . $connectPhone . "%")
                            ->where("T_U_SERVICEINFO.ServiceType", "like", "%" . $typeName . "%")
                            ->where($stateWhere)
                            ->orderBy("T_U_SERVICEINFO.ServiceID", "desc")->paginate(20);
                    }
                } else {
                    if (!empty($serviceName)) {
                        $datas = DB::table("T_U_SERVICEINFO")
                            ->leftjoin("T_P_SERVICECERTIFY", "T_U_SERVICEINFO.ServiceID", "=", "T_P_SERVICECERTIFY.ServiceID")
                            ->leftJoin("users","T_U_SERVICEINFO.UserID","=","users.userid")
                            ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark","users.phonenumber","T_P_SERVICECERTIFY.updated_at")
                           // ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark")
                            ->where("T_U_SERVICEINFO.ServiceType", "like", "%" . $typeName . "%")
                            ->where("T_U_SERVICEINFO.ServiceName", "like", "%" . $serviceName . "%")
                            ->where($stateWhere)
                            ->orderBy("T_U_SERVICEINFO.ServiceID", "desc")->paginate(20);
                    } else {
                        $datas = DB::table("T_U_SERVICEINFO")
                            ->leftjoin("T_P_SERVICECERTIFY", "T_U_SERVICEINFO.ServiceID", "=", "T_P_SERVICECERTIFY.ServiceID")
                            ->leftJoin("users","T_U_SERVICEINFO.UserID","=","users.userid")
                            ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark","users.phonenumber","T_P_SERVICECERTIFY.updated_at")
                           // ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark")
                            ->where("T_U_SERVICEINFO.ServiceType", "like", "%" . $typeName . "%")
                            ->where($stateWhere)
                            ->orderBy("T_U_SERVICEINFO.ServiceID", "desc")->paginate(20);
                    }
                }
            } else {
                if (!empty($connectPhone)) {
                    if (!empty($serviceName)) {
                        $datas = DB::table("T_U_SERVICEINFO")
                            ->leftjoin("T_P_SERVICECERTIFY", "T_U_SERVICEINFO.ServiceID", "=", "T_P_SERVICECERTIFY.ServiceID")
                            ->leftJoin("users","T_U_SERVICEINFO.UserID","=","users.userid")
                            ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark","users.phonenumber","T_P_SERVICECERTIFY.updated_at")
                           // ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark")
                            ->where("users.phonenumber", "like", "%" . $connectPhone . "%")
                            ->where("T_U_SERVICEINFO.ServiceName", "like", "%" . $serviceName . "%")
                            ->where($stateWhere)
                            ->orderBy("T_U_SERVICEINFO.ServiceID", "desc")->paginate(20);
                    } else {
                        $datas = DB::table("T_U_SERVICEINFO")
                            ->leftjoin("T_P_SERVICECERTIFY", "T_U_SERVICEINFO.ServiceID", "=", "T_P_SERVICECERTIFY.ServiceID")
                            ->leftJoin("users","T_U_SERVICEINFO.UserID","=","users.userid")
                            ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark","users.phonenumber","T_P_SERVICECERTIFY.updated_at")
                           // ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark")
                            ->where("users.phonenumber", "like", "%" . $connectPhone . "%")
                            ->where($stateWhere)
                            ->orderBy("T_U_SERVICEINFO.ServiceID", "desc")->paginate(20);
                    }
                } else {
                    if (!empty($serviceName)) {
                        $datas = DB::table("T_U_SERVICEINFO")
                            ->leftjoin("T_P_SERVICECERTIFY", "T_U_SERVICEINFO.ServiceID", "=", "T_P_SERVICECERTIFY.ServiceID")
                            ->leftJoin("users","T_U_SERVICEINFO.UserID","=","users.userid")
                            ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark","users.phonenumber","T_P_SERVICECERTIFY.updated_at")
                            //->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark")
                            ->where("T_U_SERVICEINFO.ServiceName", "like", "%" . $serviceName . "%")
                            ->where($stateWhere)
                            ->orderBy("T_U_SERVICEINFO.ServiceID", "desc")->paginate(20);
                    } else {
                        $datas = DB::table("T_U_SERVICEINFO")
                            ->leftjoin("T_P_SERVICECERTIFY", "T_U_SERVICEINFO.ServiceID", "=", "T_P_SERVICECERTIFY.ServiceID")
                            ->leftJoin("users","T_U_SERVICEINFO.UserID","=","users.userid")
                            ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark","users.phonenumber","T_P_SERVICECERTIFY.updated_at")
                            //->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark")
                            ->where($stateWhere)
                            ->orderBy("T_U_SERVICEINFO.ServiceID", "desc")->paginate(20);
                    }
                }
            }
            $db = array();
            $number=1;
            foreach ($datas as $data) {
                $serviceTypes = $data->ServiceType;
                $data->number=$number;
                $serviceType = explode(",", $serviceTypes);

                $types = DB::table("T_P_PROJECTTYPE")->select("SerName")
                    ->whereIn("TypeID", $serviceType)
                    ->get();
                $arr = array();
                foreach ($types as $value) {
                    $arr[] = $value->SerName;
                }
                $type = implode(",", $arr);
                $data->ServiceType = $type;
                $db[] = $data;
                $number++;
            }
            $results = DB::table("T_P_PROJECTTYPE")->get();
            return view("members/service/index", compact('datas', 'db', "results", "state", "typeName", "connectPhone", "serviceName"));
        }
        $state = 3;
        $typeName = 0;
        $connectPhone = "";
        $serviceName = "";
        $datas = DB::table("T_U_SERVICEINFO")
            ->leftjoin("T_P_SERVICECERTIFY", "T_U_SERVICEINFO.ServiceID", "=", "T_P_SERVICECERTIFY.ServiceID")
            ->leftJoin("users","T_U_SERVICEINFO.UserID","=","users.userid")
            ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark","users.phonenumber","T_P_SERVICECERTIFY.updated_at")
            //->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark")
            ->orderBy("T_U_SERVICEINFO.ServiceID", "desc")->paginate(20);
        $db = array();
        $number=1;
        foreach ($datas as $data) {
            $serviceTypes = $data->ServiceType;
            $data->number=$number;
            $serviceType = explode(",", $serviceTypes);

            $types = DB::table("T_P_PROJECTTYPE")->select("SerName")
                ->whereIn("TypeID", $serviceType)
                ->get();
            $arr = array();
            foreach ($types as $value) {
                $arr[] = $value->SerName;
            }
            $type = implode(",", $arr);
            $data->ServiceType = $type;
            $db[] = $data;
            $number++;
        }
        $results = DB::table("T_P_PROJECTTYPE")->get();
        return view("members/service/index", compact('datas', 'db', "results", "state", "typeName", "connectPhone", "serviceName"));

    }

    //服务方详情
    public function detail($id)
    {
        session(["url"=>$_SERVER["HTTP_REFERER"]]);
        $array = DB::table("T_U_SERVICEINFO")
            ->leftjoin("T_P_SERVICECERTIFY", "T_U_SERVICEINFO.ServiceID", "=", "T_P_SERVICECERTIFY.ServiceID")
            ->where("T_U_SERVICEINFO.ServiceID", $id)
            ->get();
        $datas = array();
        foreach ($array as $data) {
            $serviceTypes = $data->ServiceType;
            $serviceType = explode(",", $serviceTypes);

            $types = DB::table("T_P_PROJECTTYPE")->select("SerName")
                ->whereIn("TypeID", $serviceType)
                ->get();
            $arr = array();
            foreach ($types as $value) {
                $arr[] = $value->SerName;
            }
            $type = implode(",", $arr);
            $data->ServiceType = $type;
            $datas[] = $data;
        }

        return view("members/service/detail", compact('datas', "id","serviceType"));
    }

    //导出
    public function export()
    {
        set_time_limit(0);
        ini_set('memory_limit', '512M');
        $stateWhere = $typeNameWhere = $connectPhone = array();
        $state = $_GET['state'];
        $typeName = $_GET['type'];
        $connectPhone = $_GET['connectPhone'];
        $serviceName = $_GET['serviceName'];
        $stateWhere = $_GET['state'] != 3 ? array("T_P_SERVICECERTIFY.State" => $state) : array();
        if ($_GET['type'] != 0) {
            if (!empty($connectPhone)) {
                if (!empty($serviceName)) {
                    $datas = DB::table("T_U_SERVICEINFO")
                        ->leftjoin("T_P_SERVICECERTIFY", "T_U_SERVICEINFO.ServiceID", "=", "T_P_SERVICECERTIFY.ServiceID")
                        ->leftJoin("users","T_U_SERVICEINFO.UserID","=","users.userid")
                        ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark","users.phonenumber","T_P_SERVICECERTIFY.updated_at")
                        ->where("users.phonenumber", "like", "%" . $connectPhone . "%")
                        ->where("T_U_SERVICEINFO.ServiceType", "like", "%" . $typeName . "%")
                        ->where("T_U_SERVICEINFO.ServiceName", "like", "%" . $serviceName . "%")
                        ->where($stateWhere)
                        ->get();
                } else {
                    $datas = DB::table("T_U_SERVICEINFO")
                        ->leftjoin("T_P_SERVICECERTIFY", "T_U_SERVICEINFO.ServiceID", "=", "T_P_SERVICECERTIFY.ServiceID")
                        ->leftJoin("users","T_U_SERVICEINFO.UserID","=","users.userid")
                        ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark","users.phonenumber","T_P_SERVICECERTIFY.updated_at")
                        ->where("users.phonenumber", "like", "%" . $connectPhone . "%")
                        ->where("T_U_SERVICEINFO.ServiceType", "like", "%" . $typeName . "%")
                        ->where($stateWhere)
                        ->get();
                }
            } else {
                if (!empty($serviceName)) {
                    $datas = DB::table("T_U_SERVICEINFO")
                        ->leftjoin("T_P_SERVICECERTIFY", "T_U_SERVICEINFO.ServiceID", "=", "T_P_SERVICECERTIFY.ServiceID")
                        ->leftJoin("users","T_U_SERVICEINFO.UserID","=","users.userid")
                        ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark","users.phonenumber","T_P_SERVICECERTIFY.updated_at")
                        ->where("T_U_SERVICEINFO.ServiceType", "like", "%" . $typeName . "%")
                        ->where("T_U_SERVICEINFO.ServiceName", "like", "%" . $serviceName . "%")
                        ->where($stateWhere)
                        ->get();
                } else {
                    $datas = DB::table("T_U_SERVICEINFO")
                        ->leftjoin("T_P_SERVICECERTIFY", "T_U_SERVICEINFO.ServiceID", "=", "T_P_SERVICECERTIFY.ServiceID")
                        ->leftJoin("users","T_U_SERVICEINFO.UserID","=","users.userid")
                        ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark","users.phonenumber","T_P_SERVICECERTIFY.updated_at")
                        ->where("T_U_SERVICEINFO.ServiceType", "like", "%" . $typeName . "%")
                        ->where($stateWhere)
                        ->get();
                }
            }
        } else {
            if (!empty($connectPhone)) {
                if (!empty($serviceName)) {
                    $datas = DB::table("T_U_SERVICEINFO")
                        ->leftjoin("T_P_SERVICECERTIFY", "T_U_SERVICEINFO.ServiceID", "=", "T_P_SERVICECERTIFY.ServiceID")
                        ->leftJoin("users","T_U_SERVICEINFO.UserID","=","users.userid")
                        ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark","users.phonenumber","T_P_SERVICECERTIFY.updated_at")
                        ->where("users.phonenumber", "like", "%" . $connectPhone . "%")
                        ->where("T_U_SERVICEINFO.ServiceName", "like", "%" . $serviceName . "%")
                        ->where($stateWhere)
                        ->get();
                } else {
                    $datas = DB::table("T_U_SERVICEINFO")
                        ->leftjoin("T_P_SERVICECERTIFY", "T_U_SERVICEINFO.ServiceID", "=", "T_P_SERVICECERTIFY.ServiceID")
                        ->leftJoin("users","T_U_SERVICEINFO.UserID","=","users.userid")
                        ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark","users.phonenumber","T_P_SERVICECERTIFY.updated_at")
                        ->where("users.phonenumber", "like", "%" . $connectPhone . "%")
                        ->where($stateWhere)
                        ->get();
                }
            } else {
                if (!empty($serviceName)) {
                    $datas = DB::table("T_U_SERVICEINFO")
                        ->leftjoin("T_P_SERVICECERTIFY", "T_U_SERVICEINFO.ServiceID", "=", "T_P_SERVICECERTIFY.ServiceID")
                        ->leftJoin("users","T_U_SERVICEINFO.UserID","=","users.userid")
                        ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark","users.phonenumber","T_P_SERVICECERTIFY.updated_at")
                        ->where($stateWhere)
                        ->where("T_U_SERVICEINFO.ServiceName", "like", "%" . $serviceName . "%")
                        ->get();
                } else {
                    $datas = DB::table("T_U_SERVICEINFO")
                        ->leftjoin("T_P_SERVICECERTIFY", "T_U_SERVICEINFO.ServiceID", "=", "T_P_SERVICECERTIFY.ServiceID")
                        ->leftJoin("users","T_U_SERVICEINFO.UserID","=","users.userid")
                        ->select("T_U_SERVICEINFO.*", "T_P_SERVICECERTIFY.State", "T_P_SERVICECERTIFY.Remark","users.phonenumber","T_P_SERVICECERTIFY.updated_at")
                        ->where($stateWhere)
                        ->get();
                }
            }
        }
        $db = array();
        foreach ($datas as $data) {
            $serviceTypes = $data->ServiceType;
            $serviceType = explode(",", $serviceTypes);

            $types = DB::table("T_P_PROJECTTYPE")->select("TypeName")
                ->whereIn("TypeID", $serviceType)
                ->get();
            $arr = array();
            foreach ($types as $value) {
                $arr[] = $value->TypeName;
            }
            $type = implode(",", $arr);
            $data->ServiceType = $type;
            $db[] = $data;
        }
        require_once '../vendor/PHPExcel.class.php';
        require_once '../vendor/PHPExcel/IOFactory.php';
        require_once '../vendor/PHPExcel/Reader/Excel5.php';

        $phpExcel = new \PHPExcel();
        //var_dump($phpExcel);die;
        $excel_name = '资芽网服务方信息' . date("Y-m-d", time());
        $phpExcel->setActiveSheetIndex(0);
        $phpExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $phpExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $phpExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
        $phpExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
        $phpExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '公司')
            ->setCellValue('B1', '联系人')
            ->setCellValue('C1', '联系方式')
            ->setCellValue('D1', '地址')
            ->setCellValue('E1', '服务类型')
            ->setCellValue('F1', '服务地区')
            ->setCellValue('G1', '审核状态')
            ->setCellValue('H1', '完善时间')
            ->setCellValue('I1', '审核时间')
            ->setCellValue('J1', '浏览次数')
            ->setCellValue('K1', '收藏次数');
        foreach ($datas as $key => $data) {
            if ($data->State == 0) {
                $status = "待审核";
            } elseif ($data->State == 1) {
                $status = "已审核";
            } else {
                $status = "拒审核";
            }
            $i = $key + 2;
            $phpExcel->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $data->ServiceName)
                ->setCellValue('B' . $i, $data->ConnectPerson)
                ->setCellValue('C' . $i, $data->ConnectPhone)
                ->setCellValue('D' . $i, $data->ServiceLocation)
                ->setCellValue('E' . $i, $data->ServiceType)
                ->setCellValue('F' . $i, $data->ServiceArea)
                ->setCellValue('G' . $i, $status)
                ->setCellValue('H' . $i, $data->created_at)
                ->setCellValue('I' . $i, $data->updated_at)
                ->setCellValue('J' . $i, $data->ViewCount)
                ->setCellValue('K' . $i, $data->CollectionCount);
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

    //保存编辑的信息
    public function update()
    {
        $result = DB::table("T_P_SERVICECERTIFY")->where("ServiceID", $_POST['id'])->update([
            "State" => $_POST['state'],
            "Remark" => $_POST['remark'],
            'updated_at' => date("Y-m-d H:i:s", time())
        ]);
        $types=$_POST['types'];
        $changeType=implode(",",$types);
        $update=DB::table("T_U_SERVICEINFO")->where("ServiceID",$_POST['id'])->update([
            "ServiceName"=>$_POST['serviceName'],
            "ServiceIntroduction"=>$_POST['SerInt'],
            "ConnectPhone"=>$_POST['number'],
            "ServiceType"=>$changeType,
            'updated_at' => date("Y-m-d H:i:s", time())
        ]);
        if ($result && $update) {
            if($_POST['state']==1){
                $textId=DB::table("T_M_MESSAGETEXT")->insertGetId([
                    "Title"=>"服务方认证成功!",
                    "Text"=>"您的服务方认证已经通过我们的审核,请您进行您想要的操作!",
                    "Time"=>date("Y-m-d H:i:s", time())
                ]);
                $userids=DB::table("T_U_SERVICEINFO")->select("UserID")->where("ServiceID",$_POST['id'])->get();
                foreach($userids as $userid){
                    $userId=$userid->UserID;
                }
                $messages=DB::table("T_M_MESSAGE")->insert([
                    "SendID"=>0,
                    "RecID"=>$userId,
                    "TextID"=>$textId,
                    "Status"=>0,
                    "created_at"=>date("Y-m-d H:i:s", time())
                ]);
            }
            echo "<script>location.href='".session('url')."';</script>";
        } else {
            return Redirect::to("service/detail/" . $_POST['id']);
        }
    }

    //服务方上传图片
    public function upload()
    {
        $file = Input::file('Filedata');
        $clientName = $file->getClientOriginalName();//获取文件名
        $tmpName = $file->getFileName();//获取临时文件名
        $realPath = $file->getRealPath();//缓存文件的绝对路径
        $extension = $file->getClientOriginalExtension();//获取文件的后缀
        $mimeType = $file->getMimeType();//文件类型
        $newName = time() . mt_rand(1000, 9999) . '.' . $extension;//新文件名
        $path = $file->move(dirname(base_path()) . '/ziyaupload/images/services/', $newName);//移动绝对路径
        $filePath = '/services/' . $newName;//存入数据库的相对路径
        return $filePath;
    }

    //服务方图片删除处理
    public function handle()
    {
        $id = $_POST['data'];
        $title = $_POST['title'];
        $db = DB::table("T_U_SERVICEINFO")->where("ServiceID", $id)->update([
            $title => 0,
            'updated_at' => date("Y-m-d H:i:s", time())
        ]);
        if ($db) {
            $data = array("state" => 1);
        } else {
            $data = array("state" => 0);
        }
        return json_encode($data);
    }

    //服务方图片上传插入数据库
    public function editHandle()
    {
        $id = $_POST['id'];
        $data = $_POST['data'];
        $title = $_POST['title'];
        $db = DB::table("T_U_SERVICEINFO")->where("ServiceID", $id)->update([
            $title => $data,
            'updated_at' => date("Y-m-d H:i:s", time())
        ]);
        if ($db) {
            $res = array("state" => 1);
        } else {
            $res = array("state" => 0);
        }
        return json_encode($res);
    }
}
