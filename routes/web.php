<?php

use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\PDFController;
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


Route::get('send-email-pdf', [SendEmailController::class, 'sendmail']);


Route::middleware('auth')->group(function () {
    Route::controller(ParticipantController::class)->group(function () {
        Route::get('/participant', 'index')->name('participant.index');
        Route::get('/participant/admin', 'admin')->name('participant.admin');
    });

    Route::controller(TicketController::class)->group(function () {
        Route::get('/ticket/generate', 'generate')->name('ticket.generate');
        Route::get('/ticket/download', 'download')->name('ticket.download');
        Route::get('/ticket/checkin/{code}', 'checkin')->name('ticket.checkin');
        // Route::get('/ticket/print', 'print')->name('ticket.print');
        Route::get('/ticket/generatepdf', 'generatepdf')->name('ticket.generatepdf');
        Route::post('/ticket/generate', 'store')->name('ticket.store');
        Route::post('/ticket/download', 'postDownload')->name('ticket.postDownload');
    });
});


Route::get('generate-pdf',[PDFController::class,'generatePDF']);