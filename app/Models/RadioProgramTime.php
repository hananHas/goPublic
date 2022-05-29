<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadioProgramTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'day',
        'day_id',
        'hour',
        'timeable_id',
        'timeable_type'
    ];

    public function timeable()
    {
        return $this->morphTo();
    }

    public $timestamps = false;
}
