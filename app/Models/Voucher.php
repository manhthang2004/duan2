<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'discount'];
    
    public function isValid()
    {
        $now = now();
        return $this->valid_from <= $now && $this->valid_to >= $now;
    }
    public function bills()
    {
        return $this->hasMany(Bill::class, 'voucher', 'code');
    }
}
