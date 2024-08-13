@extends('other.layouts.app')
@section('navbar-title', 'Tabel Pasien')
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="flex-grow-1 me-3">
                        <form action="{{ route('pasiens') }}" method="GET">
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
                        Tambah Pasien
                    </button>
                </div>
                @include('pages.users.pasien.add')
            </div>
            <div class="card">
                @if ($users == null)
                    <div class="alert alert-danger text-center mt-3 ms-5 me-5 " role="alert">
                        Tidak ada pasien yang terdaftar
                    </div>
                @else
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
                                @foreach ($users as $key => $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($item['profileImageUrl'])
                                                <img src="{{ $item['profileImageUrl'] }}" alt="Profile Image"
                                                    style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                                            @else
                                                <img src="path/to/default/image.jpg" alt="Default Image"
                                                    style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                                            @endif
                                        </td>
                                        <td>{{ $item['displayName'] ?? '' }}</td>
                                        <td>{{ $item['email'] ?? '' }}</td>
                                        <td>{{ $item['phoneNumber'] ?? '' }}</td>
                                        <td>
                                            <div style="width: 100px; overflow: hidden; text-overflow: ellipsis;">
                                                {{ $item['alamat'] ?? '' }}</div>
                                        </td>
                                        <td>
                                            <div class="col-md-6">
                                                <div class="align-items-center">
                                                    <a href="{{ route('pasiens.edit', $key) }}"
                                                        class="btn rounded-pill btn-icon btn-primary">
                                                        <i class="tf-icons bx bx-edit-alt"></i>
                                                    </a>
                                                    <button type="button" class="btn rounded-pill btn-icon btn-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#confirmDeleteModal{{ $key }}">
                                                        <i class="tf-icons bx bx-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal Konfirmasi Hapus -->
                                    <div class="modal fade" id="confirmDeleteModal{{ $key }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form id="deleteForm{{ $key }}" method="POST"
                                                    action="{{ route('pasiens.destroy', $key) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus dokter ini?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tidak</button>
                                                        <button type="submit" class="btn btn-danger">Iya</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
