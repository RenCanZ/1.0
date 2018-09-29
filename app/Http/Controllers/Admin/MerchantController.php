<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use DB;

class MerchantController extends Controller
{	
    //添加商户
    public function add (Request $request)
    {
        $data = $request -> all();
        $id = DB::table('merchant') -> insertGetId($data);
        $res = DB::table('merchant') -> where('id','=',$id) -> first();
        if(!$res) {
            return '提交出现了错误！';
        }
        return json_encode($res);
    }

    //获取数据
    public function downList (Request $request)
    {
        $arr = [];
        $d = $request -> all();
        $userid = $request -> input('userid');
        $usertype = $request -> input('usertype');
        $data['dealer'] = DB::table('dealer') -> get();
        foreach($d as $k => $v) {
            switch ($k) {
                case 'name':
                    array_push($arr,["merchant.name",'like',"%$v%"]);
                    break;
                case 'dealer_name':
                    array_push($arr,["dealer.name",'like',"%$v%"]);
                    break;
            }
            foreach($arr as $key => $val) {
                if(!$val[2]) {
                    unset($arr[$key]);
                }
            }
        }
        if($usertype == 1) {
            $data['merchant'] = DB::table('merchant') -> join('dealer','dealer.id','=','merchant.dealer_id')
                                    -> select(DB::raw('merchant.*,dealer.name as dealer_name')) -> orderBy('id','asc') -> get();
            if($arr) {
                $data['merchant'] = DB::table('merchant') -> join('dealer','dealer.id','=','merchant.dealer_id')
                                    -> select(DB::raw('merchant.*,dealer.name as dealer_name')) -> where($arr) -> orderBy('id','asc') -> get();
            }
        }
        if($usertype == 2) {
            $data['merchant'] = DB::table('merchant') -> join('dealer','dealer.id','=','merchant.dealer_id')
                                -> select(DB::raw('merchant.*,dealer.name as dealer_name')) -> where('dealer_id','=',$userid) -> orderBy('id','asc') -> get();
            $data['dealer'] = DB::table('dealer') -> where('id','=',$userid) -> get();
            if($arr) {
                $data['merchant'] = DB::table('merchant') -> join('dealer','dealer.id','=','merchant.dealer_id')
                                -> select(DB::raw('merchant.*,dealer.name as dealer_name')) -> where($arr) -> where('dealer_id','=',$userid) -> orderBy('id','asc') -> get();
            }
        }
        return $data;
    }

    //删除数据
    public function deldealer (Request $request)
    {
        $id = $request -> input('id');
        $del = DB::table('merchant') -> where('id','=',$id) -> delete();
        return $del;
    }

    //修改数据
    public function savedealer (Request $request)
    {
        $id = $request -> input('id');
        $data = $request -> except('id');
        // dd($data);
        $res = DB::table('merchant') -> where('id','=',$id) -> update($data);
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
        return view('merchant');
    }

}
