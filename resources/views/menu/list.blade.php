@extends('layout.default')

@section('contents')
    @include('layout._notice')
    <div class="col-md-1">
    @foreach ($cates as $cate) <a href="/menu/list?id={{ $cate->id }}" class="btn btn-success">{{ $cate->name }}</a><br> @endforeach
    </div>
    <div class="col-md-11">

        <form class="navbar-form navbar-left" action="/menu/list" method="get">
            <input type="hidden" name="id" value="{{ $id }}">
            <div class="form-group">
                菜品名：<input type="text" name="keys" class="form-control" placeholder="Search">
            </div>
            <div class="form-group">
                价格范围：<input type="text" name="section" class="form-control" placeholder="Search">~<input type="text" name="sections" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">搜索</button>
        </form>

    <table class="table table-bordered table-striped">
        <tr>
            <th>ID</th>
            <th>菜品名称</th>
            <th>评分</th>
            <th>所属商家ID</th>
            <th>所属分类ID</th>
            <th>价格</th>
            <th>描述</th>
            <th>月销量</th>
            <th>评分数量</th>
            <th>提示信息</th>
            <th>满意度数量</th>
            <th>满意度评分</th>
            <th>商品图片</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach ($goods as $good)
            <tr>
                <td>{{ $good->id }}</td>
                <td>{{ $good->goods_name }}</td>
                <td>{{ $good->rating }}</td>
                <td>{{ $good->shop_id }}</td>
                <td>{{ $good->category_id }}</td>
                <td>{{ $good->goods_price }}</td>
                <td>{{ $good->description }}</td>
                <td>{{ $good->month_sales }}</td>
                <td>{{ $good->rating_count }}</td>
                <td>{{ $good->tips }}</td>
                <td>{{ $good->satisfy_count }}</td>
                <td>{{ $good->satisfy_rate	 }}</td>
                <td></td>
                <td>@if($good->status)上架@else下架@endif</td>
                <td><a href="#" class="btn btn-success btn-xs">修改</a> <a href="#" class="btn btn-warning btn-xs">删除</a></td>
            </tr>
        @endforeach
    </table>
    </div>
@endsection