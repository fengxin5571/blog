<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Cache;

class seckillTime
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
        $secktime=Cache::get('seckill');
        if(!Carbon::now()->between(new Carbon($secktime[0]),new Carbon($secktime[1]))){
            return redirect()->route('posts.list')->withErrors('对不起，秒杀还没开始');
        }
        return $next($request);
    }
}
