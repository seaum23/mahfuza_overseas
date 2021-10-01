<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManpowerJob extends Model
{
    use HasFactory;
    
    protected $fillable = ['processing_cost', 'job_id'];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
