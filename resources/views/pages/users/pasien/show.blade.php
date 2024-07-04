@extends('other.layouts.app')
@section('navbar-title', 'Pasien Detail')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <div class="card-header">
                    Detail Pasien
                </div>
                <div class="card-body">
                    <div class="foto-container">
                        @if ($pasien->foto)
                            <img src="{{ asset('storage/fotos/' . $pasien->foto) }}" alt="Foto Pasien">
                        @else
                            <img src="{{ asset('path/to/default/photo.jpg') }}" alt="Default Foto">
                        @endif
                    </div>
                    <p><strong>Nama:</strong> {{ $pasien->name_pasien }}</p>
                    <p><strong>Email:</strong> {{ $pasien->email_pasien }}</p>
                    <p><strong>Nomor Handphone:</strong> {{ $pasien->nomor_hp }}</p>
                    <p><strong>Alamat:</strong> {{ $pasien->alamat }}</p>
                    <p><strong>Created At:</strong> {{ $pasien->created_at }}</p>
                </div>
            </div>
        </div>
        </section>
    </div>
@endsection
