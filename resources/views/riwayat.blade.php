@extends('layouts.frontend')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4 fw-bold text-primary">Riwayat Transaksi</h2>

        @if ($riwayat->isEmpty())
            <div class="alert alert-info">Belum ada transaksi.</div>
        @else
            <div class="row gy-4">
                @foreach ($riwayat as $item)
                    <div class="col-md-6">
                        <div class="card border-dashed border-2 shadow-sm position-relative" style="border-color: #6c63ff;">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="card-title mb-0 text-dark ms-2">{{ $item->tiket->event->nama_event }}</h5>
                                    <span
                                        class="badge
                                    @if ($item->status == 'Sudah Bayar') bg-success
                                    @elseif($item->status == 'Belum Bayar') bg-warning text-dark
                                    @else bg-danger @endif">
                                        {{ $item->status }}
                                    </span>
                                </div>
                                <p class="mb-1 ms-2"><strong>Jenis Tiket:</strong> {{ $item->tiket->jenis_tiket }}</p>
                                <p class="mb-1 ms-2"><strong>Jumlah:</strong> {{ $item->kuantitas }} tiket</p>
                                <p class="mb-1 ms-2"><strong>Total:</strong>
                                    Rp{{ number_format($item->total_harga, 0, ',', '.') }}</p>
                                <p class="mb-0 text-muted ms-2"><small><i class="bi bi-clock"></i>
                                        {{ $item->created_at->format('d M Y, H:i') }}</small></p>
                            </div>
                            <!-- Bulatan kiri, lebih ke dalam -->
                            <div class="position-absolute top-50 translate-middle-y bg-white rounded-circle border border-2 border-primary"
                                style="left: -10px; width: 20px; height: 20px;"></div>

                            <!-- Bulatan kanan, lebih ke dalam -->
                            <div class="position-absolute top-50 translate-middle-y bg-white rounded-circle border border-2 border-primary"
                                style="right: -10px; width: 20px; height: 20px;"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
