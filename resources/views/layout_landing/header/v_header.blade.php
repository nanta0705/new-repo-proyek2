<nav class="untree_co--site-nav js-sticky-nav">
    <div class="container d-flex align-items-center">
        <div class="logo-wrap">
            <a href="index.html" class="untree_co--site-logo">kk</a>
        </div>
        <div class="site-nav-ul-wrap text-center d-none d-lg-block">
            <ul class="site-nav-ul js-clone-nav">
                <li class="active"><a href="index.html">Home</a></li>
                {{-- <li class="has-children">
                    <a href="rooms.html">Rooms</a>
                    <ul class="dropdown">
                        <li class="has-children">
                            <a href="#">King Bedroom</a>
                            <ul class="dropdown">
                                <li>
                                    <a href="#">King Bedroom</a>
                                </li>
                                <li>
                                    <a href="#">Queen &amp; Double Bedroom</a>
                                </li>
                                <li>
                                    <a href="#">Le Voila Suite</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Queen &amp; Double Bedroom</a>
                        </li>
                        <li>
                            <a href="#">Le Voila Suite</a>
                        </li>
                    </ul>
                </li> --}}
                <li><a href="about.html">About Us</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </div>

        <div class="icons-wrap text-md-right">
            <ul class="site-nav-ul js-clone-nav">
                <li>
                    @if (Auth::check())
                        @if (Auth::user()->role_id == 1)
                            <a href="{{ url('/admin/dashboard') }}">
                                <span class="fa fa-home"> Dashboard</span>
                            </a>
                        @elseif (Auth::user()->role_id == 2)
                            <a href="{{ url('/owner/dashboard') }}">
                                <span class="fa fa-home"> Dashboard</span>
                            </a>
                        @elseif (Auth::user()->role_id == 3)
                <li class="has-children">
                    <a href="rooms.html">Selamat Datang, {{ Auth::user()->name }}</a>
                    <ul class="dropdown">
                        <li>
                            <a href="{{ url('/client/dashboard') }}">Dashboard</a>
                        </li>
                        <li>
                            <a href="{{ url('/logout') }}">Logout</a>
                        </li>
                    </ul>
                </li>
                @endif
            @else
                <li>
                    <a href="{{ url('/login') }}">
                        <span class="fa fa-sign-in"> Login</span>
                    </a>
                </li>
                @endif
                </li>
            </ul>
        </div>

    </div>
</nav>
