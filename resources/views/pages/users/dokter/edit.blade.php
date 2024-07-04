@extends('other.layouts.app')
@section('navbar-title', 'Edit Dokter')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <form method="POST"
                                action="{{ route('doctors.update', ['id' => $doctor->id, 'page' => request()->query('page')]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        value="{{ old('name', $doctor->name) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                        value="{{ old('email', $doctor->email) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Address</label>
                                    <input type="text" name="alamat" class="form-control" id="alamat"
                                        value="{{ old('alamat', $doctor->alamat) }}">
                                </div>
                                <div class="mb-3">
                                    <label for="nomor_hp" class="form-label">Phone Number</label>
                                    <input type="text" name="nomor_hp" class="form-control" id="nomor_hp"
                                        value="{{ old('nomor_hp', $doctor->nomor_hp) }}">
                                </div>
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Photo</label>
                                    <input type="file" name="foto" class="form-control" id="foto">
                                    <div class="mt-3">
                                        @if ($doctor->foto)
                                            <img src="{{ asset('storage/fotos/' . $doctor->foto) }}"
                                                alt="{{ $doctor->name }}" style="width: 100px;">
                                        @else
                                            <img src="{{ asset('storage/logo/user.png') }}" class="img-circle"
                                                alt="Default Foto" style="width: 100px;">
                                        @endif
                                    </div>
                                </div>
                                <a href="{{ url()->previous() }}" class="ms-1 btn btn-secondary">Back</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-wrapper -->
@endsection
