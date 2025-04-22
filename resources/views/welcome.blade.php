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
    @php
        $tiket = \App\Models\Tiket::all();
        // $beritaF = \App\Models\BeritaF::where('flag', '1')->orderBy('id', 'asc')->paginate(6);
        $tiket = $tiket->unique(fn($item) => $item->event->nama_event);
    @endphp
    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close">
                <span class="icofont-close js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>

    @include('include.frontend.navbar')

    <div class="hero">
        <div class="hero-slide">
            <div class="img overlay"
                style="background-image: url('{{ asset('frontend/assets/images/perunggu.jpg') }}')">
            </div>
            <div class="img overlay" style="background-image: url('{{ asset('frontend/assets/images/jenny.jpg') }}')">
            </div>
            <div class="img overlay"
                style="background-image: url('{{ asset('frontend/assets/images/konser-1.jpg') }}')">
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center">
                    <h1 class="heading" data-aos="fade-up">
                        Temukan selera musikmu di WaveFest
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row mb-5 align-items-center">
                <div class="col-lg-6">
                    <h2 class="font-weight-bold text-primary heading">
                        <b>Event Hari Ini</b>
                    </h2>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <p>
                        {{-- <a href="#" target="_blank" class="btn btn-primary text-white py-3 px-4">Lihat Semua
                            Event</a> --}}
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="property-slider-wrap">
                        <div class="property-slider">
                            @foreach ($tiket->sortByDesc('created_at')->take(10) as $item)
                                <div class="property-item">
                                    <div class="property-content">
                                        <img src="{{ asset('/images/event/' . $item->event->poster) }}" alt="Image"
                                            class="img-fluid custom-img mb-2" style="margin-top: 30%" />

                                        <h5 class="mb-1">{{ $item->event->nama_event }}</h5>

                                        <div class="d-flex align-items-center text-black-50 mb-1">
                                            <i class="icon-calendar me-2"></i>
                                            <span>{{ \Carbon\Carbon::parse($item->event->tanggal_mulai)->locale('id')->translatedFormat('d F Y') }}</span>
                                        </div>

                                        <div class="specs d-flex flex-wrap mb-2 mt-2">
                                            <div class="d-flex align-items-center me-3">
                                                <i class="fas fa-map-marker-alt me-2"></i>
                                                <span class="caption">{{ $item->event->lokasi->nama_lokasi }}</span>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <i class="icon-ticket me-2"></i>
                                                <span class="caption">{{ $item->jenis_tiket }}</span>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="price">
                                                <span>Rp {{ number_format($item->harga_tiket, 0, ',', '.') }}</span>
                                            </div>
                                            <a href="{{ route('event.detail', $item->event->slug) }}"
                                                class="btn btn-primary py-2 px-3 rounded-2">
                                                Beli Tiket
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div id="property-nav" class="controls" tabindex="0" aria-label="Carousel Navigation">
                            <span class="prev" data-controls="prev" aria-controls="property"
                                tabindex="-1">Sebelumnya</span>
                            <span class="next" data-controls="next" aria-controls="property"
                                tabindex="-1">Selanjutnya</span>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <section class="features-1 py-5" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-4">
                    <h2 class="fw-bold text-primary">Statistik Event</h2>
                    <p class="text-muted">Lihat sekilas informasi menarik dari semua event yang tersedia.</p>
                </div>

                <div class="col-6 col-md-3 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="box-feature rounded shadow-lg p-4 text-center bg-white border-0 hover-zoom">
                        <span class="fas fa-ticket-alt display-4 mb-3 text-primary"></span>
                        <h4 class="mb-2 text-dark">Tiket Terjual</h4>
                        <p class="text-muted mb-3">1.240 tiket telah dibeli</p>
                    </div>
                </div>

                <div class="col-6 col-md-3 mb-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="box-feature rounded shadow-lg p-4 text-center bg-white border-0 hover-zoom">
                        <span class="fas fa-calendar-alt display-4 mb-3 text-primary"></span>
                        <h4 class="mb-2 text-dark">Total Event</h4>
                        <p class="text-muted mb-3">87 event aktif</p>
                    </div>
                </div>

                <div class="col-6 col-md-3 mb-4" data-aos="fade-up" data-aos-delay="500">
                    <div class="box-feature rounded shadow-lg p-4 text-center bg-white border-0 hover-zoom">
                        <span class="fas fa-star display-4 mb-3 text-primary"></span>
                        <h4 class="mb-2 text-dark">Rating</h4>
                        <p class="text-muted mb-3">4.6 / 5 rating pengguna</p>
                    </div>
                </div>

                <div class="col-6 col-md-3 mb-4" data-aos="fade-up" data-aos-delay="600">
                    <div class="box-feature rounded shadow-lg p-4 text-center bg-white border-0 hover-zoom">
                        <span class="fas fa-map-marker-alt display-4 mb-3 text-primary"></span>
                        <h4 class="mb-2 text-dark">Lokasi Event</h4>
                        <p class="text-muted mb-3">35 lokasi terdaftar</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


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
</body>

</html>
