<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use DB;

class DealerController extends Controller
{	
    //添加经销商
    public function add (Request $request)
    {
        $data = $request -> except('_token');
        $id = DB::table('dealer') -> insertGetId($data);
        $res = DB::table('dealer') -> where('id','=',$id) -> first();
        if(!$res) {
            return '用户名提交出现了错误！';
        }
        return json_encode($res);
    }

    //获取数据
    public function downList (Request $request)
    {
        $data = $request -> all();
        $name = isset($data['name'])?$data['name']:'';
        $area = isset($data['area'])?$data['area']:'';
        if(!empty($name) && empty($area)) {
            $data = DB::table('dealer') -> where('name','like',"%$name%") -> orderBy('id','asc') -> get();
        }elseif(empty($name) && !empty($area)) {
            $data = DB::table('dealer') -> where('area','like',"%$area%") -> orderBy('id','asc') -> get();
        }elseif(!empty($name) && !empty($area)) {
            $data = DB::table('dealer') -> where('name','like',"%$name%") -> where('area','like',"%$area%") -> orderBy('id','asc') -> get();
        }else{
            $data = DB::table('dealer') -> orderBy('id','asc') -> get();
        }
        return $data;
    }

    //删除数据
    public function deldealer (Request $request)
    {
        $id = $request -> only('id');
        $del = DB::table('dealer') -> where('id','=',$id['id']) -> delete();
        return $del;
    }

    //修改数据
    public function savedealer (Request $request)
    {
        $id = $request -> only('id');
        $data = $request -> except('id');
        $res = DB::table('dealer') -> where('id','=',$id['id']) -> update($data);
        if(!$res) {
            return false;
        }
        return $res;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dealer');
    }

}
