<?php 
namespace App\Contracts;

use Illuminate\Http\Request;

interface TicketContract extends BaseContract
{
    public function findTicketWithFilter(Request $request);

    public function closeTicket(int $ticket_id);

}