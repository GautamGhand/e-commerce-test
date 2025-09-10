<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
     protected $fillable = [
        'cart_id',
        'product_id',
        'price',
        'quantity',
        'sub_total'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
