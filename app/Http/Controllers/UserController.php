<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use function Sodium\compare;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //用户注册
    public function add()
    {
        $shops = Shop::all();
        return view('user.add',compact('shops'));
    }

    public function save(Request $request)
    {
        //数据验证
        $this->validate($request, [
            'name'=>'required|min:2|max:20',
            'password'=>'required|min:6',
            'captcha'=>'required|captcha',
            'email'=>'required',
            'status'=>'required',
            'shop_id'=>'required'
        ],
            [//自定义错误提示
                'name.required'=>'用户名不能为空',
                'name.min'=>'用户名不能少于2位',
                'name.max'=>'用户名不能多于20位',
                'password.required'=>'密码不能为空',
                'password.min:6'=>'密码不能少于6位',
                'captcha.required'=>'验证码不能为空',
                'captcha.captcha'=>'验证码不正确',
                'email.required'=>'邮箱不能为空',
                'status.required'=>'请选择状态',
                'shop_id.required'=>'请选择状态',
            ]);

        //处理密码加密
        $pwd1 = $request->password;
        $pwd2 = bcrypt($pwd1);

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$pwd2,
            'status'=>$request->status,
            'shop_id'=>$request->shop_id,
            'remember_token'=>$request->_token,
        ]);

        //添加成功的提示信息
        session()->flash('success','用户添加成功');

        return redirect()->route('user.add');

    }

    public function index()
    {
        if(Auth::user()==null){
            return redirect()->route('login')->with('warning','请先登录');
        }
        $user = Auth::user();
        return view('session.index',['user'=>$user]);
    }

    public function editpwd(User $user){
        return view('user.editpwd',compact('user'));
    }

    public function updatepwd(User $user,Request $request)
    {
        $this->validate($request, [
            'oldpassword'=>'required',
            'newpassword'=>'required',
            'repassword'=>'required',
        ],
            [//自定义错误提示
                'oldpassword.required'=>'请填写原密码',
                'newpassword.required'=>'请填写新密码',
                'repassword.required'=>'请确认重复密码',
            ]);

        if($request->newpassword == $request->repassword){
            $request->user()->fill([
                'password' => Hash::make($request->newpassword)
            ])->save();

            session()->flash('success','密码修改成功');
        }else{
            session()->flash('danger','密码修改失败，请验证原密码或确认重复密码后重新提交');
        }

        return redirect()->route('user.editpwd');
    }
}
