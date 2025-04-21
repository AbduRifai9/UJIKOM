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
                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi">
                                        {{ old('deskripsi', $event->deskripsi) }}
                                    </textarea>
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
                                <label class="col-sm-2 col-form-label" for="lokasi">Lokasi Event</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2 @error('id_lokasi') is-invalid @enderror"
                                        name="id_lokasi" id="lokasi">
                                        <option value="" disabled
                                            {{ old('id_lokasi', $event->id_lokasi) ? '' : 'selected' }}>Pilih Lokasi
                                        </option>
                                        @foreach ($lokasi as $data)
                                            <option value="{{ $data->id }}" data-kapasitas="{{ $data->kapasitas }}"
                                                {{ old('id_lokasi', $event->id_lokasi) == $data->id ? 'selected' : '' }}>
                                                {{ $data->nama_lokasi }}
                                            </option>
                                        @endforeach
                                    </select>

                                    {{-- Pesan error validasi --}}
                                    @error('id_lokasi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    {{-- Pesan error dari session (optional) --}}
                                    @if (session('error'))
                                        <div class="invalid-feedback d-block">
                                            {{ session('error') }}
                                        </div>
                                    @endif
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
                                    <select class="form-control" name="status" type="text" id="status" disabled>
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
    <!-- CKEditor 5 -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- iziToast -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#deskripsi'))
            .catch(error => {
                console.error(error);
            });

        document.addEventListener("DOMContentLoaded", function() {
            // Select2
            $('.select-lokasi').select2({
                placeholder: 'Pilih Lokasi',
                allowClear: true,
                width: '100%'
            });

            // Kapasitas lokasi
            const lokasiSelect = document.querySelector("select[name='id_lokasi']");
            const kapasitasInput = document.getElementById("kapasitas");

            lokasiSelect.addEventListener("change", function() {
                const selectedOption = lokasiSelect.options[lokasiSelect.selectedIndex];
                const kapasitas = selectedOption.getAttribute("data-kapasitas");
                kapasitasInput.value = kapasitas;
            });

            if (lokasiSelect.value) {
                const selectedOption = lokasiSelect.options[lokasiSelect.selectedIndex];
                kapasitasInput.value = selectedOption.getAttribute("data-kapasitas");
            }

            // Status otomatis
            const statusSelect = document.getElementById('status');
            const tanggalMulai = document.getElementById('tanggal_mulai').value;
            const waktuMulai = document.getElementById('waktu_mulai').value;
            const tanggalSelesai = document.getElementById('tanggal_selesai').value;
            const waktuSelesai = document.getElementById('waktu_selesai').value;

            if (tanggalMulai && waktuMulai && tanggalSelesai && waktuSelesai) {
                const start = new Date(`${tanggalMulai}T${waktuMulai}`);
                const end = new Date(`${tanggalSelesai}T${waktuSelesai}`);
                const now = new Date();

                let status = '';
                if (now < start) {
                    status = 'Segera';
                } else if (now >= start && now <= end) {
                    status = 'Sedang Berlangsung';
                } else {
                    status = 'Selesai';
                }

                for (let i = 0; i < statusSelect.options.length; i++) {
                    if (statusSelect.options[i].value === status) {
                        statusSelect.selectedIndex = i;
                        break;
                    }
                }
            }

            // Konfirmasi submit pakai SweetAlert
            const form = document.querySelector("form");
            const submitButton = form.querySelector("button[type='submit']");

            form.addEventListener("submit", function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Yakin ingin memperbarui data?',
                    text: "Perubahan akan disimpan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, simpan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // iziToast feedback
        @if (session('success'))
            iziToast.success({
                title: 'Sukses',
                message: '{{ session('success') }}',
                position: 'topRight'
            });
        @endif
    </script>
    <script>
        $(document).ready(function() {
            $('#lokasi').select2({
                placeholder: "Pilih Lokasi",
                allowClear: true
            });

            $('#lokasi').on('change', function() {
                var kapasitas = $(this).find(':selected').data('kapasitas');
                $('#kapasitas').val(kapasitas);
            });

            function parseTimeToMinutes(timeStr) {
                if (!timeStr) return null;
                const parts = timeStr.split(':');
                if (parts.length !== 2) return null;
                const hours = parseInt(parts[0], 10);
                const minutes = parseInt(parts[1], 10);
                if (isNaN(hours) || isNaN(minutes)) return null;
                return (hours * 60) + minutes;
            }

            function validateDateTime() {
                const tanggalMulai = $('#tanggal_mulai').val();
                const tanggalSelesai = $('#tanggal_selesai').val();
                const waktuMulai = $('#waktu_mulai').val();
                const waktuSelesai = $('#waktu_selesai').val();

                if (!tanggalMulai || !tanggalSelesai || !waktuMulai || !waktuSelesai) return;

                const startDateTime = new Date(`${tanggalMulai}T${waktuMulai}`);
                const endDateTime = new Date(`${tanggalSelesai}T${waktuSelesai}`);

                const diffInMinutes = (endDateTime - startDateTime) / (1000 * 60);

                if (startDateTime.getTime() === endDateTime.getTime()) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Waktu Tidak Valid',
                        text: 'Waktu selesai tidak boleh sama dengan waktu mulai.'
                    });
                    $('#waktu_selesai').val('');
                    return;
                }

                if (diffInMinutes < 120) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Durasi Terlalu Pendek',
                        text: 'Waktu selesai harus minimal 2 jam setelah waktu mulai/Kamu harus mengganti tanggal nya jika ingin sesuai dengan waktu yang anda inginkan.'
                    });
                    $('#waktu_selesai').val('');
                    return;
                }
            }

            // Trigger validation when any date/time field changes
            $('#tanggal_mulai, #tanggal_selesai, #waktu_mulai, #waktu_selesai').on('change', validateDateTime);

            // Set tanggal selesai sama dengan tanggal mulai saat tanggal mulai berubah
            $('#tanggal_mulai').on('change', function() {
                $('#tanggal_selesai').val($(this).val());
            });
        });

        let isConfirmed = false;

        form.addEventListener("submit", function(e) {
            if (!isConfirmed) {
                e.preventDefault();

                Swal.fire({
                    title: 'Yakin ingin memperbarui data?',
                    text: "Perubahan akan disimpan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, simpan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        isConfirmed = true;
                        form.submit(); // <-- ini akan trigger submit lagi, tapi isConfirmed akan true
                    }
                });
            }
        });
    </script>
@endpush
