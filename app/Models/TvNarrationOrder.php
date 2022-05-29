<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TvNarrationOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'narration_period',
        'narrations_per_day',
        'tv_time_id',
        'show_timing',
        'price',
        'notes',
        'tv_order_id',
    ];
}
