<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadioProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'radio_id',
        'domain_id',
        'presenter',
        'description',
        'hosting_price',
        'quick_news_price',
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
