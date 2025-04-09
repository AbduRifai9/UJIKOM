@extends('layouts.backend')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Edit Data tiket</h5>
                        <a href="{{ route('admin.tiket.index') }}" class="btn btn-sm btn-primary" style="float: right">Kembali</a>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.tiket.update', $tiket->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Event</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="id_event" type="text">
                                        @foreach ($event as $data)
                                            <option value="{{ $data->id }}"
                                                {{ $data->id == $tiket->id_event ? 'selected' : '' }}>
                                                {{ $data->nama_event }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Jenis Tiket</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="jenis_tiket" type="text">
                                        <option value="Early Bird"
                                            {{ $tiket->jenis_tiket == 'Early Bird' ? 'selected' : '' }}>Early Bird
                                        </option>
                                        <option value="Reguler" {{ $tiket->jenis_tiket == 'Reguler' ? 'selected' : '' }}>
                                            Reguler</option>
                                        <option value="VIP" {{ $tiket->jenis_tiket == 'VIP' ? 'selected' : '' }}>VIP
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Harga Tiket</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control @error('harga_tiket') is-invalid @enderror"
                                        value="{{ old('harga_tiket', $tiket->harga_tiket) }}" name="harga_tiket"
                                        id="harga_tiket">
                                    @error('harga_tiket')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Kuota Tiket</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control @error('kuota_tiket') is-invalid @enderror"
                                        value="{{ old('kuota_tiket', $tiket->kuota_tiket) }}" name="kuota_tiket"
                                        id="kuota_tiket">
                                    @error('kuota_tiket')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Tiket Terjual</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control @error('tiket_terjual') is-invalid @enderror"
                                        value="{{ old('tiket_terjual', $tiket->tiket_terjual) }}" name="tiket_terjual"
                                        id="tiket_terjual">
                                    @error('tiket_terjual')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Status</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="status" type="text">
                                        <option value="Aktif" {{ $tiket->status == 'Aktif' ? 'selected' : '' }}>Aktif
                                        </option>
                                        <option value="Tidak Aktif"
                                            {{ $tiket->status == 'Tidak Aktif' ? 'selected' : '' }}>
                                            Tidak Aktif</option>
                                        <option value="Kadaluwarsa"
                                            {{ $tiket->status == 'Kadaluwarsa' ? 'selected' : '' }}>Kadaluwarsa
                                        </option>
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
