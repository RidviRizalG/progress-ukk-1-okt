<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Beri Feedback - Pengaduan Sarana Prasarana</title>
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

            <?php
            $statusSekarang = $detail['status'] ?? 'Menunggu';
            $tglLapor = date('d/m/Y H:i', strtotime($detail['tgl_pelaporan']));
            ?>

            <div class="card detail-card">

                <h3>Beri Feedback</h3>

                <?php if (($pesan ?? '') === 'gagal'): ?>
                    <div class="form-alert">Feedback gagal disimpan. Silakan coba lagi.</div>
                <?php elseif (($pesan ?? '') === 'status_tidak_valid'): ?>
                    <div class="form-alert">Status yang dipilih tidak valid.</div>
                <?php endif; ?>

                <section class="detail-section" aria-labelledby="judul-info">
                    <h4 class="detail-section-title" id="judul-info">Detail Pengaduan</h4>
                    <dl class="detail-grid">
                        <div class="detail-item">
                            <dt>Siswa</dt>
                            <dd>
                                <?= htmlspecialchars($detail['nama_siswa'] ?? '-') ?>
                                (<?= htmlspecialchars($detail['kelas'] ?? '-') ?>)
                            </dd>
                        </div>
                        <div class="detail-item">
                            <dt>Tanggal Pengaduan</dt>
                            <dd><?= htmlspecialchars($tglLapor) ?></dd>
                        </div>
                        <div class="detail-item detail-item-full">
                            <dt>Kategori</dt>
                            <dd><?= htmlspecialchars($detail['ket_kategori'] ?? '-') ?></dd>
                        </div>
                        <div class="detail-item detail-item-full">
                            <dt>Lokasi</dt>
                            <dd><?= htmlspecialchars($detail['lokasi'] ?? '-') ?></dd>
                        </div>
                        <div class="detail-item detail-item-full">
                            <dt>Isi Pengaduan</dt>
                            <dd class="detail-text"><?= htmlspecialchars($detail['ket'] ?? '-') ?></dd>
                        </div>
                    </dl>
                </section>

                <section class="detail-section" aria-labelledby="judul-feedback">
                    <h4 class="detail-section-title" id="judul-feedback">Ubah Status &amp; Feedback</h4>

                    <form action="../CONTROLLERS/c_feedback.php" method="POST" autocomplete="off">

                        <input type="hidden" name="id_input" value="<?= (int)$detail['id_input'] ?>">
                        <input type="hidden" name="aspirasi_page" value="<?= (int)$aspirasiPage ?>">

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" name="status" required>
                                <?php foreach (['Menunggu', 'Proses', 'Selesai'] as $opsi): ?>
                                    <option value="<?= $opsi ?>" <?= $statusSekarang === $opsi ? 'selected' : '' ?>>
                                        <?= $opsi ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="feedback">Feedback</label>
                            <textarea
                                id="feedback"
                                name="feedback"
                                rows="5"
                                placeholder="Tulis feedback untuk siswa..."
                            ><?= htmlspecialchars($detail['feedback'] ?? '') ?></textarea>
                        </div>

                        <div class="form-action-row">
                            <button type="submit" class="btn-submit btn-submit-compact">Kirim</button>
                            <a class="btn-cancel" href="../CONTROLLERS/<?= htmlspecialchars($batalUrl) ?>">Batal</a>
                        </div>

                    </form>
                </section>

            </div>

    </div>

<script src="../JS/theme.js"></script>
</body>

</html>
