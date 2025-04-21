@extends('layouts.backend')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Tambah Data Event</h5>
                        <a href="{{ route('event.index') }}" class="btn btn-sm btn-primary" style="float: right">Kembali</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Event</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('nama_event') is-invalid @enderror"
                                        name="nama_event" id="nama_event" value="{{ old('nama_event') }}">
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
                                    <textarea name="deskripsi" id="deskripsi" class="form-control">{{ old('deskripsi') }}</textarea>
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
                                    <input type="file" class="form-control @error('poster') is-invalid @enderror"
                                        name="poster" id="poster">
                                    @error('poster')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Tanggal Mulai</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control @error('waktu_mulai') is-invalid @enderror"
                                        name="tanggal_mulai" id="tanggal_mulai" value="{{ old('tanggal_mulai') }}">
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
                                        name="waktu_mulai" id="waktu_mulai" value="{{ old('waktu_mulai') }}">
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
                                    <input type="date" class="form-control @error('waktu_selesai') is-invalid @enderror"
                                        name="tanggal_selesai" id="tanggal_selesai" value="{{ old('tanggal_selesai') }}">
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
                                        name="waktu_selesai" id="waktu_selesai" value="{{ old('waktu_selesai') }}">
                                    @error('waktu_selesai')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Lokasi Event</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2 @error('id_lokasi') is-invalid @enderror"
                                        name="id_lokasi" id="lokasi">
                                        <option value="" disabled selected>Pilih Lokasi</option>
                                        @foreach ($lokasi as $data)
                                            <option value="{{ $data->id }}" data-kapasitas="{{ $data->kapasitas }}"
                                                {{ old('id_lokasi') == $data->id ? 'selected' : '' }}>
                                                {{ $data->nama_lokasi }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {{-- Error message --}}
                                    @error('id_lokasi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    {{-- Optional: pesan error dari session (misal bentrok lokasi) --}}
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
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#deskripsi'))
            .catch(error => {
                console.error(error);
            });
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
    </script>
@endpush
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#lokasi').on('change', function() {
            var kapasitas = $(this).find(':selected').data(
                'kapasitas'); // Ambil kapasitas dari data-kapasitas
            $('#kapasitas').val(kapasitas); // Isi input kapasitas dengan nilai yang sesuai
        });
    });
</script>
