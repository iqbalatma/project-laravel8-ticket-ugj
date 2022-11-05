@extends('layouts.app')
@section('content')
<div class="row">
    <div class="order-0 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex flex-column align-items-center gap-1">
                        <h2 class="mb-2">{{ $totalTickets }}</h2>
                        <span>Total Ticket</span>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Fase Tiket</th>
                            <th scope="col">Jumlah Tiket</th>
                            <th scope="col">Jumlah Tiket Checkin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Tiket Fase Early</th>
                            <th scope="row">{{ $totalTicketEarly }}</th>
                            <th scope="row">{{ $totalTicketEarlyCheckin }}</th>
                        </tr>
                        <tr>
                            <th scope="row">Tiket Fase Presale 1</th>
                            <th scope="row">{{ $totalTicketPresale1 }}</th>
                            <th scope="row">{{ $totalTicketPresale1Checkin }}</th>
                        </tr>
                        <tr>
                            <th scope="row">Tiket Fase Presale 2</th>
                            <th scope="row">{{ $totalTicketPresale2 }}</th>
                            <th scope="row">{{ $totalTicketPresale2Checkin }}</th>
                        </tr>
                        <tr>
                            <th scope="row">Tiket Fase Presale 3</th>
                            <th scope="row">{{ $totalTicketPresale3 }}</th>
                            <th scope="row">{{ $totalTicketPresale3Checkin }}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection