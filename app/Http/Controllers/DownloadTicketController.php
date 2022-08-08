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
          return response()->download(public_path($fileName));
      } else {
          echo "KOSONG";
      }
  }

}