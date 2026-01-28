@extends('dashboard.layout.index')

@section('container')
<div class="container">
    <div class="card card-custom card-create border-0">
        <div class="card-body">
              <form action="{{ route('kota.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label class="required form-label">Nama Kota :</label>
                                <input type="text" placeholder="Kota" name="nama_kota" autocomplete="off" required="required" @error('nama_kota')is-invalid @enderror class="form-control">
                                @error('nama_kota')
                                <div class="invalid-feedback d-block">
                                  {{ $message }}
                                </div>
                              @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-6">
                            <label class="required form-label">Provinsi :</label>
                            <select class="form-select" name="provinsi_id">
                             <option></option>
                             @foreach ($provinsis as $value )
                             <option value="{{ $value->id }}">{{ $value->nama_provinsi }}</option>
                             @endforeach
                            </select>

                            </div>
                       </div>

                    </div>

                    <div class="col-12 mt-5">
                          <button type="submit" class="btn btn-primary btn-sm mb-2 me-2">
                            <i class="las la-save"></i> Tambah</button>
                          <a href="/dashboard/kota/"  type="button" class="btn btn-danger btn-sm mb-2 me-2">
                            <i class="las la-ban"> </i> Batal
                          </a>
                    </div>
              </form>
       </div>
    </div>
</div>
@endsection
