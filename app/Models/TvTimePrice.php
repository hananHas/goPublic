<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TvTimePrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'tv_time_id',
        'period',
        'price_before',
        'price_within'
    ];

    public $timestamps = false;
}
