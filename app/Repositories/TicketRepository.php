<?php 
namespace TeachMe\Repositories;

use TeachMe\Entities\Ticket;
/**
* 
*/
class TicketRepository extends BaseRepository
{	
	public function getModel()
	{
		return new Ticket();
	}

	protected function selectTicketList()
	{
		return $this->newQuery()->selectRaw(//realiza subconsultas
	            'tickets.*,'
	            .'(select count(*) from ticket_comments where ticket_comments.ticket_id = tickets.id) as num_comments,' 
	            .'(select count(*) from ticket_votes where ticket_votes.ticket_id = tickets.id) as num_votes'
	            )->with('author');
	}
	
	public function paginateLatest()
	{
		return $this->selectTicketList()
					->orderBy('created_at', 'DESC')
        			->paginate(20); 
	}

	public function paginateOpen()
	{
		return $this->selectTicketList()
					->where('status','open')
					->orderBy('date', 'ASC')
        			->paginate(20); 
	}

	public function paginateClosed()
	{
		return $this->selectTicketList()
					->where('status','closed')
					->orderBy('created_at', 'DESC')
        			->paginate(20); 
	}

	public function openNew($user, $title,$date)
	{
		return  $user->tickets()->create([
                    'title'   => $title,
                    'status'  => 'open',
                    'date'    => $date, 
                ]);
	}

}