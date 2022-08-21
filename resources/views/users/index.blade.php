@extends('layouts.app')

@section('content')
<div class="row">
  <!-- Order Statistics -->
  <div class="order-0 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between pb-0">
        <div class="card-title mb-0">
          <h5 class="">Tambah User Panitia</h5>
        </div>
      </div>
      <div class="card-body">

        @if(Session::has('success'))
        <div class="alert alert-primary" role="alert">
          {{ Session::get('success') }}
        </div>
        @endif


        <form action="{{ route('user.store') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="name" class="form-control @error('name') is-invalid           
            @enderror" name="name" id="name" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid           
            @enderror" name="email" id="email" required>
            @error('email')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
  <!--/ Order Statistics -->

  <!-- Order Statistics -->
  <div class="order-0 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between pb-0">
        <div class="card-title mb-0">
          {{-- <h5 class="m-0 me-2">File Tiket</h5> --}}
        </div>
      </div>
      <div class="card-body">
        <table id="myTable" class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nama</th>
              <th scope="col">Email</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
            <tr>
              <td>{{ $user->id }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>
                <button type="button" class="btn btn-primary update-user-trigger" data-bs-toggle="modal" data-id="{{ $user->id }}" data-email="{{ $user->email }}" data-name="{{ $user->name }}">
                  Ganti Password
                </button>
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

<!-- Modal -->
<div class="modal fade" id="update-user-modal" tabindex="-1" aria-labelledby="update-modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Ganti Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('user.update') }}" method="POST">
        @csrf
        @method("PUT")
        <div class="modal-body">
          <input type="hidden" name="id" id="id">
          <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="name" class="form-control @error('name') is-invalid           
            @enderror" name="name" id="name" readonly>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid           
            @enderror" name="email" id="email" readonly>
            @error('email')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password Baru</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection