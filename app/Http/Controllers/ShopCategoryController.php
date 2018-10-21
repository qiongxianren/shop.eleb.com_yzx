<?php

namespace App\Http\Controllers;

use App\Models\ShopCategory;
use Illuminate\Http\Request;

class ShopCategoryController extends Controller
{
    public function list()
    {
        //获取所有信息
        $categorys = ShopCategory::all();
        //调用视图显示
        return view('shop_category.list',['categorys'=>$categorys]);
    }
}
