@extends('dashboard.layout.index')

@section('container')
<div class="container">
    <div class="card card-custom card-create border-0">
        <div class="card-body">
            <form action="/dashboard/produk/{{ $ukuran->produk_id }}/ukurans/{{ $ukuran->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                  <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="required form-label">Jenis ukuran :</label>
                                <select class="form-select" name="ukuran_id">
                                    @foreach ($ukurans as $value )
                                    <option value="{{ $value->id }}" {{ $value->id == $ukuran->ukuran_id ? 'selected' : '' }}>{{ $value->jenis_ukuran }}</option>
                                    @endforeach
                                  </select>
                                @error('ukuran_id')
                                <div class="invalid-feedback d-block">
                                  {{ $message }}
                                </div>
                              @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="required form-label">Stok :</label>
                                <input type="text" value="{{ $ukuran->stock }}" placeholder="Ukuran" name="stock" autocomplete="off" required="required" @error('stock')is-invalid @enderror class="form-control">
                                @error('stock')
                                <div class="invalid-feedback d-block">
                                  {{ $message }}
                                </div>
                              @enderror
                            </div>
                        </div>
                        <div class="col-12">
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
