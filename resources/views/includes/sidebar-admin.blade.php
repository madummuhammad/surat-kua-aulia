<nav class="sidenav shadow-right sidenav-light">
    <div class="sidenav-menu">
        <div class="nav accordion" id="accordionSidenav">
            <!-- Sidenav Menu Heading (Account)-->
            <!-- * * Note: * * Visible only on and above the sm breakpoint-->
            <div class="sidenav-menu-heading d-sm-none">Account</div>
            <!-- Sidenav Link (Alerts)-->
            <!-- * * Note: * * Visible only on and above the sm breakpoint-->
            <a class="nav-link d-sm-none" href="#!">
                <div class="nav-link-icon"><i data-feather="bell"></i></div>
                Alerts
                <span class="badge bg-warning-soft text-warning ms-auto">4 New!</span>
            </a>
            <!-- Sidenav Link (Messages)-->
            <!-- * * Note: * * Visible only on and above the sm breakpoint-->
            <a class="nav-link d-sm-none" href="#!">
                <div class="nav-link-icon"><i data-feather="mail"></i></div>
                Messages
                <span class="badge bg-success-soft text-success ms-auto">2 New!</span>
            </a>
            <!-- Sidenav Menu Heading (Core)-->
            <div class="sidenav-menu-heading">Menu</div>
            <!-- Sidenav Link (Dashboard)-->
            <a class="nav-link {{ (request()->is('admin/dashboard')) ? 'active' : '' }}" href="{{ route('admin-dashboard') }}">
                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                Dashboard
            </a>
            @if(auth()->user()->jabatan=='Admin')
            <a class="nav-link {{ (request()->is('admin/user*')) ? 'active' : '' }}" href="{{ route('user.index') }}">
                <div class="nav-link-icon"><i data-feather="user"></i></div>
                Data User
            </a>
            @endif
            @if(auth()->user()->jabatan=='Petugas' OR auth()->user()->jabatan=='Masyarakat' OR auth()->user()->jabatan=='Penghulu' OR auth()->user()->jabatan=='Kepala KUA')
            <div class="dropdown-divider"></div>
            <div class="nav-link">Pengajuan Surat</div>
            <a class="nav-link {{ (request()->is('admin/permohonan*')) ? 'active' : '' }}" href="{{ route('permohonan.index') }}">
                <div class="nav-link-icon"><i data-feather="permohonan"></i></div>
                Data Permohonan
            </a>
            @endif
            @if(auth()->user()->jabatan=='Petugas'  OR auth()->user()->jabatan=='Penghulu' OR auth()->user()->jabatan=='Kepala KUA')
            <div class="dropdown-divider"></div>
            <div class="nav-link">Surat Masuk</div>
            <a class="nav-link {{ (request()->is('admin/recomendation*')) ? 'active' : '' }}" href="{{ route('recomendation.index') }}">
                <div class="nav-link-icon"><i data-feather="recomendation"></i></div>
                Rekomendasi Nikah
            </a>
            <a class="nav-link {{ (request()->is('admin/keterangan*')) ? 'active' : '' }}" href="{{ route('keterangan.index') }}">
                <div class="nav-link-icon"><i data-feather="keterangan"></i></div>
                Keterangan Nikah Tidak Tercatat
            </a>
            <a class="nav-link {{ (request()->is('admin/pemberitahuan*')) ? 'active' : '' }}" href="{{ route('pemberitahuan.index') }}">
                <div class="nav-link-icon"><i data-feather="pemberitahuan"></i></div>
                Pemberitahuan Kekurangan Syarat Pernikahan
            </a>
            @if(auth()->user()->jabatan!=='Masyarakat')
            <div class="dropdown-divider"></div>
            <div class="nav-link">Surat Keluar</div>
            <a class="nav-link {{ (request()->is('admin/nikah*')) ? 'active' : '' }}" href="{{ route('nikah.index') }}">
                <div class="nav-link-icon"><i data-feather="nikah"></i></div>
                Permintaan Buku Nikah & Akta Nikah
            </a>
            <a class="nav-link {{ (request()->is('admin/undangan*')) ? 'active' : '' }}" href="{{ route('undangan.index') }}">
                <div class="nav-link-icon"><i data-feather="undangan"></i></div>
                Undangan
            </a>
            <a class="nav-link {{ (request()->is('admin/disposisi*')) ? 'active' : '' }}" href="{{ route('disposisi.index') }}">
                <div class="nav-link-icon"><i data-feather="disposisi"></i></div>
                Disposisi
            </a>
            @endif
<!--             <div class="dropdown-divider"></div>
            <div class="nav-link">Surat Keluar</div>
            <a class="nav-link {{ (request()->is('admin/disposisi*')) ? 'active' : '' }}" href="{{ route('disposisi.index') }}">
                <div class="nav-link-icon"><i data-feather="disposisi"></i></div>
                Disposisi
            </a> -->
            @endif
            @if(auth()->user()->jabatan=='Petugas')
            <div class="dropdown-divider"></div>
            <div class="nav-link">Pegawai</div>
            <a class="nav-link {{ (request()->is('admin/pegawai*')) ? 'active' : '' }}" href="{{ route('pegawai.index') }}">
                <div class="nav-link-icon"><i data-feather="user"></i></div>                Data Pegawai
            </a>
            @endif
        </div>
    </div>
    <!-- Sidenav Footer-->
    <div class="sidenav-footer">
        <div class="sidenav-footer-content">
            <div class="sidenav-footer-subtitle">Login sebagai:</div>
            <div class="sidenav-footer-title">{{ Auth::user()->nama }}</div>
        </div>
    </div>
</nav>