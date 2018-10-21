@extends('layout.default')

@section('contents')
    <h1>添加商家信息</h1>
    @include('layout._errors')
    @include('layout._notice')
    <form method="post" action="{{route('shop.save')}}" enctype="multipart/form-data">
        <div class="form-group">
            <label>所属店铺分类</label>
            <select name="shop_category_id" class="form-control">
                @foreach($categorys as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>名称</label>
            <input type="text" name="shop_name" class="form-control" value="{{ old('shop_name') }}">
        </div>
        <div class="form-group">
            <label>分类图片</label>
            <input type="file" name="shop_img">
        </div>
        <div class="form-group">
            <label>认定评分</label>
            <label class="radio-inline">
                <input type="radio" name="shop_rating" value="1" checked="checked"> 1
            </label>
            <label class="radio-inline">
                <input type="radio" name="shop_rating" value="2"> 2
           </label>
           <label class="radio-inline">
                <input type="radio" name="shop_rating" value="3"> 3
            </label>
            <label class="radio-inline">
                <input type="radio" name="shop_rating" value="4"> 4
            </label>
            <label class="radio-inline">
                <input type="radio" name="shop_rating" value="5"> 5
            </label>
        </div>
        <div class="form-group">
            <label>是否品牌</label>
            <label class="radio-inline">
                <input type="radio" name="brand" value="1" checked="checked"> 是
            </label>
            <label class="radio-inline">
                <input type="radio" name="brand" value="0"> 否
            </label>
        </div>
        <div class="form-group">
            <label>是否准时送达</label>
            <label class="radio-inline">
                <input type="radio" name="on_time" value="1" checked="checked"> 是
            </label>
            <label class="radio-inline">
                <input type="radio" name="on_time" value="0"> 否
            </label>
        </div>
        <div class="form-group">
            <label>是否蜂鸟配送</label>
            <label class="radio-inline">
                <input type="radio" name="fengniao" value="1" checked="checked"> 是
            </label>
            <label class="radio-inline">
                <input type="radio" name="fengniao" value="0"> 否
            </label>
        </div>
        <div class="form-group">
            <label>是否保标记</label>
            <label class="radio-inline">
                <input type="radio" name="bao" value="1" checked="checked"> 是
            </label>
            <label class="radio-inline">
                <input type="radio" name="bao" value="0"> 否
            </label>
        </div>
        <div class="form-group">
            <label>是否票标记</label>
            <label class="radio-inline">
                <input type="radio" name="piao" value="1" checked="checked"> 是
            </label>
            <label class="radio-inline">
                <input type="radio" name="piao" value="0"> 否
            </label>
        </div>
        <div class="form-group">
            <label>是否准标记</label>
            <label class="radio-inline">
                <input type="radio" name="zhun" value="1" checked="checked"> 是
            </label>
            <label class="radio-inline">
                <input type="radio" name="zhun" value="0"> 否
            </label>
        </div>
        <div class="form-group">
            <label>起送金额</label>
            <input type="number" name="start_send" class="form-control" value="{{ old('start_send') }}">
        </div>
        <div class="form-group">
            <label>配送费</label>
            <input type="number" name="send_cost" class="form-control" value="{{ old('send_cost') }}">
        </div>
        <div class="form-group">
            <label>店公告</label>
            <input type="text" name="notice" class="form-control" value="{{ old('notice') }}">
        </div>
        <div class="form-group">
            <label>优惠信息</label>
            <input type="text" name="discount" class="form-control" value="{{ old('discount') }}">
        </div>
        <div class="form-group">
            <label>状态</label>
            <label class="radio-inline">
                <input type="radio" name="status" value="0" readonly="readonly" checked="checked"> 默认待审核，1-2工作日审核通过后可正常登录
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