@extends('layouts.account')

@section('content')
    <div class="account-layout border">
        <div class="account-hdr bg-primary text-white border">
            Akun Pengguna
        </div>
        <div class="account-bdy border py-3">
            <div class="row container d-flex justify-content-center">
                <div class="col-xl-12 col-md-12">
                    <div class="card user-card-full">
                        <div class="row m-l-0 m-r-0">
                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                <div class="card-block text-center text-white">
                                    <div class="m-b-25"> <img src="{{ asset('images/user-profile.png') }}" class="img-radius"
                                            alt="Gambar-Profil-Pengguna"> </div>
                                    <h6 class="f-w-600">{{ auth()->user()->name }}</h6>
                                    @role('user')
                                        <p>Pengguna</p>
                                    @endrole
                                    @role('author')
                                        <p>Perusahaan <i class="fas fa-briefcase"></i></p>
                                    @endrole
                                    @role('admin')
                                        <p>Admin <i class="fas fa-pen-square"></i></p>
                                    @endrole
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="card-block">
                                    <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Informasi</h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Email</p>
                                            <h6 class="text-muted f-w-400">{{ auth()->user()->email }}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Telepon</p>
                                            <h6 class="text-muted f-w-400">Belum diatur</h6>
                                        </div>
                                    </div>
                                    <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Akun</h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Kata Sandi</p>
                                            <a href="{{ route('account.changePassword') }}"
                                                class="btn primary-outline-btn">Ubah kata sandi</a>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Keluar</p>
                                            <a href="{{ route('logout') }}" class="btn btn-outline-dark">Keluar</a>
                                        </div>
                                    </div>
                                    @role('user')
                                        <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">CV</h6>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <p class="m-b-10 f-w-600">Unggah CV</p>
                                                <form action="{{ route('account.uploadCV') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="file" name="cv" class="form-control-file mb-2">
                                                    <button type="submit" class="btn primary-btn">Unggah</button>
                                                </form>
                                            </div>
                                            <div class="col-sm-12 mt-4">
                                                @if (auth()->user()->cv)
                                                    <p class="m-b-10 f-w-600">Preview CV</p>
                                                    <iframe src="{{ asset(auth()->user()->cv) }}" width="100%"
                                                        height="600px"></iframe>
                                                @else
                                                    <p class="m-b-10 text-muted">Belum ada CV yang diunggah</p>
                                                @endif
                                            </div>
                                        </div>
                                    @endrole

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
