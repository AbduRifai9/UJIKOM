 @extends('layouts.backend')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Edit Data Pemesanan</h5>
                        <a href="{{ route('pemesanan.index') }}" class="btn btn-sm btn-primary">Kembali</a>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('pemesanan.update', $pemesanan->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Nama Pembeli -->
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Nama Pembeli</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="id_user">
                                        @foreach ($user as $data)
                                            <option value="{{ $data->id }}"
                                                {{ $data->id == $pemesanan->id_user ? 'selected' : '' }}>
                                                {{ $data->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Nama Event (Hanya Ditampilkan) -->
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Nama Event</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control"
                                        value="{{ $pemesanan->tiket->event->nama_event }}" readonly>
                                    <input type="hidden" name="id_event" value="{{ $pemesanan->id_event }}">
                                </div>
                            </div>

                            <!-- Jenis Tiket (Hanya Ditampilkan) -->
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Jenis Tiket</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="{{ $pemesanan->tiket->jenis_tiket }}"
                                        readonly>
                                    <input type="hidden" name="id_tiket" value="{{ $pemesanan->id_tiket }}">
                                </div>
                            </div>

                            <!-- Harga Tiket (Otomatis) -->
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Harga Tiket</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="harga_tiket" readonly
                                        value="{{ $pemesanan->tiket->harga_tiket }}">
                                </div>
                            </div>

                            <!-- Kuantitas -->
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Kuantitas</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="kuantitas" name="kuantitas"
                                        value="{{ old('kuantitas', $pemesanan->kuantitas) }}" min="1">
                                </div>
                            </div>

                            <!-- Total Harga -->
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Total Harga</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="total_harga" name="total_harga" readonly>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="status">
                                        <option value="Belum Bayar"
                                            {{ $pemesanan->status == 'Belum Bayar' ? 'selected' : '' }}>Belum Bayar
                                        </option>
                                        <option value="Sudah Bayar"
                                            {{ $pemesanan->status == 'Sudah Bayar' ? 'selected' : '' }}>Sudah Bayar
                                        </option>
                                        <option value="Sudah Dibatalkan"
                                            {{ $pemesanan->status == 'Sudah Dibatalkan' ? 'selected' : '' }}>Sudah
                                            Dibatalkan</option>
                                    </select>
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
        </div>
    </div>
@endsection

@push('scriptjs')
@endpush
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const hargaTiket = document.getElementById("harga_tiket");
        const kuantitas = document.getElementById("kuantitas");
        const totalHarga = document.getElementById("total_harga");

        function hitungTotal() {
            const harga = parseFloat(hargaTiket.value) || 0;
            const jumlah = parseInt(kuantitas.value) || 1;
            const total = harga * jumlah;

            totalHarga.value = total;
        }

        // Event listener saat mengubah kuantitas
        kuantitas.addEventListener("input", hitungTotal);

        // Hitung total saat halaman dimuat
        hitungTotal();
    });
</script>
