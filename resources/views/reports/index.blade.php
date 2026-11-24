@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Laporan & Pengolahan Data</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tombol Export & Form Import -->
    <div class="d-flex justify-content-between mb-3">
        <div>
            <a href="{{ route('reports.export.excel') }}" class="btn btn-success">Export Excel</a>
            <a href="{{ route('reports.export.pdf') }}" class="btn btn-danger">Export PDF</a>
        </div>

        <form action="{{ route('reports.import.excel') }}" method="POST" enctype="multipart/form-data" class="d-flex">
            @csrf
            <input type="file" name="file" class="form-control me-2" required>
            <button type="submit" class="btn btn-primary">Import Excel</button>
        </form>
    </div>

    <!-- Form Search, Filter & Sorting -->
    <form method="GET" action="{{ route('reports.index') }}" class="row g-2 mb-3">
        <div class="col-md-4">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari nama item...">
        </div>
        <div class="col-md-3">
            <select name="kategori" class="form-select">
                <option value="">-- Semua Kategori --</option>
                <option value="Makanan" {{ request('kategori') == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                <option value="Minuman" {{ request('kategori') == 'Minuman' ? 'selected' : '' }}>Minuman</option>
            </select>
        </div>
        <div class="col-md-3">
            <select name="sort_dir" class="form-select">
                <option value="desc" {{ request('sort_dir') == 'desc' ? 'selected' : '' }}>Terbaru</option>
                <option value="asc" {{ request('sort_dir') == 'asc' ? 'selected' : '' }}>Terlama</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-dark w-100">Terapkan</button>
        </div>
    </form>

    <!-- Data Table -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Item</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $item)
            <tr>
                <td>{{ $data->firstItem() + $index }}</td>
                <td>{{ $item->nama_item }}</td>
                <td>{{ $item->kategori }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Data tidak ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div>
        {{ $data->links() }}
    </div>
</div>
@endsection