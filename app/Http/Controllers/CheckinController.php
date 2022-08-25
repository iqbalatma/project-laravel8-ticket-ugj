<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckinController extends Controller
{
    public function index()
    {
        return response()->view('checkin.narrow-screen', [
            'title' => 'Checkin',
            'tickets' => Ticket::all(),
        ]);
    }

    public function wide()
    {
        return response()->view('checkin.wide-screen', [
            'title' => 'Checkin',
            'tickets' => Ticket::all(),
        ]);
    }

    public function scannerTool()
    {
        return response()->view('checkin.scanner-tools', [
            'title' => 'Checkin',
            'tickets' => Ticket::all(),
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

            Ticket::where('code', $code)->update(['checkin_status' => '1', 'updated_at' => now()]);
            return response()->json([
                "message" => "Checkin successfuly !",
                "status" => 200,
                "timestamp" => $mytime,
                "checkin_date" =>  $ticket->updated_at->format('H:i:s')
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
