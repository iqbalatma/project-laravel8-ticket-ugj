<?php

namespace App\Http\Controllers;

use App\Models\DocPdf;
use App\Services\DownloadTicketService;

class DownloadTicketController extends Controller
{
    public function index(DownloadTicketService $service)
    {
        return response()->view('download.download', $service->getAllDataTicketDocument());
    }

    public function download(DownloadTicketService $service, string $fileName)
    {
        $downlodedFile = $service->downloadDocPdf($fileName);

        if(!$downlodedFile){
            return redirect()->route('downloadticket.index')->with('failed', "Ticket already downloaded !");
        }
       
        return response()->download("ticket/$downlodedFile");
    }
}
