<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MASUK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" href="<?= base_url('assets/img/logo.png') ?>" type="image/x-icon">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            background-color: #F0F3FA;
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 0 16px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 400px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .logo-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 16px;
            gap: 4px;
        }

        .logo-box img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            margin-bottom: 2px;
            transition: width 0.2s, height 0.2s;
        }

        .logo-box .school-name {
            font-weight: 600;
            font-size: 1.05rem;
            color: #1A3962;
            letter-spacing: 0.5px;
            text-align: center;
        }

        .login-box {
            background: white;
            border-radius: 20px;
            padding: 30px 20px;
            border: 1px solid #D5DEEF;
            width: 100%;
            box-shadow: none !important;
        }

        .form-control {
            border-color: #B1C9EF;
            box-shadow: none !important;
        }

        .form-control:focus {
            border-color: #8AAEE0;
        }

        .form-control::placeholder {
            color: #aaa;
        }

        .btn-primary {
            background-color: #628ECB;
            border-color: #628ECB;
            box-shadow: none !important;
        }

        select.form-select {
            box-shadow: none !important;
        }

        .btn-primary:hover {
            background-color: #395886;
            border-color: #395886;
        }

        .form-select:focus {
            border-color: #8AAEE0;
        }

        .copyright-box {
            margin-top: 20px;
            text-align: center;
            color: #777;
            font-size: 0.93rem;
            margin-bottom: 0;
        }

        @media (max-width: 576px) {
            body {
                justify-content: flex-start;
            }

            .login-wrapper {
                max-width: 100%;
                padding-top: 16px !important;
                margin-top: 0 !important;
            }

            .logo-box img {
                width: 120px !important;
                height: 120px !important;
            }
        }
    </style>
</head>

<body>
    <div class="login-wrapper">
        <div class="logo-box">
            <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo Sekolah">
            <span class="school-name">SMP SHANTI SATYA SUNDARA</span>
        </div>

        <div class="login-box">
            <h4 class="text-center mb-4">Masuk Ke Akun Anda</h4>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= esc(session()->getFlashdata('error')) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('auth/process') ?>" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi:</label>
                    <div class="input-group">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control"
                            required>
                        <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                            <i class="bi bi-eye"></i>
                        </span>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Login Sebagai:</label>
                    <select class="form-select" name="role" required>
                        <option value="siswa">Siswa</option>
                        <option value="guru">Guru</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100">Masuk</button>
            </form>
        </div>
        <div class="copyright-box">
            &copy; Hafidz Nugraha | Sistem Informasi | Unjani | 2025
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const toggle = document.getElementById('togglePassword');
        const input = document.getElementById('password');
        const icon = toggle.querySelector('i');
        toggle.addEventListener('click', () => {
            const isPwd = input.getAttribute('type') === 'password';
            input.setAttribute('type', isPwd ? 'text' : 'password');
            icon.classList.toggle('bi-eye');
            icon.classList.toggle('bi-eye-slash');
        });
    </script>
</body>

</html>