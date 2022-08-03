<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\DocPdf;
use App\Models\Phase;
use App\Models\Ticket;
use PDF;


class TicketService extends Controller
{

  public function checkLimit($phaseId, $quantity)
  {
    $this->phaseId = $phaseId;
    $this->limit = Phase::find($phaseId)->limit;
    $this->quantity = $quantity;
    $this->currentLimit = $this->limit - $quantity;

    if ($quantity > $this->limit) {
      return false;
    }
    return true;
  }
  public function reduceLimit()
  {
    Phase::where('id', $this->phaseId)
      ->update([
        'limit' => $this->currentLimit
      ]);

    return $this;
  }

  public function generateData()
  {
    $this->dataTicket = [];
    for ($i = 0; $i < $this->quantity; $i++) {
      $randomString = Str::random(30);

      array_push($this->dataTicket, Ticket::create([
        'phase_id' => $this->phaseId,
        'code' => $randomString
      ]));
    }

    return $this;
  }

  public function generatePDF()
  {
    $dataSetTicket = array_chunk($this->dataTicket, 50, true);
    $phaseName = str_replace(" ", "_", Phase::find($this->phaseId)->name);

    foreach ($dataSetTicket as $key => $ticket) {

      $ticketName = $phaseName . "-" . Str::random(8) . ".pdf";
      DocPdf::create(['name' => $ticketName]);

      $data['tickets'] = $ticket;
      $pdf = PDF::loadView('ticket.pdfticket', $data);
      $pdf->save("ticket/$ticketName");
    }
    return $this;
  }
}
