<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Shop;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $shopId = Shop::where('admin_id', Auth::guard('admin')->user()->id)->first()->id;
        $revenueToday =  Order::where([['shop_id', $shopId], ['status', 3]])->whereDate('created_at', Carbon::today())->sum('total');
        $revenueMonth =  DB::select("SELECT SUM(total) total FROM orders WHERE shop_id = $shopId AND status = 3 
        AND MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())
        GROUP BY MONTH(created_at), YEAR(created_at)");
        $revenueYear =  DB::select("SELECT SUM(total) total FROM orders WHERE shop_id = $shopId AND status = 3 
        AND YEAR(created_at) = YEAR(CURRENT_DATE())
        GROUP BY YEAR(created_at)");
        if ($request->has('date')) {
            $date = $request->date;
        } else {
            $date = date('Y-m-d');
        }
        if ($request->has('month') && $request->has('year')) {
            $month = $request->month;
            $year = $request->year;
        } else {
            $month = date('n');
            $year = date('Y');
        }
        $revenueByDate = $this->getRevenueByDate($shopId, $date);
        $revenueByMonthYear = $this->getRevenueByMonthYear($shopId, $month, $year);
        $countUser = Order::where([['shop_id', $shopId], ['status', 3]])->distinct('user_id')->count();

        return view('admin.dashboard.index', compact('countUser', 'revenueToday', 'revenueMonth', 'revenueYear', 'revenueByDate', 'revenueByMonthYear', 'date', 'month', 'year', 'shopId'));
    }

    private function getRevenueByDate($shopId, $date)
    {
        $data = [];
        $orders = Order::join('orders_detail', 'orders.id', '=', 'orders_detail.order_id')
        ->where([['shop_id', $shopId], ['orders.status', 3]])
        ->select(['orders.*', 'orders_detail.product_id', 'orders_detail.qty'])
        ->get();
        foreach ($orders as $order) {
            $product = Product::find($order->product_id);
            if (date('Y-m-d', strtotime($order->created_at)) == $date) {
                if (!isset($data[$product->name])) {
                    $data[$product->name] = [
                        'total' => $product->price * $order->qty
                    ];
                } else {
                    $data[$product->name]['total'] += $product->price * $order->qty;
                }
            }
        }

        return json_encode($data);
    }

    private function getRevenueByMonthYear($shopId, $month, $year)
    {
        $data = [];
        $orders = Order::join('orders_detail', 'orders.id', '=', 'orders_detail.order_id')
        ->where([['shop_id', $shopId], ['orders.status', 3]])
        ->select(['orders.*', 'orders_detail.product_id', 'orders_detail.qty'])
        ->get();
        foreach ($orders as $order) {
            $product = Product::find($order->product_id);
            if (date('m', strtotime($order->created_at)) == $month && date('Y', strtotime($order->created_at)) == $year) {
                if (!isset($data[$product->name])) {
                    $data[$product->name] = [
                        'total' => $product->price * $order->qty
                    ];
                } else {
                    $data[$product->name]['total'] += $product->price * $order->qty;
                }
            }
        }

        return json_encode($data);
    }
}
