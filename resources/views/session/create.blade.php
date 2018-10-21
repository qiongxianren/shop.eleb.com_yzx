@extends('layout.default')

@section('contents')
    @include('layout._errors')
    @include('layout._notice')
    <h1>商户登录</h1>
    <form method="post" action="{{ route('login') }}">
        <div class="form-group">
            <label>商户名</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>密码</label>
            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
        </div>
        <div class="form-group">
            <label>验证码</label>
            <input id="captcha" class="form-control" name="captcha" >
            <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember" @if(old('remember')) checked="checked" @endif>记住我
            </label>
        </div>
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">提交</button>
    </form>
@stop