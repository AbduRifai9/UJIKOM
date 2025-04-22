<nav class="site-nav">
    <div class="container">
        <div class="menu-bg-wrap">
            <div class="site-navigation">
                <a href="{{ url('/') }}" class="logo m-0 float-start "><b>WaveFest</b></a>

                <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end">
                    <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ url('/') }}">Beranda</a></li>
                    <li class="{{ Request::is('riwayat-transaksi') ? 'active' : '' }}"><a href="{{ url('/riwayat-transaksi') }}">Riwayat Transaksi</a></li>
                    <li class="{{ Request::is('about') ? 'active' : '' }}"><a href="{{url('/about')}}">About</a></li>

                    @guest
                        <li class="{{ Request::is('login') ? 'active' : '' }}">
                            <a href="{{ route('login') }}" class="border rounded px-3 py-1 me-2 d-inline-block text-white">Login</a>
                        </li>
                        <li class="{{ Request::is('register') ? 'active' : '' }}">
                            <a href="{{ route('register') }}" class="border rounded px-3 py-1 d-inline-block text-white">Register</a>
                        </li>
                    @endguest

                    @auth
                        <li class="has-children">
                            <a href="#" class="border rounded px-3 py-2 d-inline-block text-white">{{ Auth::user()->name }}</a>
                            <ul class="dropdown border rounded bg-white p-2 shadow-sm">
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-start border-0 bg-transparent">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                </ul>

                <a href="#" class="burger light me-auto float-end mt-1 site-menu-toggle js-menu-toggle d-inline-block d-lg-none" data-toggle="collapse" data-target="#main-navbar">
                    <span></span>
                </a>
            </div>
        </div>
    </div>
</nav>
