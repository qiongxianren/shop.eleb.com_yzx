<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function list(){
        $date = date("Y-m-d",time());

        $mo = date("Y-m",time());
        //dd($mo);
        $days=Order::where([['shop_id',Auth::user()->shop_id],['created_at','>=',$date.' 00:00:00'],['created_at','<=',$date.' 23:59:59']])->count();

        $months=Order::where([['shop_id',Auth::user()->shop_id],['created_at','>=',$mo.'-01 00:00:00'],['created_at','<=',$mo.'-31 23:59:59']])->count();

        $all=Order::where('shop_id',Auth::user()->shop_id)->count();

        $orders=Order::where('shop_id',Auth::user()->shop_id)->paginate(5);
        return view('order.list',compact('orders','days','months','all'));
    }

    public function show(Order $order){
        return view('order.show',compact('order'));
    }

    public function delete(Order $order){
        $order->update([
            'status'=>-1
        ]);
        return redirect('order/list')->with('success','订单取消成功');
    }

    public function save(Order $order)
    {
        $order->update([
            'status'=>1
        ]);
        return redirect('order/list')->with('success','发货成功');
    }
}


