<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Member;

class SignController extends Controller
{	
	//返回注册界面
    public function signup()
    {
    	//返回注册界面
    	return view('signup');
    }

    //发送验证码
    public function proof(Request $request)
    {
    	//获取传递过来的参数
    	if($request->ajax()){
    		$phone = $request->input('phone');
    		//发送验证码
    		$result = sendMessage($phone);
    		//返回响应数据
    		return response($result);

    	}
    }

    //校验验证码
    public function doproof(Request $request)
    {
    	//获取参数
    	if($request->ajax()){
    		$uyzm = $request->input('yzm');

	    	if(!empty($uyzm) && (null !== $request->cookie('param'))){
	    		$cyzm = $request->cookie('param');
	    		if($cyzm == $uyzm){
	    			return 1;//验证码正确
	    		}else{
	    			return 0;//验证码有误
	    		}
	    	}elseif(empty($uyzm)){
	    		return 2;//验证码为空
	    	}else{
	    		return 3;//验证码过期
	    	}
    	}
    	

    }

    //验证用户名是否可用
    public function uname(Request $request)
    {
    	//获取参数
    	if($request->ajax()){
    		$name = $request->input('name');
    		$mem = Member::where('name','=',$name)
    			->first();
    		if(empty($mem)){
    			return 0;
    		}else{
    			return 1;
    		}
    	}
    }

    //执行注册
    public function dosignup(Request $request)
    {
    	//获取参数
    	$data = $request->except(['_token','yzm']);
    	//执行添加操作
    	// dd($data);
    	try {
    		Member::create($data);
    	} catch (Exception $e) {
    		return redirect('signup');
    	}

    	return '注册成功';
    	
    } 
}
