<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function add()
    {
        $categorys = MenuCategory::where('shop_id','=',Auth::user()->shop_id)->get();
        return view('menu.add',compact('categorys'));
    }

    public function save(Request $request)
    {
        //数据验证
        $this->validate($request, [
            'goods_name'=>'required|min:2|max:20',
            'category_id'=>'required',
            'goods_price'=>'required',
            'description'=>'required',
            'tips'=>'required',
            'goods_img'=>'required|file',
            'status'=>'required',
            'captcha'=>'required|captcha',

        ],
            [//自定义错误提示
                'goods_name.required'=>'菜品名不能为空',
                'goods_name.min'=>'菜品名不能少于2位',
                'goods_name.max'=>'菜品名不能多于20位',
                'category_id.required'=>'菜品分类不能为空',
                'goods_price.required'=>'价格不能为空',
                'description.required'=>'描述不能为空',
                'tips.required'=>'提示不能为空',
                'goods_img.required'=>'图片不能为空',
                'goods_img.file'=>'文件格式不正确',
                'status.required'=>'状态不能为空',
                'captcha.required'=>'验证码不能为空',
                'captcha.captcha'=>'验证码不正确',
            ]);

        $path = $request->file('goods_img')->store('public/menus');

        $rating = 1; //默认评分1
        $shop_id = Auth::user()->shop_id; //获取登录商家id

        //$month_sales = 0; //默认月销量0

        $rating_count = 1; //默认评分数量1
        $satisfy_count = 1; //默认满意度数量1
        $satisfy_rate = 1; //默认满意度评分1

        //dd($request->month_sales);
        Menu::create([
            'goods_name'=>$request->goods_name,
            'rating'=>$rating,
            'shop_id'=>$shop_id,
            'category_id'=>$request->category_id,
            'goods_price'=>$request->goods_price,
            'description'=>$request->description,

            'rating_count'=>$rating_count,
            'tips'=>$request->tips,
            'satisfy_count'=>$satisfy_count,
            'satisfy_rate'=>$satisfy_rate,
            'goods_img'=>$path,
            'status'=>$request->status,
        ]);

        //添加成功的提示信息
        session()->flash('success','菜品添加成功');

        return redirect()->route('menu.add');

    }

    public function list(Request $request)
    {
        $first = MenuCategory::where([['shop_id','=',Auth::user()->shop_id],['is_selected','=',1]])->first();

        if($first){
            $id = $_GET['id'] ?? $first->id;
        }
        if(!$first){
            $id = $_GET['id'] ?? 1;
        }


        $cates = MenuCategory::where('shop_id','=',Auth::user()->shop_id)->get();
        if($request->keys==null&&$request->section==null&&$request->sections==null){
            $goods = Menu::where([['category_id','=',$id],['category_id',$id]])->get();
        }elseif ($request->section==0&&$request->sections==null){
            $goods=Menu::where([['category_id',$id],['shop_id',Auth::user()->shop_id],['goods_name','like',"%$request->keys%"]])->get();
        }elseif ($request->keys==0){
            $goods=Menu::where([['category_id',$id],['shop_id',Auth::user()->shop_id],])->whereBetween('goods_price',[$request->section,$request->sections])->get();
        }



        return view('menu.list',compact('goods','cates','id'));
    }

    public function edit(Menu $cate){
        return view('menu.edit',compact('cate'));
    }

    public function update(Menu $cate, Request $request){
        $this->validate($request, [
            'goods_name'=>'required|min:2|max:20',
            'category_id'=>'required',
            'goods_price'=>'required',
            'description'=>'required',
            'tips'=>'required',
            'goods_img'=>'required|file',
            'status'=>'required',
        ],
            [
                'goods_name.required'=>'菜品名不能为空',
                'goods_name.min'=>'菜品名不能少于2位',
                'goods_name.max'=>'菜品名不能多于20位',
                'category_id.required'=>'菜品分类不能为空',
                'goods_price.required'=>'价格不能为空',
                'description.required'=>'描述不能为空',
                'tips.required'=>'提示不能为空',
                'goods_img.required'=>'图片不能为空',
                'goods_img.file'=>'文件格式不正确',
                'status.required'=>'状态不能为空',
            ]);

        $shop_id = Auth::user()->shop_id;
        $path = $request->file('goods_img')->store('public/menus');

        $cate->update([
            'goods_name'=>$request->goods_name,
            'shop_id'=>$shop_id,
            'category_id'=>$request->category_id,
            'goods_price'=>$request->goods_price,
            'description'=>$request->description,
            'tips'=>$request->tips,
            'goods_img'=>$path,
            'status'=>$request->status,
        ]);

        session()->flash('success','菜品修改成功');

        return redirect()->route('menu.list');
    }

    public function delete(Menu $cate)
    {
        $cate->delete();

        session()->flash('success','删除成功');
        return redirect()->route('menu.list');

    }
}
