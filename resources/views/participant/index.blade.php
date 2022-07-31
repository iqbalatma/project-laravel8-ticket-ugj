@extends('layouts.app')

@section('content')
<div class="row">
  <!-- Order Statistics -->
  <div class="order-0 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between pb-0">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2">List Peserta</h5>
          <small class="text-muted">Dibawah ini adalah list peserta</small>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive text-nowrap mt-4">
          <table class="table">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Tanggal Registrasi</th>
                <th>Jumlah Tiket</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @foreach ($participants as $participant)
              <tr>
                <td>{{ $participant['name'] }}</td>
                <td>{{ $participant['email'] }}</td>
                <td>{{ $participant['created_at'] }}</td>
                <td class="bg-danger">BELUM SELESAI</td>
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