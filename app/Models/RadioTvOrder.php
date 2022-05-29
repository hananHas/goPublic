<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadioTvOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'radio_tv_banner_id',
        'start_date',
        'end_date',
        'price',
        'notes',
        'radio_order_id'
    ];
}
