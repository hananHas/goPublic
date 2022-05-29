<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadioRecordingOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'presenters_num',
        'type',
        'price',
        'notes',
        'radio_order_id',
    ];
}
