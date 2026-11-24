@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h1 class="mb-3">Import - Export</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-3 mb-4">
        <!-- Card Export -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Export Laporan Keuangan</h5>
                    <p class="text-muted small">Unduh seluruh data laporan keuangan (total <strong>{{ $totalData }}</strong> data tersimpan) ke dalam format Excel atau PDF.</p>
                    <div class="d-flex gap-2 mt-3">
                        <a href="{{ route('reports.export.excel') }}" class="btn btn-success">Download Excel (.xlsx)</a>
                        <a href="{{ route('reports.export.pdf') }}" class="btn btn-danger">Download PDF (.pdf)</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Import -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Import Data dari Excel</h5>
                    <p class="text-muted small">Unggah file Excel (.xlsx / .xls / .csv) dengan kolom header: <code>judul</code>, <code>kategori</code>, <code>nominal</code>, <code>tanggal</code>, <code>keterangan</code>.</p>
                    <form action="{{ route('reports.import.excel') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                        @csrf
                        <div class="input-group">
                            <input type="file" name="file" class="form-control" accept=".xlsx,.xls,.csv" required>
                            <button type="submit" class="btn btn-primary">Upload & Import</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Preview 5 Data Terbaru -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h6 class="fw-bold mb-3">5 Data Terbaru di Database</h6>
            <table class="table table-sm table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Nominal</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentData as $item)
                    <tr>
                        <td>{{ $item->expense_date }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->category }}</td>
                        <td>Rp {{ number_format($item->amount, 0, ',', '.') }}</td>
                        <td>{{ $item->description ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection