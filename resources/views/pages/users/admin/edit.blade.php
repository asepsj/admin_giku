@extends('other.layouts.app')

@section('navbar-title', 'Edit Dokter')

@section('content')
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
                        <form method="POST" action="{{ route('admins.update', $key) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="displayName">Nama lengkap</label>
                                <input type="text" name="displayName" class="form-control" id="displayName"
                                    value="{{ old('displayName', $users['displayName']) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    value="{{ old('email', $users['email']) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" name="alamat" class="form-control" id="alamat"
                                    value="{{ old('alamat', $users['alamat'] ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label for="phoneNumber" class="form-label">Nomor Handphone</label>
                                <input type="text" name="phoneNumber" class="form-control" id="phoneNumber"
                                    value="{{ old('phoneNumber', $users['phoneNumber'] ?? '') }}">
                            </div>
                            <a href="{{ url()->previous() }}" class="ms-1 btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
