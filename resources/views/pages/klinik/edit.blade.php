@extends('other.layouts.app')
@section('navbar-title', 'Edit Klinik')
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Klinik</h3>
                        </div>
                        <form action="{{ route('kliniks.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama_klinik">Nama Klinik</label>
                                    <input type="text" class="form-control" id="nama_klinik" name="nama_klinik"
                                        value="{{ $klinik->nama_klinik }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="alamat_klinik">Alamat Klinik</label>
                                    <input type="text" class="form-control" id="alamat_klinik" name="alamat_klinik"
                                        value="{{ $klinik->alamat_klinik }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi_klinik">Deskripsi Klinik</label>
                                    <textarea class="form-control" id="deskripsi_klinik" name="deskripsi_klinik">{{ $klinik->deskripsi_klinik }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="foto_klinik">Foto Klinik</label>
                                    <input type="file" class="form-control" id="foto_klinik" name="foto_klinik[]"
                                        multiple>
                                    <div class="mt-2">
                                        @foreach ($klinik->photos as $photo)
                                            <img src="{{ asset('storage/fotos/' . $photo->photo_path) }}" alt="Clinic Photo"
                                                style="width: 100px;" class="mr-2">
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('klinik', $klinik->id) }}" class="btn btn-primary">Back</a>
                                <button type="submit" class="btn btn-primary">Update Klinik</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </section>
    </div>
@endsection
