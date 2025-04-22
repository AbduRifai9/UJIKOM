@extends('layouts.backend')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Dashboard Header -->
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Selamat Datang
                                    @guest
                                    @else
                                        <b>{{ Auth::user()->name }}</b>
                                    @endguest! 🎉
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dashboard Stats -->
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card card-border-shadow-primary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="avatar me-4">
                                <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-calendar"></i></span>
                            </div>
                            <h4 class="mb-0">{{ $eventCount }}</h4>
                        </div>
                        <p class="mt-3">Total Event</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card card-border-shadow-warning h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="avatar me-4">
                                <span class="avatar-initial rounded bg-label-warning"><i
                                        class="menu-icon tf-icons bx bx ms-1 mt-1 me-1"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="17" height="20" fill="currentColor"
                                            class="bi bi-ticket-perforated-fill mb-1" viewBox="0 0 16 16">
                                            <path
                                                d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6zm4-1v1h1v-1zm1 3v-1H4v1zm7 0v-1h-1v1zm-1-2h1v-1h-1zm-6 3H4v1h1zm7 1v-1h-1v1zm-7 1H4v1h1zm7 1v-1h-1v1zm-8 1v1h1v-1zm7 1h1v-1h-1z" />
                                        </svg></i></span>
                            </div>
                            <h4 class="mb-0">{{ $tiketTerjual }}</h4>
                        </div>
                        <p class="mt-3">Tiket Terjual</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card card-border-shadow-success h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="avatar me-4">
                                <span class="avatar-initial rounded bg-label-success"><i
                                        class="bx bx-dollar-circle"></i></span>
                            </div>
                            <h5 class="mb-0">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h5>
                        </div>
                        <p class="mt-3">Pendapatan Total</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card card-border-shadow-danger h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="avatar me-4">
                                <span class="avatar-initial rounded bg-label-danger"><i class="bx bx-user"></i></span>
                            </div>
                            <h4 class="mb-0">{{ $userCount }}</h4>
                        </div>
                        <p class="mt-3">Total User</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
