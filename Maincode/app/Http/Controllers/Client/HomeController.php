<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() {
        $product_slide_1 = Product::where('qty','>',0)->where('status',1)->orderBy('id', 'DESC')->limit(3)->get();
        $product_slide_2 = Product::where('qty','>',0)->where('status',1)->orderBy('id', 'DESC')->skip(3)->limit(3)->get();
        $product_top_sale_1 = Product::where('qty','>',0)->where('status',1)->orderBy('qty_buy', 'DESC')->limit(3)->get();
        $product_top_sale_2 = Product::where('qty','>',0)->where('status',1)->orderBy('qty_buy', 'DESC')->skip(3)->limit(3)->get();
        $product_top_sale_3 = Product::where('qty','>',0)->where('status',1)->orderBy('qty_buy', 'DESC')->skip(6)->limit(3)->get();
        $product_top_review_1 =  DB::select(
            'SELECT b.*, count(a.product_id) FROM ratings a, products b WHERE a.product_id = b.id and b.status = 1 GROUP BY a.product_id ORDER BY count(*) DESC LIMIT 3'
        );
        $product_top_review_2 =  DB::select(
            'SELECT b.*, count(a.product_id) FROM ratings a, products b WHERE a.product_id = b.id and b.status = 1 GROUP BY a.product_id ORDER BY count(*) DESC LIMIT 3 OFFSET 3'
        );
        $product_top_review_3 =  DB::select(
            'SELECT b.*, count(a.product_id) FROM ratings a, products b WHERE a.product_id = b.id and b.status = 1 GROUP BY a.product_id ORDER BY count(*) DESC LIMIT 3 OFFSET 6'
        );
        return view('client.home', compact('product_slide_1', 'product_slide_2', 'product_top_sale_1', 'product_top_sale_2', 'product_top_sale_3', 'product_top_review_1', 'product_top_review_2', 'product_top_review_3'));
    }

    public function introduce()
    {
        return view('client.introduce');
    }
}
