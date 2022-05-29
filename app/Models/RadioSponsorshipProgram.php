<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadioSponsorshipProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'radio_id',
        'domain_id',
        'sponsorship_price',
    ];

    public $timestamps = false;

    public function times()
    {
        return $this->morphMany(RadioProgramTime::class, 'timeable');
    }

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }
}
