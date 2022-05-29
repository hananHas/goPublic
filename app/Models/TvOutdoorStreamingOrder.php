<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TvOutdoorStreamingOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'period',
        'presenter_type',
        'price',
        'notes',
        'tv_order_id',
    ];

}
