<?php
/**
 * Created by PhpStorm.
 * User: fengxin
 * Date: 2018/6/6
 * Time: 下午3:25
 */
namespace App\admin\Controllers;
use App\Models\Good;
use Carbon\Carbon;
use Illuminate\Http\Request;

Class GoodsController extends Controller{
    //商品列表
    public function index(){
        $goods=Good::paginate(10);
        return view('admin.goods.index',compact('goods'));
    }
    //增加商品
    public function addGood(Request $request){
        if($request->isMethod('post')){
           $data=$this->validate($request,[
               'title'=>'required|min:3',
               'num_total'=>'required|min:1|numeric',
               'img'=>'required|mimes:jpeg,bmp,png',
               'price_normal'=>'required|numeric|min:0.1',
               'status'=>'required',
               'description'=>'required',
           ],[
               'title.required'=>'商品名称不能为空',
               'num_total.required'=>'库存不能为空',
           ]);
           if($request->file('img')){
              $path=$request->file('img')->storeAs('admin/goods',md5(Carbon::now()).'.'.$request->file('img')->getClientOriginalExtension());
              $data['img']='storage/'.$path;
           }
           Good::create($data);
           return redirect()->route('admin.goods');
        }
        return view('admin.goods.add');
    }
}