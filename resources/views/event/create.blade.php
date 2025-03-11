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
                                    <input type="text" class="form-control @error('deskripsi') is-invalid @enderror"
                                        name="deskripsi" id="deskripsi" value="{{ old('deskripsi') }}">
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
                                    <select class="form-control" name="id_lokasi" id="lokasi">
                                        <option value="" disabled selected>Pilih Lokasi</option>
                                        @foreach ($lokasi as $data)
                                            <option value="{{ $data->id }}" data-kapasitas="{{ $data->kapasitas }}">
                                                {{ $data->nama_lokasi }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_lokasi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
@endpush
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#lokasi').on('change', function() {
            var kapasitas = $(this).find(':selected').data('kapasitas'); // Ambil kapasitas dari data-kapasitas
            $('#kapasitas').val(kapasitas); // Isi input kapasitas dengan nilai yang sesuai
        });
    });
</script>
