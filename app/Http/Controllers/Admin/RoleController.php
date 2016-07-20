<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class RoleController extends Controller
{
    //角色展示
    public function index(){

       $datas=DB::table("t_as_role")->orderBy("id","desc")
               ->where("status",1)
               ->paginate(1);
        return view("systems/role/index",compact("datas"));
    }

    //添加角色
    public function add(){
        var_dump($_POST);
        $_POST['status']=1;
        if(isset($_POST['_token'])){
            $db=DB::table("t_as_role")->insert([
                "RoleName"=>$_POST['roleName'],
                "Status"=>$_POST['status']
            ]);
            if($db){
                return Redirect::to("role/index");
            }
        }else{
            return view("systems/role/add");
        }

    }

    //角色的编辑
    public function update($id=""){
        if(isset($_POST['_token'])){
            $id=$_POST['id'];
            DB::table('t_as_role')->where('id',$id)->update([
                "RoleName"=>$_POST['roleName']
            ]);
           
            return Redirect::to("role/index");
        }
        $db=DB::table('t_as_role')->where('id',$id)->get();
        return view('systems/role/update',compact('db'));
    }

    //删除角色
    public function delete($id){
        $db= DB::table("t_as_role")->where("id",$id)->update([
                "status"=>0
        ]);
        if($db){
            return Redirect::to("role/index");
        }
        
    }
 //获取角色名称
    public function getRoleName(){
       $name=$_POST['data'];
       // $name="技术部经理";
        $db=DB::table('t_as_role')->where(["RoleName"=>$name,"Status"=>1])->get();
        if($db){
            $arr["status"]=1;
           
        }else{
            $arr['status']=0;
          
        }
//var_dump($arr);die;
        return json_encode($arr);
    }
}
