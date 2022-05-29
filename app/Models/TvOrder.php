<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TvOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'service_id',
        'tv_channel_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
