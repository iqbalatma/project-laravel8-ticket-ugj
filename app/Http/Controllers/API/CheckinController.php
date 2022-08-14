<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CheckinController extends Controller
{
  public function checkin(Request $request)
  {
    $code = $request->all()['code'];
    $ticket = Ticket::where('code', $code)->first();
    $mytime = Carbon::now();
    $mytime->toDateTimeString();

    if ($ticket) {
      if ($ticket->checkin_status) {
        return response()->json([
          "message" => "Ticket is already checkin !",
          "status" => 403,
          "timestamp" => $mytime
        ])->setStatusCode(403);;
      }

      Ticket::where('code', $code)->update(['checkin_status' => '1']);
      return response()->json([
        "message" => "Checkin successfuly !",
        "status" => 200,
        "timestamp" => $mytime

      ])->setStatusCode(200);;
    } else {
      return response()->json([
        "message" => "Code is invalid !",
        "status" => 404,
        "timestamp" => $mytime
      ])->setStatusCode(404);
    }
  }
}
