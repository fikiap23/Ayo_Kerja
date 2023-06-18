@extends('layouts.account')
@section('content')
    <div class="account-layout border">
        <div class="account-hdr bg-primary text-white border">
            Menjadi Pemberi Kerja di {{ config('app.name') }}
        </div>
        <div class="account-bdy p-3">
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <p class="lead">Upgrade Buat Perusahaan</p>
                </div>
                <div class="col-sm-12 col-md-8">
                    <div>
                        <p class="text-sm"><i class="fas fa-info-circle"></i> <span class="font-weight-bold">Biasanya ini harus
                                divalidasi oleh Admin, tetapi untuk pengujian, menjadi pemberi kerja hanya membutuhkan satu
                                klik.</span> </p>
                        <div class="my-4">
                            <p class="my-3">Klik tombol di bawah ini untuk menetapkan peran <span
                                    class="text-primary">Perusahaan</span> pada akun Anda.</p>
                            <form action="{{ route('account.becomeEmployer') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <div class="d-flex">
                                        <button type="submit" class="btn primary-outline-btn">Menjadi Pemberi
                                            Kerja</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
