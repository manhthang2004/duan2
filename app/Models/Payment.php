<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payment';

    // Các thuộc tính bạn có thể cần khai báo
    protected $fillable = ['name'];

    // Các phương thức và quan hệ khác (nếu cần)
    public function bills()
    {
        return $this->hasMany(Bill::class, 'payment_id');
    }
}
