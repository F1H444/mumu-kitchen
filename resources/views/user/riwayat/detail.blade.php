@extends('user.layout.index')

@section('container')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Detail Pesanan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/riwayat">Riwayat Pesanan</a></li>
            <li class="breadcrumb-item active">#{{ $pembayaran->no_pemesanan }}</li>
        </ol>

        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card overflow-hidden" style="border-radius: 20px; border: 1px solid rgba(255,255,255,0.05);">
                    <div class="card-body p-0">
                        @include('dashboard.partials.invoice_modal_content', ['item' => $pembayaran])

                        <div class="p-4 bg-glass border-top border-glass d-flex gap-2 justify-content-end">
                            @if ($pembayaran->status == 'menunggupembayaran')
                                <button id="bayar" class="btn btn-success px-4 py-2" style="border-radius: 10px;">
                                    <i class="fas fa-credit-card me-2"></i> Bayar Sekarang
                                </button>
                                <button id="batal" class="btn btn-outline-danger px-4 py-2" style="border-radius: 10px;"
                                    data-id="{{ $pembayaran->id }}">
                                    <i class="fas fa-times me-2"></i> Batalkan
                                </button>
                            @endif
                            <a href="/riwayat" class="btn btn-secondary px-4 py-2"
                                style="border-radius: 10px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #fff;">
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    @if ($pembayaran->status == 'menunggupembayaran')
        <script>
            document.getElementById('bayar').onclick = function(e) {
                e.preventDefault();
                snap.pay('{{ $pembayaran->snap_token }}', {
                    onSuccess: function(result) {
                        window.location.reload();
                    },
                    onPending: function(result) {
                        window.location.reload();
                    },
                    onError: function(result) {
                        window.location.reload();
                    }
                });
            };

            $('#batal').on('click', function() {
                var id = $(this).data('id')
                Swal.fire({
                    title: 'Batalkan Pesanan?',
                    text: "Pesanan yang dibatalkan tidak dapat dikembalikan",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Batalkan',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ url('/riwayat/pembayaran/' . $pembayaran->id . '/kembalistatuscancel') }}',
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                status: 'pesananbatal',
                                payment_status: 'batal'
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Dibatalkan!',
                                    'Pesanan berhasil dibatalkan.',
                                    'success'
                                ).then(() => {
                                    window.location.href = '/riwayat';
                                });
                            },
                            error: function() {
                                Swal.fire(
                                    'Error!',
                                    'Gagal membatalkan pesanan.',
                                    'error'
                                );
                            }
                        });
                    }
                })
            });
        </script>
    @endif
@endsection
