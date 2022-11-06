<?php

namespace App\Http\Controllers;

use App\Services\CheckinService;

class CheckinController extends Controller
{
    public function mobile()
    {
        return response()->view('checkin.mobile', [
            'title' => 'Checkin',
        ]);
    }

    public function web()
    {
        return response()->view('checkin.web', [
            'title' => 'Checkin',
        ]);
    }

    public function scannerTool(CheckinService $service)
    {
        return response()->view('checkin.scanner-tools', $service->getScannerToolData());
    }
}
