<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

class TicketEarlyController extends Controller
{
    public function index()
    {
        $data = [
            "title" => "Ticket Early",
            "earlyTickets" => Ticket::where('phase_id', 1)->get()
        ];

        return response()->view("ticket.ticketearly", $data);
    }
}
