<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use DB;

class ProgramController extends Controller
{	
    //添加商户
    public function add (Request $request)
    {
        $data = $request -> all();
        $res = DB::table('program') -> insert($data);
        if($res) {
            $id = DB::table('merchant') -> where('id','=',$data['merchant_id']) -> first();
            $num = DB::table('dealer') -> where('id','=',$id -> dealer_id) -> first();
            $num -> program_num += 1;
            $res = DB::table('dealer') -> where('id','=',$id -> dealer_id) -> update(['program_num' => $num -> program_num]);
            if($res) {
                return json_encode($data);
            }else{
                return '添加失败';
            }
        }else{
            return '添加失败';
        }       
    }

    //获取数据(待优化)
    public function downList (Request $request)
    {
        $arr = [];
        $merchant_id = [];
        $d = $request -> all();
        $userid = $request -> input('userid');
        $usertype = $request -> input('usertype');
        $data['merchant'] = DB::table('merchant') -> get();
        foreach($d as $k => $v) {
            switch ($k) {
                case 'name':
                    array_push($arr,["program.name",'like',"%$v%"]);
                    break;
                case 'merchant_name':
                    array_push($arr,["merchant.name",'like',"%$v%"]);
                    break;
                case 'type':
                    array_push($arr,["$k",'=',"$v"]);
                    break;
                case 'appid':
                    array_push($arr,["$k",'=',"$v"]);
                    break;
            }
            foreach($arr as $key => $val) {
                if(!$val[2]) {
                    unset($arr[$key]);
                }
            }
        }
        //1 管理员 2 经销商 3 商户
        if($usertype == 1) {
            $data['program'] = DB::table('program') -> join('merchant','merchant.id','=','program.merchant_id')
                               -> select(DB::raw('program.*,merchant.name as merchant_name')) -> get();
            if($arr) {
                $data['program'] = DB::table('program') -> join('merchant','merchant.id','=','program.merchant_id')
                                   -> select(DB::raw('program.*,merchant.name as merchant_name')) -> where($arr)
                                   -> get();
            }   
        }elseif($usertype == 2) {
            $data['merchant'] = DB::table('merchant') -> where('dealer_id','=',$userid) -> get();
            $merchant = DB::table('merchant') -> where('dealer_id','=',$userid) -> get();           
            foreach($merchant as $k => $v) {
                array_push($merchant_id,$v -> id);
            }
            if($merchant_id) {
                $data['program'] = DB::table('program') -> join('merchant','merchant.id','=','program.merchant_id')
                                   -> select(DB::raw('program.*,merchant.name as merchant_name')) -> whereIn('merchant_id',$merchant_id)
                                   -> get();
            }else{
                $data['program'] = [];
            }
            if($arr) {
                $data['program'] = DB::table('program') -> join('merchant','merchant.id','=','program.merchant_id')
                                   -> select(DB::raw('program.*,merchant.name as merchant_name')) -> whereIn('merchant_id',$merchant_id) -> where($arr)
                                   -> get();
            }  
        }elseif($usertype == 3) {
            $data['merchant'] = DB::table('merchant') -> where('id','=',$userid) -> get();
            $merchant = DB::table('program') -> where('merchant_id','=',$userid) -> get();
            $data['program'] = DB::table('program') -> join('merchant','merchant.id','=','program.merchant_id')
                               -> select(DB::raw('program.*,merchant.name as merchant_name')) -> where('merchant_id','=',$userid)
                               -> get();
            if($arr) {
                $data['program'] = DB::table('program') -> join('merchant','merchant.id','=','program.merchant_id')
                                   -> select(DB::raw('program.*,merchant.name as merchant_name')) -> where('merchant_id','=',$userid) -> where($arr)
                                   -> get();
            }  
        }        
        
        return $data;
    }

    //删除数据
    public function deldealer (Request $request)
    {
        $id = $request -> input('id');
        $del = DB::table('program') -> where('id','=',$id) -> delete();
        return $del;
    }

    //修改数据
    public function savedealer (Request $request)
    {
        $id = $request -> input('id');
        $data = $request -> except('id');
        $res = DB::table('program') -> where('id','=',$id) -> update($data);
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
        return view('program');
    }

}
