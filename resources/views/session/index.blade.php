@extends('layout.default')

@section('contents')
    @include('layout._errors')
    @include('layout._notice')
    <div class="row">
        <h1>商户个人管理</h1>
        你好 {{ $user->name }},欢迎登录
        <table class="table table-bordered table-striped">
            <tr>
                <th>商户ID</th>
                <th>{{ $user->id }}</th>
            </tr>
            <tr>
                <td>商户账户</td>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <td>商户邮箱</td>
                <td>{{ $user->email }}</td>
            </tr>
            </table>
        <a href="{{route('user.editpwd',[$user])}}" class="btn btn-primary btn-block">修改密码</a>
        <a href="{{route('logout')}}" class="btn btn-primary btn-block">退出登录</a>
    </div>
@stop