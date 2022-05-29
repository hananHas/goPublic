<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutdoorOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'start_date',
        'end_date',
        'duration',
        'orderable',
        'orderable_id',
        'price',
        'notes',
    ];

    public function orderable()
    {
        return $this->morphTo();
    }
}
