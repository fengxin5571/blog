<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoticeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //通知
    public function index(){
        $notices=Auth::user()->notices;
        return view('notices.index',compact('notices'));
    }

}
