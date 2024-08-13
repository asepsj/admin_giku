@extends('other.layouts.app')
@section('navbar-title', 'Profil Saya')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <form id="formAccountSettings" method="POST" action="{{ route('profile.update') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    @if (!empty($user['foto']))
                                        <img src="{{ $user['foto'] }}" alt="user-avatar"
                                            class="d-block rounded profile-avatar" id="uploadedAvatar">
                                    @else
                                        <img src="{{ asset('storage/logo/user.png') }}" alt="user-avatar"
                                            class="d-block rounded profile-avatar" id="uploadedAvatar">
                                    @endif
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                            <span class="d-none d-sm-block">Unggah Foto Baru</span>
                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                            <input type="file" id="upload" class="account-file-input" hidden
                                                name="foto" accept="image/png, image/jpeg" />
                                        </label>
                                        {{-- <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p> --}}
                                    </div>
                                </div>
                            </div>
                            <hr class="my-0" />
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="displayName" class="form-label">Nama</label>
                                        <input class="form-control" type="text" id="displayName" name="displayName"
                                            value="{{ $user['displayName'] ?? '' }}" autofocus />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input class="form-control" type="text" id="email" name="email"
                                            value="{{ $user['email'] ?? '' }}" placeholder="john.doe@example.com" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="phoneNumber" class="form-label">Nomor Telepon</label>
                                        <input type="text" id="phoneNumber" name="phoneNumber" class="form-control"
                                            placeholder="202 555 0111" value="{{ $user['phoneNumber'] ?? '' }}" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat"
                                            placeholder="Address" value="{{ $user['alamat'] ?? '' }}" />
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="description" class="form-label">Deskripsi</label>
                                        <textarea class="form-control" id="description" name="description" rows="3"
                                            placeholder="Enter the doctor's description">{{ $user['description'] ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
                                    <button type="reset" class="btn btn-outline-secondary">Batal</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .profile-avatar {
            object-fit: cover;
            width: 100px;
            height: 100px;
            border: 2px solid #696CFF;
        }
    </style>
@endsection
