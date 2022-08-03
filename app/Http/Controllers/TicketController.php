<?php

namespace App\Http\Controllers;

use App\Models\DocPdf;
use App\Models\Phase;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Mail;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->ticketService = new TicketService();
    }
    // BATAS
    public function generate()
    {
        $data = [
            "title" => "Generate Ticket"
        ];
        return response()->view('ticket.generate', $data);
    }

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

    public function download()
    {
        $data = [
            "title" => "Download Ticket",
            "docpdf" => DocPdf::all()
        ];
        return response()->view('docpdf.download', $data);
    }

    public function postDownload()
    {
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



    // public function print()
    // {
    //     $data = [
    //         "title" => "Print Ticket",
    //         'tickets' => Ticket::with('phase')->get()
    //     ];

    //     return response()->view('ticket.print', $data);
    // }
}
