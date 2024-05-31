<div class="active tab-pane" id="settings">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputName" name="name" value="{{ old('name', $authUser->name) }}" placeholder="Name">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="inputEmail" name="email" value="{{ old('email', $authUser->email) }}" placeholder="Email">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
                <small class="form-text text-muted">Leave blank if you don't want to change the password</small>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPasswordConfirmation" class="col-sm-2 col-form-label">Confirm Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPasswordConfirmation" name="password_confirmation" placeholder="Confirm Password">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputFoto" class="col-sm-2 col-form-label">Photo</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="inputFoto" name="foto">
                @if($authUser->foto)
                    <img src="{{ asset('storage/fotos/' . $authUser->foto) }}" alt="User Photo" style="max-width: 150px; margin-top: 10px;">
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="inputAlamat" class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputAlamat" name="alamat" value="{{ old('alamat', $authUser->alamat) }}" placeholder="Address">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputNomorHp" class="col-sm-2 col-form-label">Phone Number</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputNomorHp" name="nomor_hp" value="{{ old('nomor_hp', $authUser->nomor_hp) }}" placeholder="Phone Number">
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-sm-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </form>
</div>
