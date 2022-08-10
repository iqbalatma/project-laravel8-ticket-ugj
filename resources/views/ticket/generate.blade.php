@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12">
    @if ($message = Session::get('success'))
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
      <strong>{{ $message }}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if($message = Session::get("failed"))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>{{ $message }}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>{{ $message }}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
  </div>
</div>
<div class="row">
  <!-- Order Statistics -->
  <div class="order-0 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between pb-0">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2">Generate Ticket Tiket</h5>
          {{-- <small class="text-muted">Masukkan data diri beserta no pesanan shopee yang sudah anda lunasi</small> --}}
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <p>Ticket yang di generate akan menjadi satu file untuk kemudian dapat didownload di halaman "Download Ticket"</p>
        </div>
        <div class="row mt-4">
          <div class="col-lg-6">
            <small class="text-light fw-semibold">Fase Ticket dan Batas Cetak</small>
            <div class="demo-inline-spacing mt-3">
              <ul class="list-group">
                @foreach ($phases as $phase)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  {{ $phase->name }}
                  <span class="badge bg-primary">{{ $phase->limit }}</span>
                </li>
                @endforeach
              </ul>
            </div>
          </div>
          <div class="col-lg-6">
            <small class="text-light fw-semibold">Form Generate Ticket</small>
            <form method="POST" action="{{ route('ticket.store') }}">
              @csrf
              <div class="mb-3">
                <label for="quantity" class="form-label">Jumlah</label>
                <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" aria-describedby="textHelp" name="quantity"
                  placeholder="Maksimum 99 per generate operation">
                @error('quantity')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="mb-3">
                <label for="phase_id" class="form-label">Fase</label>
                <select class="form-select @error('phase_id') is-invalid @enderror" aria-label="Default select example" name="phase_id">
                  <option selected value>Pilih Fase</option>
                  <option value="1">Early</option>
                  <option value="2">Presale 1</option>
                  <option value="3">Presale 2</option>
                  <option value="4">Presale 3</option>
                  <option value="5">OTS</option>
                </select>
                @error('phase_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <button type="submit" class="btn btn-primary">Generate Ticket</button>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
  <!--/ Order Statistics -->
</div>
@endsection