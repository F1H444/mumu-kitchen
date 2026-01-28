@extends('front.layouts.main')
@section('container')

<style>
    @media (min-width: 1025px) {
            .h-custom {
            height: 100vh !important;
            }
            }

            .horizontal-timeline .items {
            border-top: 2px solid #ddd;
            }

            .horizontal-timeline .items .items-list {
            position: relative;
            margin-right: 0;
            }

            .horizontal-timeline .items .items-list:before {
            content: "";
            position: absolute;
            height: 8px;
            width: 8px;
            border-radius: 50%;
            background-color: #ddd;
            top: 0;
            margin-top: -5px;
            }

            .horizontal-timeline .items .items-list {
            padding-top: 15px;
            }
</style>
<section class="h-100 h-custom" style="margin-bottom: 200px">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-6">
          <div class="card border-top border-bottom border-3" style="border-color: #59ab6e !important;">

            <div class="card-body p-5">
                <a href="{{ url('/riwayat') }}" class="btn btn-primary btn-sm mb-2"><i class="fas fa-arrow-left"></i> Kembali</a>
             <p class="lead fw-bold mb-5 text-center" style="color: #59ab6e;">Detail Pesanan</p>
              <div class="row">
                <div class="col-md-4 mb-3">
                  <p class="small text-muted mb-1">Tanggal Pesan</p>{{ Carbon\Carbon::parse($pembayaran->created_at)->format('d-M-Y') }}
                </div>
                <div class="col-md-4 mb-3">
                  <p class="small text-muted mb-1">No. Pesanan</p>{{$pembayaran->no_pemesanan}}

                </div>
                <div class="col mb-3">
                    <p class="small text-muted mb-1">No. Invoice</p>{{ $pembayaran->no_invoice }}

                  </div>
                  <div class="col mb-3">
                    <p class="small text-muted mb-1">Catatan</p>{{ $pembayaran->catatan }}

                  </div>
              </div>

              @foreach  ($pembayaran->pesanan as $psn)


              <div class="mx-n5 px-5 py-4" style="background-color: #f2f2f2;">
                <div class="row">
                  <div class="col-md-8">
                    <p>Nama Produk</p>
                  </div>
                  <div class="col-md-4">
                    <p>{{ $psn->produk->nama_produk }} ( {{ $psn->kuantitas }} )</>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-8">
                    <p class="mb-0">Harga Produk</p>
                  </div>
                  <div class="col-md-4 ">
                    <p class="mb-0">Rp. {{ number_format ($psn->produk->harga, 0, ',', '.') }}</p>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                      <p class="mb-0">Subtotal</p>
                    </div>
                    <div class="col-md-4 ">
                      <p class="mb-0">Rp. {{ number_format ( $psn->sub_total, 0, ',', '.') }}</p>
                    </div>
                  </div>
                <div class="row">
                    <div class="col-md-8 ">
                      <p class="mb-0">Ongkir</p>
                    </div>
                    <div class="col-md-4 ">
                      <p class="mb-0">Rp.{{  number_format ( $pembayaran->pengiriman->harga_ongkir, 0, ',', '.') }}</p>
                    </div>
                  </div>
              </div>
              @endforeach

              <div class="row my-4">
                <div class="col-md-8 ">
                  <p class="lead fw-bold mb-0" style="color: #59ab6e">Total Belanja</p>
                </div>
                <div class="col-md-4 ">
                    <p class="lead fw-bold mb-0" style="color: #59ab6e;">Rp. {{ number_format($psn->pembayaran->harga, 0, ',','.' )}}</p>
                  </div>

                  @if ($pembayaran->status == 'menunggupembayaran')
                  <button id="bayar" class="btn btn-success btn-sm mt-2"> Bayar Sekarang</button>
                  <button id="batal" class="btn btn-danger btn-sm mt-2 cancel"> Batalkan Pesanan</button>

                  @endif


              </div>

              
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@section('script')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
</script>
@if ($pembayaran->status == 'menunggupembayaran')
    <script>
        $('#bayar').on('click', function(e) {
            e.preventDefault();
            snap.pay('{{ $pembayaran->snap_token }}', {
                onSuccess: function(result) {
                    console.log(result);
                    window.location.href = '/riwayat'
                }
            });
        })
    </script>
    @endif
    <script>
        $('#batal').on('click', function() {
                    var id = $(this).data('id')
                    Swal.fire({
                        title: 'Apakah Anda yakin ingin batalkan pesanan',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Tidak',
                        showLoaderOnConfirm: true,
                        preConfirm: () => {
                            return $.ajax({
                                url: '{{ url('/riwayat/pembayaran/' . $pembayaran->id. '/kembalistatuscancel') }}',
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ @csrf_token() }}'
                                },
                                data: {
                                    status: 'pesananbatal',
                                    payment_status: 'batal',


                                },
                                error: function() {
                                    Swal.showValidationMessage('Gagal menghapus data')
                                }
                            });
                        }
                    }).then(result => {
                        if (result.isConfirmed) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 1000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: 'Berhasil Menghapus Data'
                            }).then(() => {
                                window.location.reload()
                            })
                            // Swal.fire('Berhasil Menghapus Data', '', 'success')
                        }
                    })
                });
    </script>
@endsection
