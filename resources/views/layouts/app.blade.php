<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ $title }}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('sneat/assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('sneat/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('sneat/assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('sneat/assets/js/config.js') }}"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
  


    @if(Session::has('download.in.the.next.request'))
    <meta http-equiv="refresh" content="1; url={{ Session::get('download.in.the.next.request') }}">
    @endif

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.6/css/selectize.bootstrap5.css" integrity="sha512-wD3+yEMEGhx4+wKKWd0bNGCI+fxhDsK7znFYPvf2wOVxpr7gWnf4+BKphWnUCzf49AUAF6GYbaCBws1e5XHSsg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        @include('layouts.sidebar')
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">

          @include('layouts.navbar')
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
            @yield('content')
            </div>
            <!-- / Content -->

            @include('layouts.footer')
            
            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('sneat/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('sneat/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('sneat/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('sneat/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('sneat/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('sneat/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('sneat/assets/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="{{ asset('https://buttons.github.io/buttons.js') }}"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.6/js/standalone/selectize.js" integrity="sha512-X6kWCt4NijyqM0ebb3vgEPE8jtUu9OGGXYGJ86bXTm3oH+oJ5+2UBvUw+uz+eEf3DcTTfJT4YQu/7F6MRV+wbA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/html5qrcodescanner.js') }}"></script>
    <script>
       $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
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
              console.log(result);
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
                  title: `Oops...Ticket anda sudah pernah checkin pada ${result.checkin_date}!`,
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




      let html5QrcodeScanner = new Html5QrcodeScanner(
	        "reader", { fps: 1,  qrbox : { width: 600, height: 600 } });

      function onScanSuccess(decodedText, decodedResult) {
        console.log(decodedText);
          $.ajax({
                url: "{{ route('checkin.checkin') }}",
                type:'POST',
                data: {
                  code: decodedText
                },
                context: document.body,
            }).done(function(result) {
              console.log(result);
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
    // handle on error condition, with error message
    console.log(errorMessage);
}

html5QrcodeScanner.render(onScanSuccess, onScanError);

    </script>
    <script>
      $(document).ready( function () {
        $('#myTable').DataTable({
          order: [[2, 'desc']],
        });
      } );



    $(document).on("click", ".update-user-trigger", function () {
      let name = $(this).data('name');
      let id = $(this).data('id');
      let email = $(this).data('email');

      $("#update-user-modal #id").val(id);
      $("#update-user-modal #name").val(name);
      $("#update-user-modal #email").val(email);

      $('#update-user-modal').modal('show');
    });


    $(document).on("click", ".delete-user-trigger", function () {
      let id = $(this).data('id');
      $("#delete-user-modal #idDelete").val(id);

      $('#delete-user-modal').modal('show');
    });
    </script>
  </body>
</html>