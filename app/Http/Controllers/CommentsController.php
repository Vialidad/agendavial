<?php

namespace TeachMe\Http\Controllers;

use Illuminate\Http\Request;
use TeachMe\Entities\TicktComment;
use TeachMe\Entities\Ticket;
use TeachMe\Http\Requests;
use TeachMe\Repositories\CommentRepository;
use TeachMe\Repositories\TicketRepository;

class CommentsController extends Controller
{	
	protected $commentRepository;

	protected $ticketRepository;

    function __construct(
		TicketRepository $ticketRepository,
		CommentRepository $commentRepository
		)
    {	
    	$this->ticketRepository = $ticketRepository;
        $this->commentRepository = $commentRepository;
    }

    public function submit($id, Request $request)
	{	
		$this->validate($request,[
			'comment' 	=> 'required|max:250',
			//'link'		=> 'url'
			]);

		$ticket = $this->ticketRepository->findOrFail($id); //Ticket::findOrFail($id);

		$this->commentRepository->create(
			$ticket,
			currentUser(),
			$request->get('comment'),
			$request->get('link')
			);		

		session()->flash('success', 'tu comentario fue guardado exitosamente');

		return redirect()->back();
    }
}
