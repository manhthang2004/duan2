<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorProduct extends Model
{
    use HasFactory;
    protected $table = 'color_pro';

      // Khai báo các thuộc tính có thể được gán hàng loạt
      protected $fillable = ['product_id', 'color_name', 'image', 'quantity'];

      // Mối quan hệ với Product
      public function product()
      {
          return $this->belongsTo(Product::class);
      }
      // Mối quan hệ với OtherCart
      public function otherCartItems()
      {
          return $this->hasMany(OtherCart::class, 'product_id');
      }
  
      // Mối quan hệ với Brand
      public function brand()
      {
          return $this->belongsTo(Brand::class, 'brand_id');
      }
  
      // Mối quan hệ với ColorPro
      public function colorProducts()
      {
          return $this->hasMany(ColorProduct::class, 'product_id');
      }
      public function otherBills()
      {
          return $this->hasMany(OtherBill::class, 'id_clp');
      }
}
