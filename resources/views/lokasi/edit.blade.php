@extends('layouts.backend')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Edit Data Lokasi</h5>
                        <a href="{{ route('lokasi.index') }}" class="btn btn-sm btn-primary" style="float: right">Kembali</a>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('lokasi.update', $lokasi->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Nama lokasi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('nama_lokasi') is-invalid @enderror"
                                        value="{{ old('nama_lokasi', $lokasi->nama_lokasi) }}" name="nama_lokasi"
                                        id="nama_lokasi">
                                    @error('nama_lokasi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="kapasitas">Kapasitas</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control @error('kapasitas') is-invalid @enderror"
                                        value="{{ old('kapasitas', $lokasi->kapasitas) }}" name="kapasitas" id="kapasitas">
                                    @error('kapasitas')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Field Lokasi dengan Map -->
                            <div class="row mb-3">
                                <label class="form-label" for="lokasi">Lokasi</label>
                                <div id="map" class="form-control"></div>
                                <input type="hidden" id="lat" name="latitude"
                                    value="{{ old('latitude', $lokasi->latitude) }}">
                                <input type="hidden" id="lng" name="longitude"
                                    value="{{ old('longitude', $lokasi->longitude) }}">
                                <div class="input-group mt-3">
                                    <input type="text" id="search-location" class="form-control"
                                        placeholder="Masukkan nama lokasi">
                                    <button class="btn btn-primary" id="search-button" type="button">
                                        <i class="bx bx-search"></i> Cari
                                    </button>
                                </div>
                            </div>

                            <div class="row float-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Perbarui</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Basic with Icons -->
        </div>
    </div>
@endsection

@push('scriptjs')
    <!-- Leaflet JS & CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <!-- CSS tambahan untuk #map -->
    <style>
        #map {
            height: 400px;
            width: 100%;
        }

        #search-location {
            border-radius: 0.375rem 0 0 0.375rem;
        }

        #search-button {
            border-radius: 0 0.375rem 0.375rem 0;
        }
    </style>

    <!-- Script JS untuk Leaflet -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi peta dengan koordinat yang ada di database (atau nilai default jika tidak ada)
            const lat = {{ old('latitude', $lokasi->latitude ?? '-2.5489') }};
            const lng = {{ old('longitude', $lokasi->longitude ?? '118.0149') }};

            const map = L.map('map').setView([lat, lng], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);

            // Tambahkan marker yang bisa dipindah (draggable)
            let marker = L.marker([lat, lng], {
                draggable: true
            }).addTo(map);

            // Update nilai latitude dan longitude saat marker dipindahkan
            marker.on('dragend', function() {
                const lat = marker.getLatLng().lat.toFixed(6);
                const lng = marker.getLatLng().lng.toFixed(6);
                document.getElementById('lat').value = lat;
                document.getElementById('lng').value = lng;
            });

            // Fungsi pencarian lokasi menggunakan Nominatim
            document.getElementById('search-button').addEventListener('click', function() {
                const query = document.getElementById('search-location').value;

                if (!query) {
                    alert('Masukkan nama lokasi untuk mencari!');
                    return;
                }

                fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            const lat = parseFloat(data[0].lat).toFixed(6);
                            const lng = parseFloat(data[0].lon).toFixed(6);

                            map.setView([lat, lng], 15);
                            marker.setLatLng([lat, lng]);

                            document.getElementById('lat').value = lat;
                            document.getElementById('lng').value = lng;
                        } else {
                            alert('Lokasi tidak ditemukan. Coba kata kunci lain.');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching location:', error);
                        alert('Terjadi kesalahan saat mencari lokasi.');
                    });
            });
        });
    </script>
@endpush
