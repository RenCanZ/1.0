<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class UsecouponsController extends Controller
{	
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('useCoupons');
    }

    //已使用优惠券
    public function useCoupons(Request $request)
    {
        $arr = [];
        $coupons_id = [];
        $appid = [];
        $d = $request -> all();
        $userid = $request -> input('userid');
        $usertype = $request -> input('usertype');
        foreach($d as $k => $v) {
            switch ($k) {
                case 'phone':
                    array_push($arr,["$k",'=',"$v"]);
                    break;
                case 'usetime':
                    array_push($arr,["$k",'=',strtotime($v)]);
                    break;
                case 'name':
                    array_push($arr,["coupons.coupon_name",'like',"%$v%"]);
                    break;
                case 'order_num':
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
        if($usertype == 3) {
            $merchant = DB::table('program') -> join('coupons','coupons.appid','=','program.appid') -> where('program.merchant_id','=',$userid) -> select(DB::raw('coupons.id as id')) -> get();
            foreach($merchant as $k => $v) {
                array_push($coupons_id,$v -> id);
            }
            $data = DB::table('user_coupon') -> join('users','user_coupon.userid','=','users.id') -> join('coupons','user_coupon.coupon_id','=','coupons.id') -> whereIn('coupon_id',$coupons_id) -> whereNotNull('usetime') -> get();
            if($arr) {
                $data = DB::table('user_coupon') -> join('users','user_coupon.userid','=','users.id') -> join('coupons','user_coupon.coupon_id','=','coupons.id')
                        -> where($arr) -> whereIn('coupon_id',$coupons_id) -> whereNotNull('usetime') -> get();
            }
        }
        if($usertype == 2) {
            $merchant = DB::table('merchant') -> join('program','merchant.id','=','program.merchant_id') -> where('merchant.dealer_id','=',$userid) -> select(DB::raw('program.appid as appid')) -> get();
            foreach($merchant as $k => $v) {
                array_push($appid,$v -> appid);
            }
            $couid = DB::table('coupons') -> whereIn('appid',$appid) -> get();
            foreach($couid as $k => $v) {
                array_push($coupons_id,$v -> id);
            }
            $data = DB::table('user_coupon') -> join('users','user_coupon.userid','=','users.id') -> join('coupons','user_coupon.coupon_id','=','coupons.id')    -> whereIn('coupon_id',$coupons_id) -> whereNotNull('usetime') -> get();
            if($arr) {
                $data = DB::table('user_coupon') -> join('users','user_coupon.userid','=','users.id') -> join('coupons','user_coupon.coupon_id','=','coupons.id')
                        -> where($arr) -> whereIn('coupon_id',$coupons_id) -> whereNotNull('usetime') -> get();
            }
        }
        if($usertype == 1) {
            $data = DB::table('user_coupon') -> join('users','user_coupon.userid','=','users.id') -> join('coupons','user_coupon.coupon_id','=','coupons.id') -> whereNotNull('usetime') -> get();
            if($arr) {
                $data = DB::table('user_coupon') -> join('users','user_coupon.userid','=','users.id') -> join('coupons','user_coupon.coupon_id','=','coupons.id')
                         -> whereNotNull('usetime') -> where($arr) -> get();
            }
        }
		foreach($data as $k => $v) {
			$data[$k] -> cou_addtime = date('Y-m-d H:i:s',$v -> cou_addtime);
			$usetime = $data[$k] -> usetime;
			if($usetime) {
				$data[$k] -> usetime = date('Y-m-d H:i:s',$v -> usetime);
			}		
		}
    	return $data;
    }
}
