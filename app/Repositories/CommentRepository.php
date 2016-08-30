<?php 
namespace TeachMe\Repositories;

use TeachMe\Entities\TicktComment;
use TeachMe\Entities\Ticket;
use TeachMe\Entities\User;
/**
* 
*/
class CommentRepository extends BaseRepository
{
	
	public function getModel()
	{
		return new TicktComment();
	}

	public function create(Ticket $ticket,User $user, $comment, $link = '')
	{	
		$comments = new TicktComment();

		$comments->comment = $comment;

		$comments->link = $link;

		$comments->user_id = $user->id;

		$ticket->comments()->save($comments);
	}
}