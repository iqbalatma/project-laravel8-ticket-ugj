<?php

namespace App\Http\Controllers;

use App\Models\DocPdf;
use App\Models\Phase;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\Request;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use ZipArchive;
use File;
use Mpdf\Mpdf;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->ticketService = new TicketService();
    }

    public function check()
    {
          $pdf = PDF::loadView('ticket.pdfticket');
    return      $pdf->stream();
    }

    /**
     * untuk menampilkan halaman tambah ticket / generate ticket
     */
    public function create()
    {
        $data = [
            "title" => "Generate Ticket",
            "phases" => Phase::all()
        ];

        return response()->view('ticket.generate', $data);
    }

    /**
     * Operasi untuk melakukan generate ticket
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'phase_id' => 'required',
                'quantity' => 'required|numeric|min:2|max:99',
            ],
            [
                'phase_id.required' => 'You have to chose the phase',
            ]
        );

        $quantity = intval($validated['quantity']);
        $phaseId = intval($validated['phase_id']);


        if ($this->ticketService->checkLimit($phaseId, $quantity)) {
            $this->ticketService->reduceLimit()
                ->generateData()
                ->generatePDF();

            return redirect()
                ->back()
                ->with('success', "Ticket Generate Success !");
        } else {
            return redirect()
                ->back()
                ->with('failed', "Ticket generate failed ! Ticket quantity exceeds the limit");
        }
    }


    public function checkin($code)
    {
        if (!Ticket::where('code', $code)->first()->checkin_status) {
            if (Ticket::where('code', $code)->update(['checkin_status' => '1'])) {
                echo "Ticket berhasil checkin";
            } else {
                abort(404);
            }
        } else {
            echo "Tiket sudah checkin";
        }
    }


    // PHASE TICKET
    public function early()
    {
        $data = [
            "title" => "Ticket Early",
            "earlyTickets" => Ticket::where('phase_id', 1)->get()
        ];

        return response()->view("ticket.ticketearly", $data);
    }

    public function presale1()
    {
        $data = [
            "title" => "Ticket Presale 1",
            "earlyTickets" => Ticket::where('phase_id', 2)->get()
        ];

        return response()->view("ticket.ticketpresale1", $data);
    }

    public function presale2()
    {
        $data = [
            "title" => "Ticket Presale 2",
            "earlyTickets" => Ticket::where('phase_id', 3)->get()
        ];

        return response()->view("ticket.ticketpresale2", $data);
    }

    public function presale3()
    {
        $data = [
            "title" => "Ticket Presale 3",
            "earlyTickets" => Ticket::where('phase_id', 4)->get()
        ];

        return response()->view("ticket.ticketpresale3", $data);
    }

    public function ots()
    {
        $data = [
            "title" => "Ticket OTS",
            "earlyTickets" => Ticket::where('phase_id', 5)->get()
        ];

        return response()->view("ticket.ticketots", $data);
    }
}
