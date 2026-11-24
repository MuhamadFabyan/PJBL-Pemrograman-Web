@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Laporan Keuangan</h1>
        <div>
            <a href="{{ route('reports.export.excel', request()->query()) }}" class="btn btn-success btn-sm">Export Excel</a>
            <a href="{{ route('reports.export.pdf', request()->query()) }}" class="btn btn-danger btn-sm">Export PDF</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Form Search, Filter Rentang Tanggal, Kategori & Sorting -->
    <div class="card border-0 shadow-sm mb-3">
        <div class="card-body">
            <form method="GET" action="{{ route('rekap-laporan.index') }}" class="row g-2 align-items-end">
                <div class="col-md-3">
                    <label class="form-label small text-muted mb-1">Cari Judul</label>
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari judul pengeluaran...">
                </div>
                <div class="col-md-2">
                    <label class="form-label small text-muted mb-1">Kategori</label>
                    <select name="category" class="form-select">
                        <option value="">-- Semua --</option>
                        <option value="Bahan Baku" {{ request('category') == 'Bahan Baku' ? 'selected' : '' }}>Bahan Baku</option>
                        <option value="Operasional" {{ request('category') == 'Operasional' ? 'selected' : '' }}>Operasional</option>
                        <option value="Kemasan" {{ request('category') == 'Kemasan' ? 'selected' : '' }}>Kemasan</option>
                        <option value="Pemasaran" {{ request('category') == 'Pemasaran' ? 'selected' : '' }}>Pemasaran</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small text-muted mb-1">Dari Tanggal</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
                </div>
                <div class="col-md-2">
                    <label class="form-label small text-muted mb-1">Sampai Tanggal</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
                </div>
                <div class="col-md-1">
                    <label class="form-label small text-muted mb-1">Urutkan</label>
                    <select name="sort_dir" class="form-select">
                        <option value="desc" {{ request('sort_dir') == 'desc' ? 'selected' : '' }}>Terbaru</option>
                        <option value="asc" {{ request('sort_dir') == 'asc' ? 'selected' : '' }}>Terlama</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex gap-1">
                    <button type="submit" class="btn btn-dark w-100">Terapkan</button>
                    <a href="{{ route('rekap-laporan.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Judul Pengeluaran</th>
                        <th>Kategori</th>
                        <th>Nominal</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $index => $item)
                    <tr>
                        <td>{{ $data->firstItem() + $index }}</td>
                        <td>{{ $item->expense_date }}</td>
                        <td class="fw-semibold">{{ $item->title }}</td>
                        <td><span class="badge bg-secondary">{{ $item->category }}</span></td>
                        <td>Rp {{ number_format($item->amount, 0, ',', '.') }}</td>
                        <td>{{ $item->description ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Data laporan tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $data->links() }}
            </div>
        </div>
    </div>
</div>

@endsection