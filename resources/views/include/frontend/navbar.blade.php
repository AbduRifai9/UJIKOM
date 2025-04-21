<nav class="site-nav">
    <div class="container">
        <div class="menu-bg-wrap">
            <div class="site-navigation">
                <a href="index.html" class="logo m-0 float-start "><b>WaveFest</b></a>

                <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end">
                    {{-- <li>
                        <form action="#" class="narrow-w form-search d-flex align-items-stretch" data-aos="fade-in"
                            data-aos-delay="200">
                            <input type="text" class="form-control px-4" placeholder="Masukkan Kata Kunci Anda"
                                style="width: 300px" />
                            <button type="submit" class="btn btn-primary border-1"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                    class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                </svg></button>
                        </form>
                    </li> --}}
                    <li class="active"><a href="index.html">Home</a></li>
                    <li class="has-children">
                        <a href="properties.html">Properties</a>
                        <ul class="dropdown">
                            <li><a href="#">Buy Property</a></li>
                            <li><a href="#">Sell Property</a></li>
                            <li class="has-children">
                                <a href="#">Dropdown</a>
                                <ul class="dropdown">
                                    <li><a href="#">Sub Menu One</a></li>
                                    <li><a href="#">Sub Menu Two</a></li>
                                    <li><a href="#">Sub Menu Three</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="services.html">Services</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="{{ asset('frontend/assets/contact.html') }}">Contact Us</a></li>
                    @guest
                        <li>
                            <a href="{{ route('login') }}" class="border rounded px-3 py-1 me-2 d-inline-block text-white">Login</a>
                        </li>
                        <li>
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
                                        <button type="submit"
                                            class="dropdown-item text-start border-0 bg-transparent">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                </ul>

                <a href="#"
                    class="burger light me-auto float-end mt-1 site-menu-toggle js-menu-toggle d-inline-block d-lg-none"
                    data-toggle="collapse" data-target="#main-navbar">
                    <span></span>
                </a>
            </div>
        </div>
    </div>
</nav>
