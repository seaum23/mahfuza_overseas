<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Processing;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ProcessingController extends Controller
{
    public function index()
    {
        return view('templates.processing.processing_candidates'); 
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request)
    {
        
        if ($request->ajax()) {
            $query = Processing::with('candidate.agent', 'sponsor_visa.sponsor')->select('processings.*')->orderBy('id', 'desc');
            
            return Datatables::of($query)
            ->editColumn('candidate.fName', function ($query)
            {
                $html = '<p> <span class="text-secondary">Name: </span>' . $query->candidate->fName . ' ' . $query->candidate->lName . '</p>';
                $html .= '<p> <span class="text-secondary">Agent: </span>' . $query->candidate->agent->full_name . '</p>';
                $html .= '<p> <span class="text-secondary">Passport: </span>' . $query->candidate->passportNum . '</p>';
                return $html;
            })
            ->editColumn('sponsor_visa.sponsor_visa', function ($query)
            {
                $html = '<p> <span class="text-secondary">Visa: </span>' . $query->sponsor_visa->sponsor_visa . '</p>';
                $html .= '<p> <span class="text-secondary">Id: </span>' . $query->sponsor_visa->sponsor->sponsor_NID . '</p>';
                return $html;
            })
            ->editColumn('employee_request', function ($query)
            {
                if($query->employee_request == 0){
                    return '<button onclick="employee_request('.$query->id.')" class="btn btn-secondary btn-sm target-click">No</button>';
                }
                
                return '<badge class="badge badge-primary">Done</badge>';
            })
            ->editColumn('foreign_mole', function ($query)
            {
                if($query->foreign_mole == 0){
                    return '<button onclick="foreign_mole('.$query->id.')" class="btn btn-secondary btn-sm">No</button>';
                }
                
                return '<badge class="badge badge-primary">Done</badge>';
            })
            ->editColumn('okala', function ($query)
            {
                if($query->okala == 0){
                    return '<button onclick="update_okala_modal('.$query->id.', \'' . $query->candidate->fName . ' ' . $query->candidate->lName . '\')" data-toggle="modal" data-target="#okala_modal" class="btn btn-secondary btn-sm">No</button>';
                }

                $reupload_button = '<button onclick="update_okala_modal('.$query->id.', \'' . $query->candidate->fName . ' ' . $query->candidate->lName . '\')" data-toggle="modal" data-target="#okala_modal" class="btn btn-info btn-sm"><i class="fas fa-redo"></i></button>';
                $show_file = '<a target="_blank" class="btn btn-secondary btn-xs" role="button" href="'.asset($query->okala_file).'"><i class="fas fa-search"></i></a>';
                
                return '<div class="btn-group" role="group" aria-label="Basic example">' . $reupload_button . $show_file . '</div>';
            })
            ->editColumn('mufa', function ($query)
            {
                if($query->mufa == 0){
                    return '<button onclick="update_mufa_modal('.$query->id.', \'' . $query->candidate->fName . ' ' . $query->candidate->lName . '\')" data-toggle="modal" data-target="#mufa_modal" class="btn btn-secondary btn-sm">No</button>';
                }

                $reupload_button = '<button onclick="update_mufa_modal('.$query->id.', \'' . $query->candidate->fName . ' ' . $query->candidate->lName . '\')" data-toggle="modal" data-target="#mufa_modal" class="btn btn-info btn-sm"><i class="fas fa-redo"></i></button>';
                $show_file = '<a target="_blank" class="btn btn-secondary btn-xs" role="button" href="'.asset($query->mufa_file).'"><i class="fas fa-search"></i></a>';
                
                return '<div class="btn-group" role="group" aria-label="Basic example">' . $reupload_button . $show_file . '</div>';
            })
            ->editColumn('medical_update', function ($query)
            {
                if($query->medical_update == 0){
                    return '<button onclick="medical_update('.$query->id.')" class="btn btn-secondary btn-sm">No</button>';
                }
                
                return '<badge class="badge badge-primary">Done</badge>';
            })
            ->editColumn('visa_stamping', function ($query)
            {
                if($query->visa_stamping == 0){
                    return '<button onclick="update_visa_stamping('.$query->id.', \'' . $query->candidate->fName . ' ' . $query->candidate->lName . '\')" data-toggle="modal" data-target="#visa_stamping_modal" class="btn btn-secondary btn-sm">No</button>';
                }
                
                return '<a href="'.route('visa_stamping', [$query->id]).'"><badge style="cursor: pointer;" class="badge badge-primary">'.$query->visa_stamping_date.'</badge></a>';
            })
            ->editColumn('finger', function ($query)
            {
                if($query->finger == 0){
                    return '<button onclick="finger_update('.$query->id.')" class="btn btn-secondary btn-sm">No</button>';
                }
                
                return '<badge class="badge badge-primary">Done</badge>';
            })
            ->editColumn('candidate.training_card_file', function ($query)
            {
                if($query->candidate->experience_status == 2){ // Experienced
                    return '<a href="'.url('/candidate/experienced/' . $query->candidate->id).'"><button class="btn btn-xs btn-info">Experienced</button></a>';
                }

                if($query->candidate->experience_status == 1 AND empty($query->candidate->training_card_file)){ // Needs training card
                    return '<button onclick="update_training_card('.$query->candidate->id.', \''.$query->fName . ' ' . $query->lName.'\')" data-toggle="modal" data-target="#traning_card_modal" class="btn btn-xs btn-secondary">No</button>';
                }

                $reupload_button = '<button onclick="update_training_card('.$query->candidate->id.', \''.$query->fName . ' ' . $query->lName.'\')" data-toggle="modal" data-target="#traning_card_modal" class="btn btn-xs btn-secondary"><i class="fas fa-redo"></i></button>';
                $show_file = '<a target="_blank" class="btn btn-info btn-xs" role="button" href="'.asset($query->candidate->training_card_file).'"><i class="fas fa-search"></i></a>';
                
                return '<div class="btn-group" role="group" aria-label="Basic example">' . $reupload_button . $show_file . '</div>';
            })
            
            ->editColumn('manpower', function ($query)
            {
                if($query->manpower == 0){
                    return '<button onclick="update_manpower_modal('.$query->id.', \'' . $query->candidate->fName . ' ' . $query->candidate->lName . '\')" data-toggle="modal" data-target="#manpower_modal" class="btn btn-secondary btn-sm">No</button>';
                }

                $reupload_button = '<button onclick="update_manpower_modal('.$query->id.', \'' . $query->candidate->fName . ' ' . $query->candidate->lName . '\')" data-toggle="modal" data-target="#manpower_modal" class="btn btn-info btn-sm"><i class="fas fa-redo"></i></button>';
                $show_file = '<a target="_blank" class="btn btn-secondary btn-xs" role="button" href="'.asset($query->manpower_card_file).'"><i class="fas fa-search"></i></a>';
                
                return '<div class="btn-group" role="group" aria-label="Basic example">' . $reupload_button . $show_file . '</div>';
            })
            ->editColumn('ticket', function ($query)
            {
                if(!$query->has_ticket()){
                    return '<a href="'.route('ticket', $query->id).'"><button class="btn btn-secondary btn-sm">No</button></a>';
                }

                $latest_ticket = $query->tickets()->latest()->first();

                return '<a href="'.route('ticket.edit', [$query->id]).'"><badge style="cursor: pointer;" class="badge badge-primary">'.$latest_ticket->flight_time.'</badge></a>';
                
            })
            ->addColumn('action', function ($query) {
                $html = '<div class="btn-group" role="group" aria-label="Basic example">';
                $html .= '<button onclick="processing_transaction(\''.$query->id.'\', \''.$query->candidate->fName.' '.$query->candidate->lName.'\')" data-toggle="modal" data-target="#transaction_modal" class="btn btn-warning btn-xs"><i class="fas fa-dollar-sign"></i></button>';
                if($query->pending == '0'){
                    $html .= '<button onclick="flight_update(\''.$query->id.'\')" class="btn btn-secondary btn-xs"><i class="fas fa-plane"></i></button>';
                    $html .= '<button onclick="flight_return_update(\''.$query->id.'\')" class="btn btn-danger btn-xs"><i class="fas fa-user"></i></button>';
                }else if($query->pending == '2'){
                    $html .= '<button class="btn btn-success btn-xs"><i class="fas fa-plane"></i></button>';
                }else if($query->pending == '3'){
                    $html .= '<button class="btn btn-danger btn-xs"><i class="fas fa-plane"></i></button>';
                }
                return $html . '</div>';
            })
            ->rawColumns(['action', 'candidate.fName', 'sponsor_visa.sponsor_visa', 'employee_request', 'foreign_mole', 'okala', 'mufa', 'medical_update', 'visa_stamping', 'finger', 'candidate.training_card_file', 'manpower', 'ticket'])
            ->make(true);
        }
    }

    public function employee_request(Processing $processing)
    {
        $processing->employee_request = 1;

        $processing->save();
    }

    public function foreign_mole(Processing $processing)
    {
        $processing->foreign_mole = 1;

        $processing->save();
    }

    public function okala_update(Request $request)
    {
        $processing = Processing::with('candidate.agent')->find($request->update_okala_id);

        $processing->okala = 1;
        $processing->okala_file = move($request->okala_file, 'candidate', 'okala_file_' . $processing->id . '_' . time() );
        
        if($request->okala_amount > 0){
            transaction($request->okala_amount, $processing->candidate->agent->id, $processing->candidate->id, $request->okala_amount_payment_account);
        }

        $processing->save();
    }

    public function mufa_update(Request $request)
    {
        $processing = Processing::with('candidate.agent')->find($request->update_mufa_id);

        $processing->mufa = 1;
        $processing->mufa_file = move($request->mufa_file, 'candidate', 'mufa_file_' . $processing->id . '_' . time() );
        
        if($request->mufa_amount > 0){
            transaction($request->mufa_amount, $processing->candidate->agent->id, $processing->candidate->id, $request->mufa_amount_payment_account);
        }

        $processing->save();
    }

    public function medical_update(Processing $processing)
    {
        $processing->medical_update = 1;

        $processing->save();
    }

    public function visa_stamping_update(Request $request)
    {
        $processing = Processing::find($request->update_visa_stamping_id);

        $processing->visa_stamping = 1;

        if(isset($request->stamping_date)){
            $processing->visa_stamping_date = $request->stamping_date;
        }
        if(!empty($request->visa_stamping_file)){
            foreach($request->visa_stamping_file as $file){
                $tmp = new File;
                $tmp->link = move($file, 'candidate', 'stamping_file_' . $processing->id . '_' . time() );
                $processing->files()->save($tmp);
            }
        }
        $processing->save();

        return back();
    }

    public function visa_stamping($id)
    {
        $processing = Processing::find($id);
        return view('templates.processing.visa_stamping', [
            'processing_id' => $processing->id,
            'candidate_name' => $processing->candidate->fName . ' ' . $processing->candidate->lName,
            'visa_stamping_date' => $processing->visa_stamping_date,
            'images' => $processing->files
        ]);
    }

    public function delete_stamping_file(Request $request)
    {
        $file = File::find($request->id);
        $file->delete();
    }

    public function finger_update(Processing $processing)
    {
        $processing->finger = 1;

        $processing->save();
    }


    public function manpower_update(Request $request)
    {
        $processing = Processing::find($request->update_manpower_id);

        $processing->manpower = 1;
        $processing->manpower_card_file = move($request->manpower_card_file, 'candidate', 'manpower_file_' . $processing->id . '_' . time() );

        if($request->manpower_amount > 0){
            transaction($request->manpower_amount, $processing->candidate->agent->id, $processing->candidate->id, $request->manpower_amount_payment_account);
        }        

        $processing->save();
    }

    public function flight_update(Processing $processing)
    {
        $processing->pending = 2;
        $processing->save();
    }

    public function return_update(Processing $processing)
    {
        $processing->pending = 3;
        $processing->save();
    }
    
}
