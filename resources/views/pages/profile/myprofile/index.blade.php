@extends('other.layouts.app')
@section('navbar-title', 'My Profile')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            {{-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4> --}}
            <div class="row">
                <div class="col-md-12">
                    <!-- Button -->
                    @include('pages.profile.button.index')
                    <!-- /Button -->
                    <div class="card mb-4">
                        <!-- Account -->
                        <form id="formAccountSettings" method="POST" action="{{ route('profile.update') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    @if ($authUser->foto)
                                        <img src="{{ asset('storage/fotos/' . $authUser->foto) }}" alt="user-avatar"
                                            class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                                    @else
                                        <img src="{{ asset('storage/logo/user.png') }}" alt="user-avatar"
                                            class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                                    @endif
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                            <span class="d-none d-sm-block">Upload new photo</span>
                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                            <input type="file" id="upload" class="account-file-input" hidden
                                                name="foto" accept="image/png, image/jpeg" />
                                        </label>
                                        <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                            <i class="bx bx-reset d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Reset</span>
                                        </button>
                                        <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-0" />
                            <div class="card-body">

                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">Name</label>
                                        <input class="form-control" type="text" id="name" name="name"
                                            value="{{ $authUser->name }}" autofocus />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input class="form-control" type="text" id="email" name="email"
                                            value="{{ $authUser->email }}" placeholder="john.doe@example.com" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="nomor_hp" class="form-label">Phone Number</label>
                                        <input type="text" id="nomor_hp" name="nomor_hp" class="form-control"
                                            placeholder="202 555 0111" value="{{ $authUser->nomor_hp }}" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="alamat" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat"
                                            placeholder="Address" value="{{ $authUser->alamat }}" />
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                    <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                                </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
                {{-- <div class="card">
                    <h5 class="card-header">Delete Account</h5>
                    <div class="card-body">
                        <div class="mb-3 col-12 mb-0">
                            <div class="alert alert-warning">
                                <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                                <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                            </div>
                        </div>
                        <form id="formAccountDeactivation" method="POST" action="{{ route('profile.destroy') }}">
                            @csrf
                            @method('DELETE')
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" />
                                <label class="form-check-label" for="accountActivation">I confirm my account deactivation</label>
                            </div>
                            <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
                        </form>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    </div>
    @include('other.alert.success')
    @include('other.alert.error')
@endsection
