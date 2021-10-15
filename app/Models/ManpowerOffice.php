<?php

namespace App\Models;

use App\Models\Job;
use App\Models\ManpowerJob;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ManpowerOffice extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'license',
        'address',
        'comment',
        'updated_by',
    ];

    public function manpower_job()
    {
        return $this->belongsToMany(Job::class)->withPivot('processing_cost');
    }
}
