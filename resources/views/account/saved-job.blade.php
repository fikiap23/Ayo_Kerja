@extends('layouts.account')

@section('content')
    <div class="account-layout border">
        <div class="account-hdr border bg-primary text-white shadow">
            Pekerjaan yang Tersimpan
        </div>
        <div class="account-bdy p-3">
            <div class="my-2">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="bg-light small">
                            <tr>
                                <th>Posisi Pekerjaan</th>
                                <th>Tingkat Pekerjaan</th>
                                <th>Perusahaan</th>
                                <th>Jumlah Lowongan</th>
                                <th>Deadline</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                @if ($posts->count() > 0)
                                    <tr>
                                        <td><a href="{{ route('post.show', ['job' => $post]) }}">{{ $post->job_title }}</a></td>
                                        <td><a href="#">{{ $post->job_level }}</a></td>
                                        <td><a
                                                href="{{ route('account.employer', ['employer' => $post->company]) }}">{{ substr($post->company->title, 0, 14) }}..</a>
                                        </td>
                                        <td>{{ $post->vacancy_count }}</td>
                                        <td>{{ date('d/m/Y', $post->deadlineTimestamp()) }},
                                            {{ date('d', $post->remainingDays()) }} hari</td>
                                        <td>
                                            <form action="{{ route('savedJob.destroy', ['id' => $post]) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" href="#"
                                                    class="btn secondary-outline-btn">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>Anda belum menyimpan pekerjaan.</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endSection
