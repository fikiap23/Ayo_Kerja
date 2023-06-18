@extends('layouts.account')

@section('content')
    <div class="account-layout border">
        <div class="account-hdr bg-primary text-white border">
            Lamaran Pekerjaan
        </div>
        <div class="account-bdy p-3">
            <p class="alert alert-primary">Pengguna dengan nama <span class="text-capitalize"> ({{ $applicant->name }})</span>
                melamar pada listing Anda pada {{ $application->created_at }}</p>
            <div class="row">
                <div class="col-sm-12 col-md-12 mb-5">
                    <div class="card">
                        <div class="card-header">
                            Profil Pengguna (Pelamar)
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <img src="{{ asset('images/user-profile.png') }}" class="img-fluid rounded-circle"
                                        alt="">
                                </div>
                                <div class="col-9">
                                    <h6 class="text-info text-capitalize">{{ $applicant->name }}</h6>
                                    <p class="my-2"><i class="fas fa-envelope"></i> Email: {{ $applicant->email }}</p>
                                    <a href="mailto:{{ $applicant->email }}" class="btn primary-btn"
                                        title="klik untuk mengirim email">Kirim email kepada pengguna</a>
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
                                            class="fas fa-briefcase"></i> Lihat pekerjaan</a>
                                </div>
                            </div>
                            <div class="mb-3 d-flex justify-content-end">
                                <div class="small">
                                    <a href="{{ route('jobApplication.index') }}"
                                        class="btn primary-outline-btn">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
