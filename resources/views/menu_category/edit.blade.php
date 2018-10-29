@extends('layout.default')

@section('contents')
    <h1>添加菜品分类</h1>
    @include('layout._errors')
    @include('layout._notice')
    <form method="post" action="{{ route('menu_category.update',[$cate]) }}" enctype="multipart/form-data">
        <div class="form-group">
            <label>分类名称</label>
            <input type="text" name="name" class="form-control" value="{{ $cate->name }}">
        </div>
        <div class="form-group">
            <label>描述</label>
            <input type="text" name="description" class="form-control" value="{{ $cate->description }}">
        </div>
        <div class="form-group">
            <label>是否默认分类</label>
            <label class="radio-inline">
                <input type="radio" name="is_selected" value="1" > 是
            </label>
            <label class="radio-inline">
                <input type="radio" name="is_selected" value="0" checked="checked"> 否
            </label>
            <span style="color: red">提示：默认分类只能有一个，如您修改默认，其余分类会自动更改非默认</span>
        </div>
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">提交</button>
    </form>
@stop