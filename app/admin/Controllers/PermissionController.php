<?php
/**
 * Created by PhpStorm.
 * User: fengxin
 * Date: 2018/5/12
 * Time: 下午5:34
 */
namespace App\admin\Controllers;
class PermissionController extends Controller{
    public function list(){
        return view('admin.permission.index');
    }
}