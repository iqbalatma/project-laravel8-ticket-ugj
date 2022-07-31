<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function index()
    {
        $data = [
            'participants' => User::where('role_id', 3)->get()
        ];
        return response()->view('participant.index', $data);
    }

    // public function ()
    // {
    //     # code...
    // }
}
