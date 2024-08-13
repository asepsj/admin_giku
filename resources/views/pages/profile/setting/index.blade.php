@extends('other.layouts.app')
@section('navbar-title', 'Pengaturan Kata Sandi')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <hr class="my-0" />
                        <div class="card-body">
                            <form action="{{ route('profile.changePassword') }}" method="POST">
                                @csrf
                                <div class="mb-3 col-md-12">
                                    <label for="currentPassword" class="form-label">Kata Sandi Saat Ini</label>
                                    <input type="password" class="form-control" id="currentPassword" name="current_password"
                                        placeholder="Kata Sandi Saat Ini" required/>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="inputPassword" class="form-label">Kata Sandi Baru</label>
                                    <input type="password" class="form-control" id="inputPassword" name="password"
                                        placeholder="Kata Sandi Baru" required/>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="inputPasswordConfirmation" class="form-label">Konfirmasi Kata Sandi</label>
                                    <input type="password" class="form-control" id="inputPasswordConfirmation"
                                        name="password_confirmation" placeholder="Konfirmasi Kata Sandi" required/>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
