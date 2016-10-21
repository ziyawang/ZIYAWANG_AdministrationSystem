<?phpnamespace App\Http\Controllers\Admin;use Illuminate\Http\Request;use App\Http\Requests;use App\Http\Controllers\Controller;use Illuminate\Support\Facades\DB;use Illuminate\Support\Facades\Input;use Illuminate\Support\Facades\Redirect;class CheckController extends Controller{   //审核信息展示    public function index()    {        if (isset($_POST['_token'])) {            // dd($_POST['phoneNumber']);            $state = $_POST['state'];            $typeName = $_POST['typeName'];            $member=$_POST['member'];            $phoneNumber = !empty($_POST['phoneNumber']) ? $_POST['phoneNumber'] : "";            $province = $_POST['province'];            $provinceWhere = $_POST['province'] != "全国" ? array("ProArea" => $province) : array();            $typeNameWhere = $_POST['typeName'] != 0 ? array("T_P_PROJECTINFO.TypeID" => $typeName) : array();            $stateWhere = $_POST['state'] != 3 ? array("T_P_PROJECTCERTIFY.State" => $state) : array();            $memberWhere=$_POST['member']!=3 ? array("T_P_PROJECTINFO.member"=>$member) : array();            if ($_POST['province'] != "全国") {                if (!empty($_POST['phoneNumber'])) {                    $datas = DB::table("T_P_PROJECTINFO")                        ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")                        ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")                        ->leftjoin("T_P_PROJECTCERTIFY", "T_P_PROJECTCERTIFY.ProjectID", "=", "T_P_PROJECTINFO.ProjectID")                        ->select("T_P_PROJECTINFO.*","users.phonenumber", "T_P_PROJECTTYPE.TypeName", "T_P_PROJECTCERTIFY.Remark", "T_P_PROJECTCERTIFY.State", "T_P_PROJECTTYPE.TypeID","users.userid")                        ->where("ProArea", "like", "%" . $province . "%")                        ->where("users.phonenumber", "like", "%" . $phoneNumber . "%")                        ->where($typeNameWhere)                        ->where($stateWhere)                        ->where($memberWhere)                        ->where("T_P_PROJECTINFO.CertifyState", "<>", 3)                        ->orderBy("T_P_PROJECTINFO.ProjectID", "desc")->paginate(20);                } else {                    $datas = DB::table("T_P_PROJECTINFO")                        ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")                        ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")                        ->leftjoin("T_P_PROJECTCERTIFY", "T_P_PROJECTCERTIFY.ProjectID", "=", "T_P_PROJECTINFO.ProjectID")                        ->select("T_P_PROJECTINFO.*", "users.phonenumber", "T_P_PROJECTTYPE.TypeName", "T_P_PROJECTCERTIFY.Remark", "T_P_PROJECTCERTIFY.State", "T_P_PROJECTTYPE.TypeID","users.userid")                        ->where("ProArea", "like", "%" . $province . "%")                        ->where($typeNameWhere)                        ->where($stateWhere)                        ->where($memberWhere)                        ->where("T_P_PROJECTINFO.CertifyState", "<>", 3)                        ->orderBy("T_P_PROJECTINFO.ProjectID", "desc")->paginate(20);                }            } else {                if (!empty($_POST['phoneNumber'])) {                    $datas = DB::table("T_P_PROJECTINFO")                        ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")                        ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")                        ->leftjoin("T_P_PROJECTCERTIFY", "T_P_PROJECTCERTIFY.ProjectID", "=", "T_P_PROJECTINFO.ProjectID")                        ->select("T_P_PROJECTINFO.*", "users.phonenumber", "T_P_PROJECTTYPE.TypeName", "T_P_PROJECTCERTIFY.Remark", "T_P_PROJECTCERTIFY.State", "T_P_PROJECTTYPE.TypeID","users.userid")                        ->where($typeNameWhere)                        ->where("users.phonenumber", "like", "%" . $phoneNumber . "%")                        ->where($stateWhere)                        ->where($memberWhere)                        ->where("T_P_PROJECTINFO.CertifyState", "<>", 3)                        ->orderBy("T_P_PROJECTINFO.ProjectID", "desc")->paginate(20);                } else {                    $datas = DB::table("T_P_PROJECTINFO")                        ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")                        ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")                        ->leftjoin("T_P_PROJECTCERTIFY", "T_P_PROJECTCERTIFY.ProjectID", "=", "T_P_PROJECTINFO.ProjectID")                        ->select("T_P_PROJECTINFO.*", "users.phonenumber", "T_P_PROJECTTYPE.TypeName", "T_P_PROJECTCERTIFY.Remark", "T_P_PROJECTCERTIFY.State", "T_P_PROJECTTYPE.TypeID","users.userid")                        ->where($typeNameWhere)                        ->where($stateWhere)                        ->where($memberWhere)                        ->where("T_P_PROJECTINFO.CertifyState", "<>", 3)                        ->orderBy("T_P_PROJECTINFO.ProjectID", "desc")->paginate(20);                }            }            $number=1;            foreach ($datas as $data){                $projectId=$data->ProjectID;                $data->number=$number;                $counts=DB::table("T_P_RUSHPROJECT")->where("ProjectID",$projectId)->where("CooperateFlag",0)->count();                $data->counts=$counts;                $number++;            }            $results = DB::table("T_P_PROJECTTYPE")->get();            return view("members/check/index", compact("datas", "results", "state", "typeName", "province", "phoneNumber","member"));        }        if (!empty($_GET)) {            $state = $_GET['state'];            $typeName = $_GET['typeName'];            $member=$_GET['member'];            $phoneNumber = !empty($_GET['phoneNumber']) ? $_GET['phoneNumber'] : "";            $province = $_GET['province'];            // $provinceWhere=$_POST['province']!="全国" ? array("ProArea"=>$province) : array();            $typeNameWhere = $_GET['typeName'] != 0 ? array("T_P_PROJECTINFO.TypeID" => $typeName) : array();            $stateWhere = $_GET['state'] != 3 ? array("T_P_PROJECTCERTIFY.State" => $state) : array();            $memberWhere=$_GET['member']!=3 ? array("T_P_PROJECTINFO.member"=>$member) : array();            if ($_GET['province'] != "全国") {                if (!empty($_GET['phoneNumber'])) {                    $datas = DB::table("T_P_PROJECTINFO")                        ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")                        ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")                        ->leftjoin("T_P_PROJECTCERTIFY", "T_P_PROJECTCERTIFY.ProjectID", "=", "T_P_PROJECTINFO.ProjectID")                        ->select("T_P_PROJECTINFO.*", "users.phonenumber", "T_P_PROJECTTYPE.TypeName", "T_P_PROJECTCERTIFY.Remark", "T_P_PROJECTCERTIFY.State", "T_P_PROJECTTYPE.TypeID","users.userid")                        ->where("ProArea", "like", "%" . $province . "%")                        ->where("users.phonenumber", "like", "%" . $phoneNumber . "%")                        ->where($typeNameWhere)                        ->where($stateWhere)                        ->where($memberWhere)                        ->where("T_P_PROJECTINFO.CertifyState", "<>", 3)                        ->orderBy("T_P_PROJECTINFO.ProjectID", "desc")->paginate(20);                } else {                    $datas = DB::table("T_P_PROJECTINFO")                        ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")                        ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")                        ->leftjoin("T_P_PROJECTCERTIFY", "T_P_PROJECTCERTIFY.ProjectID", "=", "T_P_PROJECTINFO.ProjectID")                        ->select("T_P_PROJECTINFO.*", "users.phonenumber", "T_P_PROJECTTYPE.TypeName", "T_P_PROJECTCERTIFY.Remark", "T_P_PROJECTCERTIFY.State", "T_P_PROJECTTYPE.TypeID","users.userid")                        ->where("ProArea", "like", "%" . $province . "%")                        ->where($typeNameWhere)                        ->where($stateWhere)                        ->where($memberWhere)                        ->where("T_P_PROJECTINFO.CertifyState", "<>", 3)                        ->orderBy("T_P_PROJECTINFO.ProjectID", "desc")->paginate(20);                }            } else {                if (!empty($_GET['phoneNumber'])) {                    $datas = DB::table("T_P_PROJECTINFO")                        ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")                        ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")                        ->leftjoin("T_P_PROJECTCERTIFY", "T_P_PROJECTCERTIFY.ProjectID", "=", "T_P_PROJECTINFO.ProjectID")                        ->select("T_P_PROJECTINFO.*", "users.phonenumber", "T_P_PROJECTTYPE.TypeName", "T_P_PROJECTCERTIFY.Remark", "T_P_PROJECTCERTIFY.State", "T_P_PROJECTTYPE.TypeID","users.userid")                        ->where($typeNameWhere)                        ->where($stateWhere)                        ->where($memberWhere)                        ->where("users.phonenumber", "like", "%" . $phoneNumber . "%")                        ->where("T_P_PROJECTINFO.CertifyState", "<>", 3)                        ->orderBy("T_P_PROJECTINFO.ProjectID", "desc")->paginate(20);                } else {                    $datas = DB::table("T_P_PROJECTINFO")                        ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")                        ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")                        ->leftjoin("T_P_PROJECTCERTIFY", "T_P_PROJECTCERTIFY.ProjectID", "=", "T_P_PROJECTINFO.ProjectID")                        ->select("T_P_PROJECTINFO.*", "users.phonenumber", "T_P_PROJECTTYPE.TypeName", "T_P_PROJECTCERTIFY.Remark", "T_P_PROJECTCERTIFY.State", "T_P_PROJECTTYPE.TypeID","users.userid")                        ->where($typeNameWhere)                        ->where($stateWhere)                        ->where($memberWhere)                        ->where("T_P_PROJECTINFO.CertifyState", "<>", 3)                        ->orderBy("T_P_PROJECTINFO.ProjectID", "desc")->paginate(20);                }            }            $number=1;            foreach ($datas as $data){                $projectId=$data->ProjectID;                $data->number=$number;                $counts=DB::table("T_P_RUSHPROJECT")->where("ProjectID",$projectId)->where("CooperateFlag",0)->count();                $data->counts=$counts;                $number++;            }            $results = DB::table("T_P_PROJECTTYPE")->get();            return view("members/check/index", compact("datas", "results", "state", "typeName", "province", "phoneNumber","member"));        }        $state = 3;        $typeName = 0;        $province = "全国";        $phoneNumber = "";        $member=3;        $datas = DB::table("T_P_PROJECTINFO")            ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")            ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")            ->leftjoin("T_P_PROJECTCERTIFY", "T_P_PROJECTCERTIFY.ProjectID", "=", "T_P_PROJECTINFO.ProjectID")            ->select("T_P_PROJECTINFO.*", "users.phonenumber", "T_P_PROJECTTYPE.TypeName", "T_P_PROJECTCERTIFY.Remark", "T_P_PROJECTCERTIFY.State", "T_P_PROJECTTYPE.TypeID","users.userid")            ->where("T_P_PROJECTINFO.CertifyState", "<>", 3)            ->orderBy("T_P_PROJECTINFO.ProjectID", "desc")->paginate(20);        $number=1;        foreach ($datas as $data){            $projectId=$data->ProjectID;            $data->number=$number;            $counts=DB::table("T_P_RUSHPROJECT")->where("ProjectID",$projectId)->where("CooperateFlag",0)->count();            $data->counts=$counts;            $number++;        }        $results = DB::table("T_P_PROJECTTYPE")->get();        return view("members/check/index", compact("datas", "results", "state", "typeName", "province", "phoneNumber","member"));    }    //审核信息详情    public function detail($id, $typeId)    {        session(["url"=>$_SERVER["HTTP_REFERER"]]);        switch ($typeId) {            case "1":                $datas = DB::table("T_P_PROJECTINFO")                    ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")                    ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")                    ->leftJoin("T_P_SPEC01", "T_P_PROJECTINFO.ProjectID", "=", "T_P_SPEC01.ProjectID")                    ->select("T_P_PROJECTINFO.*", "users.phonenumber", "T_P_PROJECTTYPE.TypeName", "T_P_SPEC01.*")                    ->where("T_P_PROJECTINFO.ProjectID", $id)                    ->get();                return view("members/check/detail", compact('datas', "id"));                break;            case "2":                $datas = DB::table("T_P_PROJECTINFO")                    ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")                    ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")                    ->leftJoin("T_P_SPEC02", "T_P_PROJECTINFO.ProjectID", "=", "T_P_SPEC02.ProjectID")                    ->select("T_P_PROJECTINFO.*", "users.phonenumber", "T_P_PROJECTTYPE.TypeName", "T_P_SPEC02.*")                    ->where("T_P_PROJECTINFO.ProjectID", $id)                    ->get();               // dd($datas);                return view("members/check/releaseinfo_1", compact('datas', "id"));                break;            case "3":                $datas = DB::table("T_P_PROJECTINFO")                    ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")                    ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")                    ->leftJoin("T_P_SPEC03", "T_P_PROJECTINFO.ProjectID", "=", "T_P_SPEC03.ProjectID")                    ->select("T_P_PROJECTINFO.*", "users.phonenumber", "T_P_PROJECTTYPE.TypeName", "T_P_SPEC03.*")                    ->where("T_P_PROJECTINFO.ProjectID", $id)                    ->get();                return view("members/check/releaseinfo_2", compact('datas', "id"));                break;            case "4":                $datas = DB::table("T_P_PROJECTINFO")                    ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")                    ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")                    ->leftJoin("T_P_SPEC04", "T_P_PROJECTINFO.ProjectID", "=", "T_P_SPEC04.ProjectID")                    ->select("T_P_PROJECTINFO.*", "users.phonenumber", "T_P_PROJECTTYPE.TypeName", "T_P_SPEC04.*")                    ->where("T_P_PROJECTINFO.ProjectID", $id)                    ->get();                //dd($datas);                return view("members/check/releaseinfo_3", compact('datas', "id"));                break;            case "5":                $datas = DB::table("T_P_PROJECTINFO")                    ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")                    ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")                    ->leftJoin("T_P_SPEC05", "T_P_PROJECTINFO.ProjectID", "=", "T_P_SPEC05.ProjectID")                    ->select("T_P_PROJECTINFO.*", "users.phonenumber", "T_P_PROJECTTYPE.TypeName", "T_P_SPEC05.*")                    ->where("T_P_PROJECTINFO.ProjectID", $id)                    ->get();                return view("members/check/releaseinfo_4", compact('datas', "id"));                break;            case "6":                $datas = DB::table("T_P_PROJECTINFO")                    ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")                    ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")                    ->leftJoin("T_P_SPEC06", "T_P_PROJECTINFO.ProjectID", "=", "T_P_SPEC06.ProjectID")                    ->select("T_P_PROJECTINFO.*", "users.phonenumber", "T_P_PROJECTTYPE.TypeName", "T_P_SPEC06.*")                    ->where("T_P_PROJECTINFO.ProjectID", $id)                    ->get();                return view("members/check/releaseinfo_5", compact('datas', "id"));                break;            case "9":                $datas = DB::table("T_P_PROJECTINFO")                    ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")                    ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")                    ->leftJoin("T_P_SPEC09", "T_P_PROJECTINFO.ProjectID", "=", "T_P_SPEC09.ProjectID")                    ->select("T_P_PROJECTINFO.*", "users.phonenumber", "T_P_PROJECTTYPE.TypeName", "T_P_SPEC09.*")                    ->where("T_P_PROJECTINFO.ProjectID", $id)                    ->get();                return view("members/check/releaseinfo_6", compact('datas', "id"));                break;            case "10":                $datas = DB::table("T_P_PROJECTINFO")                    ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")                    ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")                    ->leftJoin("T_P_SPEC10", "T_P_PROJECTINFO.ProjectID", "=", "T_P_SPEC10.ProjectID")                    ->select("T_P_PROJECTINFO.*", "users.phonenumber", "T_P_PROJECTTYPE.TypeName", "T_P_SPEC10.*")                    ->where("T_P_PROJECTINFO.ProjectID", $id)                    ->get();                return view("members/check/releaseinfo_7", compact('datas', "id"));                break;            case "12":                $datas = DB::table("T_P_PROJECTINFO")                    ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")                    ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")                    ->leftJoin("T_P_SPEC12", "T_P_PROJECTINFO.ProjectID", "=", "T_P_SPEC12.ProjectID")                    ->select("T_P_PROJECTINFO.*", "users.phonenumber", "T_P_PROJECTTYPE.TypeName", "T_P_SPEC12.*")                    ->where("T_P_PROJECTINFO.ProjectID", $id)                    ->get();                return view("members/check/releaseinfo_8", compact('datas', "id"));                break;            case "13":                $datas = DB::table("T_P_PROJECTINFO")                    ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")                    ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")                    ->leftJoin("T_P_SPEC13", "T_P_PROJECTINFO.ProjectID", "=", "T_P_SPEC13.ProjectID")                    ->select("T_P_PROJECTINFO.*", "users.phonenumber", "T_P_PROJECTTYPE.TypeName", "T_P_SPEC13.*")                    ->where("T_P_PROJECTINFO.ProjectID", $id)                    ->get();                return view("members/check/releaseinfo_9", compact('datas', "id"));                break;            case "14":                $datas = DB::table("T_P_PROJECTINFO")                    ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")                    ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")                    ->leftJoin("T_P_SPEC14", "T_P_PROJECTINFO.ProjectID", "=", "T_P_SPEC14.ProjectID")                    ->select("T_P_PROJECTINFO.*", "users.phonenumber", "T_P_PROJECTTYPE.TypeName", "T_P_SPEC14.*")                    ->where("T_P_PROJECTINFO.ProjectID", $id)                    ->get();                return view("members/check/releaseinfo_10", compact('datas', "id"));                break;            case "15":                $datas = DB::table("T_P_PROJECTINFO")                    ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")                    ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")                    ->leftJoin("T_P_SPEC15", "T_P_PROJECTINFO.ProjectID", "=", "T_P_SPEC15.ProjectID")                    ->select("T_P_PROJECTINFO.*", "users.phonenumber", "T_P_PROJECTTYPE.TypeName", "T_P_SPEC15.*")                    ->where("T_P_PROJECTINFO.ProjectID", $id)                    ->get();                return view("members/check/releaseinfo_11", compact('datas', "id"));                break;        }    }    //导出    public function export()    {        set_time_limit(0);        ini_set('memory_limit', '512M');        $state = $_GET['state'];        $typeName = $_GET['type'];        $province = $_GET['province'];        $member=$_GET['member'];        $phoneNumber = $_GET['phoneNumber'];        $typeNameWhere = $_GET['type'] != 0 ? array("T_P_PROJECTINFO.TypeID" => $typeName) : array();        $stateWhere = $_GET['state'] != 3 ? array("T_P_PROJECTCERTIFY.State" => $state) : array();        $memberWhere=$_GET['member']!=3 ? array("T_P_PROJECTINFO.member"=>$member) : array();        if (!empty($phoneNumber)) {            if(!empty($province) && $province!="全国"){                $datas = DB::table("T_P_PROJECTINFO")                    ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")                    ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")                    ->leftjoin("T_P_PROJECTCERTIFY", "T_P_PROJECTCERTIFY.ProjectID", "=", "T_P_PROJECTINFO.ProjectID")                    ->select("T_P_PROJECTINFO.*", "users.phonenumber", "T_P_PROJECTTYPE.TypeName", "T_P_PROJECTCERTIFY.Remark", "T_P_PROJECTCERTIFY.State")                    ->where("users.phonenumber", "like", "%".$phoneNumber."%")                    ->where("T_P_PROJECTINFO.ProArea", "like", "%".$province ."%")                    ->where($typeNameWhere)                    ->where($stateWhere)                    ->where($memberWhere)                    ->where("CertifyState", "<>", 3)                    ->get();            }else{                $datas = DB::table("T_P_PROJECTINFO")                    ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")                    ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")                    ->leftjoin("T_P_PROJECTCERTIFY", "T_P_PROJECTCERTIFY.ProjectID", "=", "T_P_PROJECTINFO.ProjectID")                    ->select("T_P_PROJECTINFO.*", "users.phonenumber", "T_P_PROJECTTYPE.TypeName", "T_P_PROJECTCERTIFY.Remark", "T_P_PROJECTCERTIFY.State")                    ->where("users.phonenumber", "like", "%".$phoneNumber."%")                    ->where($typeNameWhere)                    ->where($stateWhere)                    ->where($memberWhere)                    ->where("CertifyState", "<>", 3)                    ->get();            }        } else {            if(!empty($province) && $province!="全国"){                $datas = DB::table("T_P_PROJECTINFO")                    ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")                    ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")                    ->leftjoin("T_P_PROJECTCERTIFY", "T_P_PROJECTCERTIFY.ProjectID", "=", "T_P_PROJECTINFO.ProjectID")                    ->select("T_P_PROJECTINFO.*", "users.phonenumber", "T_P_PROJECTTYPE.TypeName", "T_P_PROJECTCERTIFY.Remark", "T_P_PROJECTCERTIFY.State")                    ->where("T_P_PROJECTINFO.ProArea", "like", "%".$province ."%")                    ->where($typeNameWhere)                    ->where($stateWhere)                    ->where($memberWhere)                    ->where("CertifyState", "<>", 3)                    ->get();            }else{                $datas = DB::table("T_P_PROJECTINFO")                    ->leftjoin("users", "T_P_PROJECTINFO.UserID", "=", "users.userid")                    ->leftjoin("T_P_PROJECTTYPE", "T_P_PROJECTINFO.TypeID", "=", "T_P_PROJECTTYPE.TypeID")                    ->leftjoin("T_P_PROJECTCERTIFY", "T_P_PROJECTCERTIFY.ProjectID", "=", "T_P_PROJECTINFO.ProjectID")                    ->select("T_P_PROJECTINFO.*", "users.phonenumber", "T_P_PROJECTTYPE.TypeName", "T_P_PROJECTCERTIFY.Remark", "T_P_PROJECTCERTIFY.State")                    ->where($typeNameWhere)                    ->where($stateWhere)                    ->where($memberWhere)                    ->where("CertifyState", "<>", 3)                    ->get();            }        }        foreach ($datas as $data){            $projectId=$data->ProjectID;            $counts=DB::table("T_P_RUSHPROJECT")->where("ProjectID",$projectId)->where("CooperateFlag",0)->count();            $data->counts=$counts;           /* $results=DB::table("T_P_SPEC12")->where("ProjectID",$projectId)->get();            foreach ($results as $result){                $data->AssetType=$result->AssetType;                $data->Corpore=$result->Corpore;                $data->TransferMoney=$result->TransferMoney;            }*/        }        require_once '../vendor/PHPExcel.class.php';        require_once '../vendor/PHPExcel/IOFactory.php';        require_once '../vendor/PHPExcel/Reader/Excel5.php';        $phpExcel = new \PHPExcel();        //var_dump($phpExcel);die;        $excel_name = '资芽网审核发布信息' . date("Y-m-d", time());        $phpExcel->setActiveSheetIndex(0);        $phpExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);        $phpExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);        $phpExcel->setActiveSheetIndex(0)            ->setCellValue('A1', '联系方式')            ->setCellValue('B1', '发布时间')            ->setCellValue('C1', '地址')            ->setCellValue('D1', '信息类型')            ->setCellValue('E1', '浏览次数')            ->setCellValue('F1', '收藏次数')            ->setCellValue('G1', '约谈次数')            ->setCellValue('H1', '审核状态');          /*  ->setCellValue('I1', '类型')            ->setCellValue('J1', '标的物')            ->setCellValue('K1', '转让价')            ->setCellValue('L1', '详情描述');*/        foreach ($datas as $key => $data) {            if ($data->State == 0) {                $status = "待审核";            } elseif ($data->State == 1) {                $status = "已审核";            } else {                $status = "拒审核";            }            $i = $key + 2;            $phpExcel->setActiveSheetIndex(0)                ->setCellValue('A' . $i, "'" . $data->phonenumber)                ->setCellValue('B' . $i, $data->PublishTime)                ->setCellValue('C' . $i, $data->ProArea)                ->setCellValue('D' . $i, $data->TypeName)                ->setCellValue('E' . $i, $data->ViewCount)                ->setCellValue('F' . $i, $data->CollectionCount)                ->setCellValue('G' . $i, $data->counts)                ->setCellValue('H' . $i, $status);               /* ->setCellValue('I' . $i, $data->AssetType)                ->setCellValue('J' . $i, $data->Corpore)                ->setCellValue('K' . $i, $data->TransferMoney)                ->setCellValue('L' . $i, $data->WordDes);*/        }        $objWriter = \PHPExcel_IOFactory::createWriter($phpExcel, 'Excel5');        header("Pragma: public");        header("Expires: 0");        header("Cache-Control:must-revalidate, post-check=0, pre-check=0");        header("Content-Type:application/force-download");        header("Content-Type:application/vnd.ms-execl");        header("Content-Type:application/octet-stream");        header("Content-Type:application/download");        header('Content-Disposition:attachment;filename=' . $excel_name . ".xls");        header("Content-Transfer-Encoding:binary");        $objWriter->save('php://output');    }    //编辑信息详情    public function update()    {        if($_POST['state']==3){           $rushCounts=DB::table("T_P_RUSHPROJECT")->where("ProjectID",$_POST['id'])->count();           $collectCounts=DB::table("T_P_COLLECTION")->where("Type",1)->where("ItemID",$_POST['id'])->count();            if($rushCounts ||  $collectCounts){               return  back()->with("msg","该条信息已经被收藏或合作,暂不能删除!");           }       }        $db = DB::table("T_P_PROJECTINFO")->where("T_P_PROJECTINFO.ProjectID", $_POST['id'])            ->update([                "CertifyState" => $_POST['state'],                "Member" => $_POST['member'],                "Price"=>$_POST['gold'],                "Publisher"=>$_POST['publisher'],                "WordDes"=>$_POST['wordDes'],                "CompanyDes"=>$_POST['companyDes'],                "PublishState"=>$_POST['togetherType'],                'updated_at' => date("Y-m-d H:i:s", time())            ]);        $remark = !empty($_POST['remark']) ? $_POST['remark'] : "";        $result = DB::table("T_P_PROJECTCERTIFY")->where("ProjectID", $_POST['id'])->update([            "State" => $_POST['state'],            "Remark" => $remark,            'updated_at' => date("Y-m-d H:i:s", time())        ]);        if ($db && $result) {            echo "<script>location.href='".session('url')."';</script>";        } else {            return Redirect::to("check/detail/" . $_POST['id']);        }    }    //服务方上传图片    public function upload()    {        $file = Input::file('Filedata');        $clientName = $file->getClientOriginalName();//获取文件名        $tmpName = $file->getFileName();//获取临时文件名        $realPath = $file->getRealPath();//缓存文件的绝对路径        $extension = $file->getClientOriginalExtension();//获取文件的后缀        $mimeType = $file->getMimeType();//文件类型        $newName = time() . mt_rand(1000, 9999) . '.' . $extension;//新文件名//       $path = $file->move(base_path().'/public/upload/images/',$newName);//移动绝对路径//       $filePath = '/upload/images/'.$newName;//存入数据库的相对路径        $path = $file->move(dirname(base_path()) . '/ziyaupload/images/checks/', $newName);//移动绝对路径        $filePath = '/checks/' . $newName;//存入数据库的相对路径        return $filePath;    }    //审核删除照片    public function handle()    {        $id = $_POST['data'];        $title = $_POST['title'];        $db = DB::table("T_P_PROJECTINFO")->where("ProjectID", $id)->update([            $title => 0,            'updated_at' => date("Y-m-d H:i:s", time())        ]);        if ($db) {            $data = array("state" => 1);        } else {            $data = array("state" => 0);        }        return json_encode($data);    }    //处理上传的照片    public function editHandle()    {        $id = $_POST['id'];        $data = $_POST['data'];        $title = $_POST['title'];        $db = DB::table("T_P_PROJECTINFO")->where("ProjectID", $id)->update([            $title => $data,            'updated_at' => date("Y-m-d H:i:s", time())        ]);        if ($db) {            $res = array("state" => 1);        } else {            $res = array("state" => 0);        }        return json_encode($res);    }}