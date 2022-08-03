@extends('layouts.app')

@section('content')
<div class="row">
  <!-- Order Statistics -->
  <div class="order-0 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between pb-0">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2">File Tiket</h5>
        </div>
      </div>
      <div class="card-body">
        <a class="btn btn-primary" href="{{ route('ticket.generatepdf') }}">Print Ticket</a>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nama File</th>
              <th scope="col">Status Download</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($docpdf as $doc)
            <tr>
              <td>{{ $doc->id }}</td>
              <td>{{ $doc->name }}</td>
              <td>{{ $doc->is_printed==1?"Sudah Didownload":"Belum Didownload" }}</td>
              <td>
                <form action="{{ route('ticket.postDownload') }}" method="POST">
                  @csrf
                  <button type="submit" class="btn btn-primary">
                    Download
                  </button>
                </form>
              </td>
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