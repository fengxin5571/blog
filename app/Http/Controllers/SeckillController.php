<?php

namespace App\Http\Controllers;

use App\Models\Good;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SeckillController extends Controller
{
    //秒杀页面
    public function index(){
        $goods=Good::all();
        return view('seckill.index',compact('goods'));
    }

}
