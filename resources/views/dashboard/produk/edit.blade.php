@extends('dashboard.layout.index')

@section('container')
    <div class="container-fluid px-4 py-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-1">
                        <li class="breadcrumb-item small"><a href="/dashboard/produk"
                                class="text-decoration-none text-muted uppercase letter-spacing-1">Master Produk</a></li>
                        <li class="breadcrumb-item small active text-primary uppercase letter-spacing-1" aria-current="page">
                            Edit Produk</li>
                    </ol>
                </nav>
                <h1 class="h3 mb-0 text-white font-weight-bold">Edit <span class="text-primary">Produk</span></h1>
            </div>
            <a href="/dashboard/produk" class="btn btn-outline-secondary btn-sm d-flex align-items-center">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-lg-5">
                        <form action="/dashboard/produk/{{ $produk->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row g-4">
                                <!-- Left Column: Basic Info -->
                                <div class="col-md-7">
                                    <div class="mb-4">
                                        <label class="form-label text-muted small fw-bold text-uppercase mb-2">Nama Produk
                                            <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_produk"
                                            class="form-control form-control-lg @error('nama_produk') is-invalid @enderror"
                                            placeholder="Masukkan nama produk..."
                                            value="{{ old('nama_produk', $produk->nama_produk) }}" required>
                                        @error('nama_produk')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-sm-6">
                                            <label class="form-label text-muted small fw-bold text-uppercase mb-2">Kategori
                                                <span class="text-danger">*</span></label>
                                            <select
                                                class="form-select form-control-lg @error('kategori_id') is-invalid @enderror"
                                                name="kategori_id" required>
                                                @foreach ($kategori as $value)
                                                    <option value="{{ $value->id }}"
                                                        {{ old('kategori_id', $produk->kategori_id) == $value->id ? 'selected' : '' }}>
                                                        {{ $value->nama_kategori }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('kategori_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label text-muted small fw-bold text-uppercase mb-2">Stok
                                                <span class="text-danger">*</span></label>
                                            <input type="number" name="stok"
                                                class="form-control form-control-lg @error('stok') is-invalid @enderror"
                                                placeholder="Contoh: 100" value="{{ old('stok', $produk->stok) }}" required>
                                            @error('stok')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label text-muted small fw-bold text-uppercase mb-2">Harga (Rp)
                                            <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-dark border-end-0 text-white">Rp</span>
                                            <input type="number" name="harga"
                                                class="form-control form-control-lg @error('harga') is-invalid @enderror"
                                                placeholder="0" value="{{ old('harga', $produk->harga) }}" required>
                                        </div>
                                        @error('harga')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label text-muted small fw-bold text-uppercase mb-2">Deskripsi
                                            Produk <span class="text-danger">*</span></label>
                                        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="5"
                                            placeholder="Tuliskan deskripsi lengkap produk..." required>{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                                        @error('deskripsi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Right Column: Image Upload -->
                                <div class="col-md-5">
                                    <label
                                        class="form-label text-muted small fw-bold text-uppercase mb-2 text-center d-block">Gambar
                                        Produk</label>

                                    <div class="image-upload-wrapper mb-3">
                                        <input type="file" name="gambar" id="productImage" class="d-none"
                                            accept="image/*" onchange="previewImage()">
                                        <label for="productImage"
                                            class="image-preview-container d-flex flex-column align-items-center justify-content-center border border-2 border-dashed rounded-4 p-0 cursor-pointer overflow-hidden"
                                            id="imagePreview">
                                            @if ($produk->gambar && Storage::disk('public')->exists($produk->gambar))
                                                <img src="{{ asset('storage/' . $produk->gambar) }}" class="rounded-4"
                                                    style="width: 100%; height: 100%; object-fit: cover;">
                                            @else
                                                <div class="text-center p-4">
                                                    <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                                                    <span class="fw-bold text-white mb-1 d-block">Klik untuk Ganti</span>
                                                    <span class="text-muted small">Maksimal 5MB (JPG, PNG)</span>
                                                </div>
                                            @endif
                                        </label>
                                        @error('gambar')
                                            <div class="text-danger small mt-2 d-block text-center">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="alert alert-info bg-opacity-10 border-0 rounded-3 small">
                                        <i class="fas fa-info-circle me-2"></i> Tips: Kosongkan jika tidak ingin mengubah
                                        gambar produk.
                                    </div>
                                </div>
                            </div>

                            <hr class="my-5 border-secondary opacity-25">

                            <div class="d-flex align-items-center justify-content-end gap-3">
                                <a href="/dashboard/produk"
                                    class="btn btn-lg btn-light px-5 text-dark fw-bold border-0">Batal</a>
                                <button type="submit" class="btn btn-lg btn-primary px-5 fw-bold">Update Produk</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        :root {
            --primary: #FF8C00;
            --dark: #050505;
            --surface: #101010;
            --glass-border: rgba(255, 255, 255, 0.07);
        }

        .letter-spacing-1 {
            letter-spacing: 1px;
        }

        .uppercase {
            text-transform: uppercase;
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .card {
            background-color: var(--surface);
            border: 1px solid var(--glass-border) !important;
        }

        .form-control-lg,
        .form-select-lg {
            padding: 0.75rem 1rem;
            font-size: 1rem;
            background-color: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--glass-border);
            color: white;
        }

        .form-select option {
            background-color: #fff;
            color: #000;
        }

        .form-control:focus,
        .form-select:focus {
            background-color: rgba(255, 255, 255, 0.05);
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(255, 140, 0, 0.1);
            color: white;
        }

        .text-primary {
            color: var(--primary) !important;
        }

        .btn-primary {
            background-color: var(--primary) !important;
            border-color: var(--primary) !important;
            color: #fff !important;
            font-weight: 700;
        }

        .btn-primary:hover {
            background-color: #e67e00 !important;
            border-color: #e67e00 !important;
        }

        .form-label {
            color: #aaa !important;
        }

        .form-label span.text-danger {
            color: #ff4d4d !important;
        }

        .image-preview-container {
            width: 100%;
            aspect-ratio: 1 / 1;
            transition: all 0.3s ease;
            background-color: rgba(255, 255, 255, 0.02);
            overflow: hidden;
            position: relative;
        }

        .image-preview-container:hover {
            background-color: rgba(255, 255, 255, 0.05);
            border-color: var(--primary) !important;
        }

        .image-preview-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: inherit;
        }

        textarea.form-control {
            background-color: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--glass-border);
            color: white;
        }
    </style>
@endsection

@section('script')
    <script>
        function previewImage() {
            const image = document.querySelector('#productImage');
            const previewContainer = document.querySelector('#imagePreview');
            const file = image.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewContainer.innerHTML = `<img src="${e.target.result}" class="rounded-4">`;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
