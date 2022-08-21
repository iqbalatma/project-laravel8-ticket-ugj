<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class CheckinController extends Controller
{
    public function index()
    {
     return response()->view('checkin.index', [
        'title'=> 'Checkin',
        'tickets'=> Ticket::all(),
     ]);
    }
}
