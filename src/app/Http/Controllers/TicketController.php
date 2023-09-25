<?php

namespace App\Http\Controllers;

use App\Contracts\MessageContract;
use App\Contracts\TicketContract;
use App\Contracts\UserContract;
use App\Http\Requests\AddMessageRequest;
use App\Http\Requests\CreateTicketRequest;
use App\Models\Ticket;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TicketController extends Controller
{
    public function __construct(private TicketContract $ticketContract, private MessageContract $messageContract, private UserContract $userContract)
    {
    }

    public function createTicket(CreateTicketRequest $request)
    {
        try {
            $data = $request->safe()->only('title', 'description', 'category_id', 'priority');
            $data['assigned_to_user_id'] = $this->userContract->assignedToUser((int) $request->input('category_id'));
            $data['open_by_user'] = auth()->user()->id;

            $ticket = $this->ticketContract->store($data);

            // uplodad Images 
            if ($request->hasFile('attachments')) {
                $ticket->addMultipleMediaFromRequest(['attachments'])
                    ->each(function ($attachment) {
                        $attachment->toMediaCollection('attachment');
                    });
            }


            return $this->successResponse($ticket,Response::HTTP_CREATED);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function ticketList(Request $request)
    {
        try {
            $tickets = $this->ticketContract->findTicketWithFilter($request);
            return $this->successResponse($tickets);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function ticketDetails($id)
    {

        return $this->ticketContract->with(['messages', 'media'])->findOneById($id);
    }

    public function addMessage(AddMessageRequest $request)
    {
        try {
            $payload = $request->safe()->only('ticket_id', 'message_txt');
            $payload['user_id'] = auth()->user()->id;
            $message = $this->messageContract->store($payload);
            // uplodad Images 
            if ($request->hasFile('attachments')) {
                $message->addMultipleMediaFromRequest(['attachments'])
                    ->each(function ($attachment) {
                        $attachment->toMediaCollection('attachment');
                    });
            }

            return $this->successResponse($message,Response::HTTP_CREATED);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function closeTicket($ticket_id)
    {
        try {
            $this->ticketContract->closeTicket((int) $ticket_id);
            return $this->successResponse([]);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
