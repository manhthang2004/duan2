<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['pro_name', 'price', 'discount', 'img', 'detail', 'brand_id', 'category_id', 'sold'];

    public function category()
{
    return $this->belongsTo(Category::class, 'category_id');
}

public function brand()
{
    return $this->belongsTo(Brand::class, 'brand_id');
}


    // Mối quan hệ với ColorProduct
    public function colorProducts()
    {
        return $this->hasMany(ColorProduct::class);
    }
    public function otherBills()
    {
        return $this->hasMany(OtherBill::class, 'id_clp', 'id');
    }
}
