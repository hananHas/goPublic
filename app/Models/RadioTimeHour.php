<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadioTimeHour extends Model
{
    use HasFactory;

    protected $fillable = [
        'radio_time_id',
        'hour',
    ];

    public $timestamps = false;
}
