<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use DB;


class LoginController extends Controller
{	
	//返回一个登录界面
    public function login()
    {
    	return view('login');
    }

    //执行登录操作
    public function dologin(Request $request)
    {
        $username = $request -> input('username');
        $password = md5($request -> input('password'));
        $user = DB::table('login') -> where([['username','=',"$username"],['password','=',"$password"]]) -> first();
        if($user) {
            session(['username' => $username]);
            session(['type' => $user -> type]);
            session(['userid' => $user -> userid]);
            switch ($user -> type) {
                //1 管理员  2 经销商  3 商户
                case '1':
                    return redirect('/admin/user');
                    break;
                case '2':
                    return redirect('/admin/merchant');
                    break;
                case '3':
                    return redirect('/admin/program');
                    break;
            }        
        }else{
            return back();
        }
    }

    public function psw()
    {
        return view('password');
    }

    public function mpsw(Request $request)
    {
        $old_password = $request -> input('old_password');
        $new_password = md5($request -> input('new_password'));
        $usertype = $request -> input('usertype');
        $userid = $request -> input('userid');
        $password = DB::table('login') -> where([['type','=',$usertype],['userid','=',$userid]]) -> first();
        if(md5($old_password) == $password -> password) {
            $row = DB::table('login') -> where([['type','=',$usertype],['userid','=',$userid]]) -> update(['password' => $new_password]);
            if($row) {
                $request->session()->flush();       
                return 1;
            }else{
                return 2;
            }
        }else{
            return 3;
        }
    }
}
