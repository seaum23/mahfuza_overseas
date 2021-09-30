<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
