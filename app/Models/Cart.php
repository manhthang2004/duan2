<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    
    protected $table = 'cart';

    protected $fillable = [
        'id_user',
        'total',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function otherCartItems()
    {
        return $this->hasMany(OtherCart::class, 'cart_id');
    }

    // Mối quan hệ với Product thông qua OtherCart
    public function products()
    {
        return $this->hasManyThrough(Product::class, OtherCart::class, 'cart_id', 'id', 'id', 'product_id');
    }
}
