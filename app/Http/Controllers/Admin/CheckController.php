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
        $array = DB::table("T_U_SERVICEINFO")
            ->leftjoin("t_p_servicecertify", "t_U_SERVICEINFO.ServiceID", "=", "t_p_servicecertify.ServiceID")
            ->select("t_U_SERVICEINFO.*","t_p_servicecertify.State")
            ->orderBy("t_U_SERVICEINFO.ServiceID", "desc")->get();
        $datas = array();
        foreach ($array as $data) {
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
            $datas[] = $data;
        }
        return view("members/check/index", compact("datas"));
    }

    public function detail($id)
    {
        $array = DB::table("T_U_SERVICEINFO")
            ->leftjoin("t_p_servicecertify", "T_U_SERVICEINFO.ServiceID", "=", "t_p_servicecertify.ServiceID")
            ->where("T_U_SERVICEINFO.ServiceID","$id")
            ->get();
        $datas = array();
        foreach ($array as $data) {
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
            $datas[] = $data;

        }
        return view("members/check/detail", compact('datas'));
    }
}