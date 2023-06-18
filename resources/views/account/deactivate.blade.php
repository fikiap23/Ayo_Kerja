@extends('layouts.account')

@section('content')
    <div class="account-layout border">
        <div class="account-hdr bg-primary text-white border">
            Nonaktifkan Akun
        </div>
        <div class="account-bdy p-3">
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <p class="lead">Menghapus Akun</p>
                </div>
                <div class="col-sm-12 col-md-8">
                    <div class="py-3">
                        <p class="mb-3">Logout saja</p>
                        <a href="{{ route('account.logout') }}" class="btn primary-outline-btn">Logout</a>
                    </div>

                    <div>
                        <p class="text-sm"><i class="fas fa-info-circle"></i> <span class="font-weight-bold">Anda tidak akan
                                dapat mengembalikan akun Anda setelah menghapusnya.</span> </p>
                        <div class="my-4">
                            <p class="my-3">Klik tombol untuk menghapus akun ini.</p>
                            <form action="{{ route('account.delete') }}" method="POST">
                                @csrf
                                @method('delete')
                                <div class="form-group">
                                    <div class="d-flex">
                                        <button type="submit" class="btn danger-btn">Hapus Akun</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endSection
