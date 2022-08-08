<?php

namespace App\Http\Controllers;

use App\Models\DocPdf;
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

    /**
     * untuk menampilkan halaman tambah ticket / generate ticket
     */
    public function create()
    {
        $data = [
            "title" => "Generate Ticket"
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
                'quantity' => 'required|numeric',
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

            return  redirect()
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
}
