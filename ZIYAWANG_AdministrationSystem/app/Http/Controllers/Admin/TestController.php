<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    //测评系统的首页
    public function index(){
        $page=isset($_GET['page']) ? $_GET['page'] : 1;
        $count=0;
        if($count==0){
            $datas=DB::table("T_Q_PERSON")->orderBy("TestTime","desc")->paginate(20);
            $counts=DB::table("T_Q_PERSON")->orderBy("TestTime","desc")->count();
        }else{
            $datas=DB::table("T_Q_PERSON")->orderBy("TestTime","desc")->where("Count",$count)->paginate(20);
            $counts=DB::table("T_Q_PERSON")->orderBy("TestTime","desc")->where("Count",$count)->count();
        }
        $number=$counts-20*($page-1);
        foreach ($datas as $data){
            $data->number=$number;
            $number--;
        }
        return view("test/index",compact("datas","count"));
    }

    //ajax添加搜索条件
    public  function ajaxChoose(){
        $page=isset($_GET['page']) ? $_GET['page'] : 1;
        $count=$_GET['count'];
        if($count==0){
            $datas=DB::table("T_Q_PERSON")->orderBy("TestTime","desc")->paginate(20);
            $counts=DB::table("T_Q_PERSON")->orderBy("TestTime","desc")->count();
        }else{
            $datas=DB::table("T_Q_PERSON")->orderBy("TestTime","desc")->where("Count",$count)->paginate(20);
            $counts=DB::table("T_Q_PERSON")->orderBy("TestTime","desc")->where("Count",$count)->count();
        }
        $number=$counts-20*($page-1);
        foreach ($datas as $data){
            $data->number=$number;
            $number--;
        }
        return view("test/index",compact("datas","count"));
    }

    //测评系统添加测试题目
    public  function add(){
        return view("test/add");
    }

}
