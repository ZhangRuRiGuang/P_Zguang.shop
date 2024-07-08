<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Setting;
use App\Models\Shop;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        $products = DB::select(
            'select p.*,c.name cate_title,s.name supplier_title from products p, categories c, suppliers s, shops sh
             where p.shop_id = sh.id and p.category_id = c.id and p.supplier_id = s.id and p.qty > 0 and sh.status = 1 AND p.status = 1'
        );
        View::share('categories', Category::where('status',1)->get());
        View::share('products', $products);
        View::share('brands', Brand::where('status',1)->get());
        View::share('setting', Setting::first());
        view()->composer('admin.layouts.index', function ($view) {
            if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role == 1) {
                $shopId = Shop::where('admin_id', Auth::guard('admin')->user()->id)->first()->id;
                $data =  \DB::select('SELECT MONTH(o.created_at) order_month, SUM(o.total) total_price FROM orders o WHERE o.status = 3 AND o.shop_id = ? GROUP BY order_month', [$shopId]);
                $view->with(['data' => $data]);
            }
        });
    }
}
