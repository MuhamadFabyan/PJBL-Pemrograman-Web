@extends('layouts.app')

@section('content')

<style>
    .an-head { display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:16px; margin-bottom:24px; }
    .an-head h1 { font-size:28px; font-weight:800; color:#6b1a2b; margin:0; }
    .an-sub { color:#8a7f83; font-size:14px; margin-top:4px; }
    .an-filters { display:flex; gap:10px; flex-wrap:wrap; }
    .an-filters select { font-size:14px; font-weight:600; padding:10px 14px; border:1px solid #eee6e3; border-radius:12px; background:#fff; cursor:pointer; }
    .an-kpis { display:grid; grid-template-columns:repeat(3,1fr); gap:20px; margin-bottom:20px; }
    .an-kpi { background:#fff; border:1px solid #eee6e3; border-top:5px solid var(--c); border-radius:20px; padding:20px 22px; }
    .an-kpi small { color:#8a7f83; font-size:13px; }
    .an-kpi .val { font-size:24px; font-weight:800; margin-top:4px; }
    .an-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:20px; }
    .an-card { background:#fff; border:1px solid #eee6e3; border-radius:20px; padding:24px; }
    .an-card.wide { grid-column:1 / -1; }
    .an-card h3 { font-size:16px; font-weight:700; margin:0; }
    .an-card .s { font-size:12px; color:#8a7f83; margin:2px 0 16px; }
    .an-chart { position:relative; height:300px; }
    .an-insights { list-style:none; padding:0; margin:0; display:grid; gap:12px; }
    .an-insights li { display:flex; gap:12px; font-size:14px; line-height:1.5; padding:12px 14px; background:#fbf7f5; border-radius:12px; }
    @media (max-width:1000px) { .an-kpis, .an-grid { grid-template-columns:1fr; } }
</style>
<div class="container-fluid">
   <div class="an-head">
        <div>
            <h1>Analisis Data</h1>
            <div class="an-sub">Visualisasi pembelian dan pengeluaran bahan baku</div>
        </div>
        <div class="an-filters">
            <select id="filterPeriode">
                <option value="3">3 bulan terakhir</option>
                <option value="6" selected>6 bulan terakhir</option>
                <option value="12">12 bulan terakhir</option>
            </select>
            <select id="filterKategori">
                <option value="semua">Semua kategori</option>
            </select>
        </div>
    </div>

    <div class="an-kpis">
        <div class="an-kpi" style="--c:#6b1a2b"><small>Jumlah Transaksi</small><div class="val" id="kpiTrx">-</div></div>
        <div class="an-kpi" style="--c:#3f9468"><small>Total Pengeluaran</small><div class="val" id="kpiTotal">-</div></div>
        <div class="an-kpi" style="--c:#e0a043"><small>Rata-rata per Transaksi</small><div class="val" id="kpiRata">-</div></div>
    </div>

    <div class="an-grid">
        <div class="an-card wide">
            <h3>Sebaran Harga vs Jumlah Beli</h3>
            <p class="s">Scatter plot: setiap titik adalah satu pembelian bahan baku</p>
            <div class="an-chart"><canvas id="chartScatter"></canvas></div>
        </div>

        <div class="an-card">
            <h3>Pengeluaran per Kategori</h3>
            <p class="s">Total pengeluaran tiap kategori (rupiah)</p>
            <div class="an-chart"><canvas id="chartKategori"></canvas></div>
        </div>

        <div class="an-card">
            <h3>Ringkasan Analisis</h3>
            <p class="s">Temuan otomatis dari data yang dipilih</p>
            <ul class="an-insights" id="insights"></ul>
        </div>
    </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<script src="{{ asset('js/analysis.js') }}"></script>

@endsection
