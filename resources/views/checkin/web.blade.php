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

        <div class="row">
          <div class="col">
            <div style="width: 100%" id="reader"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('page-script')
<script src="{{ asset('js/html5qrcodescanner.js') }}"></script>
<script>
  $.ajaxSetup({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
         }
  });

  let html5QrcodeScanner = new Html5QrcodeScanner("reader", {fps : 10, qrbox : { width: 600, height: 600 }}, false);

  function onScanSuccess(decodedText, decodedResult) {
    html5QrcodeScanner.pause(true);

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

            Swal.fire({
              icon: "success",
              title: "Berhasil checkin !",
              showConfirmButton: false,
              timer: 1500,
            });

            setTimeout(function(){
              html5QrcodeScanner.resume();
            }, 1000);
       }).fail(function(result){
          const status = result.status;
          if(status==403){
              Swal.fire({
              icon: 'error',
              title: `Oops...Ticket anda sudah pernah checkin ${result.responseJSON.checkin_date}!`,
              showConfirmButton: false,
              timer: 1500,
            })
          }

          if(status==404){
              Swal.fire({
              icon: 'error',
              title: 'Oops...Kode tiket invalid !',
              showConfirmButton: false,
              timer: 1500,
            })
          }
          setTimeout(function(){
            html5QrcodeScanner.resume();
          }, 1000);
       });
  }

  function onScanError(errorMessage) {

  }

  html5QrcodeScanner.render(onScanSuccess, onScanError);
</script>
@endsection