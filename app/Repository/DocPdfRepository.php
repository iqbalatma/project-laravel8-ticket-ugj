<?php 

namespace App\Repository;

use App\Models\DocPdf;

class DocPdfRepository{
  public function getAllDataDocPdf():?object
  {
    return DocPdf::all();
  }

  public function getDocByFilename(string $filename):?object
  {
    return DocPdf::where("name", $filename)->first();
  }

  public function setToPrintedDocPdfByFilename(string $filename)
  {
    return DocPdf::where("name", $filename)->update(['is_printed' => 1]);
  }
}
?>