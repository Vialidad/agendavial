<?php

namespace TeachMe\Http\Controllers;

use Illuminate\Http\Request;
use TeachMe\Entities\Ticket;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use TeachMe\Repositories\TicketRepository;
use Mail;

use TeachMe\Http\Requests;

class TicketsController extends Controller
{   
    protected $ticketRepository;

    function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function latest()
    {
        $tickets = $this->ticketRepository->paginateLatest();
	   
        return view('tickets.list', compact('tickets'));
    }

    public function popular()
    {
    	return view('tickets.list');
    }

    public function open()
    {
        $tickets = $this->ticketRepository->paginateOpen();
        
    	return view('tickets.list', compact('tickets'));
    }

    public function closed()
    {
    	$tickets = $this->ticketRepository->paginateClosed(); 

        return view('tickets.list', compact('tickets'));
    }

    public function details($id)
    {
        $ticket = $this->ticketRepository->findOrFail($id);

    	return view('tickets.details', compact('ticket'));
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {   
        $this->validate($request, [
            'title' => 'required|max:100'

            ]);

        $ticket =   $this->ticketRepository->openNew(
                        currentUser(),
                        $request->get('title'),
                        $request->get('date')
                    );

        return Redirect::route('tickets.details',  $ticket->id);
    }

    public function status($id)
    {
        $ticket = Ticket::findOrFail($id);

        $ticket->status = 'closed';

        $ticket->save();

        return Redirect::route('tickets.open');
    }

    public function sendMail()
    {
        Mail::send("emails.bienvenido", [], function($message) {
            $message->to("juanbupo_77@hotmail.com", "Juan Bupo")
            ->subject("Bienvenido a Aprendible!");
        });
    }
}
