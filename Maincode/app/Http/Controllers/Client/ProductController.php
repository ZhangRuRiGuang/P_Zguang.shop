<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Wishlist;
use App\Models\Shop;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function product() {
        $products = Product::where('qty','>',0)->where('status',1)->paginate(12);
        $product_slide_1 = Product::where('qty','>',0)->where('status',1)->orderBy('id', 'DESC')->limit(3)->get();
        $product_slide_2 = Product::where('qty','>',0)->where('status',1)->orderBy('id', 'DESC')->skip(3)->limit(3)->get();
        return view('client.product-grid', compact('products', 'product_slide_1', 'product_slide_2'));
    }

    public function product_detail($id) {
        if (Auth::check()) {
            $wishlist = Wishlist::where('user_id',Auth::user()->id)->pluck('product_id')->toArray();
        } else {
            $wishlist = [];
        }
        $ratings = Rating::where('product_id', $id)->get();
        $rating = DB::select(
            'SELECT avg(r.star) avgStar, count(*) countRating FROM ratings r
            JOIN products p ON r.product_id = p.id WHERE r.product_id = ' . $id . ' GROUP BY r.product_id'
        );
        $product = Product::where('products.id', $id)->where('products.status',1)->join('categories','products.category_id','=','categories.id')
        ->join('suppliers','products.supplier_id','=','suppliers.id')
        ->join('brands','products.brand_id','=','brands.id')
        ->select(['products.*','categories.name AS cate_title','brands.name AS brand_title','suppliers.name AS supplier_title'])->first();
        $products = Product::where('category_id',$product->category_id)->where('qty','>',0)->where('products.id','<>',$id)->where('products.status',1)->orderBy('view','DESC')->limit(4)->get();
        // increment view
        Event::dispatch('product.view', $product);
        return view('client.product-detail', compact('product', 'products', 'wishlist', 'ratings', 'rating'));
    }

    public function search(Request $request)
    {
        $q = $request->input('q');
        if (!is_null($q)) {
            $products = Product::where([['qty','>',0],['name','like','%'.$q.'%']])->where('status',1)->paginate(12);
        } else {
            $products = Product::where('qty','>',0)->where('status',1)->paginate(12);
        }
        $product_slide_1 = Product::where('qty','>',0)->orderBy('id', 'DESC')->where('status',1)->limit(3)->get();
        $product_slide_2 = Product::where('qty','>',0)->orderBy('id', 'DESC')->where('status',1)->skip(3)->limit(3)->get();
        return view('client.search',compact('products', 'product_slide_1', 'product_slide_2', 'q'));
    }

    public function addToCart(Request $request)
    {
        $product = Product::find($request->id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product,$product->id);
        $request->session()->put('cart',$cart);
        return response()->json([
            'status' => 200,
            'qty'    => Session::get('cart')->totalQty,
            'price'  => Session::get('cart')->totalPrice
        ]);
    }

    public function deleteItem($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->deleteItem($id);
        if(count($cart->items) > 0){
            Session::put('cart',$cart);
        }else{
            Session::forget('cart');
        }
        return redirect()->back();
    }

    public function increaseItem($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->increaseItemByOne($id);
        Session::put('cart',$cart);
        return redirect()->back();
    }

    public function decreaseItem($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->decreaseItemByOne($id);
        if(count($cart->items) > 0){
            Session::put('cart',$cart);
        }else{
            Session::forget('cart');
        }
        return redirect()->back();
    }

    public function filter(Request $request)
    {
        if ($request->id != 0) {
            $products = Product::join('shops', 'products.shop_id', '=', 'shops.id')->where('brand_id',$request->id)->where('qty','>',0)->where('products.status',1)->where('shops.status',1)->select('products.*')->paginate(12);
        } else {
            $products = Product::join('shops', 'products.shop_id', '=', 'shops.id')->where('qty','>',0)->where('products.status',1)->where('shops.status',1)->select('products.*')->paginate(12);
        }
        return response()->json([
            'status' => 200,
            'data'   => view('client.includes.product-grid', compact('products'))->render()
        ]);
    }

    public function sort(Request $request)
    {
        if ($request->sort == 0) {
            $products = Product::join('shops', 'products.shop_id', '=', 'shops.id')->where('qty','>',0)->where('products.status',1)->where('shops.status',1)->select('products.*')->paginate(12);
        } elseif ($request->sort == 1) {
            $products = Product::join('shops', 'products.shop_id', '=', 'shops.id')->where('qty','>',0)->where('products.status',1)->where('shops.status',1)->orderBy('price','DESC')->select('products.*')->paginate(12);
        } else {
            $products = Product::join('shops', 'products.shop_id', '=', 'shops.id')->where('qty','>',0)->where('products.status',1)->where('shops.status',1)->orderBy('price','ASC')->select('products.*')->paginate(12);
        }
        return response()->json([
            'status' => 200,
            'data'   => view('client.includes.product-grid', compact('products'))->render()
        ]);
    }

    public function category($category)
    {
        $products = Product::where('qty','>',0)->where('category_id',$category)->where('status',1)->paginate(12);
        return view('client.product-category',compact('products', 'category'));
    }

    public function addWishlist($id)
    {
        Wishlist::create([
            'user_id' => Auth::user()->id,
            'product_id' => $id
        ]);
        return redirect()->back();
    }

    public function wishlist()
    {
        $products = Wishlist::select('products.*')->where('user_id',Auth::user()->id)
        ->join('products','products.id','=','wishlist.product_id')
        ->paginate(12);
        return view('client.wishlist',compact('products'));
    }

    public function deleteWishlist($id)
    {
        Wishlist::where('product_id',$id)->where('user_id',Auth::user()->id)->delete();
        return redirect()->back();
    }

    public function brand($brand)
    {
        $products = Product::where('qty','>',0)->where('brand_id',$brand)->where('status',1)->paginate(12);
        return view('client.product-brand',compact('products', 'brand'));
    }

    public function shopDetail($id)
    {
        $shop = Shop::find($id);
        $products = Product::where('shop_id', $id)->where('qty','>',0)->where('status',1)->paginate(12);
        return view('client.shop-detail', compact('shop', 'products'));
    }
}
