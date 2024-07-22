@extends('other.layoutAuth.app')
@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card">
                    <div class="card-body">
                        <div class="app-brand justify-content-center mb-2 mt-4">
                            <a href="#" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <img src="{{ asset('assets/img/logo/logo.png') }}" alt="Brand Logo" width="25">
                                </span>
                                <span class="demo text-body fw-bolder" style="font-size: 25px">Giku</span> 
                            </a>
                        </div>
                        <div class="text-center">
                            {{-- <h4 class="mb-2">Selamat datang</h4> --}}
                            <p class="mb-4">Silahkan daftarkan diri anda</p>
                        </div>
                        <form id="formAuthentication" class="mb-3" action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="displayName" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="displayName" name="displayName"
                                    placeholder="Masukkan nama lengkap anda" autofocus />
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Masukkan email anda" autofocus />
                            </div>
                            <div class="mb-3">
                                <label for="phoneNumber" class="form-label">Nomor Handphone</label>
                                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber"
                                    placeholder="Masukkan nama nomor hp anda" autofocus />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="********" aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Sign up</button>
                            </div>
                        </form>
                        <p class="text-center">
                            <span>Already have an account?</span>
                            <a href="{{ route('login') }}">
                                <span>Sign in instead</span>
                            </a>
                        </p>
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                @foreach ($errors->all() as $error)
                                    <nav>{{ $error }}</nav>
                                @endforeach
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
