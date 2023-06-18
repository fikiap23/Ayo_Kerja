@extends('layouts.account')

@section('content')
    <div class="account-layout border">
        <div class="account-hdr bg-primary text-white border ">
            Edit Kategori Perusahaan
        </div>
        <div class="account-bdy p-3">
            @if ($errors->any())
                {!! implode('', $errors->all('<div>:message</div>')) !!}
            @endif
            <div class="row mb-3">
                <div class="col-12">
                    <p class="alert alert-primary">Anda akan mengubah kategori perusahaan: {{ $category->category_name }}</p>
                    <form action="{{ route('category.update', ['id' => $category->id]) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="">Pilih Kategori Perusahaan</label>
                            <input type="text" placeholder="Edit nama kategori Anda di sini" name="category_name"
                                class="form-control @error('category_name') input-error @enderror">
                        </div>
                        <div class="d-flex">
                            <button type="submit" class="btn secondary-btn mr-3">Perbarui</button>
                            <a href="{{ route('account.dashboard') }}" class="btn primary-outline-btn">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
