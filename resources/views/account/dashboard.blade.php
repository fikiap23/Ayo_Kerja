@extends('layouts.account')

@section('content')
    <div class="account-layout  border">
        <div class="account-hdr bg-primary text-white border">
            Dasbor
        </div>
        <div class="account-bdy p-3">
            <div class="row mb-3">
                <div class="col-xl-4 col-sm-6 py-2">
                    <div class="card dashboard-card text-white h-100 shadow">
                        <div class="card-body primary-bg">
                            <div class="rotate">
                                <i class="fas fa-users fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase">Pengguna</h6>
                            <h1 class="">{{ $dashCount['user'] }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 py-2">
                    <div class="card dashboard-card text-white  h-100 shadow">
                        <div class="card-body bg-secondary">
                            <div class="rotate">
                                <i class="fas fa-building fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase">Total Pekerjaan</h6>
                            <h1 class="">{{ $dashCount['post'] }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 py-2">
                    <div class="card dashboard-card text-white h-100 shadow">
                        <div class="card-body bg-info">
                            <div class="rotate">
                                <i class="fas fa-user-tie fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase">Perusahaan</h6>
                            <h1 class="">{{ $dashCount['author'] }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-sm-6 py-2">
                    <div class="card dashboard-card text-white h-100 shadow">
                        <div class="card-body bg-danger">
                            <div class="rotate">
                                <i class="fas fa-star-of-life fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase">Postingan Live</h6>
                            <h1 class="">{{ $dashCount['livePost'] }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-sm-6 py-2">
                    <div class="card dashboard-card text-white h-100 shadow">
                        <div class="card-body bg-warning">
                            <div class="rotate">
                                <i class="fas fa-industry fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase">Kategori Perusahaan</h6>
                            <h1 class="">{{ $companyCategories->count() }}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <section class="dashboard-authors my-5">
                <div class="row my-4">
                    <div class="col-lg-12 col-md-8 col-sm-12">
                        <h4 class="card-title text-secondary">Kelola Penulis (Pemberi Pekerjaan)</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Nama Perusahaan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentAuthors as $author)
                                        @if ($author->company)
                                            <tr>
                                                <td>{{ $author->id }}</td>
                                                <td>{{ $author->name }}</td>
                                                <td>{{ $author->email }}</td>
                                                <td>{{ $author->company->title }}</td>
                                                <td>
                                                    <a href="{{ route('account.employer', ['employer' => $author->company]) }}"
                                                        class="btn primary-btn">Lihat Perusahaan</a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <button class="btn primary-outline-btn disabled">Jumlah total penulis terdaftar
                            ({{ $recentAuthors->total() }}) </button>

                        <div class="d-flex justify-content-center mt-4 custom-pagination">
                            {{ $recentAuthors->links() }}
                        </div>
                    </div>
                </div>
                <!--/row-->
            </section>
            <hr>

            <section class="dashboard-company">
                <h4 class="card-title text-secondary">Kelola Peran dan Kategori</h4>
                <div class="row my-4">
                    <div class="col-sm-12 col-md-12">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#categories-tab" role="tab" data-toggle="tab">Kategori
                                    Perusahaan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#roles-tab" role="tab" data-toggle="tab">Peran</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#permissions-tab" role="tab" data-toggle="tab">Izin</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#role-have-permission-tab" role="tab" data-toggle="tab">Peran
                                    Memiliki Izin</a>
                            </li>

                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <br>
                            <div role="tabpanel" class="tab-pane active" id="categories-tab">
                                <div class="mb-3">
                                    <form action="{{ route('category.store') }}" method="POST">
                                        @csrf
                                        <label for="">Tambahkan Kategori Baru</label>
                                        <div class="d-flex">
                                            <input type="text" class="form-control"
                                                placeholder="Nama kategori perusahaan" name="category_name">
                                            <button class="btn secondary-btn">Tambah</button>
                                        </div>
                                        @error('category_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </form>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="thead-inverse">
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Kategori</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($companyCategories as $category)
                                                <tr>
                                                    <td>{{ $category->id }}</td>
                                                    <td>{{ $category->category_name }}</td>
                                                    <td><a class="btn secondary-btn"
                                                            href="{{ route('category.edit', ['category' => $category]) }}">Edit</a>
                                                        <form
                                                            action="{{ route('category.destroy', ['id' => $category->id]) }}"
                                                            id="categoryDestroyForm" class="d-inline">
                                                            @csrf
                                                            @method('delete')
                                                            <button id="categoryDestroyBtn"
                                                                class="btn danger-btn">Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="roles-tab">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="thead-inverse">
                                            <tr>
                                                <th>#</th>
                                                <th>Peran</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roles as $index => $role)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $role }}</td>
                                                    <td><a class="btn secondary-btn" href="">Edit</a>
                                                        <form action="" class="d-inline"><button type="submit"
                                                                class="btn danger-btn">Hapus</button></form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="permissions-tab">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="thead-inverse">
                                            <tr>
                                                <th>#</th>
                                                <th>Izin</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($permissions as $index => $permission)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $permission }}</td>
                                                    <td><a class="btn secondary-btn" href="">Edit</a>
                                                        <form action="" class="d-inline"><button type="submit"
                                                                class="btn danger-btn">Hapus</button></form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="role-have-permission-tab">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="thead-inverse">
                                            <tr>
                                                <th>#</th>
                                                <th>Peran</th>
                                                <th>Izin</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($rolesHavePermissions as $index => $role)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>
                                                        {{ $role->name }}
                                                    </td>
                                                    <td>
                                                        @if ($role->permissions->count() == 0)
                                                            <span class="badge badge-primary">Izin dasar otentikasi</span>
                                                        @else
                                                            @foreach ($role->permissions as $permission)
                                                                <span
                                                                    class="badge badge-primary">{{ $permission->name }}</span>
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endSection
@push('js')
    <script>
        $(document).ready(function() {
            //delete category 
            $('#categoryDestroyBtn').click(function(e) {
                e.preventDefault();
                if (window.confirm('Apakah Anda yakin ingin menghapus Kategori ini?')) {
                    $('#categoryDestroyForm').submit();
                }
            })
        })
    </script>
@endpush
