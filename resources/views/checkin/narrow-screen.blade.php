@extends('layouts.app')

@section('content')
<div class="row">
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

        <div class="d-none d-md-block">
          <p>Ukuran layar tidak support</p>
        </div>

        <div class="row d-md-none">
          <div class="col">
            <div style="width: 100%" id="reader"></div>
          </div>
        </div>

        <select class="form-select" aria-label="Default select example" id="select-checkin">
          @foreach ($tickets as $ticket)
          <option value="{{ $ticket->code }}">{{ $ticket->code }}</option>
          @endforeach
        </select>

      </div>
    </div>
  </div>
</div>
@endsection


@section('page-script')
<script src="{{ asset('js/html5qrcodescanner.js') }}"></script>
<script>
  $.ajaxSetup({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
  });

  let html5QrcodeScanner = new Html5QrcodeScanner("reader", {fps : 1, qrbox : { width: 600, height: 600 }});

  function onScanSuccess(decodedText, decodedResult) {
       $.ajax({
             url: "{{ route('checkin.checkin') }}",
             type:'POST',
             data: {
               code: decodedText
             },
             context: document.body,
         }).done(function(result) {
           let status = result.status;
           let message = result.message;
           if(status==200){
             return Swal.fire({
                 icon: "success",
                 title: "Berhasil checkin !",
                 showConfirmButton: false,
                       timer: 1500,
             });
           }

           if(status==403){
             return Swal.fire({
               icon: 'error',
               title: 'Oops...Ticket anda sudah pernah checkin !',
               showConfirmButton: false,
                     timer: 1500,
             })
           }

           if(status==404){
             return Swal.fire({
               icon: 'error',
               title: 'Oops...Kode tiket invalid !',
               showConfirmButton: false,
                     timer: 1500,
             })
           }
       });
  }

  function onScanError(errorMessage) {

  }

  html5QrcodeScanner.render(onScanSuccess, onScanError);
</script>
@endsection