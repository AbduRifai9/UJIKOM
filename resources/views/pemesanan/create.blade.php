@extends('layouts.backend')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Tambah Data Pemesanan</h5>
                        <a href="{{ route('pemesanan.index') }}" class="btn btn-sm btn-primary"
                            style="float: right">Kembali</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pemesanan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Pembeli</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="id_user">
                                        @foreach ($user as $data)
                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_user')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Event</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="event">
                                        <option value="">-- Pilih Event --</option>
                                        @foreach ($tiket->unique('id_event') as $data)
                                            <option value="{{ $data->id_event }}">{{ $data->event->nama_event }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Jenis Tiket</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="id_tiket" id="jenis_tiket">
                                        <option value="">-- Pilih Jenis Tiket --</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Harga Tiket</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="harga_tiket" id="harga_tiket" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Kuantitas</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="kuantitas" id="kuantitas"
                                        value="1" min="1">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Total Harga</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="total_harga" id="total_harga" readonly>
                                </div>
                            </div>
                            <div class="row float-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Kirim</button>
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
@endpush
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const eventSelect = document.getElementById("event");
        const jenisTiket = document.getElementById("jenis_tiket");
        const hargaTiket = document.getElementById("harga_tiket");
        const kuantitas = document.getElementById("kuantitas");
        const totalHarga = document.getElementById("total_harga");

        // Ambil semua data tiket dari Blade ke JavaScript
        const semuaTiket = @json($tiket);

        function updateJenisTiket() {
            const eventId = eventSelect.value;

            // Kosongkan dropdown jenis tiket
            jenisTiket.innerHTML = '<option value="">-- Pilih Jenis Tiket --</option>';

            // Filter tiket berdasarkan event yang dipilih
            const tiketEvent = semuaTiket.filter(tiket => tiket.id_event == eventId);

            tiketEvent.forEach(tiket => {
                const option = document.createElement("option");
                option.value = tiket.id;
                option.textContent = tiket.jenis_tiket;
                option.setAttribute("data-harga", tiket.harga_tiket);
                jenisTiket.appendChild(option);
            });

            // Reset harga saat event berubah
            updateHarga();
        }

        function updateHarga() {
            const selectedOption = jenisTiket.options[jenisTiket.selectedIndex];
            const harga = selectedOption?.getAttribute("data-harga") || 0;

            // Harga tiket tanpa format pemisah ribuan
            hargaTiket.value = parseFloat(harga) || 0;

            hitungTotal();
        }

        function hitungTotal() {
            const harga = parseFloat(hargaTiket.value) || 0;
            const jumlah = parseInt(kuantitas.value) || 1; // Default 1 jika kosong
            const total = harga * jumlah;

            // Total harga tanpa format pemisah ribuan
            totalHarga.value = total;
        }

        // Event listener saat memilih event
        eventSelect.addEventListener("change", updateJenisTiket);

        // Event listener saat memilih jenis tiket
        jenisTiket.addEventListener("change", updateHarga);

        // Event listener saat mengubah kuantitas
        kuantitas.addEventListener("input", hitungTotal);
    });
</script>
