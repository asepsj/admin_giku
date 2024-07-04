<!-- Modal -->
<div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Tambah Dokter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('doctors.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Enter email" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Address</label>
                        <input type="text" class="form-control" id="alamat" name="alamat"
                            placeholder="Enter address" required>
                    </div>
                    <div class="mb-3">
                        <label for="nomor_hp" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="nomor_hp" name="nomor_hp"
                            placeholder="Enter phone number" required>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
