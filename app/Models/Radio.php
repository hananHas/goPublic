<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Radio extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'frequency',
        'type',
        'logo',
        'cover_image',
        'recording_price',
        'outdoor_straeming_30',
        'outdoor_straeming_60',
    ];

    public $timestamps = false;

    public function cities()
    {
        return $this->belongsToMany(City::class, 'radio_cities', 'radio_id', 'city_id');
    }

    
    public function services()
    {
        return $this->belongsToMany(Service::class, 'radio_services', 'radio_id', 'service_id');
    }
}
