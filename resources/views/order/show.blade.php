@extends('layout.default')

@section('contents')
    <h1>订单详情</h1>
    <table class="table table-bordered table-striped">
        <tr>
            <th>订单ID</th>
            <th>{{ $order->id }}</th>
        </tr>
        <tr>
            <td>用户ID</td>
            <td>{{ $order->user_id }}</td>
        </tr>
        <tr>
            <td>商家ID</td>
            <td>{{ $order->shop_id }}</td>
        </tr>
        <tr>
            <td>收货人电话</td>
            <td>{{ $order->tel }}</td>
        </tr>
        <tr>
            <td>收货人姓名</td>
            <td>{{ $order->name }}</td>
        </tr>
        <tr>
            <td>状态</td>
            <td>@if($order->status==-1)订单取消@elseif($order->status==0)待付款@elseif($order->status==1)已发货@elseif($order->status==2)待确认@elseif($order->status==3)完成@endif</td>
        </tr>
        <tr>
            <td>价格</td>
            <td>{{ $order->total }}</td>
        </tr>
    </table>
@stop