<?php

namespace App\Models;

use App\Models\SponsorVisa;
use App\Models\DelegateOffice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sponsor extends Model
{
    use HasFactory;

    protected $fillable = [
        'sponsor_NID',
        'sponsor_name',
        'sponsor_phone',
        'comment',
        'updated_by',
    ];

    public function delegate_office()
    {
        return $this->belongsTo(DelegateOffice::class);
    }

    public function visa()
    {
        return $this->hasMany(SponsorVisa::class);
    }
}
