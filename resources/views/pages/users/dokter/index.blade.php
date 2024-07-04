@extends('other.layouts.app')
@section('navbar-title', 'Tabel Dokter')
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="flex-grow-1 me-3">
                        <form action="{{ route('doctors') }}" method="GET">
                            <div class="input-group input-group-merge w-100">
                                <input type="text" class="form-control" name="table_search"
                                    value="{{ request('table_search') }}" placeholder="Search..." aria-label="Search..."
                                    aria-describedby="basic-addon-search31" />
                                <button type="submit" class="input-group-text" id="basic-addon-search31"><i
                                        class="bx bx-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
                        Tambah Dokter
                    </button>
                </div>
                @include('pages.users.dokter.add')
            </div>
            <div class="card">
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Nomor Handphone</th>
                                <th>Alamat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($doctors as $doctor)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="user-panel">
                                            <div class="image" style="width: 50px; height: 50px; overflow: hidden;">
                                                @if ($doctor->foto)
                                                    <img src="{{ asset('storage/fotos/' . $doctor->foto) }}"
                                                        alt="{{ $doctor->name }}" style="width: 100%;">
                                                @else
                                                    <img src="{{ asset('storage/logo/user.png') }}" class="img-circle"
                                                        alt="Default Foto" style="width: 100%;">
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $doctor->name }}</td>
                                    <td>{{ $doctor->email }}</td>
                                    <td>{{ $doctor->nomor_hp }}</td>
                                    <td>
                                        <div style="width: 100px; overflow: hidden; text-overflow: ellipsis;">
                                            {{ $doctor->alamat }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-6">
                                            <div class="demo-inline-spacing d-flex align-items-center">
                                                <a href="{{ route('doctors.edit', $doctor->id) }}"
                                                    class="btn rounded-pill btn-icon btn-primary">
                                                    <i class="tf-icons bx bx-edit-alt"></i>
                                                </a>
                                                <a href="{{ route('klinik', $doctor->id) }}"
                                                    class="btn rounded-pill btn-icon btn-info">
                                                    <i class="bx bx-clinic"></i>
                                                </a>
                                                <div class="dropdown">
                                                    <button type="button"
                                                        class="btn p-0 rounded-pill btn-icon btn-secondary dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('jadwal', ['doctor_id' => $doctor->id]) }}"><i
                                                                class="bx bx-receipt me-1"></i> Antrian</a>
                                                        <form action="{{ route('doctors.destroy', $doctor->id) }}"
                                                            method="POST" style="display:inline;"
                                                            onsubmit="return confirm('Are you sure you want to delete this pasien?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="dropdown-item" type="submit"><i
                                                                    class="bx bx-trash me-1"></i> Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
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
                            {!! $doctors->links('pagination::bootstrap-4') !!}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('other.alert.success')
    @include('other.alert.error')
@endsection
