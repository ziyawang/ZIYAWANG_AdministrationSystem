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
  public function index()
  {

    $datas = AsUser::where('t_as_user.Status', 1)
        ->leftJoin("t_as_userrole", "t_as_userrole.UserID", "=", "t_as_user.id")
        ->leftJoin("t_as_role", "t_as_role.id", "=", "t_as_userrole.RoleID")
        ->select("t_as_user.*", "t_as_role.RoleName")
        ->orderBy("t_as_user.id", "desc")->paginate(20);
    return view("systems/system/index", compact('datas'));
  }

  //添加人员
  public function add()
  {
    if (!empty($_POST)) {
      if (!empty($_POST['email'])) {
        $res = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
        $email = $_POST['email'];
        if (!preg_match($res, $email)) {
          return back()->with("msg0", "*请输入正确的邮箱格式!");
          return view("system/add");
        }
        if (!empty($_POST['number'])) {
          $res1 ="/^1[34578]\d{9}$/";
          $number = $_POST['number'];
          if (!preg_match($res1, $number)) {
            return back()->with("msg4", "*请输入正确的手机号!");
            return view("system/add");
          }
          $count=DB::table("t_as_user")->where("Email",$_POST['email'])->count();
          if($count!=0){
            return back()->with("msg5", "*请添加的邮箱号已经存在!");
            return view("system/add");
          }
          $_POST['status'] = 1;
          $password = md5($_POST['password']);
          $db = DB::table("t_as_user")->insertGetId([
              'Name' => $_POST['name'],
              'Email' => $_POST['email'],
              'Password' => $password,
              'PhoneNumber' => $_POST['number'],
              'Department' => $_POST['department'],
              'Status' => $_POST['status'],
              "RoleID" => $_POST['roleName'],
               'created_at'=>date("Y-m-d H:i:s", time()),
             'updated_at'=>date("Y-m-d H:i:s", time())
          ]);

          if ($db) {
            $roleId = $_POST['roleName'];
            DB::table('t_as_userrole')->insert([
                "UserID" => $db,
                "RoleID" => $roleId
            ]);
            return Redirect::to('system/index');
          } else {
            return Redirect::to('system/add');
          }
        } else {
          return back()->with("msg3", "*请输入手机号!");
          return view("system/add");
        }

      } else {
        return back()->with("msg2", "*请输入您的邮箱!");
        return view("system/add");
      }
    }
    $datas=DB::table("t_as_role")->where("Status",1)->get();
        return view('systems/system/add',compact("datas"));
    }
    //编辑人员信息
    public function update($id=null){
      if(isset($_POST['_token']) && !empty($_POST['_token'])){
        if (!empty($_POST['email'])) {
              $res = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
              $email = $_POST['email'];
          if (!preg_match($res, $email)) {
                return back()->with("msg0", "*请输入正确的邮箱格式!");
                return view("system/add");
          }
          if (!empty($_POST['number'])) {
                  $res1 ="/^1[34578]\d{9}$/";
                  $number = $_POST['number'];
            if (!preg_match($res1, $number)) {
                  return back()->with("msg4", "*请输入正确的手机号!");
                  return view("system/add");
            }
              $count=DB::table("t_as_user")->where("Email",$_POST['email'])->count();
            if($count!=0 && $count!=1){
                  return back()->with("msg5", "*您添加的邮箱号已经存在!");
                  return view("system/add");
            }
            $Id=$_POST['id'];
            $db=DB::table("t_as_user")->where('id',$Id)->update([
                'Name'=>$_POST['name'],
                'Email'=>$_POST['email'],
                'PhoneNumber'=>$_POST['number'],
                'Department'=>$_POST['department'],
                "RoleID"=>$_POST['roleName'],
                'updated_at'=>date("Y-m-d H:i:s", time())
            ]);

            if($db){

              $roleId=$_POST['roleName'];
              DB::table('t_as_userrole')->where("UserID",$Id)->update([
                  "RoleID"=>$roleId
              ]);

              return Redirect::to('system/index');
            }else{
              return Redirect::to('system/index');
            }
          } else {
            return back()->with("msg3", "*请输入手机号!");
            return view("system/add");
          }

        } else {
          return back()->with("msg2", "*请输入您的邮箱!");
          return view("system/add");
        }
      }
      $datas=AsUser::find($id)->toArray();
      $results=DB::table("t_as_role")->where("Status",1)->get();
      return view('systems/system/update',compact('datas','results'));
    }
    //删除人员信息
    public function delete($id){
      DB::table('t_as_user')->where('id',$id)
            ->update(['Status'=>0]);
      return Redirect::to('system/index');
    }
    
}
