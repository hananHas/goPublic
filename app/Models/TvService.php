<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TvService extends Model
{
    use HasFactory;

    protected $fillable = [
        'tv_channel_id',
        'service_id'
    ];

    public $timestamps = false;
}
