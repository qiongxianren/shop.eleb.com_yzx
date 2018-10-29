@extends('layout.default')

@section('contents')
    @include('layout._notice')
    <table class="table table-bordered table-striped">
        <tr>
            <th>ID</th>
            <th>分类名称</th>
            <th>菜品编号</th>
            <th>所属商家ID</th>
            <th>描述</th>
            <th>是否是默认分类</th>
            <th>操作</th>
        </tr>
        @foreach ($cates as $cate)
            <tr>
                <td>{{ $cate->id }}</td>
                <td>{{ $cate->name }}</td>
                <td>{{ $cate->type_accumulation }}</td>
                <td>{{ $cate->shop->shop_name }}</td>
                <td>{{ $cate->description }}</td>
                <td>@if($cate->is_selected)是@else否@endif</td>
                <td><a href="{{ route('menu_category.edit',[$cate]) }}" class="btn btn-success btn-xs">修改</a> <a href="{{ route('menu_category.delete',[$cate]) }}" class="btn btn-warning btn-xs">删除</a></td>
            </tr>
        @endforeach
    </table>
@endsection