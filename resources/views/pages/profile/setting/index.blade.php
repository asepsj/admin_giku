@extends('other.layouts.app')
@section('navbar-title', 'Setting Password')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-12">
                    <!-- Button -->
                    @include('pages.profile.button.index')
                    <!-- /Button -->
                    <div class="card mb-4">
                        <hr class="my-0" />
                        <div class="card-body">
                            <!-- Account -->
                            @if (session('success_password'))
                                <div class="alert alert-success">
                                    {{ session('success_password') }}
                                </div>
                            @endif
                            <form action="{{ route('profile.changePassword') }}" method="POST">
                                @csrf
                                <div class="mb-3 col-md-12">
                                    <label for="inputPassword" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="inputPassword" name="password"
                                        placeholder="New Password" />
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="inputPasswordConfirmation" class="form-label">Confirm
                                        Password</label>
                                    <input type="password" class="form-control" id="inputPasswordConfirmation"
                                        name="password_confirmation" placeholder="Confirm Password" />
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Change Password</button>
                                </div>
                            </form>
                        </div>
                        <!-- /Account -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
