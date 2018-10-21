@extends('layout.default')

@section('contents')
    @include('layout._notice')
    <table class="table table-bordered table-striped">
        <tr>
            <th>ID</th>
            <th>分类名称</th>
            <th>分类图片</th>
            <th>是否显示</th>
            <th>操作</th>
        </tr>
        @foreach ($categorys as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td><img width="50px" class="img-rounded img-responsive" src="{{ \Illuminate\Support\Facades\Storage::url($category->img) }}"/></td>
                <td>@if($category->status)是@else否@endif</td>
                <td><a href="{{route('shop_category.edit',[$category])}}" class="btn btn-warning btn-xs">修改</a>

                    <a href="{{route('shop_category.delete',[$category])}}" class="btn btn-danger btn-xs">删除</a> </td>
            </tr>
        @endforeach
    </table>
@endsection