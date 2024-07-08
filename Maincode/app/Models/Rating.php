<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','product_id','star','comment','image'];
    protected $table = "ratings";

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
