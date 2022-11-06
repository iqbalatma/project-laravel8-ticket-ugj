<?php

namespace App\Services;

use App\Models\DocPdf;
use App\Repository\DocPdfRepository;

class DownloadTicketService
{
  public function getAllDataTicketDocument(): array
  {
    return [
      "title" => "Download Ticket",
      "docpdf" => (new DocPdfRepository())->getAllDataDocPdf()->sortBy('is_printed')
    ];
  }

  public function downloadDocPdf(string $filename)
  {
    $dataDoc = (new DocPdfRepository())->getDocByFilename($filename);
    if ($dataDoc->is_printed) {
      return false;
    }

   (new DocPdfRepository())->setToPrintedDocPdfByFilename($filename);

    return $dataDoc->name;
  }
}
