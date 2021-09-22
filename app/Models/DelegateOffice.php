<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DelegateOffice extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'license_number',
        'updated_by'
    ];

}
