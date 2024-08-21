<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherCart extends Model
{
    use HasFactory;

    protected $table = 'other_cart';

    protected $fillable = ['cart_id', 'product_id', 'color_id', 'quantity', 'price'];

    // Mối quan hệ với Cart
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    // Mối quan hệ với Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Mối quan hệ với ColorPro
    public function color()
    {
        return $this->belongsTo(ColorProduct::class, 'color_id');
    }
}
