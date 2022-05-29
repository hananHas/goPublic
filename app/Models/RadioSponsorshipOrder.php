<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadioSponsorshipOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'sponsorship_program_id',
        'date',
        'price',
        'period',
        'notes',
        'radio_order_id'
    ];
}
