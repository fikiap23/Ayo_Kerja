<div class="account-nav">
    <ul class="list-group">
        @role('admin')
            <li class="list-group-item list-group-item-action {{ request()->segment(2) == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('account.dashboard') }}" class="account-nav-link">
                    <i class="fas fa-chart-line"></i> Dasbor
                </a>
            </li>
            <li
                class="list-group-item list-group-item-action {{ request()->segment(2) == 'view-all-users' ? 'active' : '' }}">
                <a href="{{ route('account.viewAllUsers') }}" class="account-nav-link">
                    <i class="fas fa-users"></i> Lihat Semua Pengguna
                </a>
            </li>
        @endrole
        @role('author')
            <li
                class="list-group-item list-group-item-action {{ request()->segment(2) == 'author-section' ? 'active' : '' }}">
                <a href="{{ route('account.authorSection') }}" class="account-nav-link">
                    <i class="fas fa-chart-line"></i> Bagian Perusahaan
            </li>
            <li
                class="list-group-item list-group-item-action {{ request()->segment(2) == 'post' && request()->segment(3) == 'create' ? 'active' : '' }}">
                <a href="{{ route('post.create') }}" class="account-nav-link">
                    <i class="fas fa-plus-square"></i> Buat Pekerjaan
            </li>
            <li
                class="list-group-item list-group-item-action {{ request()->segment(2) == 'job-application' ? 'active' : '' }}">
                <a href="{{ route('jobApplication.index') }}" class="account-nav-link">
                    <i class="fas fa-bell"></i> Lamaran Pekerjaan
            </li>
        @endrole
        <li class="list-group-item list-group-item-action {{ request()->segment(2) == 'overview' ? 'active' : '' }}">
            <a href="{{ route('account.index') }}" class="account-nav-link">
                <i class="fas fa-user-shield"></i> Akun Pengguna
            </a>
        </li>
        @role('user')
            <li
                class="list-group-item list-group-item-action {{ request()->segment(2) == 'become-employer' ? 'active' : '' }}">
                <a href="{{ route('account.becomeEmployer') }}" class="account-nav-link">
                    <i class="fas fa-user-shield"></i> Menjadi Pemberi Kerja
                </a>
            </li>
        @endrole
        <li
            class="list-group-item list-group-item-action {{ request()->segment(2) == 'change-password' ? 'active' : '' }}">
            <a href="{{ route('account.changePassword') }}" class="account-nav-link">
                <i class="fas fa-fingerprint"></i> Ubah Kata Sandi
            </a>
        </li>
        <li
            class="list-group-item list-group-item-action {{ request()->segment(2) == 'my-saved-jobs' ? 'active' : '' }}">
            <a href="{{ route('savedJob.index') }}" class="account-nav-link">
                <i class="fas fa-stream"></i> Pekerjaan Tersimpan Saya
            </a>
        </li>
        <li class="list-group-item list-group-item-action {{ request()->segment(2) == 'deactivate' ? 'active' : '' }}">
            <a href="{{ route('account.deactivate') }}" class="account-nav-link">
                <i class="fas fa-folder-minus"></i> Nonaktifkan Akun
            </a>
        </li>
    </ul>
</div>
