<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsPanel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'price',           //for 14 days
        'printing_price',
        'agency_price',
        'ads_net_id',
        'area_id',
        'ads_company_id',
        'type_id',
        'indoor',
        'size',
        'view_field',
        'lighting',
    ];

    public $timestamps = false;

    public function outdoor_orders()
    {
        return $this->morphMany(OutdoorOrder::class, 'orderable');
    }
}
