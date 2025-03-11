@extends('layouts.backend')
@section('content')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Data User</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            {{-- <th>Actions</th> --}}
                        </tr>
                    </thead>
                    @php $no = 1; @endphp
                    <tbody class="table-border-bottom-0">
                        @foreach ($user as $item)
                        <tr>
                            <th scope="row">{{ $loop->index+1 }}</th>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->is_admin ? 'Admin' : 'User' }}</td>
                            <td>
                                {{-- <div class="btn-group">
                                    <button type="button"
                                        class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                     <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a href="{{ route('user.edit', $item->id) }}" class="dropdown-item">Edit</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('user.show', $item->id) }}" class="dropdown-item">Show</a>
                                        </li>
                                        <!-- Formulir untuk hapus -->
                                        <li>
                                            <form action="{{ route('user.destroy', $item->id) }}" method="POST"
                                                class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="dropdown-item"
                                                    onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                            </form>
                                        </li>
                                    </ul> --}}
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

{{-- @extends('layouts.backend')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h6 class="mb-0 text-uppercase">ACCOUNT</h6>
    <hr>

    <div class="card">
        <div class="card-body">
            <div class="col-lg-2">
            </div>
            <table class="table mb-0 table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Is Admin ?</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $item)
                    <tr>
                        <th scope="row">{{ $loop->index+1 }}</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->is_admin ? 'Admin' : 'User' }}</td>
                        <td>

                            <a href="{{ route('user.edit', $item->id) }}" class="btn btn-warning px-5">Edit</a>
                            <a class="btn ripple btn-danger px-5" href="{{ route('user.destroy', $item->id) }}" onclick="event.preventDefault();
                                    document.getElementById('destroy-form').submit();">
                                Hapus
                            </a>

                            <form id="destroy-form" action="{{ route('user.destroy', $item->id) }}" method="POST"
                                class="d-none">
                                @method('DELETE')
                                @csrf
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection --}}
