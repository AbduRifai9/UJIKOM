@extends('layouts.frontend')

@section('content')
    <section class="about-section py-5" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="row mb-5">
                <div class="col text-center">
                    <h2 class="fw-bold text-primary">Tentang Kami</h2>
                    <p class="text-muted">Misi kami adalah menyederhanakan cara Anda mendapatkan tiket acara terbaik.</p>
                </div>
            </div>

            <div class="row align-items-center mb-5">
                <div class="col-md-6">
                    <img src="{{ asset('frontend/assets/images/konser-1.jpg') }}" alt="Tentang Kami" class="img-fluid rounded shadow">
                </div>
                <div class="col-md-6">
                    <h3 class="fw-semibold mb-3">Siapa Kami?</h3>
                    <p>Kami adalah platform pemesanan tiket yang memberikan kemudahan dalam mencari dan membeli tiket berbagai acara. Dari konser, seminar, hingga acara olahraga, kami hadir untuk membantu Anda mendapatkan pengalaman terbaik.</p>
                    <p>Dengan sistem pembayaran aman dan proses pemesanan yang mudah, kami berkomitmen untuk menjadi mitra terbaik dalam setiap acara Anda.</p>
                </div>
            </div>

            <div class="row text-center">
                <div class="col-md-4 mb-4">
                    <div class="bg-white p-4 rounded shadow-sm">
                        <h4 class="text-primary fw-bold">1000+</h4>
                        <p class="text-muted">Tiket Terjual</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="bg-white p-4 rounded shadow-sm">
                        <h4 class="text-primary fw-bold">500+</h4>
                        <p class="text-muted">Acara Terdaftar</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="bg-white p-4 rounded shadow-sm">
                        <h4 class="text-primary fw-bold">4.9/5</h4>
                        <p class="text-muted">Rating Pengguna</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
