@extends('dashboard.layout.index')

@section('container')
    <div class="container-fluid px-4 py-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-white font-weight-bold">Master <span class="text-primary">Produk</span></h1>
            <a href="{{ url('/dashboard/produk/create') }}" class="btn btn-primary d-flex align-items-center">
                <i class="fas fa-plus-circle me-2"></i> Tambah Produk Baru
            </a>
        </div>

        @if (session()->has('successcreate') || session()->has('successupdate') || session()->has('successdelete'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                    Toast.fire({
                        icon: 'success',
                        title: '{{ session('successcreate') ?? (session('successupdate') ?? session('successdelete')) }}'
                    });
                });
            </script>
        @endif

        <div class="card shadow-sm border-0 overflow-hidden">
            <div class="card-header bg-dark py-3">
                <h6 class="m-0 font-weight-bold text-white small text-uppercase letter-spacing-1">Daftar Produk Katering</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="produkTable">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4" style="width: 50px;">No</th>
                                <th>Informasi Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th class="text-center" style="width: 150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produks as $i => $produk)
                                <tr>
                                    <td class="ps-4 text-muted">{{ $produks->firstItem() + $i }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="me-3 position-relative">
                                                <div class="me-3 position-relative">
                                                    @php
                                                        $imagePath =
                                                            $produk->gambar &&
                                                            file_exists(public_path('storage/' . $produk->gambar))
                                                                ? 'storage/' . $produk->gambar
                                                                : 'images/nasi-kebuli.webp';
                                                    @endphp
                                                    <img src="{{ asset($imagePath) }}" alt="{{ $produk->nama_produk }}"
                                                        class="rounded-3 shadow-sm border"
                                                        style="width: 60px; height: 60px; object-fit: cover;">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="fw-bold text-white mb-0">{{ $produk->nama_produk }}</div>
                                                <small class="text-muted d-block text-truncate" style="max-width: 200px;">
                                                    {{ Str::limit($produk->deskripsi, 50) }}
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill font-weight-600">
                                            {{ $produk->kategori->nama_kategori }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-primary">Rp
                                            {{ number_format($produk->harga, 0, ',', '.') }}</div>
                                    </td>
                                    <td>
                                        @if ($produk->stok > 0)
                                            <span
                                                class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill font-weight-600">
                                                <i class="fas fa-check-circle me-1"></i> {{ $produk->stok }} item
                                            </span>
                                        @else
                                            <span
                                                class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill font-weight-600">
                                                <i class="fas fa-times-circle me-1"></i> Habis
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ url('/dashboard/produk/' . $produk->id . '/edit') }}"
                                                class="btn btn-sm btn-outline-info border-0 shadow-none"
                                                title="Edit Produk">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button"
                                                class="btn btn-sm btn-outline-danger border-0 shadow-none hapus"
                                                data-id="{{ $produk->id }}" title="Hapus Produk">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        Showing {{ $produks->firstItem() }} to {{ $produks->lastItem() }} of {{ $produks->total() }}
                        entries
                    </div>
                    <div>
                        {{ $produks->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Minimal Clean Up */
        .table-responsive {
            overflow-x: auto;
        }

        .text-primary {
            color: var(--primary) !important;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background-color: #e67e00;
            border-color: #e67e00;
        }
    </style>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.hapus').on('click', function() {
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Hapus Produk?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    background: '#1e1e1e',
                    color: '#fff'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ url('dashboard/produk') }}/' + id,
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            data: {
                                _method: 'DELETE'
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Terhapus!',
                                    text: 'Produk berhasil dihapus.',
                                    background: '#1e1e1e',
                                    color: '#fff'
                                }).then(() => {
                                    window.location.reload();
                                });
                            },
                            error: function(xhr) {
                                let errorMessage =
                                    'Terjadi kesalahan saat menghapus data.';
                                if (xhr.responseJSON && xhr.responseJSON.message) {
                                    errorMessage = xhr.responseJSON.message;
                                }

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: errorMessage,
                                    background: '#1e1e1e',
                                    color: '#fff'
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
