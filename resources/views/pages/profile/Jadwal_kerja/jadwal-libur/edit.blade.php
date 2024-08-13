<!-- Edit Holiday Modal -->
<div class="modal fade" id="editlibur-{{ $key }}" tabindex="-1" aria-labelledby="editHolidayLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('holidays.update', $key) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editHolidayLabel">Edit Tanggal Libur
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_tanggal_libur" class="form-label">Tanggal Libur</label>
                        <input type="date" class="form-control" id="edit_tanggal_libur" name="tanggal_libur"
                            value="{{ $item['tanggal_libur'] }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
