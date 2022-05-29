<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadioTvBanner extends Model
{
    use HasFactory;

    protected $fillable = [
        'radio_id',
        'banner',
        'price',
    ];

    public $timestamps = false;

}
