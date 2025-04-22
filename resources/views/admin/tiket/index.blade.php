@extends('layouts.backend')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Data Tiket</h5>
                    <a href="{{ route('admin.tiket.create') }}" class="btn btn-sm btn-primary" style="float: right">Tambah</a>
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
                                    <td>
                                        <div class="btn-group">
                                            <button type="button"
                                                class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="{{ route('admin.tiket.edit', $item->id) }}"
                                                        class="dropdown-item">Edit</a>
                                                </li>
                                                <!-- Formulir untuk hapus -->
                                                <li>
                                                    <form action="{{ route('admin.tiket.destroy', $item->id) }}"
                                                        method="POST" class="d-inline"
                                                        id="delete-form-{{ $item->id }}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="button" class="dropdown-item btn-delete"
                                                            data-url="{{ route('admin.tiket.destroy', $item->id) }}">Delete</button>
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
    <!-- SweetAlert2 and DataTables -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>

    <!-- Initialize DataTable -->
    <script>
        new DataTable('#dataTable');
    </script>

    <!-- SweetAlert2 for delete confirmation -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btn-delete');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const url = this.getAttribute('data-url');

                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        text: "Anda yakin ingin menghapus data tiket ini?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const form = document.getElementById('delete-form-' + url.split(
                                '/').pop());
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>

    <!-- Toast Notification for success -->
    @if (session('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            Toast.fire({
                icon: 'success',
                title: '{{ session('success') }}'
            });
        </script>
    @endif
@endpush
