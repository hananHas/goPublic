<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'indoor',
        
        'date',
        'period',
        'orderable_type',
        'orderable_id',
    ];
}
