<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

class TicketPhasesController extends Controller
{
    public function early()
    {
        return response()->view("phase.early", [
            "title" => "Ticket Early",
            "earlyTickets" => Ticket::with("user")->where('phase_id', 1)->get(),
        ]);
    }

    public function presale1()
    {
        return response()->view("phase.presale1", [
            "title" => "Ticket Presale 1",
            "earlyTickets" => Ticket::with("user")->where('phase_id', 2)->get(),
        ]);
    }

    public function presale2()
    {
        return response()->view("phase.presale2", [
            "title" => "Ticket Presale 2",
            "earlyTickets" => Ticket::with("user")->where('phase_id', 3)->get(),
        ]);
    }

    public function presale3()
    {
        return response()->view("phase.presale3", [
            "title" => "Ticket Presale 3",
            "earlyTickets" => Ticket::with("user")->where('phase_id', 4)->get(),
        ]);
    }

    public function ots()
    {
        return response()->view("phase.ots", [
            "title" => "Ticket OTS",
            "earlyTickets" => Ticket::with("user")->where('phase_id', 5)->get(),
        ]);
    }
}
