<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['sku','name','price','category_id','image_path','description','qty','brand_id','qty_buy','supplier_id','status', 'shop_id'];
    protected $table = "products";
}
