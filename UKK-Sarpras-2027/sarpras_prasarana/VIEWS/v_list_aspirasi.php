<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Histori Aspirasi - Pengaduan Sarana Prasarana</title>
    <link rel="stylesheet" href="../CSS/01-warna-dan-font.css">
    <link rel="stylesheet" href="../CSS/02-navbar-atas.css">
    <link rel="stylesheet" href="../CSS/03-form-dan-tombol.css">
    <link rel="stylesheet" href="../CSS/04-tabel-dan-badge.css">
    <link rel="stylesheet" href="../CSS/05-admin-dan-dashboard.css">
    <link rel="stylesheet" href="../CSS/06-detail-pengaduan.css">
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

        <!-- ADMIN NAVIGATION -->

            <div class="admin-nav">

                <div class="menu">

                    <a
                        class=""
                        href="../CONTROLLERS/c_admin.php"
                        title="Dashboard"
                    >
                        <img src="../ASSETS/logo_dashboard.png" alt="Dashboard" style="width:24px;height:24px;object-fit:contain;display:block;">
                    </a>

                    <a
                        class="active"
                        href="../CONTROLLERS/c_aspirasi_admin.php"
                        title="Histori Aspirasi"
                    >
                        <img src="../ASSETS/historiaspirasi.png" alt="Histori Aspirasi">
                    </a>

                    <a
                        class=""
                        href="../CONTROLLERS/c_siswa.php"
                        title="List Siswa"
                    >
                        <img src="../ASSETS/datasiswa.png" alt="List Siswa">
                    </a>

                </div>

                <small>Admin Panel</small>

            </div>

            <div class="card">

                <h3>Histori Aspirasi Siswa</h3>

                <div class="table-responsive">

                    <table class="table">

                        <thead>

                            <tr>
                                <th>Tanggal</th>
                                <th>Siswa</th>
                                <th>Kategori</th>
                                <th>Lokasi</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th>Feedback</th>
                                <th>Aksi</th>
                            </tr>

                        </thead>

                        <tbody>

                            <?php if (empty($list_aspirasi)): ?>

                                <tr>

                                    <td
                                        colspan="8"
                                        style="text-align:center;color:#888;padding:20px;"
                                    >
                                        Belum ada pengaduan.
                                    </td>

                                </tr>

                            <?php else: ?>

                                <?php foreach ($list_aspirasi as $row): ?>

                                    <?php
                                    $badgeClass = 'badge-menunggu';

                                    if (($row['status'] ?? '') === 'Proses') {
                                        $badgeClass = 'badge-proses';
                                    }

                                    if (($row['status'] ?? '') === 'Selesai') {
                                        $badgeClass = 'badge-selesai';
                                    }
                                    ?>

                                    <tr>

                                        <td>
                                            <small>
                                                <?= date(
                                                    'd/m/Y H:i',
                                                    strtotime($row['tgl_pelaporan'])
                                                ) ?>
                                            </small>
                                        </td>

                                        <td>

                                            <strong>
                                                <?= htmlspecialchars(
                                                    $row['nama_siswa'] ?? '-'
                                                ) ?>
                                            </strong>

                                            <br>

                                            <small>
                                                <?= htmlspecialchars(
                                                    $row['kelas'] ?? '-'
                                                ) ?>
                                            </small>

                                        </td>

                                        <td>
                                            <?= htmlspecialchars(
                                                $row['ket_kategori'] ?? '-'
                                            ) ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars(
                                                $row['lokasi'] ?? '-'
                                            ) ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars(
                                                $row['ket'] ?? '-'
                                            ) ?>
                                        </td>

                                        <td>

                                            <span class="badge <?= $badgeClass ?>">
                                                <?= htmlspecialchars(
                                                    $row['status'] ?? 'Menunggu'
                                                ) ?>
                                            </span>

                                        </td>

                                        <td>
                                            <?php $feedbackTeks = trim((string)($row['feedback'] ?? '')); ?>
                                            <?php if ($feedbackTeks !== ''): ?>
                                                <span style="white-space:pre-line;"><?= htmlspecialchars($feedbackTeks) ?></span>
                                            <?php else: ?>
                                                <small style="color:#888;font-style:italic;">Belum ada feedback</small>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <a
                                                class="detail-icon-btn"
                                                href="../CONTROLLERS/c_feedback.php?id=<?= (int)$row['id_input'] ?>&aspirasi_page=<?= (int)$aspirasiPage ?>"
                                                title="Beri Feedback"
                                            >
                                                <img src="../ASSETS/mengisi_feedback.png" alt="Beri Feedback">
                                            </a>
                                        </td>


                                    </tr>

                                <?php endforeach; ?>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

                <div class="pagination" style="margin-top:14px;display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
                    <?php if ($aspirasiPage > 1): ?>
                        <a class="btn-logout" href="../CONTROLLERS/c_aspirasi_admin.php?aspirasi_page=<?= (int)($aspirasiPage - 1) ?>">Sebelumnya</a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalAspirasiPages; $i++): ?>
                        <a class="btn-logout" style="<?= $i === $aspirasiPage ? 'background:#6b1d2f;color:#fff;' : '' ?>" href="../CONTROLLERS/c_aspirasi_admin.php?aspirasi_page=<?= $i ?>"><?= $i ?></a>
                    <?php endfor; ?>

                    <?php if ($aspirasiPage < $totalAspirasiPages): ?>
                        <a class="btn-logout" href="../CONTROLLERS/c_aspirasi_admin.php?aspirasi_page=<?= (int)($aspirasiPage + 1) ?>">Berikutnya</a>
                    <?php endif; ?>
                </div>

            </div>

    </div>

<script src="../JS/theme.js"></script>
</body>

</html>
