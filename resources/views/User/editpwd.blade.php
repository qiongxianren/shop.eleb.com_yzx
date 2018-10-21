@extends('layout.default')

@section('contents')
    <h1>修改密码</h1>
    @include('layout._errors')
    @include('layout._notice')
    <form method="post" action="{{ route('user.updatepwd',['user'=>$user]) }}" enctype="multipart/form-data">
        <div class="form-group">
            <label>用户名</label>
            <input type="text" name="name" class="form-control" readonly="readonly" value="{{ $user->name }}">
        </div>
        <div class="form-group">
            <label>原密码</label>
            <input type="password" name="oldpassword" class="form-control">
        </div>
        <div class="form-group">
            <label>新密码</label>
            <input type="password" name="newpassword" class="form-control">
        </div>
        <div class="form-group">
            <label>重复密码</label>
            <input type="password" name="repassword" class="form-control">
        </div>
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">提交</button>
    </form>
@stop