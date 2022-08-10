<?php

namespace App\Http\Controllers;

use App\Models\DocPdf;
use ZipArchive;
use File;


class DownloadTicketController extends Controller
{
    public function index()
    {
        $data = [
            "title" => "Download Ticket",
            "docpdf" => DocPdf::all()
        ];
        return response()->view('docpdf.download', $data);
    }

    public function postDownload($fileName)
    {
        $dataDoc = DocPdf::where("name", $fileName)->first();
        if ($dataDoc->is_printed) {
            return redirect()->route('downloadticket.index')->with('failed', "Ticket already downloaded !");
        }

        $dataDoc->is_printed = 1;
        $dataDoc->save();
        return response()->download("ticket/$fileName");
    }
}
