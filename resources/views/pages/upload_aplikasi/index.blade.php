@extends('other.layouts.app')
@section('navbar-title', 'Upload Aplikasi')
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card mb-3">
                <div class="card-header">
                    <h2>Upload APK File</h2>

                    <!-- Form Upload -->
                    <form id="uploadForm" action="{{ route('aplikasi.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="file" class="form-label">Select APK File</label>
                            <input type="file" class="form-control" id="file" name="file" accept=".apk"
                                required>
                        </div>
                        <!-- Progress Bar -->
                        <div class="progress mt-3" style="height: 25px; display: none;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%
                            </div>
                        </div>
                        <button type="submit" id="uploadButton" class="btn btn-primary">Upload</button>
                    </form>

                    <!-- Display Existing File -->
                    @if (isset($files) && count($files) > 0)
                        <h3 class="mt-3">Existing File</h3>
                        @foreach ($files as $fileId => $file)
                            <div class="card mt-2">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $file['file_name'] }}</h5>
                                    <p class="card-text">Uploaded at: {{ $file['uploaded_at'] }}</p>
                                    <a href="{{ $file['file_path'] }}" class="btn btn-info" target="_blank">Download</a>
                                    <!-- Form to delete file -->
                                    <form action="{{ route('aplikasi.delete') }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="file_id" value="{{ $fileId }}">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to Handle Progress Bar and SweetAlert2 -->
    <script>
        document.getElementById('uploadForm').addEventListener('submit', function(event) {
            event.preventDefault();

            // Hide the upload button after submission
            document.getElementById('uploadButton').style.display = 'none';

            let formData = new FormData(this);
            let xhr = new XMLHttpRequest();
            let progressBar = document.querySelector('.progress-bar');
            let progressContainer = document.querySelector('.progress');

            xhr.open('POST', this.action, true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

            // Show progress bar
            progressContainer.style.display = 'block';

            // Update progress bar
            xhr.upload.addEventListener('progress', function(event) {
                if (event.lengthComputable) {
                    let percentComplete = Math.round((event.loaded / event.total) * 100);
                    progressBar.style.width = percentComplete + '%';
                    progressBar.innerText = percentComplete + '%';
                }
            });

            // Handle response with SweetAlert2
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'File uploaded successfully',
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'File upload failed',
                        });
                    }
                }
            };

            xhr.send(formData);
        });
    </script>
@endsection
