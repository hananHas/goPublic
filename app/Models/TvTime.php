<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TvTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'tv_channel_id',
        'time_id',
        'from_hour',
        'to_hour',
    ];

    public $timestamps = false;
}
