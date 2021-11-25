<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'flight_time',
        'transit',
        'ticket_price',
        'flight_number',
        'flight_from',
        'airline',
        'flight_to',
        'airline',
        'comment',
        'updated_by',
    ];

    public function processing()
    {
        return $this->belongsTo(Processing::class);
    }
}
