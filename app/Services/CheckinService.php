<?php 

namespace App\Services;

use App\Repository\TicketRepository;
use App\Statics\GlobalStatic;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class CheckinService{
  public function getScannerToolData():array
  {
   return [
      'title' => 'Checkin',
      'tickets' => (new TicketRepository())->getAllDataNotCheckin(),
   ];
  }

  public function checkin(array $requestedData)
  {
    $code = $requestedData['code'];
    $ticket = (new TicketRepository())->getDataTicketByCode($code);

    if($ticket){
      if($ticket->checkin_status){
        return GlobalStatic::CHECKIN_ALREADY_CHECKIN;
      }

      (new TicketRepository())->updateTicketToCheckedIn($code);
      return GlobalStatic::CHECKIN_SUCCESS;
    }else{
      return GlobalStatic::CHECKIN_CODE_INVALID;
    }
  }


}

?>