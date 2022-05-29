<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsNets extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'price',
        'printing_price',
        'agency_price',
        'city_id',
        'company_id',
        'type_id',
        'in_out',
        'is_video',
    ];

    public $timestamps = false;

    public function outdoor_orders()
    {
        return $this->morphMany(OutdoorOrder::class, 'orderable');
    }

}
