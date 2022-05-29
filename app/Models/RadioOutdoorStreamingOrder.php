<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadioOutdoorStreamingOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'period',
        'presenter_type',
        'price',
        'notes',
        'radio_order_id',
    ];
}
