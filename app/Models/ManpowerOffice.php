<?php

namespace App\Models;

use App\Models\Job;
use App\Models\MaheerTransaction;
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
        'opening_balance'
    ];

    public function manpower_job()
    {
        return $this->belongsToMany(Job::class)->withPivot('processing_cost', 'id');
    }

    public function maheerTransactions()
    {
        return $this->morphMany(MaheerTransaction::class, 'particular');
    }
}
