@extends('other.layouts.app')
@section('navbar-title', 'Edit Clinic Photos')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <form action="{{ route('kliniks.updatePhotos', $klinik->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="foto_klinik">Upload Foto Baru</label>
                                    <input type="file" class="form-control" id="foto_klinik" name="foto_klinik[]"
                                        multiple>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                <a href="{{ route('klinik', $klinik->id) }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                        <div class="mt-3 ms-4">
                            <label>Foto Saat Ini</label>
                            <div>
                                @foreach ($klinik->photos as $photo)
                                    <div style="display: inline-block; position: relative; margin: 3%">
                                        <img src="{{ asset('storage/fotos/' . $photo->photo_path) }}" alt="Clinic Photo"
                                            style="width: 100px;" class="mr-2">
                                        <form action="{{ route('kliniks.deletePhoto', $photo->id) }}" method="POST"
                                            style="position: absolute; top: 0; right: 0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                style="background: none; border: none; color: red; font-size: 16px; cursor: pointer;">&times;</button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('other.alert.success')
    @include('other.alert.error')
@endsection
