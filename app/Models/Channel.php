<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TvChannel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'frequency',
        'horizontal',
        'satellite',
        'codec_rate',
        'error_correction_rate',
        'user_id',
    ];

    public $timestamps = false;
}
