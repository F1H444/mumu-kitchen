@extends('dashboard.layout.index')

@section('container')
<div class="container">
    <div class="card card-custom card-create border-0">
        <div class="card-body">
            <form action="/dashboard/provinsi/{{ $provinsis->id }}/edit" method="POST" enctype="multipart/form-data">
                @csrf
                  <div class="row">
                        <div class="col-md-4">
                            <div class="mb-4">
                                <label class="required form-label">Nama Provinsi :</label>
                                <input type="text" value="{{ $provinsis->nama_provinsi }}" placeholder="Provinsi" name="nama_provinsi" autocomplete="off" required="required" @error('nama_provinsi')is-invalid @enderror class="form-control">
                                @error('nama_provinsi')
                                <div class="invalid-feedback d-block">
                                  {{ $message }}
                                </div>
                              @enderror
                            </div>
                        </div>
                        <div class="col-12 mt-5">
                          <button type="submit" class="btn btn-primary btn-sm mb-2 me-2">
                            <i class="las la-save"></i> Edit</button>
                          <a href="/dashboard/provinsi/"  type="button" class="btn btn-danger btn-sm mb-2 me-2">
                            <i class="las la-ban"> </i> Batal
                          </a>
                    </div>
                </form>
            </div>
         </div>
     </div>

     @endsection
