@extends('layouts.auth')

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-6 px-0">
                {{-- login-poster dan register menggunakan nama kelas yang sama --}}
                <div class="login-poster">
                    {{-- <img src="" alt=""> --}}
                    <h2 class="my-3 slogon">
                        Daftar untuk kesempatan yang lebih baik
                    </h2>
                    <p class="text-white mb-3 lead"><i class="fas fa-angle-right"></i> Gratis dan selalu akan menjadi gratis
                    </p>
                    <p class="text-white mb-3 lead"><i class="fas fa-angle-right"></i> Keamanan dan kerahasiaan Anda terjamin
                    </p>
                    <p class="text-white mb-3 lead"><i class="fas fa-angle-right"></i> Kami menyediakan peluang karir</p>
                    <p class="text-white mb-3 lead"><i class="fas fa-angle-right"></i> Portal Lowongan Kerja Terpercaya di
                        Indonesia</p>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 px-0">
                <div class="login-container">
                    <div class="login-header mb-3">
                        <h3><img src="{{ asset('images/logo/joblister.png') }}" width="50px;" alt=""> Buat akun
                            pekerja gratis Anda</h3>
                        <p class="text-muted">Daftar dengan informasi dasar, lengkapi profil Anda, dan mulailah melamar
                            pekerjaan secara gratis!</p>
                    </div>
                    <div class="login-form">
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            {{-- nama lengkap --}}
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="fas fa-id-badge"></i></span>
                                    </div>
                                    <input id="name" type="name" placeholder="Nama lengkap"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- email --}}
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input id="email" type="email" placeholder="Alamat email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- kata sandi --}}
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input id="password" type="password" placeholder="Kata sandi"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        value="{{ old('password') }}" required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input id="password_confirmation" type="password" placeholder="Ulangi kata sandi"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        name="password_confirmation" value="{{ old('password_confirmation') }}" required>
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <small class="text-muted d-block mb-3">Dengan mengklik 'Buat Akun Pekerja' di bawah ini,
                                    Anda menyetujui persyaratan dan kebijakan privasi dari Joblister!</p>
                            </div>
                            <button type="submit" class="btn primary-btn btn-block">Daftar</button>
                        </form>
                        <div class="my-3">
                            <p>Sudah memiliki akun? <a href="/login">Login sekarang</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <style>
        .login-poster {
            /* cadangan */
            background-image: url('{{ asset('images/login-background.png') }}');
            background-image: linear-gradient(to bottom,
                    rgba(0, 0, 0, 0.5),
                    rgba(0, 0, 0, 0.35)),
                url('{{ asset('images/login-background.png') }}');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Daftar') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Alamat E-Mail') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Kata Sandi') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Konfirmasi Kata Sandi') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Daftar') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
