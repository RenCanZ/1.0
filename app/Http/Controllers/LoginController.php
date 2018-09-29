<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
    	//获取登录参数
    	$data = $request->all();
    	//对比数据库数据
    	$user = User::where([
    		['name','=',$data['name']],
    		['pass','=',$data['pass']],
    		])->first();
    		
    	if(empty($user)){
    		return redirect('/admin/login');
    	}else{
    		session(['user' => $user]);
    		return redirect('/user');
    	}
    	dd($user);
    }
}
