@extends('other.layouts.app')
@section('navbar-title', 'Jadwal Antrian')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools table-responsive">
                        <div class="d-flex justify-content-center align-items-center">
                            <form action="{{ route('jadwal') }}" method="GET" class="d-flex">
                                @if ($authUser['role'] === 'admin')
                                    <input type="hidden" name="doctor_key" value="{{ request('doctor_key') }}">
                                @endif
                                <div class="btn-group" role="group" aria-label="Date range">
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

                @if ($antrians == null)
                    <div class="alert alert-warning text-center mt-3 ms-5 me-5 " role="alert">
                        Tidak ada antrian pada tanggal ini.
                    </div>
                @else
                    <div class="card-body table-responsive p-0" style="height: 300px;">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                                <tr>
                                    <th>Nomor</th>
                                    <th>Nama Pasien</th>
                                    <th>Nama Dokter</th>
                                    <th>Status</th>
                                    <th>Tanggal Antrian</th>
                                    <th>Dibuat</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($antrians as $key => $item)
                                    <tr>
                                        <td>{{ $item['nomor_antrian'] ?? '' }}</td>
                                        <td>{{ $item['pasien_name'] ?? '' }}</td>
                                        <td>{{ $item['doctor_name'] ?? '' }}</td>
                                        <td>{{ $item['status'] ?? '' }}</td>
                                        <td>{{ $item['date'] ?? '' }}</td>
                                        <td>{{ $item['created_at'] ?? '' }}</td>
                                        <td>
                                            <form action="{{ url('jadwal.update') }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status"
                                                    value="{{ $item['user_key'] == 'berlangsung' ? 'selesai' : 'berlangsung' }}">
                                                <button type="submit" class="btn btn-sm btn-success">
                                                    {{ $item['user_key'] == 'berlangsung' ? 'Selesai' : 'Diterima' }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
