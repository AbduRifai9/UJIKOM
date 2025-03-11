@extends('layouts.backend')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Data Lokasi</h5>
                    <a href="{{ route('lokasi.create') }}" class="btn btn-sm btn-primary" style="float: right">Tambah</a>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lokasi</th>
                                <th>Alamat Lokasi</th>
                                <th>Kapasitas</th>
                                <th>Foto Lokasi</th>
                                <th>Lihat Lokasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        @php $no = 1; @endphp
                        <tbody class="table-border-bottom-0">
                            @foreach ($lokasi as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->nama_lokasi }}</td>
                                    <td>{{ $item->alamat_lokasi }}</td>
                                    <td>{{ $item->kapasitas }}</td>
                                    <td>
                                        <img src="{{ asset('/images/lokasi/' . $item->foto) }}" width="100">
                                    </td>
                                    <td>
                                        @if (!empty($item->url))
                                            <a href="#" onclick="Lokasi(); return false;" target="_blank"
                                                class="btn btn-success">
                                                Lihat Lokasi
                                            </a>
                                        @endif
                                    </td>
                                    {{-- @if (!empty($item->url))
                                            <a href="{{ $item->url }}" target="_blank" class="btn btn-success">
                                                Lihat Lokasi
                                            </a>
                                        @endif --}}
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
                                                    <a href="{{ route('lokasi.edit', $item->id) }}"
                                                        class="dropdown-item">Edit</a>
                                                </li>
                                                <!-- Formulir untuk hapus -->
                                                <li>
                                                    <form action="{{ route('lokasi.destroy', $item->id) }}" method="POST"
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
<script>
    function Lokasi() {
        let url = "{{ $item->url ?? '' }}"; // Jika null, default ke string kosong

        if (url.trim() !== "") {
            window.open(url, "_blank");
        }
    }
</script>
{{-- document.getElementById('output').innerHTML =
'<iframe src="{{ $item->url }}" width="100" height="100" style="border:0;" allowfullscreen></iframe>'; --}}
