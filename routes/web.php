<?php

use App\Http\Controllers\CheckinController;
use App\Http\Controllers\DownloadTicketController;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketEarlyController;
use App\Http\Controllers\TicketOTSController;
use App\Http\Controllers\TicketPresale1Controller;
use App\Http\Controllers\TicketPresale2Controller;
use App\Http\Controllers\TicketPresale3Controller;
use App\Http\Controllers\UserController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('check',  function () {
    return view('ticket.pdfticket');
});


Route::middleware('auth')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index')->name('user.index')->middleware('isSuperadmin');
        Route::post('/users', 'store')->name('user.store')->middleware('isSuperadmin');
        Route::put('/users', 'update')->name('user.update')->middleware('isSuperadmin');
        Route::delete('/users', 'delete')->name('user.delete')->middleware('isSuperadmin');
    });

    Route::controller(CheckinController::class)->group(function () {
        Route::get('/checkin', 'index')->name('checkin.index');
        Route::post('/checkin', 'checkin')->name('checkin.checkin');
    });

    Route::prefix('ticket')->group(function () {
        Route::controller(TicketController::class)->group(function () {
            Route::get('/generate', 'create')->name('ticket.create');
            Route::post('/generate', 'store')->name('ticket.store');

            Route::get('/early', 'early')->name('ticket.early');
            Route::get('/presale1', 'presale1')->name('ticket.presale1');
            Route::get('/presale2', 'presale2')->name('ticket.presale2');
            Route::get('/presale3', 'presale3')->name('ticket.presale3');
            Route::get('/ots', 'ots')->name('ticket.ots');



            Route::get('/check', 'check')->name('ticket.check');
        });

        Route::controller(DownloadTicketController::class)->group(function () {
            Route::get('/download', 'index')->name('downloadticket.index');
            Route::get('/download/{filename}', 'postDownload')->name('downloadticket.download');
        });
    });
});
