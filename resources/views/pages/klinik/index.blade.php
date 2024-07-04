@extends('other.layouts.app')
@section('navbar-title', 'Klinik')
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Klinik Information</h3>
                            </div>
                            <div class="card-body">
                                <!-- Tambahkan kode untuk menampilkan detail klinik -->
                                <div class="form-group">
                                    <label for="nama_klinik">Nama Klinik</label>
                                    <input type="text" class="form-control" id="nama_klinik" name="nama_klinik"
                                        value="{{ $klinik->nama_klinik }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="alamat_klinik">Alamat Klinik</label>
                                    <input type="text" class="form-control" id="alamat_klinik" name="alamat_klinik"
                                        value="{{ $klinik->alamat_klinik }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi_klinik">Deskripsi Klinik</label>
                                    <textarea class="form-control" id="deskripsi_klinik" name="deskripsi_klinik" disabled>{{ $klinik->deskripsi_klinik }}</textarea>
                                </div>
                                <!-- Tambahkan kode untuk menampilkan foto klinik jika ada -->
                                <div class="form-group">
                                    <label for="foto_klinik">Foto Klinik</label>
                                    @if ($klinik->photos && $klinik->photos->isNotEmpty())
                                        <div class="mt-2">
                                            @foreach ($klinik->photos as $photo)
                                                <img src="{{ asset('storage/fotos/' . $photo->photo_path) }}"
                                                    alt="Clinic Photo" style="width: 100px;" class="mr-2">
                                            @endforeach
                                        </div>
                                    @else
                                        <p>No photos available</p>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer">
                                @if ($authUser->role === 'admin')
                                    <a href="{{ route('doctors') }}" class="btn btn-primary">Back</a>
                                @else
                                    <a href="{{ route('klinik.edit', $klinik->user_id) }}" class="btn btn-primary">Edit</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
