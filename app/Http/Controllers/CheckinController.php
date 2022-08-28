<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckinController extends Controller
{
    public function mobile()
    {
        return response()->view('checkin.mobile', [
            'title' => 'Checkin',
        ]);
    }

    public function wide()
    {
        return response()->view('checkin.web', [
            'title' => 'Checkin',
        ]);
    }

    public function scannerTool()
    {
        return response()->view('checkin.scanner-tools', [
            'title' => 'Checkin',
            'tickets' => Ticket::where('checkin_status', 0)->get(),
        ]);
    }

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
                    "timestamp" => $mytime,
                    "checkin_date" =>  $ticket->updated_at->format('H:i:s')
                ])->setStatusCode(200);;
            }

            Ticket::where('code', $code)->update(['checkin_status' => '1', 'updated_at' => now(), "user_id" => Auth::user()->id,]);
            return response()->json([
                "message" => "Checkin successfuly !",
                "status" => 200,
                "timestamp" => $mytime,
                "user_id" => Auth::user()->id,
            ])->setStatusCode(200);;
        } else {
            return response()->json([
                "message" => "Code is invalid !",
                "status" => 404,
                "timestamp" => $mytime,
            ])->setStatusCode(200);
        }
    }
}
