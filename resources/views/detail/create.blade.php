@extends('layouts.backend')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Tambah Data Detail Tiket/Pemesanan</h5>
                        <a href="{{ route('detail.index') }}" class="btn btn-sm btn-primary" style="float: right">Kembali</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('detail.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <!-- Field Nama detail -->
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Nama Pemesan</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="id_pemesanan" id="id_pemesanan">
                                                @foreach ($pemesanan as $data)
                                                    <option value="{{ $data->id }}">
                                                        {{ $data->user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Field Kapasitas -->
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Email Pemesan</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="id_pemesanan" id="id_pemesanan">
                                                @foreach ($pemesanan as $data)
                                                    <option value="{{ $data->id }}">{{ $data->user->email }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Field detail dengan Map -->
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Jenis Acara</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="id_pemesanan" id="id_pemesanan">
                                                @foreach ($pemesanan as $data)
                                                    <option value="{{ $data->id }}">
                                                        {{ $data->tiket->event->nama_event }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Jenis Tiket</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="id_pemasanan" id="id_pemasanan">
                                                @foreach ($pemesanan as $data)
                                                    <option value="{{ $data->id }}">{{ $data->tiket->jenis_tiket }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="float-end">
                                        <button type="submit" class="btn btn-primary">Kirim</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @push('scriptjs')
    <!-- Leaflet JS & CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <!-- CSS tambahan untuk #map -->
    <style>
        #map {
            height: 400px;
            /* Definisikan tinggi agar peta muncul */
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
            // Inisialisasi peta dengan koordinat default Indonesia
            const map = L.map('map').setView([-2.5489, 118.0149], 5);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);

            // Tambahkan marker yang bisa dipindah (draggable)
            let marker = L.marker([-2.5489, 118.0149], {
                draggable: true
            }).addTo(map);

            // Update nilai latitude dan longitude saat marker dipindahkan
            marker.on('dragend', function() {
                const lat = marker.getLatLng().lat.toFixed(6);
                const lng = marker.getLatLng().lng.toFixed(6);
                document.getElementById('lat').value = lat;
                document.getElementById('lng').value = lng;
            });

            // Fungsi pencarian detail menggunakan Nominatim
            document.getElementById('search-button').addEventListener('click', function() {
                const query = document.getElementById('search-location').value;

                if (!query) {
                    alert('Masukkan nama detail untuk mencari!');
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
                            alert('detail tidak ditemukan. Coba kata kunci lain.');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching location:', error);
                        alert('Terjadi kesalahan saat mencari detail.');
                    });
            });
        });
    </script>
@endpush --}}
