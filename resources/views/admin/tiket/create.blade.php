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
                        <a href="{{ route('admin.tiket.index') }}" class="btn btn-sm btn-primary"
                            style="float: right">Kembali</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.tiket.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Pilih Event --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Nama Event</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="event_id" id="event_id">
                                        @foreach ($event as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama_event }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Checkbox Jenis Tiket --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Jenis Tiket</label>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input tiket-check" type="checkbox" name="jenis[]"
                                            value="Reguler" id="regulerCheck">
                                        <label class="form-check-label" for="regulerCheck">Reguler</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input tiket-check" type="checkbox" name="jenis[]"
                                            value="VIP" id="vipCheck">
                                        <label class="form-check-label" for="vipCheck">VIP</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input tiket-check" type="checkbox" name="jenis[]"
                                            value="Early Bird" id="earlyCheck">
                                        <label class="form-check-label" for="earlyCheck">Early Bird</label>
                                    </div>
                                </div>
                            </div>

                            {{-- Input Dinamis berdasarkan Jenis --}}
                            <div id="input-container">
                                {{-- Reguler --}}
                                <div class="jenis-tiket-form d-none" data-jenis="Reguler">
                                    <hr>
                                    <h6>Tiket Reguler</h6>
                                    <input type="hidden" name="aktif_jenis[]" value="Reguler">
                                    <div class="mb-3">
                                        <label>Harga</label>
                                        <input type="number" class="form-control" name="harga_tiket[Reguler]"
                                            placeholder="Harga Reguler">
                                    </div>
                                    <div class="mb-3">
                                        <label>Kuota</label>
                                        <input type="number" class="form-control kuota-input" name="kuota_tiket[Reguler]"
                                            placeholder="Kuota Reguler">
                                        <small class="text-danger kuota-warning d-none">Kuota melebihi kapasitas!</small>
                                    </div>
                                </div>

                                {{-- VIP --}}
                                <div class="jenis-tiket-form d-none" data-jenis="VIP">
                                    <hr>
                                    <h6>Tiket VIP</h6>
                                    <input type="hidden" name="aktif_jenis[]" value="VIP">
                                    <div class="mb-3">
                                        <label>Harga</label>
                                        <input type="number" class="form-control" name="harga_tiket[VIP]"
                                            placeholder="Harga VIP">
                                    </div>
                                    <div class="mb-3">
                                        <label>Kuota</label>
                                        <input type="number" class="form-control kuota-input" name="kuota_tiket[VIP]"
                                            placeholder="Kuota VIP">
                                        <small class="text-danger kuota-warning d-none">Kuota melebihi kapasitas!</small>
                                    </div>
                                </div>

                                {{-- Early Bird --}}
                                <div class="jenis-tiket-form d-none" data-jenis="Early Bird">
                                    <hr>
                                    <h6>Tiket Early Bird</h6>
                                    <input type="hidden" name="aktif_jenis[]" value="Early Bird">
                                    <div class="mb-3">
                                        <label>Harga</label>
                                        <input type="number" class="form-control" name="harga_tiket[Early Bird]"
                                            placeholder="Harga Early Bird">
                                    </div>
                                    <div class="mb-3">
                                        <label>Kuota</label>
                                        <input type="number" class="form-control kuota-input"
                                            name="kuota_tiket[Early Bird]" placeholder="Kuota Early Bird">
                                        <small class="text-danger kuota-warning d-none">Kuota melebihi kapasitas!</small>
                                    </div>
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
<script>
    const kapasitas = @json($kapasitasPerEvent);
    const selectEvent = document.getElementById('event_id');
    const kuotaInputs = document.querySelectorAll('.kuota-input');
    const warningTexts = document.querySelectorAll('.kuota-warning');

    // Toggle berdasarkan checkbox
    document.querySelectorAll('.tiket-check').forEach(cb => {
        cb.addEventListener('change', function () {
            const jenis = this.value;
            const formDiv = document.querySelector(`.jenis-tiket-form[data-jenis="${jenis}"]`);
            if (this.checked) {
                formDiv.classList.remove('d-none');
            } else {
                formDiv.classList.add('d-none');
            }
        });
    });

    // Validasi kuota
    function updateKuotaValidation() {
        const selectedId = selectEvent.value;
        const sisa = kapasitas[selectedId] ?? 1;

        kuotaInputs.forEach((input, index) => {
            input.max = sisa;
            input.placeholder = `Maksimum ${sisa}`;
            const val = parseInt(input.value);
            if (val > sisa) {
                warningTexts[index].classList.remove('d-none');
            } else {
                warningTexts[index].classList.add('d-none');
            }
        });
    }

    selectEvent.addEventListener('change', updateKuotaValidation);
    kuotaInputs.forEach(input => input.addEventListener('input', updateKuotaValidation));
    window.addEventListener('DOMContentLoaded', updateKuotaValidation);
</script>
@endpush
