<?php

namespace App\Http\Controllers\Admin;

use App\AsUser;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class SystemController extends Controller
{
    //系统管理
    //人员管理列表
  public function index(){
     
      $datas=AsUser::where('t_as_user.Status',1)
          ->leftjoin("t_as_userrole","t_as_userrole.UserID","=","t_as_user.id")
          ->leftjoin("t_as_role","t_as_role.id","=","t_as_userrole.RoleID")
          ->orderBy("t_as_user.id","desc")->paginate(2);
    
    return view("systems/system/index",compact('datas'));
  }
    //添加人员
    public function add(){
      if(!empty($_POST)){
        $_POST['status']=1;
        $password=md5($_POST['password']);
        $db=DB::table("t_as_user")->insertGetId([
            'Name'=>$_POST['name'],
              'Email'=>$_POST['email'],
                'Password'=>$password,
              'PhoneNumber'=>$_POST['number'],
              'Department'=>$_POST['department'],
              'Status'=>$_POST['status'],
            "RoleID"=>$_POST['roleName']
        ]);

        if($db){
          $roleId=$_POST['roleName'];
          DB::table('t_as_userrole')->insert([
             "UserID"=>$db,
            "RoleID"=>$roleId
          ]);

          return Redirect::to('system/index');
        }else{
          return Redirect::to('system/add');
        }
      }
      
      $datas=DB::table("t_as_role")->where("Status",1)->get();
      return view('systems/system/add',compact("datas"));
      
     
    }
    //编辑人员信息
    public function update($id=null){

      if(isset($_POST['_token']) && !empty($_POST['_token'])){
        $Id=$_POST['id'];

        $db=DB::table("t_as_user")->where('id',$Id)->update([
            'Name'=>$_POST['name'],
            'Email'=>$_POST['email'],
            'PhoneNumber'=>$_POST['number'],
            'Department'=>$_POST['department'],
        ]);
        if($db){
        
          return Redirect::to('system/index');
        }else{
          return Redirect::to('system/index');
        }
      }
      $datas=AsUser::find($id)->toArray();
      return view('systems/system/update',compact('datas'));
    }
    //删除人员信息
    public function delete($id){
      DB::table('t_as_user')->where('id',$id)
            ->update(['Status'=>0]);
      return Redirect::to('system/index');
    }
    
}
