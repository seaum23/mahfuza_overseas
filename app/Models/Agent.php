<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'full_name',
        'phone',
        'comment',
        'updated_by',
        'password'
    ];
}