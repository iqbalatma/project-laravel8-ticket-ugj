<?php 

namespace App\Repository;

use App\Models\Ticket;
use App\Statics\GlobalStatic;

class TicketRepository{
  public function getAllDataNotCheckin():?object
  {
    return Ticket::where('checkin_status', 0)->get();
  }

  public function getDataTicketByCode(string $code)
  {
    return Ticket::where('code', $code)->first();
  }

  public function updateTicketToCheckedIn(string $code, array $requestedData)
  {
    return Ticket::where('code', $code)
      ->update($requestedData);
  }
}

?>