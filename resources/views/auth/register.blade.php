{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  databackend-assets-path="{{ asset('backend/assets/') }}"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Register | WaveFest</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('backend/assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('backend/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/css/pages/page-auth.css') }}" />
    <!-- Helpers -->
    <script src="{{ asset('backend/assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('backend/assets/js/config.js') }}"></script>
  </head>

  <body class="bg-light">
  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y min-vh-100 d-flex align-items-center justify-content-center">
      <div class="authentication-inner">
        <!-- Register Card -->
        <div class="card shadow-lg border-0 rounded-4">
          <div class="card-body p-4">
            <!-- Logo -->
            <div class="app-brand justify-content-center mb-3">
              <a href="/" class="app-brand-link gap-2 text-decoration-none">
                <span class="app-brand-logo demo">
                  <img src="{{ asset('frontend/assets/images/logo.png') }}" alt="Logo" width="40">
                </span>
                <span class="app-brand-text text-body fw-bolder fs-4">WaveFest</span>
              </a>
            </div>

            <h4 class="text-center mb-2">Buat Akun Baru 🚀</h4>
            <p class="text-center text-muted mb-4">Silakan isi data untuk mendaftar</p>

            <form method="POST" action="{{ route('register') }}">
              @csrf

              <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bx bx-user"></i></span>
                  <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" required autofocus placeholder="Nama lengkap">
                </div>
                @error('name')
    <span class="text-danger small">{{ $message }}</span>
@enderror
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                  <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" required placeholder="Email aktif">
                </div>
                @error('email')
    <span class="text-danger small">{{ $message }}</span>
@enderror
              </div>

              <div class="mb-3 form-password-toggle">
                <label class="form-label" for="password">Password</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    required placeholder="••••••••">
                  <span class="input-group-text"><i class="bx bx-hide"></i></span>
                </div>
                @error('password')
    <span class="text-danger small">{{ $message }}</span>
@enderror
              </div>

              <div class="mb-3 form-password-toggle">
                <label class="form-label" for="password-confirm">Konfirmasi Password</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="password-confirm" name="password_confirmation"
                    class="form-control" required placeholder="••••••••">
                  <span class="input-group-text"><i class="bx bx-hide"></i></span>
                </div>
              </div>

              <button type="submit" class="btn btn-primary d-grid w-100">Daftar Sekarang</button>
            </form>

            <p class="text-center mt-3">
              Sudah punya akun?
              <a href="{{ route('login') }}">Login di sini</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="{{ asset('backend/assets/vendor/libs/jquery/jquery.js') }}"></script>
  <script src="{{ asset('backend/assets/vendor/libs/popper/popper.js') }}"></script>
  <script src="{{ asset('backend/assets/vendor/js/bootstrap.js') }}"></script>
  <script src="{{ asset('backend/assets/vendor/js/menu.js') }}"></script>
  <script src="{{ asset('backend/assets/js/main.js') }}"></script>
</body>

</html>
