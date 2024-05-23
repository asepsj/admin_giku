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
                <form method="POST" action="{{ route('pasiens.update', ['id' => $pasiens->id, 'page' => request()->query('page')]) }}">
                  @csrf
                  <div class="form-group">
                    <label for="name_pasien">Name</label>
                    <input type="text" name="name_pasien" class="form-control" id="name_pasien" value="{{ $pasiens->name_pasien }}" required>
                  </div>

                  <div class="form-group">
                    <label for="email_pasien">Email</label>
                    <input type="email" name="email_pasien" class="form-control" id="email_pasien" value="{{ $pasiens->email_pasien }}" required>
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
