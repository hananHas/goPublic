<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadioNarrationOrderTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'radio_narration_order_id',
        'radio_time_id',
    ];
}
