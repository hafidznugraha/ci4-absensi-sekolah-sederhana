<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Profil Saya</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
        rel="stylesheet">
    <link
        rel="icon"
        href="<?= base_url('assets/img/logo.png') ?>"
        type="image/x-icon">
    <style>
        body {
            background-color: #F0F3FA;
            font-family: 'Segoe UI', sans-serif;
            padding-top: 70px;
        }

        .profile-card {
            max-width: 400px;
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .profile-header {
            background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
            padding: 2rem 1rem;
            color: #fff;
            text-align: center;
        }

        .profile-header .bi-person-circle {
            font-size: 4rem;
            opacity: .8;
        }

        .profile-header h4 {
            margin-top: .5rem;
            font-weight: 600;
        }

        .profile-body {
            padding: 1.5rem;
        }

        .profile-body p {
            margin-bottom: .75rem;
        }

        .profile-body p strong {
            width: 80px;
            display: inline-block;
        }

        .modal-content .form-control {
            box-shadow: none !important;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-light bg-white border-bottom fixed-top shadow-sm d-none d-md-flex">
        <div class="container-fluid px-4 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo" style="height:36px">
                <span class="fw-semibold text-primary">SMPN SWA BHUWANA PAKSA</span>
            </div>
            <div class="d-flex gap-4 text-center">
                <a href="<?= base_url('guru/beranda') ?>"
                    class="nav-link text-dark <?= service('uri')->getSegment(2) === 'beranda' ? 'fw-bold text-primary' : '' ?>">
                    <div><i class="bi bi-house-fill"></i><br><small>Beranda</small></div>
                </a>
                <a href="<?= base_url('guru/profil') ?>"
                    class="nav-link text-dark <?= service('uri')->getSegment(2) === 'profil' ? 'fw-bold text-primary' : '' ?>">
                    <div><i class="bi bi-person-circle"></i><br><small>Profil</small></div>
                </a>
                <a href="<?= base_url('logout') ?>" class="nav-link text-danger">
                    <div><i class="bi bi-box-arrow-right"></i><br><small>Logout</small></div>
                </a>
            </div>
        </div>
    </nav>

    <div class="container d-flex justify-content-center py-5">
        <div class="card profile-card">
            <div class="profile-header">
                <i class="bi bi-person-circle"></i>
                <h4>Profil Saya</h4>
            </div>
            <div class="profile-body">
                <p><strong>Nama:</strong> <?= esc($user['nama']) ?></p>
                <p><strong>Email:</strong> <?= esc($user['email']) ?></p>
                <div class="text-center mt-3">
                    <button class="btn btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#modalEditPassword">
                        Ubah Password
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditPassword" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <form action="<?= base_url('guru/profil/update') ?>" method="post">
                    <div class="modal-header border-0">
                        <h5 class="modal-title">Ubah Password</h5>
                    </div>
                    <div class="modal-body">
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif ?>
                        <div class="mb-3 text-start">
                            <label for="password" class="form-label">Password Baru</label>
                            <input type="password"
                                name="password"
                                id="password"
                                class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit"
                            class="btn btn-primary">
                            Simpan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <nav class="navbar fixed-bottom bg-white border-top d-flex d-md-none w-100">
        <div class="container d-flex justify-content-around text-center">
            <a href="<?= base_url('guru/beranda') ?>"
                class="<?= service('uri')->getSegment(2) === 'beranda' ? 'text-primary fw-bold' : 'text-dark' ?>">
                <i class="bi bi-house-fill"></i><br><small>Beranda</small>
            </a>
            <a href="<?= base_url('guru/profil') ?>"
                class="<?= service('uri')->getSegment(2) === 'profil' ? 'text-primary fw-bold' : 'text-dark' ?>">
                <i class="bi bi-person-fill"></i><br><small>Profil</small>
            </a>
            <a href="<?= base_url('logout') ?>" class="text-danger">
                <i class="bi bi-box-arrow-right"></i><br><small>Logout</small>
            </a>
        </div>
    </nav>


    <div id="toastContainer" class="position-fixed top-0 end-0 p-3" style="z-index: 1055"></div>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            <?php if (session()->getFlashdata('success')): ?>
                document.querySelectorAll('#toastContainer .toast').forEach(el => {
                    bootstrap.Toast.getOrCreateInstance(el).hide();
                });

                const toastHtml = `
            <div class="toast align-items-center text-bg-success border-0" 
                role="alert" aria-live="assertive" aria-atomic="true" 
                data-bs-delay="3000">
                <div class="d-flex">
                <div class="toast-body">
                    <?= esc(session()->getFlashdata('success')) ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" 
                        data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>`.trim();

                const wrapper = document.createElement('div');
                wrapper.innerHTML = toastHtml;
                const toastEl = wrapper.firstElementChild;

                toastEl.addEventListener('hidden.bs.toast', () => {
                    toastEl.remove();
                });

                document.getElementById('toastContainer').appendChild(toastEl);

                new bootstrap.Toast(toastEl).show();
            <?php endif; ?>
        });
    </script>
</body>

</html>