<?php

use App\Http\Controllers\DownloadTicketController;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketEarlyController;
use App\Http\Controllers\TicketOTSController;
use App\Http\Controllers\TicketPresale1Controller;
use App\Http\Controllers\TicketPresale2Controller;
use App\Http\Controllers\TicketPresale3Controller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('check',  function ()
{
    return view('ticket.pdfticket');
});


Route::middleware('auth')->group(function () {
    Route::controller(TicketController::class)->group(function () {
        Route::get('/ticket/create', 'create')->name('ticket.create');
        Route::get('/ticket/generatepdf', 'generatepdf')->name('ticket.generatepdf');


        Route::post('/ticket/generate', 'store')->name('ticket.store');
        // Route::get('/ticket/tespdf', 'tespdf')->name('ticket.tespdf');
    });

    Route::controller(DownloadTicketController::class)->group(function ()
    {
        Route::get('/ticket/download', 'index')->name('downloadticket.index');
        Route::get('/ticket/download/{filename}', 'postDownload')->name('downloadticket.download');
    });

    Route::controller(TicketEarlyController::class)->group(function ()
    {
        Route::get('/ticket/early', 'index')->name('ticketearly.index');
    });
    Route::controller(TicketPresale1Controller::class)->group(function ()
    {
        Route::get('/ticket/presale1', 'index')->name('ticketpresale1.index');
    });
    Route::controller(TicketPresale2Controller::class)->group(function ()
    {
        Route::get('/ticket/presale2', 'index')->name('ticketpresale2.index');
    });
    Route::controller(TicketPresale3Controller::class)->group(function ()
    {
        Route::get('/ticket/presale3', 'index')->name('ticketpresale3.index');
    });
    Route::controller(TicketOTSController::class)->group(function ()
    {
        Route::get('/ticket/ots', 'index')->name('ticketots.index');
    });
});

