<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;

class TongjiController extends Controller
{
    //一周订每日单量
    public function order_week()
    {
        $shop_id=Auth::user()->shop_id;
        $time_start=date('Y-m-d 00:00:00',strtotime('-6 day'));
        $time_end=date('Y-m-d 23:59:59');
        $sql="select date(created_at) as date,count(*) as total from orders where created_at >= '{$time_start}' and created_at <= '{$time_end}' and shop_id = {$shop_id} group by date(created_at)";

        $rows = DB::select($sql);

        //dd($rows);

        $result = [];
        for ($i=0;$i<7;$i++){
            $result[date('Y-m-d',strtotime("-{$i} day"))] = 0;
        }

        foreach ($rows as $row){
            $result[$row->date] = $row->total;
        }


        //dd($result);
        return view('order.order_week',compact('result'));

    }

    public function menu_week()
    {
        $shop_id = Auth::user()->shop_id;
        $time_start = date('Y-m-d 00:00:00',strtotime('-6 day'));
        $time_end = date('Y-m-d 23:59:59');
        $sql = "SELECT
	            DATE(orders.created_at) AS date,order_details.goods_id,
	            SUM(order_details.amount) AS total
                FROM
	            order_details
                JOIN orders ON order_details.order_id = orders.id
                WHERE
                     orders.created_at >= '{$time_start}' and orders.created_at <= '{$time_end}'
                AND shop_id = {$shop_id}
                GROUP BY
                    DATE(orders.created_at),order_details.goods_id";

        $rows = DB::select($sql);
        //构造7天统计格式
        $result = [];
        //获取当前商家的菜品列表
        $menus = Menu::where('shop_id',$shop_id)->select(['id','goods_name'])->get();
        $keyed = $menus->mapWithKeys(function ($item) {
            return [$item['id'] => $item['goods_name']];
        });
        $menus = $keyed->all();
        //dd($menus);
        $week=[];
        for ($i=0;$i<7;$i++){
            $week[] = date('Y-m-d',strtotime("-{$i} day"));
        }
        foreach ($menus as $id=>$name){
            foreach ($week as $day){
                $result[$id][$day] = 0;
            }
        }
        //dd($result);
        foreach ($rows as $row){
            $result[$row->goods_id][$row->date]=$row->total;
        }


        //dd($result);
        $series = [];
        foreach ($result as $id=>$data){
            $serie = [
                'name'=> $menus[$id],
                'type'=>'line',
                'stack'=> '销量',
                'data'=>array_values($data)
            ];
            $series[] = $serie;
        }

        return view('menu.menu_week',compact('result','menus','week','series'));

    }

//统计3月订单量
    public function order_month()
    {
        $shop_id=Auth::user()->shop_id;
        $time_start=date('Y-m',strtotime('-2 month'));
        $time_end=date('Y-m',strtotime('+1 month'));
        $sql="select date_format(created_at,'%Y-%m') as date,count(*) as total from orders where created_at >= '{$time_start}' and created_at < '{$time_end}' and shop_id = {$shop_id} group by date";
        //$sql="select date(created_at) as date,count(*) as total from orders where created_at >= '{$time_start}' and created_at < '{$time_end}' and shop_id = {$shop_id} group by date(created_at)";

        $rows = DB::select($sql);
        //dd($rows);

        $result = [];
        for ($i=0;$i<3;$i++){
            $result[date('Y-m',strtotime("-{$i} month"))] = 0;
        }

        foreach ($rows as $row){
            $result[$row->date] = $row->total;
        }


        //dd($result);
        return view('order.order_month',compact('result'));

    }

    //3月菜品销量统计
    public function menu_month()
    {
        $shop_id = Auth::user()->shop_id;
        $time_start=date('Y-m',strtotime('-2 month'));
        $time_end=date('Y-m');
        $sql = "SELECT
	            DATE_FORMAT(orders.created_at,'%Y-%m') AS date,order_details.goods_id,
	            SUM(order_details.amount) AS total
                FROM
	            order_details
                JOIN orders ON order_details.order_id = orders.id
                WHERE
                     orders.created_at >= '{$time_start}' and orders.created_at <= '{$time_end}'
                AND shop_id = {$shop_id}
                GROUP BY
                    DATE,order_details.goods_id";

        $rows = DB::select($sql);
        //构造3月统计格式
        $result = [];
        //获取当前商家的菜品列表
        $menus = Menu::where('shop_id',$shop_id)->select(['id','goods_name'])->get();
        $keyed = $menus->mapWithKeys(function ($item) {
            return [$item['id'] => $item['goods_name']];
        });
        /*
        $keyed2 = $menus->mapWithKeys(function ($item) {
            return [$item['id'] => 0];
        });
        */
        $menus = $keyed->all();
        //dd($menus);
        $month=[];
        for ($i=0;$i<3;$i++){
            $month[]=date('Y-m',strtotime("-{$i} month"));
        }
        //dd($month);
        foreach ($menus as $id=>$name){
            foreach ($month as $day){
                $result[$id][$day] = 0;
            }
        }
        //dd($result);
        foreach ($rows as $row){
            $result[$row->goods_id][$row->date]=$row->total;
        }


        //dd($result);
        $series = [];
        foreach ($result as $id=>$data){
            $serie = [
                'name'=> $menus[$id],
                'type'=>'line',
                'stack'=> '销量',
                'data'=>array_values($data)
            ];
            $series[] = $serie;
        }

        return view('menu.menu_month',compact('result','menus','month','series'));

    }
}
