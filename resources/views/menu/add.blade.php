@extends('layout.default')

@section('contents')
    <h1>添加菜品</h1>
    @include('layout._errors')
    @include('layout._notice')
    <form method="post" action="{{route('menu.save')}}" enctype="multipart/form-data">
        <div class="form-group">
            <label>菜品名称</label>
            <input type="text" name="goods_name" class="form-control" value="{{ old('goods_name') }}">
        </div>
        <div class="form-group">
            <label>所属店铺分类</label>
            <select name="category_id" class="form-control">
                @foreach($categorys as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>价格</label>
            <input type="number" name="goods_price" class="form-control" value="{{ old('goods_price') }}">
        </div>
        <div class="form-group">
            <label>描述</label>
            <input type="text" name="description" class="form-control" value="{{ old('description') }}">
        </div>
        <div class="form-group">
            <label>提示信息</label>
            <input type="text" name="tips" class="form-control" value="{{ old('tips') }}">
        </div>
        <div class="form-group">
            <label>商品图片</label>
            <input type="file" name="goods_img">
        </div>
        <div class="form-group">
            <label>状态</label>
            <label class="radio-inline">
                <input type="radio" name="status" value="1" checked="checked"> 上架
            </label>
            <label class="radio-inline">
                <input type="radio" name="status" value="0" > 下架
            </label>
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