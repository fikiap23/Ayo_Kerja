<nav class="navbar navbar-expand-md navbar-white bg-white border-bottom sticky-top" id="navbar">
    <div class="container">
        <a href="{{ URL('/') }}" class="navbar-brand">
            <img src="{{ asset('images/logo/joblister.png') }}" alt="Logo" class="logo" style="max-height: 60px;">
        </a> <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ URL('/') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ URL('/about-us') }}">Tentang Kami</a>
                </li>
                <li class="nav-item mr-5">
                    <a class="nav-link" href="{{ URL('/contact-us') }}">Hubungi Kami</a>
                </li>
                @auth
                    <li class="nav-item dropdown dropdown-left">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
                            <img class="img-profile rounded-circle" src="{{ asset('images/user-profile.png') }}"
                                width="40px">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            @role('admin')
                                <a class="dropdown-item" href="{{ route('account.dashboard') }}"> <i
                                        class="fas fa-cogs fa-sm "></i> Dashboard</a>
                            @endrole
                            @role('author')
                                <a class="dropdown-item" href="{{ route('account.authorSection') }}"> <i
                                        class="fa fa-cogs fa-sm "></i> Dashboard Perusahaan </a>
                            @endrole
                            <a class="dropdown-item" href="{{ route('account.index') }}"> <i class="fas fa-user fa-sm "></i>
                                Profil </a>
                            <a class="dropdown-item" href="{{ route('account.changePassword') }}"> <i
                                    class="fas fa-key fa-sm "></i> Ubah Kata Sandi </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('account.logout') }}">
                                <i class="fas fa-sign-out-alt"></i>
                                Keluar
                            </a>
                        </div>
                    </li>
                @endauth
                @guest
                    <a href="/login" class="btn primary-btn">Daftar atau Masuk</a>
                @endguest
            </ul>
        </div>
    </div>
</nav>
