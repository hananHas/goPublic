<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'logo'
    ];

    public $timestamps = false;

    public function radios()
    {
        return $this->belongsToMany(Radio::class, 'radio_services', 'service_id', 'radio_id');
    }

    public function channels()
    {
        return $this->belongsToMany(TvChannel::class, 'tv_services', 'service_id', 'tv_channel_id');
    }

}
