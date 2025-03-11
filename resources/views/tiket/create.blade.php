@extends('layouts.backend')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Tambah Data Tiket</h5>
                        <a href="{{ route('tiket.index') }}" class="btn btn-sm btn-primary" style="float: right">Kembali</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tiket.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Event</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="id_event">
                                        @foreach ($event as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama_event }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_event')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Harga Tiket</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control @error('harga_tiket') is-invalid @enderror"
                                        name="harga_tiket" id="harga_tiket" value="{{ old('harga_tiket') }}">
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
                                        name="kuota_tiket" id="kuota_tiket" value="{{ old('kuota_tiket') }}">
                                    @error('kuota_tiket')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
