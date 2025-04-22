@extends('layouts.backend')

@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Data User</h5>
                    <a href="{{ route('user.pdf') }}" class="btn btn-sm btn-success" style="float: right">PDF</a>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        @php $no = 1; @endphp
                        <tbody class="table-border-bottom-0">
                            @foreach ($user as $item)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        @if ($item->is_admin == 1)
                                            Admin
                                        @else
                                            User
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->is_admin == 0)
                                            <button class="btn btn-danger btn-sm delete-user"
                                                    data-id="{{ $item->id }}"
                                                    data-name="{{ $item->name }}">
                                                Hapus
                                            </button>
                                        @endif
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

    @push('scriptjs')
        <!-- SweetAlert JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            // Script untuk konfirmasi hapus menggunakan SweetAlert
            document.querySelectorAll('.delete-user').forEach(function(button) {
                button.addEventListener('click', function() {
                    const userId = button.getAttribute('data-id');
                    const userName = button.getAttribute('data-name');

                    Swal.fire({
                        title: 'Anda yakin?',
                        text: "Data " + userName + " akan dihapus!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Hapus',
                        cancelButtonText: 'Batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Kirim request untuk menghapus user
                            window.location.href = '/user/' + userId + '/destroy';
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
