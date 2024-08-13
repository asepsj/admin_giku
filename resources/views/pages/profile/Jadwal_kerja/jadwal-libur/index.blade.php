@extends('other.layouts.app')
@section('navbar-title', 'Jadwal Kerja Dokter - Tanggal Libur')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <!-- Holiday Schedule Section -->
                <div class="col-lg-12 col-md-12 mb-4">
                    @include('pages.profile.jadwal_kerja.nav')
                    <div class="card">
                        <div class="card-header d-flex justify-content-end align-items-center">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahlibur">
                                Tambah Tanggal Libur
                            </button>
                        </div>
                        @include('pages.profile.jadwal_kerja.jadwal-libur.add')
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jadwal Libur</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($holidays))
                                        @foreach ($holidays as $key => $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item['tanggal_libur'])->format('j M Y') }}
                                                </td>
                                                <td>
                                                    <button type="button" class="btn rounded-pill btn-icon btn-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editlibur-{{ $key }}"><i
                                                            class="tf-icons bx bx-edit-alt"></i></button>
                                                    <form action="{{ route('holidays.destroy', $key) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn rounded-pill btn-icon btn-danger"><i
                                                                class="tf-icons bx bx-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @include('pages.profile.jadwal_kerja.jadwal-libur.edit')
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada jadwal tanggal libur</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
