<?php

namespace App\Http\Controllers;

use App\Models\Account;
use DateTime;
use Carbon\Carbon;
use App\Models\File;
use App\Models\Agent;
use Barryvdh\DomPDF\PDF;
use App\Models\Candidate;
use App\Models\Processing;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ManpowerOffice;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Response;

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
                    return '<button onclick="employee_request('.$query->id.')" class="btn btn-secondary btn-xs target-click">No</button>';
                }
                
                return '<badge class="badge badge-primary">Done</badge>';
            })
            ->editColumn('foreign_mole', function ($query)
            {
                if($query->foreign_mole == 0){
                    return '<button onclick="foreign_mole('.$query->id.')" class="btn btn-secondary btn-xs">No</button>';
                }
                
                return '<badge class="badge badge-primary">Done</badge>';
            })
            ->editColumn('okala', function ($query)
            {
                if($query->okala == 0){
                    return '<button onclick="update_okala_modal('.$query->id.', \'' . $query->candidate->fName . ' ' . $query->candidate->lName . '\')" data-toggle="modal" data-target="#okala_modal" class="btn btn-secondary btn-xs">No</button>';
                }

                $reupload_button = '<button onclick="update_okala_modal('.$query->id.', \'' . $query->candidate->fName . ' ' . $query->candidate->lName . '\')" data-toggle="modal" data-target="#okala_modal" class="btn btn-info btn-xs"><i class="fas fa-redo"></i></button>';
                $show_file = '<a target="_blank" class="btn btn-secondary btn-xs" role="button" href="'.asset($query->okala_file).'"><i class="fas fa-search"></i></a>';
                
                return '<div class="btn-group" role="group" aria-label="Basic example">' . $reupload_button . $show_file . '</div>';
            })
            ->editColumn('mufa', function ($query)
            {
                if($query->mufa == 0){
                    return '<button onclick="update_mufa_modal('.$query->id.', \'' . $query->candidate->fName . ' ' . $query->candidate->lName . '\')" data-toggle="modal" data-target="#mufa_modal" class="btn btn-secondary btn-xs">No</button>';
                }

                $reupload_button = '<button onclick="update_mufa_modal('.$query->id.', \'' . $query->candidate->fName . ' ' . $query->candidate->lName . '\')" data-toggle="modal" data-target="#mufa_modal" class="btn btn-info btn-xs"><i class="fas fa-redo"></i></button>';
                $show_file = '<a target="_blank" class="btn btn-secondary btn-xs" role="button" href="'.asset($query->mufa_file).'"><i class="fas fa-search"></i></a>';
                
                return '<div class="btn-group" role="group" aria-label="Basic example">' . $reupload_button . $show_file . '</div>';
            })
            ->editColumn('medical_update', function ($query)
            {
                if($query->medical_update == 0){
                    return '<button onclick="medical_update('.$query->id.')" class="btn btn-secondary btn-xs">No</button>';
                }
                
                return '<badge class="badge badge-primary">Done</badge>';
            })
            ->editColumn('visa_stamping', function ($query)
            {
                if($query->visa_stamping == 0){
                    return '<button onclick="update_visa_stamping('.$query->id.', \'' . $query->candidate->fName . ' ' . $query->candidate->lName . '\')" data-toggle="modal" data-target="#visa_stamping_modal" class="btn btn-secondary btn-xs">No</button>';
                }
                $today = Carbon::now();
                $stamping_date = new Carbon(new DateTime($query->visa_stamping_date));
                $stamping_date->addDays(90);
                if($stamping_date >= $today){
                    $diff = $stamping_date->diffInDays($today);
                }else{
                    $diff = -1 * $stamping_date->diffInDays($today);
                }
                $html = '<a href="'.route('visa_stamping', [$query->id]).'"><badge style="cursor: pointer;" class="badge badge-primary">'.$query->visa_stamping_date.'</badge></a>';
                $html .= ($diff < 0 ) ? '<badge class="badge badge-danger">'.$diff. ' ' . Str::plural('day', $diff) . '</badge>' : '<badge class="badge badge-info">'.$diff. ' ' . Str::plural('day', $diff) . '</badge>';
                return $html;
            })
            ->editColumn('finger', function ($query)
            {
                $html = '<div class="btn btn-group"><button id="generate_pdf_button" onclick="generate_pdf('.$query->candidate->id.')" class="btn btn-info btn-xs">PDF</button>';
                $html .= '<button id="zip_button" onclick="get_zip('.$query->candidate->id.')" class="btn btn-warning btn-xs"><i class="fas fa-file-archive"></i></button>';
                if($query->finger == 0){
                    $html .= '<button onclick="finger_update('.$query->id.')" class="btn btn-secondary btn-xs">No</button>';
                }else{
                    $html .= '<badge class="badge badge-primary">Done</badge>';
                }
                
                return $html.'</div>';
            })
            ->editColumn('candidate.training_card_file', function ($query)
            {
                if($query->candidate->experience_status == 2){ // Experienced
                    return '<a href="'.url('/candidate/experienced/' . $query->candidate->id).'"><button class="btn btn-xs btn-info">Experienced</button></a>';
                }

                if($query->candidate->experience_status == 1 AND empty($query->candidate->training_card_file)){ // Needs training card
                    return '<button onclick="update_training_card('.$query->candidate->id.', \''.$query->fName . ' ' . $query->lName.'\')" data-toggle="modal" data-target="#traning_card_modal" class="btn btn-xs btn-secondary">No</button>';
                }

                $reupload_button = '<button onclick="update_training_card('.$query->candidate->id.', \''.$query->fName . ' ' . $query->lName.'\')" data-toggle="modal" data-target="#traning_card_modal" class="btn btn-xs btn-info"><i class="fas fa-redo"></i></button>';
                $show_file = '<a target="_blank" class="btn btn-secondary btn-xs" role="button" href="'.asset($query->candidate->training_card_file).'"><i class="fas fa-search"></i></a>';
                
                return '<div class="btn-group" role="group" aria-label="Basic example">' . $reupload_button . $show_file . '</div>';
            })
            
            ->editColumn('manpower', function ($query)
            {
                if($query->manpower == 0){
                    return '<button onclick="update_manpower_modal('.$query->id.', \'' . $query->candidate->fName . ' ' . $query->candidate->lName . '\')" data-toggle="modal" data-target="#manpower_modal" class="btn btn-secondary btn-xs">No</button>';
                }

                $reupload_button = '<button onclick="update_manpower_modal('.$query->id.', \'' . $query->candidate->fName . ' ' . $query->candidate->lName . '\')" data-toggle="modal" data-target="#manpower_modal" class="btn btn-info btn-xs"><i class="fas fa-redo"></i></button>';
                $show_file = '<a target="_blank" class="btn btn-secondary btn-xs" role="button" href="'.asset($query->manpower_card_file).'"><i class="fas fa-search"></i></a>';
                
                return '<div class="btn-group" role="group" aria-label="Basic example">' . $reupload_button . $show_file . '</div>';
            })
            ->editColumn('ticket', function ($query)
            {
                if(!$query->has_ticket() AND $query->pending != 2){
                    return '<a href="'.route('ticket', $query->id).'"><button class="btn btn-secondary btn-xs">No</button></a>';
                }

                $latest_ticket = $query->tickets()->latest()->first();

                if(!is_null($latest_ticket)){
                    return '<a href="'.route('ticket.edit', [$query->id]).'"><badge style="cursor: pointer;" class="badge badge-primary">'.$latest_ticket->flight_time.'</badge></a>';
                }

                return '<badge class="badge badge-secondary">No Ticket Assigned!</badge>';
                
            })
            ->addColumn('action', function ($query) {
                $html = '<div class="btn-group" role="group" aria-label="Basic example">';
                $html .= '<button onclick="processing_transaction(\''.$query->id.'\', \''.$query->candidate->fName.' '.$query->candidate->lName.'\')" data-toggle="modal" data-target="#transaction_modal" class="btn btn-warning btn-xs"><i class="fas fa-dollar-sign"></i></button>';
                if($query->pending == '0' AND $query->has_ticket()){
                    $html .= '<button data-target="#flight_update_modal" data-toggle="modal" onclick="flight_update(\''.$query->id.'\', )" class="btn btn-secondary btn-xs"><i class="fas fa-plane"></i></button>';
                    $html .= '<button onclick="flight_return_update(\''.$query->id.'\')" class="btn btn-danger btn-xs"><i class="fas fa-plane-arrival"></i></button>';
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
            if($processing->candidate->agent->id == 1){ // Maheer Agent Account
                maheerTransaction($request->okala_amount, $processing->candidate->id, 'Okala');
            }else{
                transaction($request->okala_amount, $processing->candidate->agent->id, $processing->candidate->id, $request->okala_amount_payment_account, 'Okala');
            }
        }

        $processing->save();
    }

    public function mufa_update(Request $request)
    {
        $processing = Processing::with('candidate.agent')->find($request->update_mufa_id);

        $processing->mufa = 1;
        $processing->mufa_file = move($request->mufa_file, 'candidate', 'mufa_file_' . $processing->id . '_' . time() );
        
        if($request->mufa_amount > 0){
            if($processing->candidate->agent->id == 1){ // Maheer Agent Account
                maheerTransaction($request->mufa_amount, $processing->candidate->id, 'MUFA');
            }else{
                transaction($request->mufa_amount, $processing->candidate->agent->id, $processing->candidate->id, $request->mufa_amount_payment_account, 'Mufa');
            }
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
        $processing = Processing::with('candidate.agent')->find($request->update_manpower_id);

        $processing->manpower = 1;
        $processing->manpower_card_file = move($request->manpower_card_file, 'candidate', 'manpower_file_' . $processing->id . '_' . time() );

        if($request->manpower_amount > 0){
            if($processing->candidate->agent->id == 1){ // Maheer Agent Account
                maheerTransaction($request->mufa_amount, $processing->candidate->id, 'Manpower Office');
            }else{
                transaction($request->manpower_amount, $processing->candidate->agent->id, $processing->candidate->id, $request->manpower_amount_payment_account, 'Manpower Card');
            }
        }        

        $processing->save();
    }

    public function get_flight_update($processing)
    {
        $accounts = Account::where('payment_account', 1)->get();
        return view('form_templates.flight-update-form', [
            'accounts' => $accounts
        ])->render();
    }

    public function flight_update_wo_ticket(Processing $processing)
    {
        $processing->pending = 2;
        $processing->save();

        if(!empty($processing->candidate->agent_comission)){
            $this->agent_comission_transaction($processing);
        }
    }

    public function flight_update($processing, Request $request)
    {
        $processing = Processing::with('candidate.job', 'tickets')->find($processing);
        $processing->pending = 2;
        $processing->save();

        if($processing->candidate->agent->id == 1){ // Maheer Agent Account
            maheerTransaction($request->tickets[0]->ticket_price, $processing->candidate->id, 'Ticket Expense');
        }else{
            transaction($processing->tickets[0]->ticket_price, null, $processing->candidate->id, $request->flight_accounts, '', '8');
        }
    }

    public function agent_comission_transaction($processing)
    {
            $transaction = new Transaction();
            $transaction->quantity = 1;
            $transaction->currency = 'bdt';
            $transaction->unit_price = $processing->candidate->agent_comission;
            $transaction->exchange_rate = 1;
            $transaction->particular_type = Agent::class;
            $transaction->particular_id = $processing->candidate->agent_id;
            $transaction->candidate_id = $processing->candidate->id;
            $transaction->save();
            $transaction->transaction_id = str_pad($transaction->id, 10, '0', STR_PAD_LEFT);
            $transaction->save();
    
            $transaction->debits()->create([
                'amount' => $processing->candidate->agent_comission,
                'account_id' => '7',
            ]);
    
            $transaction->credits()->create([
                'amount' => $processing->candidate->agent_comission,
                'account_id' => '2',
            ]);
    }

    public function return_update(Processing $processing)
    {
        $processing->pending = 3;
        $processing->save();
    }

    public function generate_finger_pdf(Candidate $candidate)
    {
        $images = finger_image($candidate);
        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper('A4');
        $pdf->loadView('pdf/finger', [
            'images' => $images
        ]);
        $random = time();
        $pdf->save(storage_path("app/public/candidate/finger/test_$random.pdf"));
        unlink(storage_path("app/public/candidate/finger/$images[0]"));
        unlink(storage_path("app/public/candidate/finger/$images[1]"));
        return asset("storage/candidate/finger/test_$random.pdf");
    }

    public function generate_zip($candidate)
    {
        $candidate = Candidate::with('processings')->find($candidate);
        $now = Carbon::now();
        $zip_file = 'public/storage/zip/candidates_document_'.$now->format('Y_m_d_H_i_s').'.zip'; // Name of our archive to download
        $manpower = ManpowerOffice::select('office_pad')->find($candidate->manpower_office_id);

        // Initializing PHP class
        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        // Adding file: second parameter is what will the path inside of the archive
        // So it will create another folder called "storage/" inside ZIP, and put the file there.
        if(!empty($candidate->passport_scanned_copy)){
            $ext = explode('.', $candidate->passport_scanned_copy);
            $zip->addFile(public_path($candidate->passport_scanned_copy), 'Passport Copy.'.$ext[1]);
        }
        if(!empty($candidate->training_card_file)){
            $ext = explode('.', $candidate->training_card_file);
            $zip->addFile(public_path($candidate->training_card_file), 'Training Card.'.$ext[1]);
        }
        if(!empty($candidate->departureSealFile)){
            $ext = explode('.', $candidate->departureSealFile);
            $zip->addFile(public_path($candidate->departureSealFile), 'Departure Seal.'.$ext[1]);
        }
        if(!empty($candidate->arrivalSealFile)){
            $ext = explode('.', $candidate->arrivalSealFile);
            $zip->addFile(public_path($candidate->arrivalSealFile), 'Arrival Seal.'.$ext[1]);
        }
        
        if(!empty($candidate->visa_stamping_file)){
            $ext = explode('.', $candidate->visa_stamping_file);
            $zip->addFile(public_path($candidate->visa_stamping_file), 'VISA File.'.$ext[1]);
        }
        
        if(!empty($manpower->office_pad)){
            $ext = explode('.', $manpower->office_pad);
            $zip->addFile(public_path($manpower->office_pad), 'Office Pad.'.$ext[1]);
        }
        
        $zip->close();

        // We return the file immediately after download
        return asset($zip_file);
    }
    
}
