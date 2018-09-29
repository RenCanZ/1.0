<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{	
	//用户列表页
    public function index(Request $request)
    {	
    	//查询所有数据返回给前台页面
    	$users = User::where('name','like','%'.$request->input('name').'%')
    				->orderBy('id','asc')
    				->paginate(5);
    	return view('index',['user'=>$users,'request'=>$request->all()]);
    }

    //删除用户
    public function destroy(Request $request)
    {	
    	//获取id
    	if($request->ajax()){
    		$id = $request->input('id');

    		//执行删除
    		$bool = User::where('id','=',$id)
    			->delete();
    		//返回数据
    		if($bool){
    			return 1;
    		}else{
    			return 0;
    		}
    	}
    	
    }

    //添加用户页面
    public function create()
    {	
    	return view('add');
    }

    //执行添加操作
    public function store(Request $request)
    {	
    	//获取参数
    	$user = $request->only(['name','pass']);
    	//执行数据库添加
    	try {
    		User::create($user);
    	} catch (Exception $e) {
    		return redirect('/user/add')->back()->withInput()->withErrors("添加失败");
    	}

    	return redirect('/user');
    }

    //执行修改操作
    public function update(Request $request)
    {	
    	//获取参数
    	if($request->ajax()){
    		$id=$request->input('id');
    		$type=$request->input('type');
    		$info=$request->input('info');
    		//判断参数类型 执行更新操作 返回结果
    		if($type==1){
    			User::where('id','=',$id)
    					->update(['name'=>$info]);
    			return 1;
    		}else if($type==2){
    			User::where('id','=',$id)
    					->update(['pass'=>$info]);
    			return 1;
    		}
    	}
    }
}
