@extends('layouts.backend')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Edit Data event</h5>
                        <a href="{{ route('event.index') }}" class="btn btn-sm btn-primary" style="float: right">Kembali</a>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Nama event</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('nama_event') is-invalid @enderror"
                                        value="{{ old('nama_event', $event->nama_event) }}" name="nama_event"
                                        id="nama_event">
                                    @error('nama_event')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Deskripsi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('deskripsi') is-invalid @enderror"
                                        value="{{ old('deskripsi', $event->deskripsi) }}" name="deskripsi" id="deskripsi">
                                    @error('deskripsi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Poster</label>
                                <div class="col-sm-10">
                                    <img src="{{ asset('images/event/' . $event->poster) }}"
                                        style="width: 150px;height: 100px;" class="mb-3">
                                    <input type="file" class="form-control" name="poster">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Tanggal Mulai</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                        value="{{ old('tanggal_mulai', $event->tanggal_mulai) }}" name="tanggal_mulai"
                                        id="tanggal_mulai">
                                    @error('tanggal_mulai')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Waktu Mulai</label>
                                <div class="col-sm-10">
                                    <input type="time" class="form-control @error('waktu_mulai') is-invalid @enderror"
                                        value="{{ old('waktu_mulai', $event->waktu_mulai) }}" name="waktu_mulai"
                                        id="waktu_mulai">
                                    @error('waktu_mulai')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Tanggal Selesai</label>
                                <div class="col-sm-10">
                                    <input type="date"
                                        class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                        value="{{ old('tanggal_selesai', $event->tanggal_selesai) }}"
                                        name="tanggal_selesai" id="tanggal_selesai">
                                    @error('tanggal_selesai')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Waktu Selesai</label>
                                <div class="col-sm-10">
                                    <input type="time" class="form-control @error('waktu_selesai') is-invalid @enderror"
                                        value="{{ old('waktu_selesai', $event->waktu_selesai) }}" name="waktu_selesai"
                                        id="waktu_selesai">
                                    @error('waktu_selesai')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Lokasi</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="id_lokasi" type="text">
                                        @foreach ($lokasi as $data)
                                            <option value="{{ $data->id }}" data-kapasitas="{{ $data->kapasitas }}"
                                                {{ $data->id == $event->id_lokasi ? 'selected' : '' }}>
                                                {{ $data->nama_lokasi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Kapasitas</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kapasitas" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Status</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="status" type="text">
                                        <option value="Segera" {{ $event->status == 'Segera' ? 'selected' : '' }}>Segera
                                        </option>
                                        <option value="Sedang Berlangsung"
                                            {{ $event->status == 'Sedang Berlangsung' ? 'selected' : '' }}>
                                            Sedang Berlangsung</option>
                                        <option value="Selesai" {{ $event->status == 'Selesai' ? 'selected' : '' }}>
                                            Selesai
                                        </option>
                                        <option value="Dibatalkan" {{ $event->status == 'Dibatalkan' ? 'selected' : '' }}>
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
            <!-- Basic with Icons -->
        </div>
    </div>
@endsection
@push('scriptjs')
@endpush
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const lokasiSelect = document.querySelector("select[name='id_lokasi']");
        const kapasitasInput = document.getElementById("kapasitas");

        lokasiSelect.addEventListener("change", function() {
            const selectedOption = lokasiSelect.options[lokasiSelect.selectedIndex];
            const kapasitas = selectedOption.getAttribute("data-kapasitas");

            kapasitasInput.value = kapasitas; // Mengisi input kapasitas
        });

        // Set kapasitas default saat halaman dimuat jika ada lokasi yang dipilih
        if (lokasiSelect.value) {
            const selectedOption = lokasiSelect.options[lokasiSelect.selectedIndex];
            kapasitasInput.value = selectedOption.getAttribute("data-kapasitas");
        }
    });
</script>
