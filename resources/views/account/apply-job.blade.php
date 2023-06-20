@extends('layouts.account')

@section('content')
    <div class="account-layout border">
        <div class="account-hdr bg-primary text-white border">
            Lamar Pekerjaan
        </div>
        <div class="account-bdy p-3">
            <div class="row">
                <div class="col-sm-12 col-md-12 mb-5">
                    <div class="card">
                        <div class="card-header">
                            Profil Saya
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <img src="{{ asset('images/user-profile.png') }}" class="img-fluid rounded-circle"
                                        alt="">
                                </div>
                                <div class="col-9">
                                    <h6 class="text-info text-capitalize">{{ auth()->user()->name }}</h6>
                                    <p class="my-2"><i class="fas fa-envelope"></i> Email: {{ auth()->user()->email }}</p>
                                    <a href="{{ route('account.index') }}">Lihat Profil Saya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Persyaratan Pekerjaan Utama
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3 d-flex align-items-center border p-3">
                                    <img src="{{ asset($company->logo) }}" class="img-fluid" alt="">
                                </div>
                                <div class="col-9">
                                    <p class="h4 text-info text-capitalize">
                                        {{ $post->job_title }}
                                    </p>
                                    <h6 class="text-uppercase">
                                        <a
                                            href="{{ route('account.employer', ['employer' => $company]) }}">{{ $company->title }}</a>
                                    </h6>
                                    <p class="my-2"><i class="fas fa-map-marker-alt"></i> Lokasi:
                                        {{ $post->job_location }}</p>
                                    <p class="text-danger small">{{ date('l, jS \of F Y', $post->deadlineTimestamp()) }},
                                        ({{ date('d', $post->remainingDays()) }} hari lagi)</p>
                                </div>
                            </div>
                            <div class="mb-3 d-flex justify-content-end">
                                <div class="my-2">
                                    <a href="{{ route('post.show', ['job' => $post]) }}" class="secondary-link"><i
                                            class="fas fa-briefcase"></i> Lihat pekerjaan</a>|
                                    <a href="{{ route('savedJob.store', ['id' => $post->id]) }}" class="secondary-link"><i
                                            class="fas fa-share-square"></i> Simpan pekerjaan</a>
                                </div>
                            </div>
                            <div class="mb-3 d-flex justify-content-end ">
                                <div class="small">

                                    <a href="{{ URL::previous() }}" class="btn primary-outline-btn">Batal</a>
                                    <form action="{{ route('account.applyJob') }}" method="POST" class="d-inline-block"
                                        enctype="multipart/form-data">
                                        <div class="form-group ">
                                            <div class="py-3">
                                                <p>Upload CV</p>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="validatedCustomFile"
                                                    name="cv" onchange="updateFileName(this)">
                                                <label class="custom-file-label selected-file-name"
                                                    for="validatedCustomFile">Pilih
                                                    CV...</label>
                                                <div id="selectedFileName" class="selected-file-name"></div>
                                                @error('cv')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                        </div>
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                        <button type="submit" class="btn primary-btn">Kirim Lamaran <i
                                                class="fas fa-chevron-right"></i></a>
                                    </form>

                                    <script>
                                        function updateFileName(input) {
                                            let fileName = input.files[0].name;
                                            let label = input.nextElementSibling;
                                            label.innerHTML = fileName;
                                            let selectedFileName = document.getElementById("selectedFileName");
                                            selectedFileName.innerHTML = fileName;
                                        }
                                    </script>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
