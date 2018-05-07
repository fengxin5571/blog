<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['only'=>['center','fan','unfan','userseting']]);
        $this->middleware('guest',['only'=>['index','login']]);
    }

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
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);
        Auth::login($user);
        return redirect()->route("posts.list");
    }
    //用户登录
    public function login(Request $request){
        
        if($request->isMethod("post")){//如果是post提交
            $data=$this->validate($request,[
                'email'=>"required|email",
                'password'=>"required|min:6|max:10"
            ]);
            if(Auth::attempt($data,$request->is_remember)){//验证是否登陆成功
                return redirect()->route('posts.list');
            }
            return redirect()->back()->withErrors("用户名或密码错误！");
        }
        return view("users.login");
    }
    //用户中心
    public function center(User $user){
        $posts=$user->posts()->orderBy("created_at",'desc')->paginate(10);
        $user=$user::withCount('posts','stars','fans')->find($user->id);
        $stars=$user->stars()->paginate('10');
        //dd($stars[0]->stars()->count());
        $fans=$user->fans()->paginate(10);
        return view('users.home',compact('user','posts','stars','fans'));
    }
    //用户设置
    public function userseting(Request $request,User $user){

        if($request->isMethod('post')){
            $this->validate($request,[
                'name'=>'required|min:3'
            ]);
            $name=$request->input('name');
            if($name!=$user->name){
                if(User::where('name',$name)->count()){
                    return redirect()->back()->withErrors('此姓名已经有人注册了');
                }
            }
            $data=array(
                'name'=>$name,
            );
            if($request->file('avatar')){
                $path=$request->file('avatar')->storeAs('avatar/'.$user->id,md5(Carbon::now()).'.'.$request->file('avatar')->getClientOriginalExtension());
                $data['avatar']='storage/'.$path;
            }
            $user->update($data);
            return redirect()->route('users.home',compact('user'));


        }
        return view('users.seting',compact('user'));
    }
    //用户登出
    public function logout(){
        Auth::logout();
        return redirect()->route("login");
    }
    //关注
    public  function fan(User $user){
        if(!Auth::user()->isFan($user->id)){
            Auth::user()->doFan($user->id);
            return response()->json(['error'=>0,'msg'=>'关注成功']);
        }
        return response()->json(['error'=>1,'msg'=>'关注失败']);

    }
    //取消关注
    public function unfan(User $user){
        if(Auth::user()->isFan($user->id)){
            Auth::user()->doUnFan($user->id);
            return response()->json(['error'=>0,'msg'=>'取消关注成功']);
        }
        return response()->json(['error'=>1,'msg'=>'取消关注失败']);
    }
}
