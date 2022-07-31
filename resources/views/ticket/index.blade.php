@extends('layouts.app')

@section('content')
<div class="row">
  <!-- Order Statistics -->
  <div class="order-0 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between pb-0">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2">List Ticket</h5>
          <small class="text-muted">Dibawah ini adalah list ticket anda</small>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive text-nowrap mt-4">
          <table class="table">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Nomor HP</th>
                <th>Code Ticket</th>
                <th>Status Tiket</th>
                <th>Tanggal Request</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @foreach ($tickets as $ticket)
              <tr>
                <td>{{ $ticket['name'] }}</td>
                <td>{{ $ticket['phone'] }}</td>
                <td>{{ $ticket['code'] }}</td>
                <td class="
                @if ($ticket['order_status']=='On Progress')
                  table-danger
                @endif">{{ $ticket['order_status'] }}</td>
                <td>{{ $ticket['created_at'] }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!--/ Order Statistics -->
</div>
@endsection