<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('assets/') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Giku</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo/logo.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!-- Template customizer & Theme config files -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <img src="{{ asset('assets/img/logo/logo.png') }}" alt="Loading...">
    </div>

    <!-- Hero Section -->
    <section class="hero-section bg-white">
        <div class="container">
            <h1>Selamat datang di Giku</h1>
            <p>Melalui aplikasi ini, pasien dapat dengan mudah mendaftardan memilih waktu kunjungan yang sesuai dengan
                jadwal mereka. Semua proses pendaftaran dilakukan secara online, sehingga pasien bisa mendapatkan nomor
                antrian tanpa harus datang langsung ke klinik.</p>
            <a href="{{ route('download.app') }}" class="btn btn-primary">Unduh Aplikasi Android</a>
        </div>
    </section>

    <!-- Features Section -->
    <div class="card bg-white">
        <section id="features" class="card bg-primary text-white ms-3 me-3">
            <div class="card-header">
                <h2 class="text-white text-center">Fitur Kami</h2>
                <div class="row">
                    <div class="col-12 col-md-4 mb-4">
                        <div class="feature-box">
                            <i class="bx bx-calendar-plus feature-icon"></i>
                            <h3>Tambah Antrian</h3>
                            <p class="text-black">Dengan fitur ini, pasien dapat dengan mudah menambahkan antrian untuk
                                kunjungan ke
                                klinik. Cukup pilih tanggal dan waktu yang diinginkan, dan antrian akan langsung
                                ditambahkan ke sistem tanpa perlu menunggu lama.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-4">
                        <div class="feature-box">
                            <i class="bx bx-calendar feature-icon"></i>
                            <h3>Melihat Jadwal dan Antrian</h3>
                            <p class="text-black">Fitur ini memungkinkan pasien untuk melihat jadwal kunjungan mereka
                                dan status antrian
                                secara real-time. Pasien dapat dengan mudah mengecek jadwal yang tersedia dan status
                                antrian mereka di klinik melalui aplikasi.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-4">
                        <div class="feature-box">
                            <i class="bx bx-bell feature-icon"></i>
                            <h3>Notifikasi Realtime</h3>
                            <p class="text-black">Dengan notifikasi realtime, pasien akan mendapatkan pemberitahuan
                                langsung tentang status
                                antrian mereka, perubahan jadwal, atau informasi penting lainnya terkait kunjungan
                                mereka ke klinik. Ini memastikan bahwa pasien selalu mendapatkan informasi terbaru
                                secara cepat.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Giku.</p>
    </footer>

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
            });
        </script>
    @endif

    <!-- Core JS -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>

    <!-- Preloader JS -->
    <script src="{{ asset('assets/js/preloader.js') }}"></script>

    <!-- GitHub Buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>

<!-- Custom Styles -->
<style>
    /* Header Section */
    .navbar {
        padding-top: 10px;
        /* Add spacing above the header content */
        padding-bottom: 10px;
        /* Add spacing below the header content */
    }

    .header-logo {
        margin-top: 5px;
        /* Add spacing above the logo */
        margin-bottom: 5px;
        /* Add spacing below the logo */
    }

    .header-text {
        margin-top: 5px;
        /* Add spacing above the text */
        margin-bottom: 5px;
        /* Add spacing below the text */
    }

    /* Hero Section */
    .hero-section {
        padding: 60px 20px;
        text-align: center;
        background: #f8f9fa;
    }

    .hero-section h1 {
        font-size: 2.5rem;
        margin-bottom: 20px;
    }

    .hero-section p {
        font-size: 1.25rem;
        margin-bottom: 20px;
    }

    .hero-section .btn-primary {
        font-size: 1rem;
    }

    /* Features Section */
    .features-section {
        padding: 60px 20px;
    }

    .feature-box {
        text-align: center;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        height: 100%;
        /* Ensure boxes expand to fill column height */
    }

    .feature-box h3 {
        font-size: 1.25rem;
        color: #007bff;
    }

    .feature-box p {
        font-size: 1rem;
    }

    @media (max-width: 768px) {
        .hero-section h1 {
            font-size: 2rem;
        }

        .hero-section p {
            font-size: 1rem;
        }

        .feature-box h3 {
            font-size: 1.125rem;
        }

        .feature-box p {
            font-size: 0.875rem;
        }
    }

    @media (max-width: 576px) {
        .hero-section h1 {
            font-size: 1.75rem;
        }

        .hero-section p {
            font-size: 0.875rem;
        }

        .feature-box h3 {
            font-size: 1rem;
        }

        .feature-box p {
            font-size: 0.75rem;
        }
    }

    /* Features Section */
    .features-section {
        padding: 60px 20px;
    }

    .features-section h2 {
        font-size: 2rem;
        margin-bottom: 30px;
    }

    .feature-box {
        text-align: center;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        height: 100%;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .feature-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .feature-icon {
        font-size: 3rem;
        color: #007bff;
        margin-bottom: 15px;
    }

    .features-section p {
        font-size: 1rem;
    }

    /* Footer */
    footer {
        padding: 20px;
        text-align: center;
        background-color: #f8f9fa;
    }

    footer p {
        margin: 0;
        font-size: 0.875rem;
    }
</style>
