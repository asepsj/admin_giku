@extends('other.layouts.app')
@section('navbar-title', 'Riwayat Antrian')
@section('content')
    <!-- Main content -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <form action="#" method="GET">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right"
                                    placeholder="Search" value="{{ request('table_search') }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pasien</th>
                                <th>Nama Dokter</th>
                                <th>Nomor Antrian</th>
                                <th>Status</th>
                                <th>Tanggal Antrian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($antrians as $antrian)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $antrian->name_pasien }}</td>
                                    <td>{{ $antrian->name_doctor }}</td>
                                    <td>{{ $antrian->nombor_antrian }}</td>
                                    <td>{{ $antrian->status }}</td>
                                    <td>{{ $antrian->tanggal_antrian }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <ul class="pagination pagination m-0 float-right">
                        {!! $antrians->links('pagination::bootstrap-4') !!}
                    </ul>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.content-wrapper -->
@endsection
