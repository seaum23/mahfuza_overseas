<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaheerTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['quantity','currency','unit_price','exchange_rate','particular_type','particular_id','purpose', 'account_of', 'transaction_type', 'input_date', 'adjusted_value'];


    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function particular()
    {
        return $this->morphTo();
    }
}
