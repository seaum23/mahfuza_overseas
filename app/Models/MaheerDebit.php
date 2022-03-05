<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaheerDebit extends Model
{
    use HasFactory;
    
    protected $fillable = ['amount', 'account_id'];

    public function transaction()
    {
        return $this->belongsTo(MaheerTransaction::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
