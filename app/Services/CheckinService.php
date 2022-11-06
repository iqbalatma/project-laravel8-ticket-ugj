<?php 

namespace App\Services;

use App\Repository\TicketRepository;
use App\Statics\GlobalStatic;

class CheckinService{
  public function getScannerToolData():array
  {
   return [
      'title' => 'Checkin',
      'tickets' => (new TicketRepository())->getAllDataNotCheckin(),
   ];
  }

  public function checkin(array $requestedData):array
  {
    $code = $requestedData['code'];
    $ticket = (new TicketRepository())->getDataTicketByCode($code);

    if($ticket){
      if($ticket->checkin_status){
        return [
          'status' =>GlobalStatic::CHECKIN_ALREADY_CHECKIN,
          'checkin_date' => $ticket->updated_at->format('H:i:s')
        ];
      }

      (new TicketRepository())->updateTicketToCheckedIn($code);
      return [
        'status' => GlobalStatic::CHECKIN_SUCCESS
      ];
    }else{
      return [
        'status' => GlobalStatic::CHECKIN_CODE_INVALID
      ];
    }
  }


}

?>