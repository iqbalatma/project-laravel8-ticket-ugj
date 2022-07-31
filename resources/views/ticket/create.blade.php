@extends('layouts.app')

@section('content')
<div class="row">
  <!-- Order Statistics -->
  <div class="order-0 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between pb-0">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2">Request Tiket</h5>
          <small class="text-muted">Masukkan data diri beserta no pesanan shopee yang sudah anda lunasi</small>
        </div>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('ticket.store') }}">
          @csrf
          <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="textHelp" name="name">
            @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">Nomor HP</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" aria-describedby="textHelp" name="phone">
            @error('phone')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="mb-3">
            <label for="order_number" class="form-label">Nomor Pesanan Shopee</label>
            <input type="text" class="form-control @error('order_number') is-invalid @enderror" id="order_number" aria-describedby="textHelp" name="order_number">
            @error('order_number')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary">Request</button>
        </form>
      </div>
    </div>
  </div>
  <!--/ Order Statistics -->
</div>
@endsection