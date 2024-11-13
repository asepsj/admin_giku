@extends('other.layouts.app')
@section('navbar-title', 'Jadwal Antrian')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools table-responsive">
                        <div class="d-flex align-items-center">
                            <form action="{{ route('jadwal') }}" method="GET" class="d-flex flex-wrap w-100">
                                @if ($authUser['role'] === 'admin')
                                    <input type="hidden" name="doctor_id" value="{{ request('doctor_id') }}">
                                @endif
                                <div class="btn-group mx-auto" role="group" aria-label="Date range">
                                    @for ($i = 0; $i < 7; $i++)
                                        @php
                                            \Carbon\Carbon::setLocale('id');
                                            $date = \Carbon\Carbon::now()->addDays($i);
                                        @endphp
                                        <button type="submit" name="date" value="{{ $date->toDateString() }}"
                                            class="btn btn-primary date-box mr-4 {{ $date->toDateString() == request('date', \Carbon\Carbon::now()->toDateString()) ? 'active' : '' }}"
                                            style="height: 60px; width: 135px;">
                                            <div>
                                                {{ $date->translatedFormat('l') }},
                                                {{ $date->format('d') }}
                                                {{ $date->translatedFormat('F') }}
                                            </div>
                                        </button>
                                    @endfor
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                @if ($antrians == null)
                    <div class="alert alert-danger text-center mt-3 ms-5 me-5 " role="alert">
                        Tidak ada antrian pada tanggal ini.
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
                                            @if ($item['status'] == 'berlangsung')
                                                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#catatanModal{{ $key }}">
                                                    <i class='bx bx-check-circle'></i> Selesai
                                                </button>
                                            @else
                                                <form action="{{ url('jadwal/update', $key) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="berlangsung">
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        <i class='bx bx-check-circle'></i> Diterima
                                                    </button>
                                                </form>
                                            @endif
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                                data-bs-target="#detailModal{{ $key }}">
                                                <i class='bx bx-show'></i> Detail
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    @include('pages.antrian.jadwal.show')
                                    @include('pages.antrian.jadwal.catatan')
                                    <!-- //Modal -->
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
<style>
    .modal-header.bg-primary {
        background-color: #007bff;
        color: white;
    }

    .modal-title.text-center {
        width: 100%;
        text-align: center;
    }
</style>
