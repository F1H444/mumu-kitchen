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
                                    <h5 class="m-0 font-weight-bold text-primary">Provinsi</h5>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ url('/dashboard/provinsi/create') }}" class="btn-sm  btn btn-primary">
                                        Tambah provinsi</a>
                                </div>
                            </div>
                            <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0"
                                role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th style="width: 20px;">No
                                        </th>

                                          <th class="text-center">Nama Provinsi
                                        </th>

                                        <th class="text-center" style="width: 62px;">Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($provinsis as $i=>$h)
                                   <tr>
                                    <td>{{ $provinsis->firstItem() + $i }}</td>
                                      <td class="text-center">{{ $h->nama_provinsi }}</td>

                                      <td>
                                         <div class="d-flex">
                                               <a href="{{ url('/dashboard/provinsi/'.$h->id.'/edit') }}" class="btn btn-info me-2">
                                                   Edit
                                               </a>
                                            {{-- <form method="POST" action="{{ url('/dashboard/provinsi/'.$h->id) }}">
                                                   @method('DELETE')
                                                   @csrf
                                                   <button type="submit" class="btn btn-danger">
                                                       Hapus
                                                   </button>
                                            </form> --}}
                                            <button type="submit"
                                               class="btn btn-danger menu-link px-3 text-white hapus w-100 justify-content-center"
                                               data-id="{{ $h->id }}"><i class="fas fa-trash"></i>
                                               Delete</button>
                                            </div>
                                         </td>
                                   </tr>
                                   @endforeach
                                </tbody>
                            </table>
                            <div class="pull-right">
                                {{ $provinsis->links() }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('table').on('click', '.hapus', function() {
                    var id = $(this).data('id')
                    Swal.fire({
                        title: 'Apakah Anda yakin ingin menghapus?',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Hapus',
                        showLoaderOnConfirm: true,
                        preConfirm: () => {
                            return $.ajax({
                                url: '{{ url('dashboard/provinsi') }}/' + id,
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ @csrf_token() }}'
                                },
                                data: {
                                    _method: 'DELETE'
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
                                window.location.href = "/dashboard/provinsi"
                            })
                            // Swal.fire('Berhasil Menghapus Data', '', 'success')
                        }
                    })
                });
    </script>
@endsection
