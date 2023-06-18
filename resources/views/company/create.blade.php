@extends('layouts.account')

@section('content')
    <div class="account-layout border">
        <div class="account-hdr bg-primary text-white border">
            Buat Perusahaan
        </div>
        <div class="account-bdy p-3">
            <form action="{{ route('company.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Pilih Kategori Perusahaan</label>
                    <select class="form-control" name="category" value="{{ old('category') }}" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="pb-3">
                    <div class="py-3">
                        <p>Logo Perusahaan</p>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="validatedCustomFile" name="logo" required>
                        <label class="custom-file-label" for="validatedCustomFile">Pilih logo...</label>
                        @error('logo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="py-3">
                        <p>Nama Perusahaan</p>
                    </div>
                    <input type="text" placeholder="Nama perusahaan"
                        class="form-control @error('password') is-invalid @enderror" name="title"
                        value="{{ old('title') }}" required>
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="py-3">
                        <p>URL Website Perusahaan</p>
                        <p class="text-primary">Contoh: https://www.examplecompany.com</p>
                    </div>
                    <input type="text" placeholder="Website Perusahaan"
                        class="form-control @error('website') is-invalid @enderror" name="website"
                        value="{{ old('website') }}" required>
                    @error('website')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="pb-3">
                    <div class="py-3">
                        <p>Banner/Cover Perusahaan</p>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="cover_img">
                        <label class="custom-file-label">Pilih gambar cover...</label>
                        @error('cover_img')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="pt-2">
                    <p class="mt-3 alert alert-primary">Berikan deskripsi singkat tentang perusahaan Anda</p>
                </div>
                <div class="form-group">
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" required>{{ old('description') }}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="line-divider"></div>
                <div class="mt-3">
                    <button type="submit" class="btn primary-btn">Buat perusahaan</button>
                    <a href="{{ route('account.authorSection') }}" class="btn primary-outline-btn">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endSection
