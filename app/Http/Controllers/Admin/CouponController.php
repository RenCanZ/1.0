<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use DB;

class CouponController extends Controller
{	
    public function demo ()
    {
        return view('demo');
    }
	//存储数据
	public function setCoupons (Request $request)
	{	
        $data = $request -> all();
        $data['addtime'] = strtotime($data['addtime']);
        $data['endtime'] = strtotime($data['endtime']);
		$appid = $request -> input('appid');
		$a = DB::table('program') -> where('appid','=',$appid) -> first();
        //dd($data);
		$coupons_id = DB::table('coupons') -> insertGetId($data);
		$id = Redis::get('coupons');
        $id = isset($id)?$id:'';
        $data['id'] = $coupons_id;
        $data['name'] = $data['coupon_name'];
        unset($data['coupon_name']);
        $data['addtime'] = date('Y-m-d',$data['addtime']);
        $data['endtime'] = date('Y-m-d',$data['endtime']);
		$data['program_name'] = $a -> name;
        // dd($data);
		Redis::hmset('coupons'.$coupons_id,$data);
		$id .= $coupons_id.'&';
		Redis::set('coupons',$id);
        return json_encode($data);
	}
	//获取数据
	public function getCoupons ()
	{
        $pro = DB::table('program') -> get();
		$res = [];
		$id = Redis::get('coupons');
		if($id) {
			$id = rtrim($id,'&');
			$data = explode('&',$id);
			foreach($data as $k => $v) {
				$res[$v] = Redis::hgetall('coupons'.$v);	
			}
			foreach($pro as $k => $v) {
				foreach($res as $key => $val) {
					if($v -> appid == $val['appid']) {
						$pro[$k] -> coupons[$key] = $val;
					}
				}            
			}
			return json_encode($pro);
		}else{
			$pro = [];
			return $pro;
		}
	}
	
	//领取优惠券
	public function receiveCoupons (Request $request)
	{
        session_write_close();              
        $data = $request -> only('data');
        $data = json_decode($data['data'],true);
        $sid = isset($data['sid'])?$data['sid']:'';
        if(!$sid) {
            return '缺少参数！';
        }   
        session_id($sid);
        session_start();        
        $key = $_SESSION['val'];    
        $token = isset($data['token'])?$data['token']:'';       
        unset($data['token']);
        ksort($data);
        $md5 = '';
        foreach($data as $k => $v) {
            $md5 .= $k.'='.$v.'&';          
        }
        $info = rtrim($md5,'&').$key;
        $md5 = md5($info);
        if($md5 == $token) {
            $user_id = $data['user_id'];
            $coupon_id = $data['coupon_id'];
            $res = Redis::hgetall('coupons'.$coupon_id);
            $res['num'] -= 1;
            if($res['num'] < 0) {
                $res['num'] = 0;
                return $res['num'];
            }else{
				//dd(date('Y-m-d H:i:s',time()));
				//echo $user_id.'=';echo $coupon_id;
                $row = DB::table('user_coupon') -> insert(['userid' => $user_id,'coupon_id' => $coupon_id,'cou_addtime' => time()]);			
                Redis::hmset('coupons'.$coupon_id,$res);
                $data = DB::table('user_coupon') -> join('coupons', 'coupons.id', '=', 'user_coupon.coupon_id') -> where('user_coupon.userid','=',$user_id) -> get();
                foreach($data as $k => $v) {
                    $data[$k] -> addtime = date('Y-m-d',$v -> addtime);
                    $data[$k] -> endtime = date('Y-m-d',$v -> endtime);
                }
                return json_encode($data);
            }
        }else{
            return '验证错误';
        }		
	} 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('coupons');
    }

    //后台获取数据
    public function adminGetCoupons (Request $request)
    {
        $addtime = substr($request -> input('addtime'),0,10);
        $endtime = substr($request -> input('endtime'),0,10);
        $addtime = isset($addtime)?strtotime($addtime):'';
        $endtime = isset($endtime)?strtotime($endtime):'';
        $userid = $request -> input('userid');
        $usertype = $request -> input('usertype');
        $pro = DB::table('program') -> get();
        $res = [];
        $appid = [];
        $id = Redis::get('coupons');
		$id = isset($id)?$id:'';
        $id = rtrim($id,'&');
		if($id) {
			$data = explode('&',$id);
			foreach($data as $k => $v) {
				$res['coupons'][$v] = Redis::hgetall('coupons'.$v);    
			}
			if($usertype == 3) {
				$pro = DB::table('program') -> where('merchant_id','=',$userid) -> get();
				// $program = DB::table('program') -> where('merchant_id','=',$userid) -> get();
				foreach($pro as $k => $v) {
					array_push($appid,$v -> appid);
				}
				foreach($res['coupons'] as $k => $v) {
					if(!in_array($v['appid'],$appid)) {
						unset($res['coupons'][$k]);
					}
				}
			}
			if($usertype == 2) {
				$pro = DB::table('program') -> join('merchant','merchant.id','=','program.merchant_id') -> select(DB::raw('program.*')) -> where('merchant.dealer_id','=',$userid) -> get();
				foreach($pro as $k => $v) {
					array_push($appid,$v -> appid);
				}
				foreach($res['coupons'] as $k => $v) {
					if(!in_array($v['appid'],$appid)) {
						unset($res['coupons'][$k]);
					}
				}
			}
			//dd($res);
			if($addtime && $endtime) {
				foreach($res['coupons'] as $k => $v) {
					if(strtotime(substr($v['addtime'],0,10)) != $addtime && strtotime(substr($v['endtime'],0,10)) != $endtime) {
						unset($res['coupons'][$k]);
					}
				}
			}
			if($addtime) {
			   foreach($res['coupons'] as $k => $v) {
					if(strtotime(substr($v['addtime'],0,10)) != $addtime) {
						unset($res['coupons'][$k]);
					}
				} 
			}
			//dd($res);
			if($endtime) {
			   foreach($res['coupons'] as $k => $v) {
					if(strtotime(substr($v['endtime'],0,10)) != $endtime) {
						unset($res['coupons'][$k]);
					}
				} 
			}
			foreach($pro as $k => $v) {
				foreach($res['coupons'] as $key => $val) {
					if($v -> appid == $val['appid']) {
						$res['coupons'][$key]['program_name'] = $v -> name;
					}
				}            
			}
			$res['program'] = $pro;
			return $res;
			
		}else{
			$res['program'] = $pro;
			$res['coupons'] = [];
			return $res;
		}
    }

    //删除优惠券
    public function delCoupon (Request $request)
    {   
        $id = $request -> input('id');
        $coupons_id = Redis::get('coupons');
        $coupons_id = rtrim($coupons_id,'&');
        $data = explode('&',$coupons_id);
        foreach($data as $k => $v) {
            if($v == $id) {
                unset($data[$k]);
            }
        }
        $coupons = implode('&',$data).'&';
        Redis::set('coupons',$coupons);    
        $del = DB::table('coupons') -> where('id','=',$id) -> delete();
        $del2 = DB::table('user_coupon') -> where('coupon_id','=',$id) -> delete();
        Redis::del('coupons'.$id);
        return $del;
    }

    //修改优惠券
    public function savecoupon(Request $request)
    {
        $id = $request -> input('id');
        $data = $request -> except('id');
        $data['addtime'] = strtotime($data['addtime']);
        $data['endtime'] = strtotime($data['endtime']);
        // dd($data);
        $res = DB::table('coupons') -> where('id','=',$id) -> update($data);
        $data['name'] = $data['coupon_name'];
        unset($data['coupon_name']);
        $data['id'] = $id;
        $data['addtime'] = date('Y-m-d',$data['addtime']);
        $data['endtime'] = date('Y-m-d',$data['endtime']);
        Redis::hmset('coupons'.$id,$data);
        if(!$res) {
            return false;
        }
        return $res;
    }

}
