@extends('layouts.account')

@section('content')

    <div class="account-layout  border">
        <div class="account-hdr bg-primary text-white border">
            Bagian Perusahaan
        </div>
        <div class="account-bdy p-3">
            <div class="row mb-3">
                <div class="col-xl-4 col-sm-6 py-2">
                    <div class="card dashboard-card text-white h-100 shadow">
                        <div class="card-body primary-bg">
                            <div class="rotate">
                                <i class="fas fa-users fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase">Postingan Saya</h6>
                            <h1 class="">{{ $company ? $company->posts->count() : 0 }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 py-2">
                    <div class="card dashboard-card text-white  h-100 shadow">
                        <div class="card-body bg-info">
                            <div class="rotate">
                                <i class="fas fa-th fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase">Postingan Aktif</h6>
                            <h1 class="">{{ $livePosts ?? 0 }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 py-2">
                    <a href="{{ route('jobApplication.index') }}">
                        <div class="card dashboard-card text-white h-100 shadow">
                            <div class="card-body bg-danger">
                                <div class="rotate">
                                    <i class="fas fa-envelope fa-4x"></i>
                                </div>
                                <h6 class="text-uppercase">Total Lamaran</h6>
                                <h1 class="">{{ $applications ? $applications->count() : 0 }}</h1>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <section class="author-company-info">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Kelola Detail Perusahaan</h4>
                                <p class="mb-3 alert alert-info">Untuk daftar pekerjaan, Anda perlu menambahkan detail
                                    Perusahaan.</p>

                                <div class="mb-3 d-flex">
                                    @if (!$company)
                                        <a href="{{ route('company.create') }}" class="btn primary-btn mr-2">Buat
                                            Perusahaan</a>
                                    @else
                                        <a href="{{ route('company.edit') }}" class="btn secondary-btn mr-2">Edit
                                            Perusahaan</a>
                                        <div class="ml-auto">
                                            <form action="{{ route('company.destroy') }}" id="companyDestroyForm"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" id="companyDestroyBtn" class="btn danger-btn">Hapus
                                                    Perusahaan</a>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                                @if ($company)
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <img src="{{ asset($company->logo) }}" width="100px"
                                                        class="img-fluid border p-2" alt="">
                                                    <h5>{{ $company->title }}</h5>
                                                    <small>{{ $company->getCategory->category_name }}</small>
                                                    <a class="d-block" href="{{ $company->website }}"><i
                                                            class="fas fa-globe"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="author-posts">
                <div class="row my-4">
                    <div class="col-lg-12 col-md-8 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Kelola Postingan (Pekerjaan)</h4>
                                <a href="{{ route('post.create') }}" class="btn primary-btn">Buat daftar pekerjaan baru</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>#</th>
                                        <th>Judul</th>
                                        <th>Tingkat</th>
                                        <th>Jumlah Posisi</th>
                                        <th>Batas Waktu</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($company)
                                        @foreach ($company->posts as $index => $post)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td> <a href="{{ route('post.show', ['job' => $post]) }}" target="_blank"
                                                        title="Buka postingan ini">{{ $post->job_title }}</a></td>
                                                <td>{{ $post->job_level }}</td>
                                                <td>{{ $post->vacancy_count }}</td>
                                                <td>@php
                                                    $date = new DateTime($post->deadline);
                                                    $timestamp = $date->getTimestamp();
                                                    $dayMonthYear = date('d/m/Y', $timestamp);
                                                    $daysLeft = date('d', $timestamp - time()) . ' hari tersisa';
                                                    echo "$dayMonthYear <br> <span class='text-danger'> $daysLeft </span>";
                                                @endphp</td>
                                                <td>
                                                    <a href="{{ route('post.edit', ['post' => $post]) }}"
                                                        class="btn primary-btn">Edit</a>
                                                    <form action="{{ route('post.destroy', ['post' => $post->id]) }}"
                                                        class="d-inline-block" id="delPostForm" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" id="delPostBtn"
                                                            class="btn danger-btn">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>Anda belum membuat perusahaan.</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--/row-->
            </section>

        </div>
    </div>
@endSection
@push('js')
    <script>
        $(document).ready(function() {
            //delete author company
            $('#companyDestroyBtn').click(function(e) {
                e.preventDefault();
                if (window.confirm('Apakah Anda yakin ingin menghapus perusahaan ini?')) {
                    $('#companyDestroyForm').submit();
                }
            })
        })
    </script>
@endpush
