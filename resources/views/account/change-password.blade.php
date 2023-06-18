@extends('layouts.account')

@section('content')
    <div class="account-layout border">
        <div class="account-hdr bg-primary text-white border">
            Ubah Kata Sandi
        </div>
        <div class="account-bdy p-3">
            <form action="{{ route('account.changePassword') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <input type="password" placeholder="Kata Sandi Saat Ini *"
                        class="form-control @error('current_password') is-invalid @enderror" name="current_password"
                        value="{{ old('current_password') }}" required>
                    @error('current_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <p class="mt-3 alert alert-primary">Kata sandi harus terdiri dari 8 karakter dengan 1 karakter khusus</p>
                <div class="form-group">
                    <input type="password" placeholder="Kata Sandi Baru*"
                        class="form-control @error('new_password') is-invalid @enderror" name="new_password"
                        value="{{ old('new_password') }}" required>
                    @error('new_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Konfirmasi Kata Sandi *"
                        class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password"
                        value="{{ old('confirm_password') }}" required>
                    @error('confirm_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="line-divider"></div>
                <div class="mt-3">
                    <button type="submit" class="btn primary-btn">Ubah Kata Sandi</button>
                    <button class="btn primary-outline-btn">Batal</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('css')
@endpush
