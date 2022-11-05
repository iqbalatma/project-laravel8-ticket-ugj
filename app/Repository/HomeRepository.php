<?php 

namespace App\Repository;

use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

class HomeRepository {
  public function getAllDataSummary()
  {
    $tickets = Ticket::select('id', 'phase_id', 'checkin_status')->get();

    $data = [
      'title' => 'Home',
      'totalTickets' => $tickets->count(),
      'totalTicketEarly' =>  $tickets->where('phase_id', 1)->count(),
      'totalTicketPresale1' => $tickets->where('phase_id', 2)->count(),
      'totalTicketPresale2' => $tickets->where('phase_id', 3)->count(),
      'totalTicketPresale3' => $tickets->where('phase_id', 4)->count(),
      'totalTicketOTS' => $tickets->where('phase_id', 5)->count(),
      'totalTicketEarlyCheckin' => $tickets->where('phase_id', 1)->where('checkin_status', 1)->count(),
      'totalTicketPresale1Checkin' => $tickets->where('phase_id', 2)->where('checkin_status', 1)->count(),
      'totalTicketPresale2Checkin' => $tickets->where('phase_id', 3)->where('checkin_status', 1)->count(),
      'totalTicketPresale3Checkin' => $tickets->where('phase_id', 4)->where('checkin_status', 1)->count(),
      'totalTicketOTSCheckin' => $tickets->where('phase_id', 5)->where('checkin_status', 1)->count(),
    ];
    return $data;
  }
}

?>