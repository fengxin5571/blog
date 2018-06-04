<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class SeckillController extends Controller
{
    //秒杀页面
    public function index(){

        return view('seckill.index');
    }
}
