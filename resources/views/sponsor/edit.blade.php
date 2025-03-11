@extends('layouts.backend')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Edit Data Sponsor</h5>
                        <a href="{{ route('sponsor.index') }}" class="btn btn-sm btn-primary" style="float: right">Kembali</a>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('sponsor.update', $sponsor->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Event</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="id_event" type="text">
                                        @foreach ($event as $data)
                                            <option value="{{ $data->id }}"
                                                {{ $data->id == $sponsor->id_event ? 'selected' : '' }}>
                                                {{ $data->nama_event }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Nama sponsor</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('nama_sponsor') is-invalid @enderror"
                                        value="{{ old('nama_sponsor', $sponsor->nama_sponsor) }}" name="nama_sponsor"
                                        id="nama_sponsor">
                                    @error('nama_sponsor')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Logo</label>
                                <div class="col-sm-10">
                                    <img src="{{ asset('images/sponsor/' . $sponsor->logo) }}"
                                        style="width: 150px;height: 100px;" class="mb-3">
                                    <input type="file" class="form-control" name="logo">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Deskripsi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('deskripsi') is-invalid @enderror"
                                        value="{{ old('deskripsi', $sponsor->deskripsi) }}" name="deskripsi" id="deskripsi">
                                    @error('deskripsi')
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
