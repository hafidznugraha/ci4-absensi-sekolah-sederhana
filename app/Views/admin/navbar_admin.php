<!-- app/Views/admin/_navbar_desktop.php -->
<nav class="navbar navbar-expand bg-white border-bottom shadow-sm
            d-none d-md-flex position-fixed top-0 start-0 end-0 px-4 py-2">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <img src="<?= base_url('assets/img/logo.png') ?>"
                alt="Logo" style="height:36px">
            <span class="fw-semibold text-primary">
                SMP SHANTI SATYA SUNDARA
            </span>
        </div>
        <div class="d-flex gap-4 text-center">
            <a href="<?= base_url('admin/dashboard') ?>"
                class="nav-link text-dark <?= service('uri')->getSegment(2) === 'dashboard' ? 'fw-bold text-primary' : '' ?>">
                <div><i class="bi bi-speedometer2"></i><br><small>Dashboard</small></div>
            </a>
            <a href="<?= base_url('admin/jadwal') ?>"
                class="nav-link text-dark <?= service('uri')->getSegment(2) === 'jadwal' ? 'fw-bold text-primary' : '' ?>">
                <div><i class="bi bi-calendar-week"></i><br><small>Jadwal</small></div>
            </a>
            <a href="<?= base_url('admin/siswa') ?>"
                class="nav-link text-dark <?= service('uri')->getSegment(2) === 'siswa' ? 'fw-bold text-primary' : '' ?>">
                <div><i class="bi bi-people-fill"></i><br><small>Siswa</small></div>
            </a>
            <a href="<?= base_url('admin/guru') ?>"
                class="nav-link text-dark <?= service('uri')->getSegment(2) === 'guru' ? 'fw-bold text-primary' : '' ?>">
                <div><i class="bi bi-person-badge-fill"></i><br><small>Guru</small></div>
            </a>
            <a href="<?= base_url('logout') ?>"
                class="nav-link text-danger">
                <div><i class="bi bi-box-arrow-right"></i><br><small>Logout</small></div>
            </a>
        </div>
    </div>
</nav>