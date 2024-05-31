@extends('layouts.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Patient</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Patient</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <form method="POST" action="{{ route('doctors.update', ['id' => $doctor->id, 'page' => request()->query('page')]) }}">
                  @csrf
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ $doctor->name }}" required>
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ $doctor->email }}" required>
                  </div>

                  <div class="mb-3">
                    <label for="alamat" class="form-label">Address</label>
                    <input type="text" name="alamat" class="form-control" id="alamat" value="{{ $doctor->alamat }}">
                </div>
                <div class="mb-3">
                    <label for="nomor_hp" class="form-label">Phone Number</label>
                    <input type="text" name="nomor_hp" class="form-control" id="nomor_hp" value="{{ $doctor->nomor_hp }}">
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Photo</label>
                    <input type="file" name="foto" class="form-control" id="foto">
                    @if ($doctor->foto)
                        <img src="{{ asset('images/' . $doctor->foto) }}" alt="Doctor Photo" class="img-thumbnail mt-2" width="150">
                    @endif
                </div>

                  <button type="submit" class="btn btn-primary">Update</button>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
