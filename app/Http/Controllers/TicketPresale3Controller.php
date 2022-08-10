<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketPresale3Controller extends Controller
{
    public function index()
    {
        $data = [
            "title" => "Ticket Presale 1",
            "earlyTickets" => Ticket::where('phase_id', 4)->get()
        ];

        return response()->view("ticket.ticketpresale3", $data);
    }
}
