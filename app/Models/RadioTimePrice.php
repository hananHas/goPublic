<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadioTimePrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'radio_time_id',
        'period',
        'price',
    ];

    public $timestamps = false;

    public function time()
    {
        return $this->belongsTo(Time::class);
    }
}
