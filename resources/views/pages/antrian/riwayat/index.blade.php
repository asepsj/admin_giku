@extends('other.layouts.app')
@section('navbar-title', 'Riwayat Antrian')
@section('content')
    <!-- Main content -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex flex-grow-1 me-3">
                        <!-- Search Form -->
                        <form action="{{ route('antrian.riwayat') }}" method="GET" class="w-100">
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" name="table_search" value="{{ $search }}"
                                    placeholder="Cari pasien...." aria-label="Cari pasien...."
                                    aria-describedby="basic-addon-search31" />
                                <button type="submit" class="input-group-text" id="basic-addon-search31"><i
                                        class="bx bx-search"></i></button>
                            </div>
                        </form>
                    </div>

                    <div>
                        <!-- Date Filter Form -->
                        <form action="{{ route('antrian.riwayat') }}" method="GET">
                            <div class="input-group input-group-merge">
                                <input type="date" class="form-control" name="date_filter" value="{{ $dateFilter }}"
                                    aria-label="Date Filter" aria-describedby="basic-addon-date31" />
                                <button type="submit" class="input-group-text" id="basic-addon-date31"><i
                                        class="bx bx-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                @if ($antrians == null)
                    <div class="alert alert-danger text-center mt-3 ms-5 me-5 " role="alert">
                        Riwayat antrian tidak ada
                    </div>
                @else
                    <div class="card-body table-responsive p-0">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                                <tr>
                                    <th>Nomor</th>
                                    <th>Nama Pasien</th>
                                    <th>Nama Dokter</th>
                                    <th>Status</th>
                                    <th>Tanggal Antrian</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($antrians as $key => $item)
                                    <tr>
                                        <td>{{ $item['nomor_antrian'] ?? '' }}</td>
                                        <td>{{ $item['name_pasien'] ?? '' }}</td>
                                        <td>{{ $item['doctor_name'] ?? '' }}</td>
                                        <td>{{ $item['status'] ?? '' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item['date'])->format('j M Y') }}</td>
                                        <td>
                                            <button type="button" class="btn rounded-pill btn-icon btn-info"
                                                data-bs-toggle="modal" data-bs-target="#detailModal{{ $key }}">
                                                <i class='tf-icons bx bx-show'></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @include('pages.antrian.jadwal.show')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.content-wrapper -->
@endsection
