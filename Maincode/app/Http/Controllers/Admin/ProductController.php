<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Supplier;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::select(
        'select p.*,c.name cate_title,b.name brand_title, s.name supplier_title from products p,categories c,brands b,suppliers s
         where p.category_id = c.id and p.brand_id = b.id and p.supplier_id = s.id and p.shop_id = ' . Shop::where('admin_id', Auth::guard('admin')->user()->id)->first()->id
        );
        return view('admin.products.list',['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::where('shop_id', Shop::where('admin_id', Auth::guard('admin')->user()->id)->first()->id)->get();
        $suppliers = Supplier::where('shop_id', Shop::where('admin_id', Auth::guard('admin')->user()->id)->first()->id)->get();
        return view('admin.products.add',['categories'=>$categories, 'brands' => $brands, 'suppliers' => $suppliers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            //  Let's do everything here
            if ($request->file('image')->isValid()) {
                //
                $validated = $request->validate([
                    'title' => 'required',
                    'price' => 'required',
                    'category_id' => 'required',
                    'brand_id' => 'required',
                    'supplier_id' => 'required',
                    'quantity' => 'required'
                ]);
                $request->image->storeAs('/public/images/products', $request->image->getClientOriginalName());
                Product::create([
                   'name' => $validated['title'],
                   'price' => $validated['price'],
                   'category_id' => $validated['category_id'],
                   'brand_id' => $validated['brand_id'],
                   'image_path' => '/storage/images/products/' . $request->image->getClientOriginalName(),
                   'description' => $request->input('content'),
                   'view' => $request->input('view'),
                   'supplier_id' => $validated['supplier_id'],
                   'qty' => $validated['quantity'],
                   'shop_id' => Shop::where('admin_id', Auth::guard('admin')->user()->id)->first()->id
                ]);
                toastr()->success('Thêm thành công');
                return redirect()->route('product.list');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::find($id);
        $brands = Brand::where('shop_id', Shop::where('admin_id', Auth::guard('admin')->user()->id)->first()->id)->get();
        $suppliers = Supplier::where('shop_id', Shop::where('admin_id', Auth::guard('admin')->user()->id)->first()->id)->get();
        return view('admin.products.edit',['product' => $product,'categories'=>$categories, 'brands' => $brands, 'suppliers' => $suppliers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $product = Product::find($id);
        if ($request->hasFile('image')) {
            //  Let's do everything here
            if ($request->file('image')->isValid()) {
                $request->image->storeAs('/public/images/products', $request->image->getClientOriginalName());
                $product->image_path = '/storage/images/products/' .  $request->image->getClientOriginalName();
            }
        }
        $product->name = $request->input('title');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        $product->brand_id = $request->input('brand_id');
        $product->description = !empty($request->input('content')) ? $request->input('content'):'';
        $product->view = $request->input('view');
        $product->supplier_id = $request->input('supplier_id');
        $product->qty = $request->input('quantity');
        $product->save();
        toastr()->success('Cập nhật thành công');
        return redirect()->route('product.list');
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        toastr()->success('Xóa thành công');
        return redirect()->route('product.list');
    }

    public function updateStatus($id, $status)
    {
        $product = Product::find($id);
        $product->status = $status;
        $product->save();
        toastr()->success('Cập nhật trạng thái thành công');
        return redirect()->route('product.list');
    }
}
