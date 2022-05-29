<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadioTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'radio_id',
        'time_id',
    ];

    public $timestamps = false;

    public function radio()
    {
        return $this->belongsTo(Radio::class);
    }

    public function time()
    {
        return $this->belongsTo(Time::class);
    }
}
