<?php

namespace App\View\Components;

use App\Models\Job;
use Illuminate\View\Component;

class AssignJobToCandidate extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $jobs = Job::get();
        return view('components.assign-job-to-candidate', [
            'jobs' => $jobs,
        ]);
    }
}
