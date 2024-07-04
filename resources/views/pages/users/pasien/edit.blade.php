@extends('other.layouts.app')
@section('navbar-title', 'Edit Pasien')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Basic Layout & Basic with Icons -->
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="POST" action="{{ route('pasiens.update', $pasien->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="name_pasien">Name</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-user"></i></span>
                                            <input type="text" class="form-control" id="name_pasien" name="name_pasien"
                                                value="{{ old('name_pasien', $pasien->name_pasien) }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="email_pasien">Email</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                            <input type="email" class="form-control" id="email_pasien" name="email_pasien"
                                                value="{{ old('email_pasien', $pasien->email_pasien) }}" required>
                                        </div>
                                        <div class="form-text">You can use letters, numbers & periods</div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="alamat">Address</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-building"></i></span>
                                            <input type="text" class="form-control" id="alamat" name="alamat"
                                                value="{{ old('alamat', $pasien->alamat) }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="nomor_hp">Phone No</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-phone"></i></span>
                                            <input type="text" class="form-control" id="nomor_hp" name="nomor_hp"
                                                value="{{ old('nomor_hp', $pasien->nomor_hp) }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="foto">Photo</label>
                                    {{-- <div class="col-sm-10">
                                        <input type="file" class="form-control" id="foto" name="foto">
                                    </div> --}}
                                    <div class="col-sm-10">
                                        @if($pasien->foto)
                                            <img src="{{ asset('storage/fotos/' . $pasien->foto) }}" alt="Patient Photo" style="max-width: 100px;">
                                        @else
                                            <p>No photo available</p>
                                        @endif
                                        <input type="file" class="form-control mt-2" id="foto" name="foto">
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
