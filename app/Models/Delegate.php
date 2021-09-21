<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delegate extends Model
{
    use HasFactory;

    protected $fillable = [
        'updated_by',
        'name',
        'country',
        'state',
        'comment',
    ];

    // protected $attributes = [
    //     'updated_by' => auth()->id(),
    // ];

    public function delegate_offices()
    {
        return $this->hasMany(DelegateOffice::class);
    }
}
