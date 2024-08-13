@extends('other.layouts.app')
@section('navbar-title', 'Jadwal Kerja Dokter - Jam Kerja')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">

                <!-- Work Schedule Section -->
                <div class="col-lg-12 col-md-12 mb-4">
                    @include('pages.profile.jadwal_kerja.nav')
                    <div class="card">
                        <div class="card-header d-flex justify-content-end align-items-center">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahjam">
                                Tambah jam kerja
                            </button>
                        </div>
                        @include('pages.profile.jadwal_kerja.jam-kerja.add')
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Hari</th>
                                        <th>Jam Mulai</th>
                                        <th>Jam Selesai</th>
                                        <th>Hari libur</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($schedules))
                                        @foreach ($schedules as $key => $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item['day'] }}</td>
                                                <td>{{ $item['waktu_mulai'] ?? '-' }}</td>
                                                <td>{{ $item['waktu_selesai'] ?? '-' }}</td>
                                                <td>{{ $item['is_holiday'] ? 'Iya' : 'Tidak' }}</td>
                                                <td>
                                                    <!-- Edit Button -->
                                                    <button type="button" class="btn rounded-pill btn-icon btn-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editJadwal-{{ $key }}"><i
                                                            class="tf-icons bx bx-edit-alt"></i></button>
                                                    <form action="{{ route('jadwal-kerja.delete', $key) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn rounded-pill btn-icon btn-danger"><i
                                                                class="tf-icons bx bx-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @include('pages.profile.jadwal_kerja.jam-kerja.edit')
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada jadwal jam kerja</td>
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

    <script>
        // Set min date for holiday date input to today
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('tanggal_libur').setAttribute('min', today);
        });
    </script>
@endsection
