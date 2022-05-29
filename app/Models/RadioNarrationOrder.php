<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadioNarrationOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'narration_period',
        'price',
        'notes',
        'radio_order_id',
        'narrations_per_day'
    ];
}
