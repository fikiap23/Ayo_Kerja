@extends('layouts.account')

@section('content')
    <div class="account-layout border">
        <div class="account-hdr bg-primary text-white border">
            Lamaran Pekerjaan
        </div>
        <div class="account-bdy p-3">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <p class="mb-3 alert alert-primary">Menampilkan semua pelamar yang telah melamar untuk <strong>lowongan
                            pekerjaan</strong> Anda.</p>
                    @if ($applications && $applications->count())
                        @php
                            $groupedApplications = $applications->groupBy('post_id');
                        @endphp
                        @foreach ($groupedApplications as $postId => $groupedApplication)
                            @php
                                $jobTitle = $groupedApplication->first()->post->job_title;
                            @endphp
                            <div class="mb-4">
                                <h5>Judul Pekerjaan: <a
                                        href="{{ route('post.show', ['job' => $postId]) }}">{{ $jobTitle }}</a></h5>
                                <table class="table table-hover table-striped small">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Pelamar</th>
                                            <th>Email</th>
                                            <th>Dilamar pada</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($groupedApplication as $key => $application)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $application->user->name }}</td>
                                                <td><a
                                                        href="mailto:{{ $application->user->email }}">{{ $application->user->email }}</a>
                                                </td>
                                                <td>{{ $application->created_at }}</td>
                                                <td>
                                                    <a href="{{ route('jobApplication.show', ['id' => $application]) }}"
                                                        class="btn primary-outline-btn">Lihat</a>
                                                    <form action="{{ route('jobApplication.destroy') }}" method="POST"
                                                        class="d-inline-block">
                                                        @csrf
                                                        @method('delete')
                                                        <input type="hidden" name="application_id"
                                                            value="{{ $application->id }}">
                                                        <button type="submit" class="btn danger-btn">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    @else
                        <p>Anda belum menerima lamaran pekerjaan.</p>
                    @endif
                    <div class="d-flex justify-content-center mt-4 custom-pagination">
                        {{ $applications && $applications->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
