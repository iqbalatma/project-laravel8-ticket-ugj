<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tickets = Ticket::get();

      
        $data =[
            'title' => 'Home',
            'totalTickets' => $tickets->count(),
            'totalTicketEarly' =>  $tickets->where('phase_id',1)->count(),
            'totalTicketPresale1' => $tickets->where('phase_id',2)->count(),
            'totalTicketPresale2' => $tickets->where('phase_id',3)->count(),
            'totalTicketPresale3' => $tickets->where('phase_id',4)->count(),
            'totalTicketOTS' => $tickets->where('phase_id',5)->count(),
            'totalTicketEarlyCheckin' => $tickets->where('phase_id',1)->where('checkin_status',1)->count(),
            'totalTicketPresale1Checkin' => $tickets->where('phase_id',2)->where('checkin_status',1)->count(),
            'totalTicketPresale2Checkin' => $tickets->where('phase_id',3)->where('checkin_status',1)->count(),
            'totalTicketPresale3Checkin' => $tickets->where('phase_id',4)->where('checkin_status',1)->count(),
            'totalTicketOTSCheckin' => $tickets->where('phase_id',5)->where('checkin_status',1)->count(),

        ];
        return view('home', $data);
    }
}
