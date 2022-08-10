<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class CheckinController extends Controller
{
  public function checkin(Request $request)
  {
    $code = $request->all()['code'];
    $ticket = Ticket::where('code', $code)->first();

    if ($ticket) {
      if ($ticket->checkin_status) {
        return response()->json([
          "message" => "Ticket is already checkin !",
          "status" => 403
        ]);
      }

      Ticket::where('code', $code)->update(['checkin_status' => '1']);
      return response()->json([
        "message" => "Checkin successfuly !",
        "status" => 200
      ]);
    } else {
      return response()->json([
        "message" => "Code is invalid !",
        "status" => 404
      ])->setStatusCode(404);
    }
  }
}
