<?php 
namespace App\Repositories;

use App\Contracts\TicketContract;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TicketRepository extends BaseRepository implements TicketContract
{
    public function findTicketWithFilter(Request $request)
    {
         $tickets  = $this->model->when($request->input('category_id'),function($query) use ($request){
            $query->where('category_id',$request->input('category_id'));
         })
         ->where(function($query){
            $query->orWhere('assigned_to_user_id',auth()->user()->id);
            $query->orWhere('open_by_user',auth()->user()->id);
         })
         ->orderBy('created_at','DESC')
         ->paginate(config('helpdesk.DEFAULT_PAGINATION_COUNT'));

         return $tickets;

    }

    public function closeTicket(int $ticket_id)
    {
         $this->update($this->model,$ticket_id,[
            'is_closed' => true,
            'closed_date' => Carbon::now()->format('Y-m-d'),
            'closed_by_user' => auth()->user()->id
         ]);
    }

}