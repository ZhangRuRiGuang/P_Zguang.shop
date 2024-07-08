<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Customer;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Voucher;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function shopping_cart() {
        return view('client.shopping-cart');
    }

    public function checkout(Request $request) {
        $data = $request->all();
        if (empty($data['shop_id'])) {
            toastr()->error('Vui lòng chọn sản phẩm bạn muốn thanh toán');
            return redirect()->back();
        }
        $shopIds = explode(',',$data['shop_id']);
        $type = $request->type;
        return view('client.checkout', compact('shopIds', 'type'));
    }

    /**
     * Pay
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pay(Request $request){
        $shopIds = explode(',', $request->shop_id);
        if(!Session::has('cart')){
            return view('cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        if ($request->type == 0) {
            Stripe::setApiKey('sk_test_51HgKtQA1q67YUalkoHBcyRRhWX9wzd92uQKM3ES7tpdifxzzRdF6LpeymEdsAXcVTtjRgEvHes0Wh4x8c0ftuYgO008aIpQ0IQ');
            $customer = new Customer();
            $customerDetailsAry = array(
                'email' => $request->input('email'),
                'source' => $request->input('stripeToken')
            );
            $customerDetails = $customer->create($customerDetailsAry);
        }
        try {
            foreach($shopIds as $shopId){
                $total = 0;
                foreach ($cart->items as $row) {
                    $product = Product::find($row['item']['id']);
                    if ($product->shop_id == $shopId) {
                        $total += $row['qty'] * $product->price;
                    }
                }
                if ($request->type == 0) {
                    if (isset($request->voucher)) {
                        $voucher = Voucher::where('code',$request->voucher)->first();
                        Voucher::where('code',$request->voucher)->update(['qty' => $voucher->qty -1]);
                        $charge = Charge::create(array(
                            "customer" => $customerDetails->id,
                            "amount" => $total - $voucher->price,
                            "currency" => $request->input('currency_code'),
                        ));
                    } else {
                        $charge = Charge::create(array(
                            "customer" => $customerDetails->id,
                            "amount" => $total,
                            "currency" => $request->input('currency_code'),
                        ));
                    }
                    $orderId = $charge->id;
                } else {
                    $orderId = 'cod_' . $this->generateRandomString();
                }
                $order = Order::create([
                    'id'      => $orderId,
                    'user_id' => Auth::user()->id,
                    'total'   => $total,
                    'address' => $request->address,
                    'voucher_code' => $request->voucher,
                    'shop_id' => $shopId,
                    'type' => $request->type
                ]);
                foreach($cart->items as $row) {
                    $product = Product::find($row['item']['id']);
                    if ($product->shop_id == $shopId) {
                        OrderDetail::create([
                            'product_id' => $row['item']['id'],
                            'price' => $row['price'],
                            'qty' => $row['qty'],
                            'order_id' => $orderId
                        ]);
                        Product::where('id',$row['item']['id'])->update(['qty' => $product['qty'] - $row['qty']]);
                        Product::where('id',$row['item']['id'])->update(['qty_buy' => $product['qty_buy'] + $row['qty']]);
                        if ($product->qty <= 0) {
                            Product::where('id',$row['item']['id'])->update(['status' => 0]);
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            return redirect()->route('client.checkout')->with('invalid', $e->getMessage());
        }
        $cart->handleCart($shopIds);
        Session::put('cart',$cart);
        return redirect()->route('thank');
    }

    public function thank()
    {
        return view('client.thank');
    }

    public function myOrder()
    {
        $orders = Order::where('user_id',Auth::user()->id)->get();
        return view('client.my-order',compact('orders'));
    }

    public function showMyOrder($id)
    {
        $orders = OrderDetail::where('order_id',$id)
        ->join('products','products.id','=','orders_detail.product_id')
        ->get(['orders_detail.*','products.name','products.price']);
        return view('client.show-my-order',compact('orders','id'));
    }

    public function checkVoucher(Request $request)
    {
        $voucher = Voucher::whereIn('shop_id', explode(',',$request->shop_id))->where('code',$request->code)->first();
        if (!is_null($voucher)) {
            return response()->json([
                'status' => 200,
                'total' => $request->total - $voucher->price,
                'code' => $request->code
            ]);
        } else {
            return response()->json([
                'status' => 403,
                'msg'   => 'Voucher không tồn tại',
                'total' => $request->total
            ]);
        }
    }

    private function generateRandomString($length = 24) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
