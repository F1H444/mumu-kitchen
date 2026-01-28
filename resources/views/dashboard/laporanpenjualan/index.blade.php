@extends('dashboard.layout.index')

@section('container')
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
                            <h5 class="m-0 font-weight-bold text-primary">Laporan Penjualan</h5>
                        </div>
                        <div class="col-6 text-right d-flex">
                            <button type="button" class="btn btn-danger me-2 ms-auto" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fas fa-file-alt"></i>
                            </button>
                        </div>
                    </div>
                    <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0"
                        role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                        <thead>
                            <tr role="row">
                                <th style="width: 20px;">No
                                </th>
                                <th  class="text-center">No.Pesanan</th>
                                <th  class="text-center">Tanggal Pesanan</th>
                                <th  class="text-center">Total Harga</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pembayaran as $i => $value)
                            <tr>
                             <td>{{ $pembayaran->firstItem() + $i }}</td>

                               <td>{{ $value->no_pemesanan }}</td>
                               <td>{{ Carbon\Carbon::parse($value->created_at)->format('d-M-Y') }} </td>
                               <td>Rp.{{ number_format ($value->harga, 0, ',', '.') }}</td>
                                                            </tr>

                            @endforeach
                         </tbody>
                    </table>
                </div>
                {{ $pembayaran->links() }}
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('/dashboard/laporan/cetak_pdf') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <input type="text" name="date" id="" class="waktu" value="{{ date('Y-m-d') }}">
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary w-100">Download</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                    </div>
                  </div>
                </div>
              </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(".waktu").flatpickr(
        {
            dateFormat: "Y-m-d",
            defaultDate: "{{ request()->date }} "
            // onChange: function(date, datestr){
            //     window.location.href = "{{ url('/laporan/cetak_pdf') }}/?date" + datestr;
            // }
        }
    );
</script>
@endsection
