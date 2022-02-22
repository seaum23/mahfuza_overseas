<?php

namespace App\Models;

use App\Models\Candidate;
use App\Models\SponsorVisa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Processing extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'sponsor_visa_id',
        'updated_by',
    ];


    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function sponsor_visa()
    {
        return $this->belongsTo(SponsorVisa::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    
    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function has_ticket()
    {
        return ( $this->tickets->count() > 0 ) ? true : false;
    }
}
