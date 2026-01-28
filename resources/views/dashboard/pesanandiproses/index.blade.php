@extends('dashboard.layout.index')

@section('container')
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row card-header py-3 justify-content-between">
                                <div class="col-6">
                                    <h5 class="m-0 font-weight-bold text-primary">Pesanan Diproses</h5>
                                </div>
                            </div>
                            <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0"
                                role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th style="width: 20px;">No
                                        </th>
                                        <th class="text-center">No.Pesanan</th>
                                        <th class="text-center">Penerima</th>
                                        <th class="text-center">Alamat</th>
                                        <th class="text-center">No.Invoice</th>
                                        <th class="text-center">Total Harga</th>

                                        <th class="text-center" style="width: 62px;">Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pembayaran as $i => $value)
                                        <tr>
                                            <td>{{ $pembayaran->firstItem() + $i }}</td>

                                            <td>{{ $value->no_pemesanan }}</td>
                                            <td>{{ $value->pengiriman->nama_penerima }}</td>
                                            <td>{{ $value->pengiriman->alamat }}</td>
                                            <td>{{ $value->no_invoice }}</td>
                                            <td>Rp.{{ number_format($value->harga, 0, ',', '.') }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-success me-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal-{{ $value->id }}">
                                                        <i class="fas fa-eye"></i>
                                                    </button>

                                                    <form
                                                        action="{{ url('/dashboard/pesanandiproses/' . $value->id . '/updateproses') }}"
                                                        method="POST" class="d-flex">

                                                        @csrf

                                                        <input type="hidden" name="status" value="pesanandikirim">

                                                        <button type="submit" class="btn btn-primary ">
                                                            <i class="fas fa-check"></i></button>

                                                        {{-- </Form>
                                                   <form action="{{ url('/dashboard/pesanandiproses/'. $value->id.  '/kembaliproses') }}" method="POST" class="d-flex">

                                                    @csrf

                                                     <input type="hidden" name="status"

                                                     value="pesananbaru">

                                                     <button class="btn btn-warning me-2 ms-2"
                                                    class="btn btn-primary  ">
                                                     <i class="fas fa-arrow-left"></i></button>

                                                    </Form> --}}

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $pembayaran->links() }}
                    </div>
                    @foreach ($pembayaran as $item)
                        <div class="modal fade" id="exampleModal-{{ $item->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Pesanan</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-0">
                                        @include('dashboard.partials.invoice_modal_content', [
                                            'item' => $item,
                                        ])
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
