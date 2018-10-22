<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SessionController extends Controller
{
    public function create()
    {
        //登录表单

        return view('session.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'password'=>'required',
            'captcha'=>'required|captcha',
        ]);

        //验证 账号密码是否正确
        if(Auth::attempt(['name'=>$request->name,'password'=>$request->password],$request->has('remember'))){
            //认证通过 登录成功 提示登录成功 跳转到上一次访问的页面
            if (Auth::user()->status!=1) {
                return back()->with('danger', '账号未过审，请等待审核')->withInput();
            }

            return redirect()->intended(route('user.index'))->with('success','登录成功');

        }else{
            //登录失败
            return back()->with('danger','用户名或密码错误，请重新登录')->withInput();
        }

    }

    public function destroy()
    {
        //用户退出 注销
        Auth::logout();

        return redirect()->route('login')->with('success','您已成功退出登录');
    }
}
