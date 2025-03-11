@extends('layouts.backend')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row justify-content-center">
            <div class="card-md-8">
                <div class="card">
                    <div class="card-header">Data Event
                        <a href="{{ route('event.index') }}" class="btn btn-sm btn-primary" style="float: right">Kembali</a>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Event : </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ $event->nama_event }}" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Deskripsi Event :
                            </label>
                            <div class="col-sm-10">
                                <p class="form-control disabled-div">{{ $event->deskripsi }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Poster : </label>
                            <img src="{{ asset('/images/event/' . $event->poster) }}" alt="" style="width: 200px">
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Tanggal Mulai : </label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" value="{{ $event->tanggal_mulai }}" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Waktu Mulai : </label>
                            <div class="col-sm-10">
                                <input type="time" class="form-control" value="{{ $event->waktu_mulai }}" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Tanggal Selesai : </label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" value="{{ $event->tanggal_selesai }}" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Waktu Selesai : </label>
                            <div class="col-sm-10">
                                <input type="time" class="form-control" value="{{ $event->waktu_selesai }}" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Lokasi Event : </label>
                            <div class="col-sm-10">
                                <select class="form-control" name="id_lokasi" type="text" disabled>
                                    @foreach ($lokasi as $data)
                                        <option value="{{ $data->id }}"
                                            {{ $data->id == $event->id_lokasi ? 'selected' : '' }}>
                                            {{ $data->nama_lokasi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Kapasitas Event : </label>
                            <div class="col-sm-10">
                                <select class="form-control" name="id_lokasi" type="text" disabled>
                                    @foreach ($lokasi as $data)
                                        <option value="{{ $data->id }}"
                                            {{ $data->id == $event->id_lokasi ? 'selected' : '' }}>
                                            {{ $data->kapasitas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Status : </label>
                            <div class="col-sm-10">
                                <b class="form-control disabled-div">
                                    @if ($event->status == 'Segera')
                                        Segera
                                    @elseif ($event->status == 'Sedang Berlangsung')
                                        Sedang Berlangsung
                                    @elseif ($event->status == 'Selesai')
                                        Selesai
                                    @else
                                        Dibatalkan
                                    @endif
                                </b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scriptjs')
@endpush
