<?php

namespace App\Models;

use App\Models\ManpowerJob;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'credit_type',
        'updated_by',
    ];

    public function visa()
    {
        return $this->hasMany(SponsorVisa::class);
    }

    public function manpower_offices()
    {
        return $this->belongsToMany(ManpowerOffice::class)->withPivot('processing_cost');
    }
}
