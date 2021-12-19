<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperiencedFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_path'
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
