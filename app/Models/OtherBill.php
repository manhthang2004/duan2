<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherBill extends Model
{
    use HasFactory;

    protected $table = 'other_bill';

    protected $fillable = [
        'id_bill', 'id_clp', 'name_pro', 'color_product', 'price_pro', 'quantity_pro', 'quantity_cart'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_clp', 'id');
    }

    public function bill()
    {
        return $this->belongsTo(Bill::class, 'id_bill','id');
    }

    public function colorPro()
    {
        return $this->belongsTo(ColorProduct::class, 'id_clp');
    }

 
}
