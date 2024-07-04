<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card-header text-muted border-bottom-0">
                <h1 class="text-center">Informasi Klinik</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-7">
                        <h2 class="lead"><b>{{ $klinik->nama_klinik }}</b></h2>
                        <p class="text-muted text-sm"><b>About: </b> {{ $klinik->deskripsi_klinik }}</p>
                        <ul class="list-unstyled text-muted">
                            <li>Address: {{ $klinik->alamat_klinik }}
                            </li>
                            <li>Phone : {{ $authUser->nomor_hp }}
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-5">
                        <div id="carouselExample-cf" class="carousel carousel-dark slide carousel-fade"
                            data-bs-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach ($klinik->photos as $key => $photo)
                                    <li data-bs-target="#carouselExample-cf" data-bs-slide-to="{{ $key }}"
                                        class="{{ $loop->first ? 'active' : '' }}"></li>
                                @endforeach
                            </ol>
                            <div class="carousel-inner">
                                @foreach ($klinik->photos as $key => $photo)
                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                        <img class="d-block w-100"
                                            src="{{ asset('storage/fotos/' . $photo->photo_path) }}"
                                            alt="Foto Klinik" />
                                        <!-- Jika Anda ingin menambahkan teks caption -->
                                        <!-- <div class="carousel-caption d-none d-md-block">
                                                <h5>{{ $photo->caption }}</h5>
                                            </div> -->
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExample-cf" role="button"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExample-cf" role="button"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
