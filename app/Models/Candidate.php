<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'passportNum',
        'fName',
        'lName',
        'phone',
        'data_of_birth',
        'gender',
        'issue_date',
        'validity',
        'comment',
        'country',
    ];
}
