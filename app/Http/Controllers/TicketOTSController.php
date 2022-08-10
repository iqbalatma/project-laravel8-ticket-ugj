<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketOTSController extends Controller
{
    public function index()
    {
        $data = [
            "title" => "Ticket Presale 1",
            "earlyTickets" => Ticket::where('phase_id', 5)->get()
        ];

        return response()->view("ticket.ticketots", $data);
    }
}
