@extends('layouts.app')

@section('content')



<div class="row">
  <!-- Order Statistics -->
  <div class="order-0 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between pb-0">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2">Semua ticket yang belum dicetak</h5>
        </div>
      </div>
      <div class="card-body">
        <a class="btn btn-primary" href="{{ route('ticket.generatepdf') }}">Print Ticket</a>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Code</th>
              <th scope="col">Tangga Generate</th>
              <th scope="col">Status Cetak</th>
              <th scope="col">Status Checkin</th>
              <th scope="col">Fase</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($tickets as $ticket)
            <tr>
              <th scope="row">{{ $ticket->id }}</th>
              <td>{{ $ticket->code }}</td>
              <td>{{ $ticket->created_at }}</td>
              <td>Belum Dicetak</td>
              <td>Belum Checkin</td>
              <td>{{ $ticket->phase->name }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!--/ Order Statistics -->
</div>
@endsection