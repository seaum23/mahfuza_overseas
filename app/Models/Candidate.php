<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Agent;
use App\Models\Processing;
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
        'in_processing',
        'father_name',
        'mother_name',
        'spouse_name',
        'nationality',
        'birth_place',
        'passport_place',
        'division',
        'district',
        'upzilla',
        'union',
        'house',
        'road',
        'post_office',
        'post_code',
        'profession',
        'nominee',
        'nominee_relation',
        'contact_name',
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

    public function processings()
    {
        return $this->hasMany(Processing::class);
    }

    /**
     * Accessor for Age.
     */
    public function age()
    {        
        return Carbon::createFromFormat('Y-m-d', $this->attributes['data_of_birth'])->diff(Carbon::now())->format('%yy%mm%dd');
    }

    /**
     * Accessor for Passport Expiry Date.
     */
    public function passport_expiry()
    {
        $issue_date = new Carbon($this->attributes['issue_date']);
        $issue_date->addYears($this->attributes['validity']);

        $today = Carbon::now();

        $diff = $today->diff($issue_date);

        $difference = array();
        ($diff->y > 0 ) ? ( $difference[] = $diff->y . 'y' ) : '';
        ($diff->m > 0 ) ? ( $difference[] = $diff->m . 'm' ) : '';
        ($diff->d > 0 ) ? ( $difference[] = $diff->d . 'd' ) : '';        
        return implode('', $difference);
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
