@extends('layouts.app')

@section('content')
<div class="row">
  <!-- Order Statistics -->
  <div class="col-12 order-0 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between pb-0">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2">List Ticket Belum Terkonfirmasi</h5>
          <small class="text-muted">Dibawah ini adalah list ticket yang belum terkonfirmasi</small>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive text-nowrap mt-4">
          <table class="table">
            <thead>
              <tr>
                <th>Nama User</th>
                <th>Email User</th>
                <th>Nama Data Tiket</th>
                <th>Nomor HP</th>
                <th>Status Tiket</th>
                <th>Tanggal Request</th>
                <th>Nomor Pesanan</th>
                <th>Konfirmasi Tiket</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @foreach ($tickets as $ticket)
              <tr>
                <td>{{ $ticket->user->name }}</td>
                <td>{{ $ticket->user->email }}</td>
                <td>{{ $ticket->name }}</td>
                <td>{{ $ticket->phone }}</td>
                <td class="
                @if ($ticket['order_status']=='On Progress')
                table-danger
                @endif">{{ $ticket['order_status'] }}</td>
                <td>{{ $ticket['created_at'] }}</td>
                <td>{{ $ticket->order_number }}</td>
                <td>
                  <form action="{{ route('ticket.confirm') }}" method="POST">
                    @csrf
                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                    <button type="submit" class="btn btn-primary text-white">Konfirmasi</button>
                  </form>
                </td>
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