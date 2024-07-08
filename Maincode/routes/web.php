<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Client

Route::namespace('Client')->prefix('/')->group(function () {
    Route::namespace('Auth')->prefix('auth')->group(function () {

        Route::get('/login', 'AuthController@showLogin')->name('auth.show.login');
        Route::post('/login', 'AuthController@login')->name('auth.post.login');
        Route::get('/register', 'AuthController@showRegister')->name('auth.show.register');
        Route::post('/register', 'AuthController@register')->name('auth.post.register');
        Route::get('/logout', 'AuthController@logout')->name('auth.logout');
        Route::get('/resetpass', 'AuthController@resetPass')->name('auth.resetpass');
        Route::post('/sendlink', 'AuthController@sendLink')->name('auth.sendlink');
        Route::get('change-password/{token}','AuthController@showChangePassword');
        Route::post('change-password','AuthController@updatePassword')->name('auth.updatepassword');
    });

    Route::get('oauth/{driver}', 'SocialController@redirectToProvider')->name('client.social.oauth');
    Route::get('oauth/{driver}/callback', 'SocialController@handleProviderCallback')->name('client.social.callback');
    Route::get('social-update-info/{token}','SocialController@showUpdateInfo')->name('social.show.update-info');
    Route::post('social-update-info','SocialController@updateInfo')->name('social.update-info');

    Route::get('', 'HomeController@index')->name('client.home');
    Route::get('introduce', 'HomeController@introduce')->name('client.introduce');
    Route::get('product', 'ProductController@product')->name('client.product');
    Route::group(['middleware' => 'filter'], function() {
        Route::get('product-detail/{id}', 'ProductController@product_detail')->name('client.product.detail');
    });
    Route::get('product-search','ProductController@search')->name('client.search.product');
    Route::get('product-category/{category}','ProductController@category')->name('client.product.category');
    Route::get('product-brand/{brand}','ProductController@brand')->name('client.product.brand');
    Route::get('add-to-cart', 'ProductController@addToCart');
    Route::get('delete-item/{id}', 'ProductController@deleteItem')->name('delete.item');
    Route::get('increase-item/{id}', 'ProductController@increaseItem')->name('increase.item');
    Route::get('decrease-item/{id}', 'ProductController@decreaseItem')->name('decrease.item');
    Route::get('shopping-cart', 'OrderController@shopping_cart')->name('client.shopping.cart');
    Route::post('checkout', 'OrderController@checkout')->name('client.checkout');
    Route::get('check-voucher', 'OrderController@checkVoucher');
    Route::post('pay','OrderController@pay')->name('pay');
    Route::get('thank','OrderController@thank')->name('thank');
    Route::get('filter', 'ProductController@filter');
    Route::get('sort', 'ProductController@sort');
    Route::get('my-order','OrderController@myOrder')->name('my.order');
    Route::get('my-order/{id}','OrderController@showMyOrder')->name('my.order.show');
    Route::post('add-rating','RatingController@addRating')->name('add.rating');
    Route::get('wishlist','ProductController@wishlist')->name('client.wishlist');
    Route::get('add-wishlist/{id}','ProductController@addWishlist')->name('client.add.wishlist');
    Route::get('delete-wishlist/{id}','ProductController@deleteWishlist')->name('client.delete.wishlist');
    Route::get('shop/{id}','ProductController@shopDetail')->name('shop.detail');
});

// Admin
Route::namespace('Admin')->prefix('ad')->group(function () {
    Route::get('/', function () {
        if (Auth::guard('admin')->check()) {
            if (Auth::guard('admin')->user()->role == 0) {
                return redirect()->route('shop.list');
            } elseif (Auth::guard('admin')->user()->role == 1) {
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('rating.list');
            }
        } else {
            return redirect()->route('admin.form.login');
        }
    });
    // Register, login, logout
    Route::get('/login', 'LoginController@showLoginForm')->name('admin.form.login');
    Route::post('/login', 'LoginController@login')->name('admin.handle.login');
    Route::get('/register', 'LoginController@showRegisterForm')->name('admin.form.register');
    Route::post('/register', 'LoginController@register')->name('admin.handle.register');
    Route::get('/logout', 'LoginController@logout')->name('admin.handle.logout');

    Route::group(['middleware' => 'check.admin.login'], function() {
        // Dashboard
        Route::get('dashboard','DashboardController@index')->name('dashboard');
        Route::get('filter-order', 'DashboardController@fillterOrder')->name('filter.order');
        Route::get('export-order-excel', 'DashboardController@exportExcel')->name('order.export.excel');
        // Setting
        Route::get('setting','SettingController@index')->name('setting');
        Route::post('setting/{id}','SettingController@update')->name('setting.edit');
        // Category
        Route::group(['prefix'=>'category'],function(){
            Route::get('list','CategoryController@index')->name('category.list');
            
            Route::get('edit/{id}','CategoryController@edit')->name('category.edit.form');

            Route::post('edit/{id}','CategoryController@update')->name('category.edit');

            Route::get('add','CategoryController@create')->name('category.add.form');

            Route::post('add','CategoryController@store')->name('category.add');
            
            Route::get('delete/{id}','CategoryController@destroy')->name('category.delete');

            Route::get('update-status/{id}/{status}','CategoryController@updateStatus')->name('category.update.status');
        });
        // Supplier
        Route::group(['prefix'=>'supplier'],function(){
            Route::get('list','SupplierController@index')->name('supplier.list');
            
            Route::get('edit/{id}','SupplierController@edit')->name('supplier.edit.form');

            Route::post('edit/{id}','SupplierController@update')->name('supplier.edit');

            Route::get('add','SupplierController@create')->name('supplier.add.form');

            Route::post('add','SupplierController@store')->name('supplier.add');
            
            Route::get('delete/{id}','SupplierController@destroy')->name('supplier.delete');
        });
        // Brand
        Route::group(['prefix'=>'brand'],function(){
            Route::get('list','BrandController@index')->name('brand.list');
            
            Route::get('edit/{id}','BrandController@edit')->name('brand.edit.form');

            Route::post('edit/{id}','BrandController@update')->name('brand.edit');

            Route::get('add','BrandController@create')->name('brand.add.form');

            Route::post('add','BrandController@store')->name('brand.add');
            
            Route::get('delete/{id}','BrandController@destroy')->name('brand.delete');

            Route::get('update-status/{id}/{status}','BrandController@updateStatus')->name('brand.update.status');
        });
        // Product
        Route::group(['prefix'=>'product'],function(){
            Route::get('list','ProductController@index')->name('product.list');
            
            Route::get('edit/{id}','ProductController@edit')->name('product.edit.form');

            Route::post('edit/{id}','ProductController@update')->name('product.edit');

            Route::get('add','ProductController@create')->name('product.add.form');

            Route::post('add','ProductController@store')->name('product.add');
            
            Route::get('delete/{id}','ProductController@destroy')->name('product.delete');

            Route::get('update-status/{id}/{status}','ProductController@updateStatus')->name('product.update.status');
        });
         // Voucher
         Route::group(['prefix'=>'voucher'],function(){
            Route::get('list','VoucherController@index')->name('voucher.list');
            
            Route::get('edit/{id}','VoucherController@edit')->name('voucher.edit.form');

            Route::post('edit/{id}','VoucherController@update')->name('voucher.edit');

            Route::get('add','VoucherController@create')->name('voucher.add.form');

            Route::post('add','VoucherController@store')->name('voucher.add');
            
            Route::get('delete/{id}','VoucherController@destroy')->name('voucher.delete');
        });
        // Staff
        Route::group(['prefix'=>'staff'],function(){
            Route::get('list','StaffController@index')->name('staff.list');
            
            Route::get('edit/{id}','StaffController@edit')->name('staff.edit.form');

            Route::post('edit/{id}','StaffController@update')->name('staff.edit');

            Route::get('add','StaffController@create')->name('staff.add.form');

            Route::post('add','StaffController@store')->name('staff.add');
            
            Route::get('delete/{id}','StaffController@destroy')->name('staff.delete');
        });
        // User
        Route::group(['prefix'=>'user'],function(){
            Route::get('list','UserController@index')->name('customer.list');
            
            Route::get('delete/{id}','UserController@destroy')->name('customer.delete');

            Route::get('disable/{id}','UserController@disable')->name('customer.disable');

            Route::get('enable/{id}','UserController@enable')->name('customer.enable');
        });
        // Rating
        Route::group(['prefix'=>'rating'],function(){
            Route::get('list','RatingController@index')->name('rating.list');

            Route::get('show/{id}','RatingController@show')->name('rating.show');
            
            Route::get('delete/{id}','RatingController@destroy')->name('rating.delete');
        });
        // Order
        Route::group(['prefix'=>'order'],function(){
            Route::get('list','OrderController@index')->name('order.list');

            Route::get('show/{id}','OrderController@show')->name('order.show');

            Route::post('edit/{id}','OrderController@update')->name('order.edit');

            Route::get('print/{id}','OrderController@print')->name('order.print');
        });
        // Shop
        Route::group(['prefix'=>'shop'],function(){
            Route::get('list','ShopController@index')->name('shop.list');
            
            Route::get('delete/{id}','ShopController@destroy')->name('shop.delete');

            Route::get('disable/{id}','ShopController@disable')->name('shop.disable');

            Route::get('enable/{id}','ShopController@enable')->name('shop.enable');
        });
        // Setting shop
        Route::get('setting-shop','SettingShopController@index')->name('setting.shop');
        Route::post('setting-shop/{id}','SettingShopController@update')->name('setting.shop.edit');
    });
});