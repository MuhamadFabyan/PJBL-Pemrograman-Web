
<aside class="sidebar" id="sidebar">

    <div class="brand">
        <div class="brand-icon">
            <i class="bi bi-shop"></i>
        </div>
        <div>
            <h5>UMKM<span>Hub.</span></h5>
            <small>Management System</small>
        </div>
    </div>

    <div class="sidebar-label">MENU UTAMA</div>

    <nav class="nav-menu">
        <a href="{{ url('/dashboard') }}" class="nav-link">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ url('/stok-bahan') }}" class="nav-link">
            <i class="bi bi-box-seam"></i>
            <span>Stok Bahan</span>
        </a>

        <a href="{{ url('/pembelian') }}" class="nav-link">
            <i class="bi bi-cart3"></i>
            <span>Pembelian</span>
        </a>

        <a href="{{ url('/pengeluaran') }}" class="nav-link">
            <i class="bi bi-wallet2"></i>
            <span>Pengeluaran</span>
        </a>

        <div class="sidebar-label mt-4">ANALISIS & DATA</div>

        <a href="{{ url('/analisis-data') }}" class="nav-link">
            <i class="bi bi-graph-up-arrow"></i>
            <span>Analisis Data</span>
        </a>

        <a href="{{ url('/rekap-laporan') }}" class="nav-link">
            <i class="bi bi-file-earmark-bar-graph"></i>
            <span>Rekap Laporan</span>
        </a>

        <a href="{{ url('/import-export') }}" class="nav-link">
            <i class="bi bi-arrow-left-right"></i>
            <span>Import / Export</span>
        </a>

        <a href="{{ url('/catatan') }}" class="nav-link">
            <i class="bi bi-journal-text"></i>
            <span>Catatan</span>
        </a>
    </nav>

    <div class="sidebar-footer">
        <i class="bi bi-leaf"></i>
        <div>
            <strong>Grow Your Business</strong>
            <small>Manage smarter, grow better.</small>
        </div>
    </div>

</aside>
