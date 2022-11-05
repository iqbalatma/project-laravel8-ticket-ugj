<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Services\HomeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(HomeService $service)
    {
        return response()->view('home', $service->getAllDataSummary());
    }
}
