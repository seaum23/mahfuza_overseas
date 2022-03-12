<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['quantity','currency','unit_price','exchange_rate','particular_type','particular_id','purpose', 'account_of'];

    public function credits()
    {
        return $this->hasMany(Credit::class);
    }

    public function debits()
    {
        return $this->hasMany(Debit::class);
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
