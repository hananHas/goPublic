<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TvSponsorshipOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'date',
        'price',
        'period',
        'notes',
        'tv_order_id'
    ];
}
