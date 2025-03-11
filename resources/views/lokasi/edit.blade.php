@extends('layouts.backend')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Edit Data lokasi</h5>
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
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Alamat lokasi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('alamat_lokasi') is-invalid @enderror"
                                        value="{{ old('alamat_lokasi', $lokasi->alamat_lokasi) }}" name="alamat_lokasi"
                                        id="alamat_lokasi">
                                    @error('alamat_lokasi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Kapasitas</label>
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
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Foto</label>
                                <div class="col-sm-10">
                                    <img src="{{ asset('images/lokasi/' . $lokasi->foto) }}"
                                        style="width: 100px;height: 100px;" class="mb-3">
                                    <input type="file" class="form-control" name="foto">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">URL</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('url') is-invalid @enderror"
                                        value="{{ old('url', $lokasi->url) }}" name="url" id="url">
                                    @error('url')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
