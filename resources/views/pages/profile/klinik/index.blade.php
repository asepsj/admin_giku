@extends('other.layouts.app')
@section('navbar-title', 'My Profile')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-12">
                    <!-- Button -->
                    @include('pages.profile.button.index')
                    <!-- /Button -->
                    <div class="card mb-4">
                        {{-- <h1 class="text-center pt-3">INFORMASI KLINIK</h1> --}}
                        <div id="carouselExample-cf" class="carousel carousel-dark slide carousel-fade mt-2"
                            data-bs-ride="carousel" style="width: 500px; margin: 0 auto;">
                            <ol class="carousel-indicators">
                                @foreach ($klinik->photos as $index => $photo)
                                    <li data-bs-target="#carouselExample-cf" data-bs-slide-to="{{ $index }}"
                                        class="{{ $index == 0 ? 'active' : '' }}"></li>
                                @endforeach
                            </ol>
                            <div class="carousel-inner">
                                @foreach ($klinik->photos as $index => $photo)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}"
                                        style="display: flex; justify-content: center; align-items: center; height: 350px;">
                                        <img src="{{ asset('storage/fotos/' . $photo->photo_path) }}"
                                            alt="Clinic Photo {{ $index + 1 }}"
                                            style="max-height: 100%; max-width: 100%;">
                                    </div>
                                @endforeach
                            </div>
                            {{-- <a class="carousel-control-prev" href="#carouselExample-cf" role="button" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExample-cf" role="button" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </a> --}}
                        </div>
                        <!-- Account -->
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

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Klinik</button>
                                <a href="{{ route('kliniks.editPhotos', $klinik->id) }}" class="btn btn-secondary">Edit
                                    Photos</a>
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
    @include('other.alert.success')
    @include('other.alert.error')
@endsection
