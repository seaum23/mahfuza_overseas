<?php

namespace App\Http\Controllers;

use App\Models\Processing;
use App\Models\Ticket;
use DateTime;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('templates.ticket.ticket_list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Processing $processing)
    {
        return view('templates.ticket.new_ticket', [
            'candidate' => $processing->candidate,
            'processing_id' => $processing->id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Processing $processing)
    {
        $this->validate($request, [
            'airline' => 'required',
            'flightNo' => 'required',
            'flightDate' => 'required',
            'flightTime' => 'required',
            'fromPlace' => 'required',
            'toPlace' => 'required',
            'amount' => 'required',
        ]);

        $ticket = $processing->tickets()->create([
            'flight_time' => $request->flightDate . ' ' . $request->flightTime,
            'transit' => ($request->transit == 'yes') ? $request->transitHour : 0,
            'ticket_price' => $request->amount,
            'flight_number' => $request->flightNo,
            'flight_from' => $request->fromPlace,
            'flight_to' => $request->toPlace,
            'airline' => $request->airline,
            'comment' => $request->comment,
            'updated_by' => auth()->id(),
        ]);

        $ticket->ticket_file = move($request->ticketCopy, 'candidate', 'ticket_file_' . $ticket->id . '_' . time() );
        $ticket->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        $flight_time = new DateTime(date($ticket->flight_time));
        return view('templates.ticket.edit_ticket', [
            'flight_date' => $flight_time->format('Y-m-d'),
            'flight_time' => $flight_time->format('h:m'),
            'ticket' => $ticket,
            'candidate' => $ticket->processing->candidate,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $this->validate($request, [
            'airline' => 'required',
            'flightNo' => 'required',
            'flightDate' => 'required',
            'flightTime' => 'required',
            'fromPlace' => 'required',
            'toPlace' => 'required',
            'amount' => 'required',
        ]);

        $ticket->flight_time = $request->flightDate . ' ' . $request->flightTime;
        $ticket->transit = ($request->transit == 'yes') ? $request->transitHour : 0;
        $ticket->ticket_price = $request->amount;
        $ticket->flight_number = $request->flightNo;
        $ticket->flight_from = $request->fromPlace;
        $ticket->flight_to = $request->toPlace;
        $ticket->airline = $request->airline;
        $ticket->comment = $request->comment;
        $ticket->updated_by = auth()->id();

        if(!empty($request->ticketCopy)){
            $ticket->ticket_file = move($request->ticketCopy, 'candidate', 'ticket_file_' . $ticket->id . '_' . time() );
        }
        
        $ticket->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Datatable
     * 
     * @return datatable
     */
    public function datatable(Request $request)
    {
        // <a href="'.asset($query->test_medical_file).'" target="_blank">
        //                             <button class="btn btn-xs btn-info"><i class="fas fa-search"></i></button>
        //                         </a>
        if ($request->ajax()) {
            $query = Ticket::with('processing.candidate')->select('tickets.*')->orderBy('id', 'desc');
            
            return Datatables::of($query)
            ->editColumn('processing.candidate.fName', function ($query)
            {
                $html = '<p> <span class="text-secondary">Name: </span>' . $query->processing->candidate->fName . ' ' . $query->processing->candidate->lName . '</p>';
                $html .= '<p> <span class="text-secondary">Passport: </span>' . $query->processing->candidate->passportNum . '</p>';
                return $html;
            })
            ->editColumn('flight_time', function ($query)
            {
                $fligh_time = new DateTime($query->flight_time);
                $html = '<p> <span class="font-weight-bold">' . $fligh_time->format('d F, Y') . ' - </span> <span class="font-weight-bold"> ' . $fligh_time->format('H:m:i') . '</span></p>';
                return $html;
            })
            ->editColumn('transit', function ($query)
            {
                if(empty($query->transit)){
                    return '<badge class="badge badge-primary">None</badge>';
                }
                
                return '<badge class="badge badge-primary">'.$query->transit.' Hours</badge>';
            })
            ->editColumn('ticket_price', function ($query)
            {
                return number_format($query->ticket_price);
            })
            ->editColumn('ticket_file', function ($query)
            {
               
                return '<a target="_blank" class="btn btn-secondary btn-xs" role="button" href="'.asset($query->ticket_file).'"><i class="fas fa-search"></i></a>';
                
            })
            ->addColumn('action', function ($query) {
                $html = '';
                $html .= '<a href="'.route('ticket.edit', $query->id).'" class="btn btn-info" role="button">Edit</a>';
                return $html;
            })
            ->rawColumns(['name', 'action', 'processing.candidate.fName', 'flight_time', 'transit', 'ticket_price', 'ticket_file', 'mufa', 'medical_update', 'visa_stamping', 'finger', 'candidate.training_card_file', 'manpower', 'ticket'])
            ->make(true);
        }
    }
}
