<!-- Modal -->
<div class="modal fade" id="detailModal{{ $key }}" tabindex="-1"
    aria-labelledby="detailModalLabel{{ $key }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white justify-content-center">
                <h5 class="modal-title text-center text-white">DETAIL ANTRIAN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <h1>00{{ $item['nomor_antrian'] ?? '' }}</h1>
                    <p>{{ \Carbon\Carbon::parse($item['date'])->format('j M Y') }}
                    </p>
                </div>
                <div class="mb-3">
                    <label for="pasien" class="form-label">Pelanggan/Pasien</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="pasien"
                            value="{{ $item['pasien_name'] ?? '' }}" disabled>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="dokter" class="form-label">Dokter</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="dokter"
                            value="{{ $item['doctor_name'] ?? '' }}" disabled>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Dibuat</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="date"
                            value="{{ \Carbon\Carbon::parse($item['date'])->format('j M Y') }}" disabled>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status Antrian</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="status"
                            value="{{ $item['status'] ?? '' }}" disabled>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
