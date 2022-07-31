<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function qr()
    {


        // echo      QrCode::format("svg")
        //     ->size(50)
        //     ->generate("haha");

        // return  QrCode::generate('Make me into a QrCode!', '/qrcodes/qrcode.svg');
        $qrcode = QrCode::size(400)->generate("tes");
        return $qrcode;
    }
}
