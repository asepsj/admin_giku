@extends('other.layouts.app')
@section('navbar-title', 'Dashboard')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Selamat datang {{ $authUser['role'] }}
                                {{ $authUser['displayName'] }}</h5>
                            <p class="mb-4">
                                Anda berhasil masuk !!!
                            </p>
                            @if ($authUser['role'] == 'admin')
                                <a href="{{ route('admins') }}" class="btn btn-sm btn-outline-primary">Kelola user</a>
                            @else
                                <a href="{{ route('jadwal') }}" class="btn btn-sm btn-outline-primary">Lihat Antrian</a>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140"
                                alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($authUser['role'] === 'admin')
            <div class="row">
                <div class="col-6 mb-4">
                    <a href="#" class="text-decoration-none">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-title d-flex">
                                        <span class="fw-semibold d-block mb-1">Dokter</span>
                                    </div>
                                    <h3 class="card-title mb-2">{{ str_pad(count($doctors), 4, '0', STR_PAD_LEFT) }}</h3>
                                    <small class="text-success fw-semibold">Terdaftar</small>
                                </div>
                                <img src="{{ asset('assets/img/illustrations/dokter.png') }}" alt="Doctor"
                                    class="img-fluid" style="max-width: 100px;">
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 mb-4">
                    <a href="#" class="text-decoration-none">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-title d-flex">
                                        <span class="fw-semibold d-block mb-1">Pasien</span>
                                    </div>
                                    <h3 class="card-title mb-2">{{ str_pad(count($users), 4, '0', STR_PAD_LEFT) }}</h3>
                                    <small class="text-success fw-semibold">Terdaftar</small>
                                </div>
                                <img src="{{ asset('assets/img/illustrations/pasien.png') }}" alt="Patient"
                                    class="img-fluid" style="max-width: 100px;">
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 mb-4">
                    <a href="#" class="text-decoration-none">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-title d-flex">
                                        <span class="fw-semibold d-block mb-1">Antrian</span>
                                    </div>
                                    <h3 class="card-title mb-2">{{ str_pad(count($users), 4, '0', STR_PAD_LEFT) }}</h3>
                                    <small class="text-success fw-semibold">Terdaftar</small>
                                </div>
                                <img src="{{ asset('assets/img/illustrations/antrian.png') }}" alt="Queue"
                                    class="img-fluid" style="max-width: 100px;">
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection
