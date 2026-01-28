@extends('dashboard.layout.index')

@section('container')
<div class="container">
    <div class="card card-custom card-create border-0">
        <div class="card-body">
            <form action="/dashboard/ukuran/{{ $ukurans->id }}/edit" method="POST" enctype="multipart/form-data">
                @csrf
                  <div class="row">
                        <div class="col-md-4">
                            <div class="mb-4">
                                <label class="required form-label">Jenis ukuran :</label>
                                <input type="text" value="{{ $ukurans->jenis_ukuran }}" placeholder="Ukuran" name="jenis_ukuran" autocomplete="off" required="required" @error('jenis_ukuran')is-invalid @enderror class="form-control">
                                @error('jenis_ukuran')
                                <div class="invalid-feedback d-block">
                                  {{ $message }}
                                </div>
                              @enderror
                            </div>
                        </div>
                        <div class="col-12 mt-5">
                          <button type="submit" class="btn btn-primary btn-sm mb-2 me-2">
                            <i class="las la-save"></i> Edit</button>
                          <a href="/dashboard/ukuran/"  type="button" class="btn btn-danger btn-sm mb-2 me-2">
                            <i class="las la-ban"> </i> Batal
                          </a>
                    </div>
                </form>
            </div>
         </div>
     </div>

     @endsection
