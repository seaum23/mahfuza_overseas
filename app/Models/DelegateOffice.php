<?php

namespace App\Models;

use App\Models\Sponsor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DelegateOffice extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'license_number',
        'updated_by'
    ];

    public function sponsor()
    {
        return $this->hasMany(Sponsor::class);
    }

}
