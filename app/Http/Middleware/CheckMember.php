<?php

namespace App\Http\Middleware;

use Closure;

class CheckMember
{
    /**
     * Handle an incoming request.
     *检查会员
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = session('user');
        if(!$user){
            return redirect('/login');
        }
        return $next($request);
    }
}
