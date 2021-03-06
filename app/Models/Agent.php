<?php

namespace App\Models;

use App\Models\Candidate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'full_name',
        'phone',
        'comment',
        'updated_by',
        'password',
        'opening_balance'
    ];

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }

    /**
     * Get all of the post's comments.
     */
    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'particular');
    }

    public function sponsor()
    {
        return $this->morphMany(Sponsor::class, 'sponsorable');
    }
}
