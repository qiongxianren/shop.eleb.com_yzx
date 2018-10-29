<?php

namespace App\Http\Controllers;


use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuCategoryController extends Controller
{
    public function add()
    {
        return view('menu_category.add');
    }

    public function save(Request $request)
    {
        //数据验证
        $this->validate($request, [
            'name'=>'required|min:2|max:20',
            'captcha'=>'required|captcha',
            'description'=>'required',
        ],
            [//自定义错误提示
                'name.required'=>'分类名不能为空',
                'name.min'=>'分类名不能少于2位',
                'name.max'=>'分类名不能多于20位',
                'description.required'=>'描述不能为空',
                'captcha.required'=>'验证码不能为空',
                'captcha.captcha'=>'验证码不正确',
            ]);

        $type_accumulation = str_random(6);
        $shop_id = Auth::user()->shop_id;

        $cate = MenuCategory::where([['shop_id','=',Auth::user()->shop_id],['is_selected','=',1]])->get();

        if($request->is_selected == 1){
            if(count($cate)){
                DB::update('update menu_categories set is_selected=?',[0]);
            }
        }

        MenuCategory::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'type_accumulation'=>$type_accumulation,
            'shop_id'=>$shop_id,
            'is_selected'=>$request->is_selected,

        ]);

        //添加成功的提示信息
        session()->flash('success','菜品分类添加成功');

        return redirect()->route('menu_category.add');

    }

    public function list()
    {
        $cates = MenuCategory::where('shop_id','=',Auth::user()->shop_id)->get();
        return view('menu_category.list',['cates'=>$cates]);
    }

    public function edit(MenuCategory $cate){
        return view('menu_category.edit',compact('cate'));
    }

    public function update(MenuCategory $cate, Request $request){
        $this->validate($request, [
            'name'=>'required|min:2|max:20',
            'description'=>'required',
        ],
            [
                'name.required'=>'分类名不能为空',
                'name.min'=>'分类名不能少于2位',
                'name.max'=>'分类名不能多于20位',
                'description.required'=>'描述不能为空',
            ]);

        $cates = MenuCategory::where([['shop_id','=',Auth::user()->shop_id],['is_selected','=',1]])->get();

        if($request->is_selected == 1){
            if(count($cates)){
                DB::update('update menu_categories set is_selected=?',[0]);
            }
        }

        $cate->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'is_selected'=>$request->is_selected,
        ]);

        session()->flash('success','菜品分类修改成功');

        return redirect()->route('menu_category.list');
    }

    public function delete(MenuCategory $cate)
    {
        $menu = Menu::where('category_id','=',$cate->id)->first();
        if($menu) {
            return back()->with('danger','菜品分类下还有菜品，不能删除')->withInput();
        }

        $cate->delete();

        session()->flash('success','删除成功');
        return redirect()->route('menu_category.list');

    }
}
