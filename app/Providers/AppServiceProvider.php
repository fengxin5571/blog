<?php

namespace App\Providers;

use App\Models\Topic;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //时间中文化
        Carbon::setLocale("zh");
        //试图合成器
        \View::composer('layouts.sidebar',function ($view){
            $topics=Topic::all();
            $view->with('topics',$topics);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
