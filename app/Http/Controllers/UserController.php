<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //注册页面
    public function index(){
        return view('users.register');
    }
    //处理注册
    public function register(Request $request){
        $this->validate($request,[
            'name'=>'required|min:3|unique:users,name',
            'email'=>"required|email|unique:users,email",
            'password'=>'required|min:6|confirmed|max:10'
        ]);
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);
    }
}
