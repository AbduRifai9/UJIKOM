@extends('layouts.frontend')

@section('content')
    <section class="tiket-list py-5" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="fw-bold text-primary">Daftar Tiket</h2>
                    <p class="text-muted">Temukan tiket acara yang sesuai dengan keinginan Anda!</p>
                </div>
            </div>

            <div class="row">
                <!-- Filter Section -->
                <div class="col-12 col-md-3 mb-4">
                    <div class="filter-panel bg-white p-4 rounded shadow-sm">
                        <h5 class="mb-3">Filter Tiket</h5>
                        <form id="filter-form">
                            <div class="mb-3">
                                <label for="category" class="form-label">Kategori</label>
                                <select id="category" name="category" class="form-select">
                                    <option value="">Semua Kategori</option>
                                    <option value="music">Musik</option>
                                    <option value="sports">Olahraga</option>
                                    <option value="conference">Konferensi</option>
                                    <!-- Tambahkan kategori lainnya -->
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="location" class="form-label">Lokasi</label>
                                <select id="location" name="location" class="form-select">
                                    <option value="">Semua Lokasi</option>
                                    @foreach ($lokasi as $lok)
                                        <option value="{{ $lok->id }}">{{ $lok->nama_lokasi }}</option>
                                    @endforeach
                                </select>
                            </div>



                            <div class="mb-3">
                                <label for="price_range" class="form-label">Rentang Harga</label>
                                <input type="text" id="price_range" name="price_range" class="form-control"
                                    placeholder="Masukkan harga (misalnya: 1000000 - 5000000)">
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Terapkan Filter</button>
                        </form>
                    </div>
                </div>

                <!-- Tiket Section -->
                <div class="col-12 col-md-9">
                    <div id="tiket-list" class="row">
                        <!-- Data Tiket Akan Ditampilkan di Sini -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Fungsi untuk melakukan pencarian dan filter tiket dengan AJAX
        document.getElementById('filter-form').addEventListener('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            // Mengambil data filter dan kirim ke server
            fetch("{{ route('tiket.filter') }}", {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    let tiketsContainer = document.getElementById('tiket-list');
                    tiketsContainer.innerHTML = ''; // Kosongkan kontainer tiket

                    // Menampilkan data tiket yang diterima dari server
                    data.tikets.forEach(tiket => {
                        let tiketItem = `
                    <div class="col-12 col-md-4 mb-4">
                        <div class="tiket-card rounded shadow-sm bg-white p-4">
                            <img src="{{ asset('/images/event') }}/${tiket.event.poster}" class="img-fluid mb-3" alt="${tiket.event.nama_event}" style="height: 200px; object-fit: cover;">
                            <h5 class="mb-2">${tiket.event.nama_event}</h5>
                            <p class="text-muted">${tiket.event.lokasi.nama_lokasi}</p>
                            <p><strong>Harga: Rp ${new Intl.NumberFormat('id-ID').format(tiket.harga_tiket)}</strong></p>
                            <a href="{{ route('event.detail', ['slug' => '${tiket.event.slug}']) }}" class="btn btn-primary w-100">Beli Tiket</a>
                        </div>
                    </div>
                `;
                        tiketsContainer.innerHTML += tiketItem;
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>
@endsection
