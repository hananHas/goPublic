<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadioService extends Model
{
    use HasFactory;

    protected $fillable = [
        'radio_id',
        'service_id'
    ];

    public $timestamps = false;
}
