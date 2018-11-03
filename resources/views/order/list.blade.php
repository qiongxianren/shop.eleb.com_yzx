@extends('layout.default')

@section('contents')
    @include('layout._notice')

    <table class="table table-bordered table-striped">
        <tr>
            <th>ID</th>
            <th>用户ID</th>
            <th>商家ID</th>
            <th>收货人电话</th>
            <th>收货人姓名</th>
            <th>状态</th>
            <th>价格</th>
            <th>操作</th>
        </tr>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user_id }}</td>
                <td>{{ $order->shop_id }}</td>
                <td>{{ $order->tel }}</td>
                <td>{{ $order->name }}</td>
                <td>@if($order->status==-1)订单取消@elseif($order->status==0)待付款@elseif($order->status==1)已发货@elseif($order->status==2)待确认@elseif($order->status==3)完成@endif</td>
                <td>{{ $order->total }}</td>
                <td>
                    <a href="{{ route('order.delete',$order) }}" class="btn btn-warning btn-xs">取消订单</a>
                    <a href="{{ route('order.save',$order) }}" class="btn btn-primary btn-xs">发货</a>
                    <a href="{{ route('order.show',$order) }}" class="btn btn-success btn-xs">订单详情</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $orders->links() }}
    <h1>今日订单量：{{ $days }}</h1>
    <h1>本月订单量：{{ $months }}</h1>
    <h1>本店总订单量：{{ $all }}</h1>
@endsection