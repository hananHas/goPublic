<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;
    // for radio times (وقت ذروة وعادي)

    protected $fillable = [
        'name',
        'type',
    ];

    public $timestamps = false;

    public function hours()
    {
        return $this->hasMany(RadioTime::class);
    }

    public function periods()
    {
        return $this->hasMany(RadioTimePrice::class);
    }

    public function tvhours()
    {
        return $this->hasOne(TvTime::class);
    }
}
