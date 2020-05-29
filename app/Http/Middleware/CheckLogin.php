<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $admin = session('admin');
        if(!$admin){
            /**七天免登录 */
            $cookie_admin = request()->cookie('admin');
            if($cookie_admin){
                session(['admin'=>unserialize($cookie_admin)]);
            }else{
                return redirect('./login');
            }
        }

        return $next($request);
    }
}
