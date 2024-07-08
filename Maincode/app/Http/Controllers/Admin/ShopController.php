<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Shop::all();
        return view('admin.shops.list',['shops' => $shops]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shop = Shop::find($id);
        $shop->delete();
        return redirect()->back()->with('success','Xóa cửa hàng thành công.');
    }

    public function disable($id)
    {
        Shop::where('id', $id)->update(['status'=>2]);
        return redirect()->back()->with('success','Tạm ngưng hoạt động cửa hàng thành công.');
    }

    public function enable($id)
    {
        Shop::where('id', $id)->update(['status'=>1]);
        return redirect()->back()->with('success','Mở hoạt động cửa hàng thành công.');
    }
}
