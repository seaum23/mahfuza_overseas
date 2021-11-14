<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Agent;
use Illuminate\Support\Str;
use App\Models\ExperiencedFile;
use Illuminate\Database\Eloquent\Model;
use App\Models\CandidateTraveledCountry;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'job_id',
        'agent_id',
        'manpower_office_id',
        'experience_status',
        'updated_by',
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function experience_filse()
    {
        return $this->hasMany(ExperiencedFile::class);
    }

    public function countries()
    {
        return $this->hasMany(CandidateTraveledCountry::class);
    }

    /**
     * Accessor for Age.
     */
    public function age()
    {
        return Carbon::parse($this->attributes['data_of_birth'])->age;
    }

    /**
     * Accessor for Passport Expiry Date.
     */
    public function passport_expiry()
    {
        $issue_date = new Carbon($this->attributes['issue_date']);
        $issue_date->addYears($this->attributes['validity']);

        $today = new Carbon();

        $diff = $today->diff($issue_date);

        $difference = array();
        ($diff->y > 0 ) ? ( $difference[] = $diff->y . ' ' . Str::plural('Year', $diff->y) ) : '';
        ($diff->m > 0 ) ? ( $difference[] = $diff->m . ' ' . Str::plural('Month', $diff->m) ) : '';
        ($diff->d > 0 ) ? ( $difference[] = $diff->d . ' ' . Str::plural('Day', $diff->d) ) : '';        
        return implode(', ', $difference);
    }

    /**
     * Accessor for Passport Expiry Date.
     */
    public function experience()
    {
        $arrival_date = new Carbon($this->attributes['arrival_date']);
        $departure_date = new Carbon($this->attributes['departure_date']); 

        $diff = $departure_date->diff($arrival_date);

        $difference = array();
        ($diff->y > 0 ) ? ( $difference[] = $diff->y . ' ' . Str::plural('Year', $diff->y) ) : '';
        ($diff->m > 0 ) ? ( $difference[] = $diff->m . ' ' . Str::plural('Month', $diff->m) ) : '';
        ($diff->d > 0 ) ? ( $difference[] = $diff->d . ' ' . Str::plural('Day', $diff->d) ) : '';        
        return implode(', ', $difference);
    }


}
