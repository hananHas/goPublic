<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadioCity extends Model
{
    use HasFactory;

    protected $fillable = [
        'radio_id',
        'city_id'
    ];

    public $timestamps = false;
}
