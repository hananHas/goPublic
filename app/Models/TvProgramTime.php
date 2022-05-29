<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TvProgramTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'day',
        'hour',
        'tv_program_id',
    ];

    public $timestamps = false;

}
