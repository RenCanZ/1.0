<?php

namespace App\Http\Middleware;

use Closure;


class SessionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $rand='';
		$randstr= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@~#$%^&*()_+';
		$max = strlen($randstr)-1;
		mt_srand((double)microtime()*1000000);
		for($i=0;$i<32;$i++) {
		   $rand.=$randstr[mt_rand(0,$max)];
		}
		session(['session_id' => $rand]);
		session_id();
		return $next($request);
    }
}
