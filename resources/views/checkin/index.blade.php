@extends('layouts.app')

@section('content')
<div class="row">
  <!-- Order Statistics -->
  <div class="order-0 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between pb-0">
        <div class="card-title mb-0">
          <h5 class="">Checkin Ticket</h5>
        </div>
      </div>
      <div class="card-body">

        @if(Session::has('success'))
        <div class="alert alert-primary" role="alert">
          {{ Session::get('success') }}
        </div>
        @endif

        <div style="width: 1200px" id="reader"></div>

        {{-- <select class="form-select" aria-label="Default select example" id="select-checkin">
          @foreach ($tickets as $ticket)
          <option value="{{ $ticket->code }}">{{ $ticket->code }}</option>
          @endforeach
        </select> --}}


      </div>
    </div>
  </div>
  <!--/ Order Statistics -->

</div>


@endsection