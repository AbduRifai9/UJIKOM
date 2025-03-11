@extends('layouts.backend')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
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
        </div>
        <div class="row">
            <div class="col-sm-6 col-lg-3 mb-6">
                <div class="card card-border-shadow-warning h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="avatar me-4">
                                <span class="avatar-initial rounded bg-label-warning"><i
                                        class="bx bi-person-circle"></i></span>
                            </div>
                            {{-- <h4 class="mb-0">{{  }}</h4> --}}
                        </div>
                        <p class="mt-3">Data User</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-6">
                <div class="card card-border-shadow-danger h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="avatar me-4">
                                <span class="avatar-initial rounded bg-label-danger"><i
                                        class="bx bi-megaphone-fill"></i></span>

                            </div>
                            {{-- <h4 class="mb-0">{{  }}</h4> --}}
                        </div>
                        <p class="mt-3">Data Pengumuman</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-6">
                <div class="card card-border-shadow-info h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="avatar me-4">
                                <span class="avatar-initial rounded bg-label-info"><i class="bx bx-layout"></i></span>
                            </div>
                            {{-- <h4 class="mb-0">{{  }}</h4> --}}
                        </div>
                        <p class="mt-3">Data Berita Fakultas</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
