<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - WaveFest</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card-checkout {
            border-radius: 20px;
            padding: 40px;
            background: #fff;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .card-checkout::before,
        .card-checkout::after {
            content: '';
            position: absolute;
            width: 50px;
            height: 50px;
            background: #f5f7fa;
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
            z-index: 1;
        }

        .card-checkout::before {
            left: -25px;
        }

        .card-checkout::after {
            right: -25px;
        }

        .section-title {
            font-weight: 700;
            font-size: 1.5rem;
        }

        .form-label {
            font-weight: 500;
        }

        .summary-box {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            border: 1px dashed #ccc;
        }

        .ticket-divider {
            border-top: 1px dashed #aaa;
            margin: 30px 0;
        }

        .btn-primary {
            font-weight: 600;
            font-size: 1.1rem;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-10">
                <div class="card shadow card-checkout">

                    <!-- Judul Event -->
                    <div class="text-center mb-4">
                        <h4 class="section-title mb-1">Konfirmasi Pemesanan</h4>
                        <small class="text-muted">WaveFest 2025</small>
                        <p class="text-muted mb-0">21 April 2025 • Indonesia</p>
                    </div>

                    <div class="ticket-divider"></div>

                    <!-- Ringkasan Tiket -->
                    <div class="summary-box mb-4">
                        <h5 class="mb-3">🎟️ Ringkasan Tiket</h5>
                        <div class="d-flex justify-content-between">
                            <span>Harga Satuan</span>
                            <span>Rp{{ number_format($tiket->harga_tiket) }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Jumlah Tiket</span>
                            <span>{{ $kuantitas }} Tiket</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Subtotal</span>
                            <span>Rp{{ number_format($tiket->harga_tiket * $kuantitas) }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold">
                            <span>Total Pembayaran</span>
                            <span class="text-primary">Rp{{ number_format($tiket->harga_tiket * $kuantitas) }}</span>
                        </div>
                    </div>

                    <!-- Form Pemesan -->
                    <h5 class="section-title mb-3">🧾 Data Pemesan</h5>
                    <form id="payment-form">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="{{ auth()->user()->name ?? '' }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ auth()->user()->email ?? '' }}" readonly>
                        </div>
                        <button type="button" id="pay-button" class="btn btn-primary w-100 py-3">
                            <i class="bi bi-credit-card me-2"></i>Bayar Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#pay-button').click(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Memproses Pembayaran',
                    text: 'Mohon tunggu...',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                // Ambil ID pemesanan secara aman dari blade
                const pemesananId = "{{ $pemesanan->id ?? '' }}";

                if (!pemesananId) {
                    Swal.close();
                    Swal.fire({
                        icon: 'error',
                        title: 'Data Tidak Lengkap',
                        text: 'ID pemesanan tidak ditemukan.'
                    });
                    return;
                }

                $.ajax({
                    url: `/pemesanan/${pemesananId}/bayar`,
                    method: 'GET',
                    success: function(response) {
                        Swal.close();

                        if (response.snap_token) {
                            window.snap.pay(response.snap_token, {
                                onSuccess: function(result) {
                                    updatePaymentStatus('success', pemesananId);
                                },
                                onPending: function(result) {
                                    updatePaymentStatus('pending', pemesananId);
                                },
                                onError: function(result) {
                                    updatePaymentStatus('error', pemesananId);
                                },
                                onClose: function() {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Pembayaran Dibatalkan',
                                        text: 'Anda menutup popup pembayaran'
                                    });
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Token Gagal Didapatkan',
                                text: 'Token pembayaran tidak tersedia.'
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.close();
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: xhr.responseJSON?.error ||
                                'Gagal memproses pembayaran.'
                        });
                    }
                });
            });

            function updatePaymentStatus(status, pemesananId) {
                const statusMessages = {
                    success: {
                        icon: 'success',
                        title: 'Pembayaran Berhasil',
                        text: 'Terima kasih atas pembayaran Anda'
                    },
                    pending: {
                        icon: 'info',
                        title: 'Pembayaran Tertunda',
                        text: 'Silakan selesaikan pembayaran Anda'
                    },
                    error: {
                        icon: 'error',
                        title: 'Pembayaran Gagal',
                        text: 'Transaksi tidak berhasil dilakukan'
                    }
                };

                $.ajax({
                    url: `/pemesanan/${pemesananId}/update-status`,
                    method: 'POST',
                    data: {
                        status: status
                    },
                    success: function(response) {
                        Swal.fire(statusMessages[status]).then(() => {
                            if (status === 'success') {
                                window.location.href = '/';
                            } else if (status === 'pending') {
                                window.location.href = `/pemesanan/${status}`;
                            }
                        });
                    },
                    error: function(xhr) {
                        console.error('Gagal update status:', xhr);
                    }
                });
            }
        });
    </script>
</body>

</html>

{{-- <!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
</script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        $('#pay-button').click(function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Memproses Pembayaran',
                text: 'Mohon tunggu...',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            $.ajax({
                url: '{{ route('pemesanan.proses') }}',
                method: 'POST',
                data: {
                    tiket_id: '{{ $tiket->id }}',
                    jumlah: '{{ $kuantitas }}',
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.close();

                    if (response.snap_token) {
                        window.snap.pay(response.snap_token, {
                            onSuccess: function(result) {
                                handlePaymentResult('success', result);
                            },
                            onPending: function(result) {
                                handlePaymentResult('pending', result);
                            },
                            onError: function(result) {
                                handlePaymentResult('error', result);
                            },
                            onClose: function() {
                                handlePaymentResult('close');
                            }
                        });
                    } else {
                        showError('Token pembayaran tidak valid');
                    }
                },
                error: function(xhr) {
                    handleAjaxError(xhr);
                }
            });
        });

        function handlePaymentResult(status, result = null) {
            const responses = {
                success: {
                    icon: 'success',
                    title: 'Pembayaran Berhasil',
                    text: 'Terima kasih atas pembayaran Anda',
                    redirect: '{{ route('pemesanan.success') }}'
                },
                pending: {
                    icon: 'info',
                    title: 'Pembayaran Pending',
                    text: 'Silakan selesaikan pembayaran Anda',
                    redirect: '{{ route('pemesanan.pending') }}'
                },
                error: {
                    icon: 'error',
                    title: 'Pembayaran Gagal',
                    text: 'Terjadi kesalahan saat pembayaran'
                },
                close: {
                    icon: 'warning',
                    title: 'Pembayaran Dibatalkan',
                    text: 'Anda menutup popup pembayaran'
                }
            };

            Swal.fire({
                icon: responses[status].icon,
                title: responses[status].title,
                text: responses[status].text
            }).then(() => {
                if (responses[status].redirect) {
                    window.location.href = responses[status].redirect;
                }
            });
        }

        function showError(message) {
            Swal.fire('Error', message, 'error');
        }
    });
</script> --}}
