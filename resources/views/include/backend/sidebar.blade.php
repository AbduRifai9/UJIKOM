<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link mt-3">
            <span class="app-brand-logo demo">
                <!-- Ganti logo dengan gambar -->
                <img src="{{ asset('frontend/assets/images/logo.png') }}" alt="Logo" width="40">
            </span>
            <!-- Nama brand -->
            <span class="app-brand-text demo menu-text fw-bolder ms-2">WaveFest</span>
        </a>


        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1 mt-3">
        <!-- Dashboard -->
        <li class="menu-item {{ Request::is('admin/home') ? 'active' : '' }}">
            <a href="{{ url('/admin/home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Layouts -->
        <li class="menu-item {{ Request::is('admin/event') ? 'active' : '' }}">
            <a href="{{ url('/admin/event') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar"></i>
                <div data-i18n="Event">Event</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('admin/tiket') ? 'active' : '' }}">
            <a href="{{ url('admin/tiket') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx"><svg xmlns="http://www.w3.org/2000/svg" width="17"
                        height="20" fill="currentColor" class="bi bi-ticket-perforated-fill mb-1"
                        viewBox="0 0 16 16">
                        <path
                            d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6zm4-1v1h1v-1zm1 3v-1H4v1zm7 0v-1h-1v1zm-1-2h1v-1h-1zm-6 3H4v1h1zm7 1v-1h-1v1zm-7 1H4v1h1zm7 1v-1h-1v1zm-8 1v1h1v-1zm7 1h1v-1h-1z" />
                    </svg></i>
                <div data-i18n="Account Settings">Tiket</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('admin/lokasi') ? 'active' : '' }}">
            <a href="{{ url('admin/lokasi') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-map"></i>
                <div data-i18n="Authentications">Lokasi</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('admin/sponsor') ? 'active' : '' }}">
            <a href="{{ url('admin/sponsor') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="Authentications">Sponsor</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('admin/user') ? 'active' : '' }}">
            <a href="{{ url('admin/user') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx"><svg xmlns="http://www.w3.org/2000/svg" width="17"
                        height="20" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                        <path
                            d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                    </svg></i>
                <div data-i18n="Misc">User</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('admin/pemesanan') ? 'active' : '' }}">
            <a href="{{ url('admin/pemesanan') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Pemesanan</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('admin/detail') ? 'active' : '' }}">
            <a href="{{ url('admin/detail') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Detail Pemesanan</div>
            </a>
        </li>
    </ul>
</aside>
<!-- / Menu -->
