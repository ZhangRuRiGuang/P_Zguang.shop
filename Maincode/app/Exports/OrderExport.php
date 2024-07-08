<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Order;
use App\Models\User;
use App\Models\Voucher;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class OrderExport implements FromCollection,WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

   /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $startDate = $this->data['start_date'];
        $endDate = $this->data['end_date'];
        $status = $this->data['status'];
        if ($status == -1) {
            $orders = Order::where('shop_id', Shop::where('admin_id', Auth::guard('admin')->user()->id)->first()->id)
            ->whereBetween('updated_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])->get();
        } else {
            $orders = Order::where('shop_id', Shop::where('admin_id', Auth::guard('admin')->user()->id)->first()->id)
            ->whereBetween('updated_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->where('status', $status)
            ->get();
        }
        foreach ($orders as $order) {
            $order->user = User::find($order['user_id'])->name;
            $order->total = !is_null($order['voucher_code']) ? number_format($order['total'] - Voucher::where('code', $order['voucher_code'])->first()->price,-3,',',',') : number_format($order['total'],-3,',',',') . ' VND';
            $order->voucher = !is_null($order['voucher_code']) ? $order['voucher_code'] : 'Không có';
            $order->start_date = date('d/m/Y H:i:s',strtotime($order['created_at']));
            if ($order->status === 0) {
                $status = 'Chờ xác nhận';
            } elseif ($order->status === 1) {
                $status = 'Đang chuẩn bị đơn hàng';
            } elseif ($order->status === 2) {
                $status = 'Đang giao hàng';
            } elseif ($order->status === 3) {
                $status = 'Đã giao hàng';
            } elseif ($order->status === 4) {
                $status = 'Hủy';
            }
            $order->status_order = $status;
            unset($order['user_id'], $order['created_at'], $order['updated_at'], $order['status'], $order['voucher_code']);
        }
        return $orders;
    }

    public function headings():array
    {
        return [
            'Mã đơn hàng',
            'Tổng tiền',
            'Địa chỉ',
            'Khách hàng',
            'Mã khuyến mãi',
            'Ngày đặt hàng',
            'Trạng thái'
        ];
    }
}