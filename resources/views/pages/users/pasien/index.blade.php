@extends('other.layouts.app')
@section('navbar-title', 'Tabel Pasien')
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="mb-3 row">
                <div class="col-md-5">
                    <form action="{{ route('pasiens') }}" method="GET">
                        <div class="input-group input-group-merge">
                            <input type="text" class="form-control" name="table_search"
                                value="{{ request('table_search') }}" placeholder="Search..." aria-label="Search..."
                                aria-describedby="basic-addon-search31" />
                            <button type="submit" class="input-group-text" id="basic-addon-search31"><i
                                    class="bx bx-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <p></p>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Nomor Handphone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($pasiens as $pasien)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="user-panel">
                                            {{-- <div class="image" style="width: 50px; height: 50px; overflow: hidden;"> --}}
                                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                                @if ($pasien->foto)
                                                    <img src="{{ asset('storage/fotos/' . $pasien->foto) }}"
                                                        alt="{{ $pasien->name_pasien }}" class="img-circle d-block rounded"
                                                        height="50" width="50">
                                                @else
                                                    <img src="{{ asset('storage/logo/user.png') }}"
                                                        class="img-circle d-block rounded" height="50" width="50">
                                                @endif
                                            </div>
                                        </div>
                </div>
                </td>
                <td>{{ $pasien->name_pasien }}</td>
                <td>{{ $pasien->email_pasien }}</td>
                <td>{{ $pasien->nomor_hp }}</td>
                <td>
                    <div class="col-md-6">
                        <div class="demo-inline-spacing d-flex align-items-center">
                            <a href="{{ route('pasiens.edit', $pasien->id) }}"
                                class="btn rounded-pill btn-icon btn-primary">
                                <i class="tf-icons bx bx-edit-alt"></i>
                            </a>
                            <a href="{{ route('pasiens.show', $pasien->id) }}" class="btn rounded-pill btn-icon btn-info">
                                <i class="bx bx-show-alt"></i>
                            </a>
                            <form action="{{ route('pasiens.destroy', $pasien->id) }}" method="POST"
                                style="display:inline;"
                                onsubmit="return confirm('Are you sure you want to delete this pasien?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn rounded-pill btn-icon btn-danger">
                                    <i class="tf-icons bx bx-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </td>
                </tr>
                @endforeach
                </tbody>
                </table>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-footer clearfix">
                <div class="d-flex justify-content-end">
                    <ul class="pagination m-0">
                        {!! $pasiens->links('pagination::bootstrap-4') !!}
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
