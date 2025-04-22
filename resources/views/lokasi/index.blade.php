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
                                <th>Kapasitas</th>
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
                                    <td>{{ $item->kapasitas }}</td>
                                    <td>
                                        <div id="map{{ $item->id }}" style="height: 100px; border-radius: 8px;"></div>
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
                                                    <form id="delete-form-{{ $item->id }}"
                                                        action="{{ route('lokasi.destroy', $item->id) }}" method="POST"
                                                        class="d-inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="dropdown-item delete-btn"
                                                            data-id="{{ $item->id }}">Delete</button>
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

<!-- SweetAlert2 JS & CSS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <!-- Inisialisasi Map untuk setiap lokasi -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @foreach ($lokasi as $item)
                // Pastikan variabel latitude dan longitude tersedia. Gunakan default jika nilainya null.
                var lat = {{ $item->latitude ?? '-2.5489' }};
                var lng = {{ $item->longitude ?? '118.0149' }};

                // Inisialisasi map dengan ID unik, misal "map1", "map2", dst.
                var map{{$item->id}} = L.map('map{{ $item->id }}').setView([lat, lng], 15);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '© OpenStreetMap'
                }).addTo(map{{$item->id}});
                L.marker([lat, lng]).addTo(map{{$item->id}});
            @endforeach
        });
    </script>

    <script>
        // Handle the delete confirmation using SweetAlert
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault(); // Mencegah form untuk langsung dikirimkan

                    const formId = `delete-form-${this.getAttribute('data-id')}`;

                    // Tampilkan SweetAlert konfirmasi
                    Swal.fire({
                        title: 'Apakah Anda Yakin?',
                        text: 'Data ini akan dihapus secara permanen!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Hapus',
                        cancelButtonText: 'Batal',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById(formId)
                                .submit(); // Kirimkan form jika dikonfirmasi
                        }
                    });
                });
            });
        });
    </script>
@endpush

{{-- document.getElementById('output').innerHTML =
'<iframe src="{{ $item->url }}" width="100" height="100" style="border:0;" allowfullscreen></iframe>'; --}}
