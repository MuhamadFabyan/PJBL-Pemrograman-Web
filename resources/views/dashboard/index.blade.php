@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <h2>Dashboard</h2>
    <p>Selamat datang di UMKM Management!</p>

    <div class="row g-3 mt-3">
        <div class="col-md-3">
            <div class="card p-3">
                <h6>Total Stok Bahan</h6>
                <h3>0</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3">
                <h6>Total Pembelian</h6>
                <h3>0</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3">
                <h6>Total Pengeluaran</h6>
                <h3>Rp0</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3">
                <h6>Aktivitas Terbaru</h6>
                <h3>0</h3>
            </div>
        </div>
    </div>
</div>
@endsection