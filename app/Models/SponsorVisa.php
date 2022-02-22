<?php

namespace App\Models;

use App\Models\Job;
use App\Models\Sponsor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SponsorVisa extends Model
{
    use HasFactory;

    protected $fillable = [
        'sponsor_visa',
        'issue_date',
        'visa_amount',
        'visa_gender_type',
        'comment',
        'visa_rate',
        'updated_by',
        'job_id',
        'country',
    ];

    protected $attributes = [
        'visa_rate' => 0,
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function sponsor()
    {
        return $this->belongsTo(Sponsor::class);
    }

    public function delegates()
    {
        return $this->hasManyThrough(Delegate::class, Sponsor::class);
    }
}
