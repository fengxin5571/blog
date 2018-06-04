<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

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
        if(!Carbon::now()->between(Carbon::create(2018,6,4),Carbon::create(2018,12,12))){
            return redirect()->route('posts.list')->withErrors('对不起，秒杀还没开始');
        }
        return $next($request);
    }
}
