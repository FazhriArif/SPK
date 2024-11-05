<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" style="background: url('{{ asset('template/assets/img/illustrations/sidebar-background.jpg') }}') no-repeat center center fixed;
    background-size: cover;">
    <div class="app-brand demo">
        <a href="/dashboard" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ url($settingItem->path_logo) }}" alt="logo.png" style="width: 30px;">
            </span>
            <span class="demo menu-text fw-bolder ms-2"
                style="font-size: 23px;">{{ $settingItem->nama_perusahaan }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ $active === 'Dashboard' ? ' active' : '' }}">
            <a href="/dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-dashboard"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        @if (auth()->user()->role == 'admin')
            <!-- Master Data -->
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Kelola Data</span>
            </li>

            <li class="menu-item {{ $active === 'Produk' ? ' active' : '' }}">
                <a href="/produk" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-package"></i>
                    <div data-i18n="Analytics">Produk</div>
                </a>
            </li>
            
            <li class="menu-item {{ $active === 'alternatif' ? ' active' : '' }}">
                <a href="/alternatif" class="menu-link">
                    <i class="menu-icon bx bx-list-ul"></i>
                    <div data-i18n="Analytics">Alternatif</div>
                </a>
            </li>

            <li class="menu-item {{ $active === 'nilai_alter' ? ' active' : '' }}">
                <a href="/nilaialternatif" class="menu-link">
                    <i class="menu-icon bx bx-food-menu"></i>
                    <div data-i18n="Analytics">Nilai Alternatif</div>
                </a>
            </li>

            <li class="menu-item {{ $active === 'Kriteria' ? ' active' : '' }}">
                <a href="/kriteria" class="menu-link">
                    <i class="menu-icon bx bxs-spreadsheet"></i>
                    <div data-i18n="Analytics">Kriteria</div>
                </a>
            </li>

            <li class="menu-item {{ $active === 'nilaiKriteria' ? ' active' : '' }}">
                <a href="/nilaikriteria" class="menu-link">
                    <i class="menu-icon bx bx-right-indent"></i>
                    <div data-i18n="Analytics">Nilai Kriteria</div>
                </a>
            </li>

            <li class="menu-item {{ $active === 'perhitungan' ? ' active' : '' }}">
                <a href="/perhitungan" class="menu-link">
                    <i class="menu-icon bx bx-math"></i>
                    <div data-i18n="Analytics">Perhitungan WP-TOPSIS</div>
                </a>
            </li>

            <li class="menu-item {{ $active === 'Laporan' ? ' active' : '' }}">
                <a href="/laporan" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-report"></i>
                    <div data-i18n="Analytics">Laporan</div>
                </a>
            </li>
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">SETTING</span>
            </li>
            <!-- Setting -->
            <li class="menu-item {{ $active === 'Setting' ? ' active' : '' }}">
                <a href="/setting" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-cog"></i>
                    <div data-i18n="Analytics">Setting</div>
                </a>
            </li>
            <li class="menu-item {{ $active === 'User' ? ' active' : '' }}">
                <a href="/users" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-user"></i>
                    <div data-i18n="Analytics">User</div>
                </a>
            </li>
        @endif

    </ul>
</aside>
