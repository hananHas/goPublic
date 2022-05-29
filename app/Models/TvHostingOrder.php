<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TvHostingOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'hosting_date',
        'hosting_period',
        'price',
        'notes',
        'tv_order_id',
    ];

}
