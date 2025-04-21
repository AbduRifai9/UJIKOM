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
                                <b class="form-control disabled-div event-status"
                                    data-start="{{ $event->tanggal_mulai }} {{ $event->waktu_mulai }}"
                                    data-end="{{ $event->tanggal_selesai }} {{ $event->waktu_selesai }}">
                                    {{ $event->status }}
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const statusEl = document.querySelector('.event-status');
        const start = new Date(statusEl.dataset.start);
        const end = new Date(statusEl.dataset.end);
        const now = new Date();

        let status = '';
        if (now < start) {
            status = 'Segera';
        } else if (now >= start && now <= end) {
            status = 'Sedang Berlangsung';
        } else {
            status = 'Selesai';
        }

        statusEl.textContent = status;
    });
</script>
@endpush

