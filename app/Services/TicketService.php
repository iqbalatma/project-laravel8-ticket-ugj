<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\DocPdf;
use App\Models\Phase;
use App\Models\Ticket;
use App\Repository\PhaseRepository;
use PDF;


class TicketService extends Controller
{
  private $phaseId;
  private $quantity;
  private $limit;
  private $currentLimit;
  public function getAllDataForCreate(): array
  {
    return [
      "title" => "Generate Ticket",
      "phases" => (new PhaseRepository())->getAllDataPhase()
    ];
  }

  public function checkLimit(int $phaseId, int $quantity)
  {
    $this->phaseId = $phaseId;
    $this->quantity = $quantity;
    $this->limit = (new PhaseRepository())->getLimitById($phaseId);
    $this->currentLimit = $this->limit - $quantity;

    if ($quantity > $this->limit) {
      return false;
    }
    return true;
  }
  
  public function reduceLimit():TicketService
  {
    (new PhaseRepository())->setLimitById($this->phaseId, $this->currentLimit);
    return $this;
  }

  public function generateData():TicketService
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
  public function generatePDF():TicketService
  {
    $dataSetTicket = array_chunk($this->dataTicket, 1000, true);
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
