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
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.6/js/standalone/selectize.js"
  integrity="sha512-X6kWCt4NijyqM0ebb3vgEPE8jtUu9OGGXYGJ86bXTm3oH+oJ5+2UBvUw+uz+eEf3DcTTfJT4YQu/7F6MRV+wbA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
  $.ajaxSetup({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
  });
  $(function () {
        function onChangeRoll(context) {
            let ticketCode = $(context).val();

            $.ajax({
                url: "{{ route('checkin.checkin') }}",
                type:'POST',
                data: {
                  code: ticketCode
                },
                context: document.body,
            }).done(function(result) {
              let status = result.status;
              let message = result.message;

              return Swal.fire({
                    icon: "success",
                    title: "Berhasil checkin !",
                    showConfirmButton: false,
                    timer: 1500,
              });
            }).fail(function(result){
              const status = result.status;
              if(status==403){
                return Swal.fire({
                  icon: 'error',
                  title: `Oops...Ticket anda sudah pernah checkin pada ${result.responseJSON.checkin_date}!`,
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


        $("#select-checkin").on("change", function() {
           onChangeRoll(this);
        });


       let selectized =  $("#select-checkin").selectize({
          openOnFocus:false
        });

        selectized[0].selectize.focus();

        selectized[0].selectize.on("focus", function() {
            $("#select-checkin").unbind("change");
            selectized[0].selectize.clear();
            selectized[0].selectize.focus();
            $("#select-checkin").bind("change", function() {
                onChangeRoll(this);
            });
        });


      });
</script>
@endsection