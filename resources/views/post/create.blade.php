@extends('layouts.account')

@section('content')
    <div class="account-layout border">
        <div class="account-hdr bg-primary text-white border">
            Buat Daftar Pekerjaan
        </div>
        <div class="account-bdy p-3">
            <div class="alert alert-primary">Rincian perusahaan Anda akan terlampir secara otomatis.</div>
            <p class="text-primary mb-4">Isi semua kolom untuk membuat daftar pekerjaan</p>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-12">
                    <form action="{{ route('post.store') }}" id="postForm" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Pekerjaan</label>
                            <input type="text" placeholder="Nama Pekerjaan"
                                class="form-control @error('job_title') is-invalid @enderror" name="job_title"
                                value="{{ old('job_title') }}" required autofocus>
                            @error('job_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Tingkat Pekerjaan</label>
                                    <select name="job_level" class="form-control" value="{{ old('job_level') }}" required>
                                        <option value="Senior level">Senior level</option>
                                        <option value="Mid level">Mid level</option>
                                        <option value="Top level">Top level</option>
                                        <option value="Entry level">Entry level</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Jumlah Kebutuhan</label>
                                    <input type="number" class="form-control @error('vacancy_count') is-invalid @enderror"
                                        name="vacancy_count" value="{{ old('vacancy_count') }}" required>
                                    @error('vacancy_count')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="">Jenis Pekerjaan</label>
                            <select name="employment_type" class="form-control" name="employment_type"
                                value="{{ old('employment_type') }}">
                                <option value="Full Time">Full Time</option>
                                <option value="Part Time">Part Time</option>
                                <option value="Freelance">Freelance</option>
                                <option value="Internship">Internship</option>
                                <option value="Trainneship">Trainneship</option>
                                <option value="Volunter">Volunter</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Lokasi Pekerjaan</label>
                            <input type="text" placeholder="Lokasi Pekerjaan"
                                class="form-control @error('job_location') is-invalid @enderror" name="job_location"
                                value="{{ old('job_location') }}" required>
                            @error('job_location')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Gaji yang Ditawarkan (Bulanan)</label>
                                    <input type="text" placeholder="20k - 50k"
                                        class="form-control @error('salary') is-invalid @enderror" name="salary"
                                        value="{{ old('salary') }}" required>
                                    @error('salary')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="">Batas Waktu</label>
                                    <input type="date" class="form-control @error('deadline') is-invalid @enderror"
                                        name="deadline" value="{{ old('deadline') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Tingkat Pendidikan</label>
                                    <select name="education_level" class="form-control"
                                        value="{{ old('education_level') }}">
                                        <option value="Bachelors">Bachelors</option>
                                        <option value="High School">High School</option>
                                        <option value="Master">Master</option>
                                        <option value="SEE Mid School">SEE Mid School</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Pengalaman</label>
                                    <select name="experience" class="form-control" value="{{ old('experience') }}">
                                        <option value="Internship">Kurang dari 1 tahun</option>
                                        <option value="1 year">1 tahun</option>
                                        <option value="2 years">2 tahun</option>
                                        <option value="2 years">3 tahun</option>
                                        <option value="More than 5+ year">Lebih dari 5 tahun</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Keterampilan Profesional <span class="text-info">(Jika ada lebih dari
                                    satu, pisahkan dengan ",")</span></label>
                            <input type="text" placeholder="Keterampilan1,Keterampilan2 dst"
                                class="form-control @error('skills') is-invalid @enderror" name="skills"
                                value="{{ old('skills') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="">Deskripsi Pekerjaan (Spesifikasi) <small>Kolom Opsional</small></label>
                            <input type="hidden" id="specifications" name="specifications"
                                value="{{ old('specifications') }}">
                            <div id="quillEditor" style="height:200px"></div>
                        </div>

                        <button type="button" id="postBtn" class="btn primary-btn">Buat Daftar Pekerjaan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endSection
@push('css')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush
@push('js')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        $(document).ready(function() {
            var quill = new Quill('#quillEditor', {
                modules: {
                    toolbar: [
                        [{
                            'font': []
                        }, {
                            'size': []
                        }],
                        ['bold', 'italic'],
                        [{
                            list: 'ordered'
                        }, {
                            list: 'bullet'
                        }],
                        ['link', 'blockquote', 'code-block', 'image'],
                    ]
                },
                placeholder: 'Persyaratan Pekerjaan, Spesifikasi Pekerjaan, dll...',
                theme: 'snow'
            });


            const postBtn = document.querySelector('#postBtn');
            const postForm = document.querySelector('#postForm');
            const specifications = document.querySelector('#specifications');

            if (specifications.value) {
                quill.root.innerHTML = specifications.value;
            }

            postBtn.addEventListener('click', function(e) {
                e.preventDefault();
                specifications.value = quill.root.innerHTML

                postForm.submit();
            })
        })
    </script>
@endpush
