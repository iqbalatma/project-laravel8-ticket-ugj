<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use PDF;

class SendEmailController extends Controller
{
    public function sendmail(Request $request)
    {


        $data["email"] = "iqbalatma@gmail.com";
        $data["title"] = "From ItSolutionStuff.com";
        $data["body"] = "This is Demo";

        $pdf = PDF::loadView('email.ticket', $data);

        Mail::send('email.ticket', $data, function ($message) use ($data, $pdf) {
            $message->to($data["email"], $data["email"])
                ->subject($data["title"])
                ->attachData($pdf->output(), "text.pdf");
        });
    }
}
