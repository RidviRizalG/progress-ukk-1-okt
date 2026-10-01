<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin - Pengaduan Sarana Prasarana</title>
    <link rel="stylesheet" href="../CSS/01-warna-dan-font.css">
    <link rel="stylesheet" href="../CSS/02-navbar-atas.css">
    <link rel="stylesheet" href="../CSS/03-form-dan-tombol.css">
    <link rel="stylesheet" href="../CSS/04-tabel-dan-badge.css">
    <link rel="stylesheet" href="../CSS/05-admin-dan-dashboard.css">
</head>

<body class="dashboard-page">

    <div class="navbar">

        <div class="brand">
            <img class="logo" src="../ASSETS/logo_sekolah_temagelap.png" alt="Logo Sekolah">
            <span>Aplikasi Pengaduan Sarana Prasarana SMK Hunter x Hunter</span>
        </div>

        <div class="user-info">

            <span class="role-name">
                Admin:
                <?= htmlspecialchars($nama_admin) ?>
            </span>

            <small>
                (<?= htmlspecialchars($role_admin) ?>)
            </small>

            <button type="button" class="theme-toggle" data-theme-toggle aria-label="Ganti tema"></button>
            <a
                class="btn-logout"
                href="../CONTROLLERS/c_logout.php"
                title="Logout"
            >
                <img src="../ASSETS/logout.png" alt="Logout">
            </a>

        </div>

    </div>

    <!-- =========================
         CONTENT
    ========================= -->

    <div class="container">

            <div class="dashboard-hero">
                <div class="dashboard-hero-content">
                    <img class="dashboard-hero-logo" src="../ASSETS/logo_sekolah.png" alt="Logo Sekolah" style="border:0;object-fit:contain;">
                    <h2>Selamat datang di Pengaduan Sarana Prasarana</h2>
                    <h2>SMK Hunter x Hunter</h2>
                    <div class="dashboard-name">
                        <?= htmlspecialchars($_SESSION['nama_admin'] ?? 'Admin') ?>
                    </div>
                    <h3>Kelola data siswa dan pantau histori aspirasi secara mudah dan terorganisir</h3>
                </div>
            </div>

            <div class="dashboard-nav-grid">
                <a class="dashboard-link" href="../CONTROLLERS/c_aspirasi_admin.php">
                    <img src="../ASSETS/historiaspirasi.png" alt="List Aspirasi">
                    <span> List Aspirasi</span>
                </a>

                <a class="dashboard-link" href="../CONTROLLERS/c_siswa.php">
                    <img src="../ASSETS/datasiswa.png" alt="List Siswa">
                    <span>List Siswa</span>
                </a>
            </div>

    </div>

<script src="../JS/theme.js"></script>
</body>

</html>
