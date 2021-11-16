<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateTraveledCountry extends Model
{
    use HasFactory;

    protected $fillable = [
        'country'
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
