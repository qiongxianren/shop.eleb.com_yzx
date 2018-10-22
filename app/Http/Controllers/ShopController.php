<?php

namespace App\Http\Controllers;

use App\Models\ShopCategory;
use App\Models\Shop;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    //添加商家分类
    public function add()
    {
        $categorys = ShopCategory::all();
        return view('shop.add',compact('categorys'));
    }

    public function save(Request $request)
    {
        //数据验证
        $this->validate($request, [
            'name'=>'required|min:2|max:20',
            'password'=>'required|min:6',
            'email'=>'required',

            'shop_category_id'=>'required',//分类店铺ID
            'shop_name'=>'required|min:2|max:20',//名称
            'shop_img'=>'required|file',//店铺图片
            'shop_rating'=>'required',//评分
            'brand'=>'required',//是否是品牌
            'on_time'=>'required',//是否准时送达
            'fengniao'=>'required',//是否蜂鸟配送
            'bao'=>'required',//是否保标记
            'piao'=>'required',//是否票标记
            'zhun'=>'required',//是否准标记
            'start_send'=>'required',//起送金额
            'send_cost'=>'required',//配送费
            'notice'=>'max:50',
            'discount'=>'max:50',
            'status'=>'required',//状态:1正常,0待审核,-1禁用
            'captcha'=>'required|captcha',

        ],
            [//自定义错误提示
                'name.required'=>'用户名不能为空',
                'name.min'=>'用户名不能少于2位',
                'name.max'=>'用户名不能多于20位',
                'password.required'=>'密码不能为空',
                'password.min:6'=>'密码不能少于6位',
                'email.required'=>'邮箱不能为空',

                'shop_category_id.required'=>'分类不能为空',
                'shop_name.required'=>'店铺名称不能为空',
                'shop_name.min'=>'分类标题不能少于2位',
                'shop_name.max'=>'分类标题不能多于20位',
                'shop_img.required'=>'请提交图片',
                'shop_img.file'=>'提交图片文件不合法',
                'shop_rating.required'=>'评分不能为空',
                'brand.required'=>'是否是品牌不能为空',
                'on_time.required'=>'是否准时送达不能为空',
                'fengniao.required'=>'是否蜂鸟配送不能为空',
                'bao.required'=>'是否保标记不能为空',
                'piao.required'=>'是否票标记不能为空',
                'zhun.required'=>'是否准标记不能为空',
                'start_send.required'=>'起送金额不能为空',
                'send_cost.required'=>'配送费不能为空',
                'notice.max'=>'店公告长度不能超过50',
                'discount.max'=>'优惠信息长度不能超过50',
                'status.required'=>'状态不能为空',
                'captcha.required'=>'验证码不能为空',
                'captcha.captcha'=>'验证码不正确',
            ]);

        //处理上传文件
        $path = $request->file('shop_img')->store('public/shops');

        if($request->notice == null){
            $request->notice = '无';
        }

        if ($request->discount == null){
            $request->discount = '无';
        }

        DB::beginTransaction();
        try{
            $shop = Shop::create([
                'shop_category_id'=>$request->shop_category_id,
                'shop_name'=>$request->shop_name,
                'shop_img'=>$path,
                'shop_rating'=>$request->shop_rating,
                'brand'=>$request->brand,
                'on_time'=>$request->on_time,
                'fengniao'=>$request->fengniao,
                'bao'=>$request->bao,
                'piao'=>$request->piao,
                'zhun'=>$request->zhun,
                'start_send'=>$request->start_send,
                'send_cost'=>$request->send_cost,
                'notice'=>$request->notice,
                'discount'=>$request->discount,
                'status'=>$request->status,
            ]);
            User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
                'status'=>$request->status,
                'shop_id'=>$shop->id,
                'remember_token'=>$request->_token,
            ]);

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
        }

        //添加成功的提示信息
        session()->flash('success','商家信息添加成功');

        return redirect()->route('shop.add');
    }
}
