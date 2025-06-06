<!-- /*
* Template Name: Property
* Template Author: Untree.co
* Template URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Untree.co" />
    <link rel="shortcut icon" href="{{ asset('frontend/assets/fonts/favicon.png') }}" />

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap5" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('frontend/assets/fonts/icomoon/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/fonts/flaticon/font/flaticon.css') }}" />

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/aos.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <title>
        WaveFest
    </title>
</head>

<body>
    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close">
                <span class="icofont-close js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>

    @include('include.frontend.navbar')

    <div class="hero page-inner overlay"
        style="background-image: url('{{ asset('frontend/assets/images/konser-1.jpg') }}');">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center mt-5">
                    <h1 class="heading" data-aos="fade-up">Detail Tiket</h1>

                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Beranda</a></li>
                            <li class="breadcrumb-item active text-white-50" aria-current="page">
                                Detail Tiket
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row text-left mb-5">
                <div class="col-12">
                    <h2 class="font-weight-bold heading text-primary mb-4">{{ $event->nama_event }}</h2>
                </div>
                <div class="section pt-0">
                    <div class="container">
                        <div class="row justify-content-between mb-5">
                            <div class="col-lg-7 mb-5 mb-lg-0">
                                <div class="img-about position-relative"
                                    style="padding-top: 56.25%; overflow: hidden; border-radius: 10px;">
                                    <img src="{{ asset('/images/event/' . $event->poster) }}"
                                        alt="Poster {{ $event->nama_event }}"
                                        class="img-fluid position-absolute top-0 start-0 w-100 h-100 object-fit-cover" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card shadow-sm rounded-3 p-4">
                                    <h4 class="fw-bold text-primary">Jadwal Tiket</h4>
                                    <hr class="mb-4">

                                    <!-- Tanggal Event -->
                                    <div class="d-flex align-items-center mb-4">
                                        <span
                                            class="wrap-icon me-3 rounded-circle bg-light d-flex justify-content-center align-items-center"
                                            style="width: 45px; height: 45px;">
                                            <span class="icon-calendar text-primary fs-5"></span>
                                        </span>
                                        <div>
                                            <span class="text-muted fw-semibold fs-6">
                                                <b>{{ \Carbon\Carbon::parse($event->tanggal_mulai)->locale('id')->translatedFormat('d F Y') }}</b>
                                            </span>
                                        </div>
                                    </div>


                                    <!-- Lokasi Event -->
                                    <div class="d-flex align-items-center mb-4">
                                        <span
                                            class="wrap-icon me-3 rounded-circle bg-light d-flex justify-content-center align-items-center"
                                            style="width: 45px; height: 45px;">
                                            <i class="fas fa-map-marker-alt text-danger fs-5"></i>
                                        </span>
                                        <div>
                                            <span class="text-muted fw-semibold fs-6">
                                                <b>{{ $event->lokasi->nama_lokasi }}</b>
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Jenis Tiket -->
                                    <div class="d-flex align-items-start">
                                        <span
                                            class="wrap-icon me-3 rounded-circle bg-light d-flex justify-content-center align-items-center"
                                            style="width: 45px; height: 45px;">
                                            <span class="icon-ticket text-success fs-5"></span>
                                        </span>
                                        <div>
                                            <span class="text-muted fw-semibold fs-6 d-block mb-1"><b>Jenis
                                                    Tiket</b></span>
                                            <ul class="ps-3 mb-0">
                                                @foreach ($tikets as $tiket)
                                                    <li class="text-muted fs-6">{{ $tiket->jenis_tiket }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Kolom Deskripsi -->
                    <div class="col-lg-8 pe-4">
                        <div class="border rounded-2 p-4">
                            <h5 class="mb-3">Deskripsi</h5>
                            <hr>
                            <p class="text-black-50 mb-0">
                                {!! $event->deskripsi ?? 'Deskripsi belum tersedia.' !!}
                            </p>
                        </div>
                    </div>

                    <!-- Kolom Tiket -->
                    <div class="col-lg-4 ps-4">
                        <h5 class="mb-3">Informasi Tiket</h5>

                        @foreach ($tikets as $tiket)
                            <div class="mb-3 border rounded p-3">
                                <h5 class="mb-2"><b>{{ $tiket->jenis_tiket }}</b></h5>
                                <hr>
                                <p class="mb-1">Harga: Rp{{ number_format($tiket->harga_tiket) }}</p>
                                <p class="mb-2">Stok tersedia: {{ $tiket->kuota_tiket }}</p>

                                <div class="d-flex align-items-center justify-content-between">
                                    <!-- Input jumlah tiket -->
                                    <div class="me-3" style="flex: 1;">
                                        <label for="jumlah_tiket_{{ $tiket->id }}"
                                            class="form-label mb-1 small">Jumlah</label>
                                        <input type="number" name="jumlah_tiket[{{ $tiket->id }}]"
                                            id="jumlah_tiket_{{ $tiket->id }}" class="form-control"
                                            min="1" max="{{ min(5, $tiket->kuota_tiket) }}" value="1">
                                    </div>

                                    <!-- Tombol beli yang mengarah ke halaman transaksi -->
                                    <div>
                                        <button type="button" onclick="goToTransaksi({{ $tiket->id }})"
                                            class="btn btn-primary mt-4" style="border-radius: 5px;">
                                            Beli
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- <div class="section pt-0">
        <div class="container">
            <div class="row justify-content-between mb-5">
                <div class="col-lg-7 mb-5 mb-lg-0 order-lg-2">
                    <div class="img-about dots">
                        <img src="{{ asset('frontend/assets/images/hero_bg_3.jpg') }}" alt="Image"
                            class="img-fluid" />
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="d-flex feature-h">
                        <span class="wrap-icon me-3">
                            <span class="icon-home2"></span>
                        </span>
                        <div class="feature-text">
                            <h3 class="heading">Quality properties</h3>
                            <p class="text-black-50">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Nostrum iste.
                            </p>
                        </div>
                    </div>

                    <div class="d-flex feature-h">
                        <span class="wrap-icon me-3">
                            <span class="icon-person"></span>
                        </span>
                        <div class="feature-text">
                            <h3 class="heading">Top rated agents</h3>
                            <p class="text-black-50">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Nostrum iste.
                            </p>
                        </div>
                    </div>

                    <div class="d-flex feature-h">
                        <span class="wrap-icon me-3">
                            <span class="icon-security"></span>
                        </span>
                        <div class="feature-text">
                            <h3 class="heading">Easy and safe</h3>
                            <p class="text-black-50">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Nostrum iste.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="0">
                    <img src="{{ asset('frontend/assets/images/img_1.jpg') }}" alt="Image" class="img-fluid" />
                </div>
                <div class="col-md-4 mt-lg-5" data-aos="fade-up" data-aos-delay="100">
                    <img src="{{ asset('frontend/assets/images/img_3.jpg') }}" alt="Image" class="img-fluid" />
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <img src="{{ asset('frontend/assets/images/img_2.jpg') }}" alt="Image" class="img-fluid" />
                </div>
            </div>
            <div class="row section-counter mt-5">
                <div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="counter-wrap mb-5 mb-lg-0">
                        <span class="number"><span class="countup text-primary">2917</span></span>
                        <span class="caption text-black-50"># of Buy Properties</span>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="counter-wrap mb-5 mb-lg-0">
                        <span class="number"><span class="countup text-primary">3918</span></span>
                        <span class="caption text-black-50"># of Sell Properties</span>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">
                    <div class="counter-wrap mb-5 mb-lg-0">
                        <span class="number"><span class="countup text-primary">38928</span></span>
                        <span class="caption text-black-50"># of All Properties</span>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="600">
                    <div class="counter-wrap mb-5 mb-lg-0">
                        <span class="number"><span class="countup text-primary">1291</span></span>
                        <span class="caption text-black-50"># of Agents</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section sec-testimonials bg-light">
        <div class="container">
            <div class="row mb-5 align-items-center">
                <div class="col-md-6">
                    <h2 class="font-weight-bold heading text-primary mb-4 mb-md-0">
                        The Team
                    </h2>
                </div>
                <div class="col-md-6 text-md-end">
                    <div id="testimonial-nav">
                        <span class="prev" data-controls="prev">Prev</span>

                        <span class="next" data-controls="next">Next</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4"></div>
            </div>
            <div class="testimonial-slider-wrap">
                <div class="testimonial-slider">
                    <div class="item">
                        <div class="testimonial">
                            <img src="{{ asset('frontend/assets/images/person_1-min.') }}jpg" alt="Image"
                                class="img-fluid rounded-circle w-25 mb-4" />
                            <h3 class="h5 text-primary">James Smith</h3>
                            <p class="text-black-50">Designer, Co-founder</p>

                            <p>
                                Far far away, behind the word mountains, far from the
                                countries Vokalia and Consonantia, there live the blind texts.
                                Separated they live in Bookmarksgrove right at the coast of
                                the Semantics, a large language ocean.
                            </p>

                            <ul class="social list-unstyled list-inline dark-hover">
                                <li class="list-inline-item">
                                    <a href="#"><span class="icon-twitter"></span></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><span class="icon-facebook"></span></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><span class="icon-linkedin"></span></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><span class="icon-instagram"></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="item">
                        <div class="testimonial">
                            <img src="{{ asset('frontend/assets/images/person_2-min.') }}jpg" alt="Image"
                                class="img-fluid rounded-circle w-25 mb-4" />
                            <h3 class="h5 text-primary">Carol Houston</h3>
                            <p class="text-black-50">Designer, Co-founder</p>

                            <p>
                                Far far away, behind the word mountains, far from the
                                countries Vokalia and Consonantia, there live the blind texts.
                                Separated they live in Bookmarksgrove right at the coast of
                                the Semantics, a large language ocean.
                            </p>

                            <ul class="social list-unstyled list-inline dark-hover">
                                <li class="list-inline-item">
                                    <a href="#"><span class="icon-twitter"></span></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><span class="icon-facebook"></span></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><span class="icon-linkedin"></span></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><span class="icon-instagram"></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="item">
                        <div class="testimonial">
                            <img src="{{ asset('frontend/assets/images/person_3-min.') }}jpg" alt="Image"
                                class="img-fluid rounded-circle w-25 mb-4" />
                            <h3 class="h5 text-primary">Synthia Cameron</h3>
                            <p class="text-black-50">Designer, Co-founder</p>

                            <p>
                                Far far away, behind the word mountains, far from the
                                countries Vokalia and Consonantia, there live the blind texts.
                                Separated they live in Bookmarksgrove right at the coast of
                                the Semantics, a large language ocean.
                            </p>

                            <ul class="social list-unstyled list-inline dark-hover">
                                <li class="list-inline-item">
                                    <a href="#"><span class="icon-twitter"></span></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><span class="icon-facebook"></span></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><span class="icon-linkedin"></span></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><span class="icon-instagram"></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="item">
                        <div class="testimonial">
                            <img src="{{ asset('frontend/assets/images/person_4.jpg"') }} alt="Image"
                                class="img-fluid rounded-circle w-25 mb-4" />
                            <h3 class="h5 text-primary">Davin Smith</h3>
                            <p class="text-black-50">Designer, Co-founder</p>

                            <p>
                                Far far away, behind the word mountains, far from the
                                countries Vokalia and Consonantia, there live the blind texts.
                                Separated they live in Bookmarksgrove right at the coast of
                                the Semantics, a large language ocean.
                            </p>

                            <ul class="social list-unstyled list-inline dark-hover">
                                <li class="list-inline-item">
                                    <a href="#"><span class="icon-twitter"></span></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><span class="icon-facebook"></span></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><span class="icon-linkedin"></span></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><span class="icon-instagram"></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    @include('include.frontend.footer')
    <!-- /.site-footer -->

    <!-- Preloader -->
    <div id="overlayer"></div>
    <div class="loader">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/aos.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/navbar.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/counter.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/custom.js') }}"></script>
    <script>
        function goToTransaksi(tiketId) {
            const jumlahInput = document.getElementById(`jumlah_tiket_${tiketId}`);
            const jumlah = jumlahInput.value;

            const userId = @json(auth()->check() ? auth()->id() : null);

            if (!userId) {
                // Jika belum login, arahkan ke halaman login
                window.location.href = '/login';
                return;
            }

            // Jika login, redirect ke halaman transaksi
            window.location.href = `/transaksi/${tiketId}/${jumlah}`;
        }
    </script>
</body>

</html>
