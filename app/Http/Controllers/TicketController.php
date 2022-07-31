<?php

namespace App\Http\Controllers;


use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{

    public function index()
    {
        $data = [
            'tickets' => Ticket::where('user_id', Auth::id())->get()
        ];

        return response()->view('ticket.index', $data);
    }

    public function create()
    {
        return response()->view('ticket.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:60',
            'phone' => 'required|max:20',
            'order_number' => 'required|max:64',
        ]);

        $validated['user_id'] = Auth::id();

        if (Ticket::create($validated))
            return  redirect()
                ->route('ticket.create')
                ->with('success', "Permintaan tiket telah berhasil dikirim, tiket akan dikirimkan apabila sudah terkonfirmasi.");
    }

    public function confirmed()
    {
        $data = [
            'tickets' => Ticket::with('user')->where('order_status', 'Confirm')->get()
        ];
        return response()->view('ticket.confirmed', $data);
    }

    public function confirm(Request $request)
    {
        $ticket_id = $request->input('ticket_id');

        /**
         * !update_at belum
         */

        $query =   DB::table('tickets')
            ->where('id', $ticket_id)
            ->update([
                'order_status' => "Confirm",
                'code' => 'ini adalah code'
            ]);

        dd($query);
    }

    public function waitingconfirm()
    {
        $data = [
            'tickets' => Ticket::with('user')->where('order_status', 'On Progress')->get()
        ];
        return response()->view('ticket.waitingconfirm', $data);
    }
}
