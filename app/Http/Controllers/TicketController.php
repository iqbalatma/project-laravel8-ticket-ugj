<?php

namespace App\Http\Controllers;

use App\Models\DocPdf;
use App\Models\Phase;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Mail;
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
            // "docpdf" => DocPdf::all()
        ];
        // return response()->view('docpdf.download', $data);





        $html = view("ticket/pdfticket", $data);

        $mpdf = new \Mpdf\Mpdf([
          'margin_left' => 10,
          'margin_right' => 10,
          'margin_top' => 48,
          'margin_bottom' => 25,
          'margin_header' => 10,
          'margin_footer' => 10,
          'format' => 'A5-L'
        ]);
        $mpdf->SetProtection(array('print'));
        $mpdf->SetTitle("tes");
        $mpdf->SetAuthor("RZ TEXTILE");
        $mpdf->SetDisplayMode('fullpage');
    
        $mpdf->WriteHTML($html);

        dd($mpdf);
        // return $mpdf->Output();
    
    }

    public function postDownload()
    {
        $dataDoc = DocPdf::where("is_printed", 0)->get();
        if (count($dataDoc)) {
            DocPdf::where("is_printed", 0)->update(['is_printed' => 1]);

            File::delete('ticket.zip');

            $zip      = new ZipArchive();
            $fileName = 'ticket.zip';

            if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {
                foreach ($dataDoc as $key => $value) {
                    $zip->addFile(public_path("ticket/" . $value->name), $value->name);
                }
                $zip->close();
            }
            // Session::flash('download.in.the.next.request', $fileName);
            // return redirect()->to('/ticket/download');
            return response()->download(public_path($fileName));
        } else {
            echo "KOSONG";
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



    // public function print()
    // {
    //     $data = [
    //         "title" => "Print Ticket",
    //         'tickets' => Ticket::with('phase')->get()
    //     ];

    //     return response()->view('ticket.print', $data);
    // }
}
