@extends('layouts.backend')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Data Event</h5>
                    <a href="{{ route('event.create') }}" class="btn btn-sm btn-primary" style="float: right">Tambah</a>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Event</th>
                                {{-- <th>Deskripsi</th> --}}
                                <th>Poster</th>
                                <th>Tanggal Event</th>
                                {{-- <th>Waktu Event</th> --}}
                                <th>Lokasi Event</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        @php $no = 1; @endphp
                        <tbody class="table-border-bottom-0">
                            @foreach ($event as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->nama_event }}</td>
                                    {{-- <td>{{ $item->deskripsi }}</td> --}}
                                    <td>
                                        <img src="{{ asset('/images/event/' . $item->poster) }}" width="100">
                                    </td>
                                    <td>{{ $item->tanggal_mulai }}</td>
                                    {{-- <td>{{ $item->waktu_event }}</td> --}}
                                    <td>{{ $item->lokasi->nama_lokasi }}</td>
                                    <td class="event-status"
                                        data-start="{{ $item->tanggal_mulai }} {{ $item->waktu_mulai }}"
                                        data-end="{{ $item->tanggal_selesai }} {{ $item->waktu_selesai }}">
                                        {{ $item->status }}
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
                                                    <a href="{{ route('event.edit', $item->id) }}"
                                                        class="dropdown-item">Edit</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('event.show', $item->id) }}"
                                                        class="dropdown-item">Show</a>
                                                </li>
                                                <!-- Formulir untuk hapus -->
                                                <li>
                                                    <form action="{{ route('event.destroy', $item->id) }}" method="POST"
                                                        class="d-inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="button" class="dropdown-item btn-delete"
                                                            data-url="{{ route('event.destroy', $item->id) }}">
                                                            Delete
                                                        </button>
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
@push('scriptjs')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>

    <script>
        new DataTable('#dataTable');
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusCells = document.querySelectorAll('.event-status');

            statusCells.forEach(cell => {
                const start = new Date(cell.dataset.start);
                const end = new Date(cell.dataset.end);
                const now = new Date();

                let status = '';

                if (now < start) {
                    status = 'Segera';
                } else if (now >= start && now <= end) {
                    status = 'Sedang Berlangsung';
                } else {
                    status = 'Selesai';
                }

                cell.textContent = status;
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btn-delete');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const url = this.getAttribute('data-url');

                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        text: "Anda yakin ingin menghapus data ini!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal',
                        customClass: {
                            popup: 'colored-toast' // gunakan styling jika ingin seragam
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = url;

                            const csrf = document.createElement('input');
                            csrf.type = 'hidden';
                            csrf.name = '_token';
                            csrf.value = '{{ csrf_token() }}';

                            const method = document.createElement('input');
                            method.type = 'hidden';
                            method.name = '_method';
                            method.value = 'DELETE';

                            form.appendChild(csrf);
                            form.appendChild(method);

                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>


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
                title: 'Berhasil!',
                customClass: {
                    popup: 'colored-toast'
                }
            });
        </script>
    @endif
@endpush
