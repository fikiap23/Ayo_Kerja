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
                        <input type="file" class="custom-file-input" id="logoInput" name="logo"
                            onchange="previewImage(this, 'logoPreview')" required>
                        <label class="custom-file-label" id="logoLabel" for="logoInput">Pilih logo...</label>
                        @error('logo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <img id="logoPreview" src="#" alt="Preview"
                            style="max-width: 200px; max-height: 200px; display: none;">
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
                        <input type="file" class="custom-file-input" id="coverImgInput" name="cover_img"
                            onchange="previewImageBannr(this, 'logoBannerPreview')">
                        <label class="custom-file-label" id="coverImgLabel" for="coverImgInput">Pilih gambar
                            cover...</label>
                        @error('cover_img')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <img id="logoBannerPreview" src="#" alt="Preview"
                            style="max-width: 200px; max-height: 200px; display: none;">
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
    <script>
        function previewImage(input, previewId) {
            var fileName = input.value.split('\\').pop();
            var label = document.getElementById('logoLabel');
            label.innerText = fileName;
            var preview = document.getElementById(previewId);
            var label = document.getElementById(input.id + 'Label');
            var file = input.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(file);
            label.innerText = file.name;
        }

        function previewImageBannr(input, previewId) {
            var fileName = input.value.split('\\').pop();
            var label = document.getElementById('coverImgLabel');
            label.innerText = fileName;
            var preview = document.getElementById(previewId);
            var label = document.getElementById(input.id + 'Label');
            var file = input.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(file);
            label.innerText = file.name;
        }
    </script>
@endSection
