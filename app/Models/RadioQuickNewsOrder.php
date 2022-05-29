<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadioQuickNewsOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'date',
        'price',
        'notes',
        'radio_order_id'
    ];
}
