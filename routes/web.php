<?php

use App\Http\Controllers\ParticipantController;
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


Route::get('/qr', [App\Http\Controllers\HomeController::class, 'qr'])->name('add-qr-code');
Route::get('send-email-pdf', [SendEmailController::class, 'sendmail']);

Route::controller(TicketController::class)->group(function () {
    Route::get('/ticket', 'index')->name('ticket.index');
    Route::get('/ticket/confirmed', 'confirmed')->name('ticket.confirmed');
    Route::get('/ticket/waitingconfirm', 'waitingconfirm')->name('ticket.waitingconfirm');
    Route::get('/ticket/request', 'create')->name('ticket.create');
    Route::post('/ticket', 'store')->name('ticket.store');
    Route::post('/ticket/confirm', 'confirm')->name('ticket.confirm');
});

Route::controller(ParticipantController::class)->group(function () {
    Route::get('/participant', 'index')->name('participant.index');
    Route::get('/participant/admin', 'admin')->name('participant.admin');
});
