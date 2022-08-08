<?php

use App\Http\Controllers\DownloadTicketController;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\TicketController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('check',  function ()
{
    return view('ticket.pdfticket');
    
});


Route::middleware('auth')->group(function () {
    Route::controller(TicketController::class)->group(function () {
        Route::get('/ticket/create', 'create')->name('ticket.create');
        Route::get('/ticket/checkin/{code}', 'checkin')->name('ticket.checkin');


        Route::get('/ticket/generatepdf', 'generatepdf')->name('ticket.generatepdf');
        Route::post('/ticket/generate', 'store')->name('ticket.store');
    });

    Route::controller(DownloadTicketController::class)->group(function ()
    {
        Route::get('/ticket/download', 'index')->name('downloadticket.index');
        Route::post('/ticket/download', 'postDownload')->name('downloadticket.download');
    });
});

