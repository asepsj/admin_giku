<!-- Modal Catatan -->
<div class="modal fade" id="catatanModal{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="catatanModalLabel{{ $key }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white w-100 text-center" id="catatanModalLabel{{ $key }}">Catatan Antrian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('jadwal/update', $key) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="catatan">Masukkan Catatan:</label>
                        <textarea name="catatan" id="catatan" class="form-control" rows="3" required></textarea>
                    </div>
                    <input type="hidden" name="status" value="selesai">
                    <button type="submit" class="btn btn-primary mt-3">Simpan Catatan & Selesaikan Antrian</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- //Modal Catatan -->