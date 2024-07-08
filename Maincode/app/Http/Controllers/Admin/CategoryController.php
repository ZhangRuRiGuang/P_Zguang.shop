<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.list',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.add');
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
                    'category-name' => 'required'
                ]);
                $request->image->storeAs('/public/images/categories', $request->image->getClientOriginalName());
                Category::create([
                   'name' => $validated['category-name'],
                   'image_path' => '/storage/images/categories/' . $request->image->getClientOriginalName()
                ]);
                toastr()->success('Thêm thành công');
                return redirect()->route('category.list');
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
        $category = Category::find($id);
        return view('admin.categories.edit',['category' => $category]);
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
        $category = Category::find($id);
        if ($request->hasFile('image')) {
            //  Let's do everything here
            if ($request->file('image')->isValid()) {
                $request->image->storeAs('/public/images/categories', $request->image->getClientOriginalName());
                $category->image_path = '/storage/images/categories/' . $request->image->getClientOriginalName();
            }
        }
        $category->name = $request->input('category-name');
        $category->save();
        toastr()->success('Cập nhật thành công');
        return redirect()->route('category.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        toastr()->success('Xóa thành công');
        return redirect()->route('category.list');
    }

    public function updateStatus($id, $status)
    {
        $product = Category::find($id);
        $product->status = $status;
        $product->save();
        toastr()->success('Cập nhật trạng thái thành công');
        return redirect()->route('category.list');
    }
}
