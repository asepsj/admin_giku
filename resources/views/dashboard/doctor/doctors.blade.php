@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dokter</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dokter</li>
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
              <div class="card-header">                
                <a href="{{ route('doctors.add') }}" class="btn btn-primary">Add Doctor</a>
                <div class="card-tools">
                  <form action="{{ route('doctors') }}" method="GET">
                      <div class="input-group input-group-sm" style="width: 150px;">
                          <input type="text" name="table_search" class="form-control float-right" placeholder="Search" value="{{ request('table_search') }}">
                          <div class="input-group-append">
                              <button type="submit" class="btn btn-default">
                                  <i class="fas fa-search"></i>
                              </button>
                          </div>
                      </div>
                  </form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Foto</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Nomor Handphone</th>
                      <th>Alamat</th>
                      <th>Created At</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($doctors as $doctor)
                    <tr>
                      <td>{{ $doctor->id }}</td>
                      <td><img src="{{ asset('storage/fotos/'.$doctor->foto) }}" alt="{{ $doctor->name }}" style="width: 50px;"></td>
                      <td>{{ $doctor->name }}</td>
                      <td>{{ $doctor->email }}</td>
                      <td>{{ $doctor->nomor_hp }}</td>
                      <td>{{ $doctor->alamat }}</td>
                      <td>{{ $doctor->created_at }}</td>
                      <td>
                        <td>
                          <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-sm btn-warning">
                              <i class="fas fa-edit"></i>
                          </a>
                          <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this pasien?');">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-sm btn-danger">
                                  <i class="fas fa-trash-alt"></i>
                              </button>
                          </form>
                      </td>
                    </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
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