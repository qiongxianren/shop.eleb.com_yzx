@extends('layout.default')

@section('contents')
    <h1>添加用户</h1>
    @include('layout._errors')
    @include('layout._notice')
    <form method="post" action="{{ route('user.save') }}" enctype="multipart/form-data">
        <div class="form-group">
            <label>用户名</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>密码</label>
            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
        </div>
        <div class="form-group">
            <label>邮箱</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label>状态</label>
            <label class="radio-inline">
                <input type="radio" name="status" value="1" checked="checked"> 启用
            </label>
            <label class="radio-inline">
                <input type="radio" name="status" value="0"> 禁用
            </label>
        </div>
        <div class="form-group">
            <label>所属商家</label>
            <select name="shop_id" class="form-control">
                @foreach($shops as $shop)
                    <option value="{{$shop->id}}">{{$shop->shop_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>验证码</label>
            <input id="captcha" class="form-control" name="captcha" >
            <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
        </div>
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">提交</button>
    </form>
@stop