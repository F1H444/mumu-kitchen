@extends('dashboard.layout.index')

@section('container')
<div class="container">
    <div class="card card-custom card-create">
        <div class="card-body">
            <form action="/dashboard/kategori/{{ $kategori->id }}/edit" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- @method('PUT') --}}
                 <div class="row">
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="required form-label">Nama kategori :</label>
                            <input value="{{ $kategori->nama_kategori }}" type="text" placeholder="Nama Kategori" name="nama_kategori" autocomplete="off" required="required" @error('nama_kategori')is-invalid @enderror class="form-control">
                            @error('nama_kategori')
                            <div class="invalid-feedback d-block">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                    </div>

                      <div class="col-md-4 mb-3">
                        <label class="required form-label">Foto</label>
                        <img src="{{ asset('storage/' . $kategori->gambar) }}" width="200" class="d-block">
                        <input type="file" accept="jpg, png, jpeg" name="gambar" class="form-control">
                      </div>
                       <div class="col-12">
                         <button type="submit" class="btn btn-primary btn-sm mb-2 me-2">
                           <i class="las la-save"></i> Edit</button>
                         <a href="/dashboard/kategori/"  type="button" class="btn btn-danger btn-sm mb-2 me-2">
                           <i class="las la-ban"> </i> Batal
                         </a>
                   </div>
             </form>
       </div>
    </div>
</div>

@endsection
