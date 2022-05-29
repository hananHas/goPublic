<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TvProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'tv_channel_id',
        'presenter',
        'domain_id',
        'hosting_price',
        'sponsorship_price',
        'description',
        'is_program',
    ];

    public $timestamps = false;

    public function times()
    {
        return $this->hasMany(TvProgramTime::class);
    }

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }
}
