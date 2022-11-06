<?php

use App\Http\Controllers\API\CheckinController as APICheckinController;
use App\Http\Controllers\CheckinController;
use App\Http\Controllers\DownloadTicketController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketPhasesController;
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

/**
 * DEV
 */
Route::get('check',  function () {
    $pdf = PDF::loadView('ticket.check-pdfticket');
    return  $pdf->stream();
});


/**
 * PROD
 */
Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();


// url, class controller, method, middleware, name, http method

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    Route::middleware("isSuperadmin")
        ->prefix('users')
        ->name('user.')
        ->controller(UserController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::put('/', 'update')->name('update');
            Route::delete('/', 'delete')->name('delete');
        });

    Route::prefix("checkin")
        ->controller(CheckinController::class)
        ->name('checkin.')
        ->group(function () {
            Route::get('/mobile', 'mobile')->name('mobile');
            Route::get('/web', 'web')->name('web');
            Route::get('/scanner-tools', 'scannerTool')->name('scanner-tools');
        });
    
    Route::prefix("checkin")
        ->controller(APICheckinController::class)
        ->name('checkin.')
        ->group(function () {
            Route::post('/', 'checkin')->name('checkin');
        });
    

    

    Route::prefix("phase/ticket")
        ->controller(TicketPhasesController::class)
        ->name('phase.ticket.')
        ->group(function () {
            Route::get('/early', 'early')->name('early');
            Route::get('/presale1', 'presale1')->name('presale1');
            Route::get('/presale2', 'presale2')->name('presale2');
            Route::get('/presale3', 'presale3')->name('presale3');
        });


    Route::prefix('tickets')
        ->controller(TicketController::class)
        ->name('tickets.')
        ->group(function () {
            Route::get('/', 'create')->name('create');
            Route::post('/', 'store')->name('store');
        });

    Route::prefix('download')
        ->controller(DownloadTicketController::class)
        ->name('downloadticket.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{filename}', 'download')->name('download');
        });
});
