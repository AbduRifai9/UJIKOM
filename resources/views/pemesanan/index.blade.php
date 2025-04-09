@extends('layouts.backend')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Data pemesanan</h5>
                    <a href="{{ route('pemesanan.create') }}" class="btn btn-sm btn-primary" style="float: right">Tambah</a>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pembeli</th>
                                <th>Event</th>
                                <th>Jenis Tiket</th>
                                <th>Harga Tiket</th>
                                <th>Kuantitas</th>
                                <th>Total Harga</th>
                                <th>Status Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        @php $no = 1; @endphp
                        <tbody class="table-border-bottom-0">
                            @foreach ($pemesanan as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->tiket->event->nama_event }}</td>
                                    <td>{{ $item->tiket->jenis_tiket }}</td>
                                    <td>Rp {{ number_format($item->tiket->harga_tiket, 0, ',', '.') }}</td>
                                    <td>{{ $item->kuantitas }}</td>
                                    <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                    <td>
                                        <span
                                            class="badge bg-{{ $item->status == 'Sudah Bayar' ? 'success' : ($item->status == 'Belum Bayar' ? 'warning' : 'danger') }}">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button"
                                                class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="{{ route('pemesanan.edit', $item->id) }}"
                                                        class="dropdown-item">Edit</a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('pemesanan.destroy', $item->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item"
                                                            onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</button>
                                                    </form>
                                                </li>

                                                {{-- Tombol bayar Midtrans jika status masih belum bayar --}}
                                                @if ($item->status == 'Belum Bayar')
                                                    <li>
                                                        <button type="button" class="dropdown-item text-success"
                                                            onclick="window.handlePayment({{ $item->id }})">
                                                            Bayar Sekarang
                                                        </button>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        // Definisikan fungsi dalam scope global window
        window.handlePayment = function(id) {
            Swal.fire({
                title: 'Memproses Pembayaran',
                text: 'Mohon tunggu...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });

            $.ajax({
                url: `/admin/pemesanan/${id}/bayar`, // Updated URL with admin prefix
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                success: function(data) {
                    Swal.close();

                    window.snap.pay(data.snap_token, {
                        onSuccess: function(result) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Pembayaran Berhasil',
                                text: 'Terima kasih atas pembayaran Anda'
                            }).then(() => {
                                location.reload();
                            });
                        },
                        onPending: function(result) {
                            Swal.fire({
                                icon: 'info',
                                title: 'Pembayaran Pending',
                                text: 'Silakan selesaikan pembayaran Anda'
                            }).then(() => {
                                location.reload();
                            });
                        },
                        onError: function(result) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Pembayaran Gagal',
                                text: 'Terjadi kesalahan dalam proses pembayaran'
                            });
                        },
                        onClose: function() {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Pembayaran Dibatalkan',
                                text: 'Anda menutup popup pembayaran'
                            });
                        }
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON?.message ||
                            'Terjadi kesalahan dalam memproses pembayaran'
                    });
                }
            });
        };
    </script>
@endpush
