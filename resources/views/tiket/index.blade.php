@extends('layouts.backend')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Data Tiket</h5>
                    <a href="{{ route('tiket.create') }}" class="btn btn-sm btn-primary" style="float: right">Tambah</a>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Event</th>
                                <th>Jenis Tiket</th>
                                <th>Harga Tiket</th>
                                <th>Kuota Tiket</th>
                                <th>Tiket Terjual</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        @php $no = 1; @endphp
                        <tbody class="table-border-bottom-0">
                            @foreach ($tiket as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->event->nama_event }}</td>
                                    <td>{{ $item->jenis_tiket }}</td>
                                    <td>Rp {{ number_format($item->harga_tiket, 0, ',', '.') }}</td>
                                    <td>{{ $item->kuota_tiket }}</td>
                                    <td>{{ $item->tiket_terjual }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button"
                                                class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="{{ route('tiket.edit', $item->id) }}"
                                                        class="dropdown-item">Edit</a>
                                                </li>
                                                <!-- Formulir untuk hapus -->
                                                <li>
                                                    <form action="{{ route('tiket.destroy', $item->id) }}" method="POST"
                                                        class="d-inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="dropdown-item"
                                                            onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Tersebut?')">Delete</button>
                                                    </form>
                                                </li>
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
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#dataTable');
    </script>
@endpush
