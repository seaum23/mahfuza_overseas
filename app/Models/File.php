<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['link'];
    
    /**
     * Get the parent fileable model (Candidate or Processing).
     */
    public function fileable()
    {
        return $this->morphTo();
    }
}
