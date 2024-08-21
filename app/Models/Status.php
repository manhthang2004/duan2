<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $table = 'status';

    protected $fillable = [
        'status_name',
    ];

    // Các mối quan hệ khác nếu có
    public function bills()
    {
        return $this->hasMany(Bill::class, 'id_status');
    }
}
