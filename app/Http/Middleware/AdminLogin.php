<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!session('user')) {
            return redirect("/");
        } else {
            $res = DB::table("T_AS_USER")->select("id")->whereIn("RoleID", [1, 9])->get();
            $results = array();
            foreach ($res as $val) {
                $results[] = $val->id;
            }
            $userId = session("userId");
            if (!in_array($userId, $results)) {
                $roles = DB::table("T_AS_USER")->where("id", $userId)->pluck("RoleID");
                $auths = DB::table("T_AS_ROLEAUTH")->where("RoleID", $roles['0'])->get();
                $authArr = array();
                foreach ($auths as $auth) {
                    $authArr[] = $auth->AuthID;
                }
                $path = $request->path();
               if (!in_array($pathAuthIds['0'], $authArr)) {
                    return redirect("/");
                } else {
                    return $next($request);
                }
            } else {
                return $next($request);
            }
        }

    }
}
