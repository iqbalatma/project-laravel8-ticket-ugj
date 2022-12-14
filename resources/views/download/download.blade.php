@extends('layouts.app')

@section('content')
<x-alert></x-alert>

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
        <table class="table" id="table-download-doc">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nama File</th>
              <th scope="col">Status Download</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($docpdf as $doc)
            <tr>
              <td>{{ $doc->id }}</td>
              <td>{{ $doc->name }}</td>
              <td>
                @if ($doc->is_printed)
                <button class="btn btn-secondary" disabled>
                  Sudah Didownload
                </button>
                @else
                <a href="/download/{{ $doc->name }}" class="btn btn-primary">
                  Download
                </a>
                @endif
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