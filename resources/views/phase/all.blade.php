@extends('layouts.app')

@section('content')
<div class="row">
  <!-- Order Statistics -->
  <div class="order-0 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between pb-0">
        <div class="card-title mb-0">
          {{-- <h5 class="m-0 me-2">File Tiket</h5> --}}
        </div>
      </div>
      <div class="card-body">
        <table id="ticket-all" class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Code</th>
              <th scope="col">Status Checkin</th>
              <th scope="col">Tanggal Checkin</th>
              <th scope="col">Phase</th>
              <th scope="col">Inspektor</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($earlyTickets as $ticket)
            <tr>
              <td>{{ $ticket->id }}</td>
              <td>{{ $ticket->code }}</td>
              <td>@if ($ticket->checkin_status)
                <button class="btn btn-primary" disabled>Sudah Checkin</button>
                @else
                <button class="btn btn-secondary" disabled>Belum Checkin</button>
                @endif
              </td>
              <td>{{ $ticket->updated_at }}</td>
              <td>{{ $ticket->phase->name ?? "-" }} </td>
              <td>{{ $ticket->user->name ?? "-" }} </td>
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

@section('page-script')
<script>
  $(document).ready( function () {
    $('#ticket-all').DataTable({
      order: [
        [2, 'desc'],
        [3, 'desc'],
      ],
    });
  })
</script>
@endsection