<?php
/**
 * Created by PhpStorm.
 * User: fengxin
 * Date: 2018/5/8
 * Time: 上午11:41
 */
namespace App\admin\Controllers;
class HomeController extends  Controller{
    public function __construct()
    {
        //$this->middleware('auth:admin');
    }

    public function home(){
        return view('admin.home.index');
    }
}