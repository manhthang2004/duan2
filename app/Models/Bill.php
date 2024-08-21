<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $table = 'bill';

    // Các thuộc tính có thể được gán hàng loạt
    protected $fillable = [
        'name_user',
        'tel_user',
        'address_user',
        'date',
        'total',
        'payment',
        'voucher',
        'id_status',
        'id_user'
    ];

    // Khai báo kiểu dữ liệu cho các thuộc tính
    protected $casts = [
        'date' => 'datetime',
        'total' => 'integer',
        'payment' => 'integer',
        'id_status' => 'integer',
        'id_user' => 'integer'
    ];

    // Định nghĩa quan hệ với model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status', 'id');
    }

    public function otherBills()
    {
        return $this->hasMany(OtherBill::class, 'id_bill', 'id');
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }
    public function voucher()
    {
        return $this->belongsTo(Voucher::class, 'voucher', 'code');
    }
  

}
