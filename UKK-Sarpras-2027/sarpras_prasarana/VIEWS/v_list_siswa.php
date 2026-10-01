<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>List Siswa - Pengaduan Sarana Prasarana</title>
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

        <?php if (!$showEditForm): ?>
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
                        class=""
                        href="../CONTROLLERS/c_aspirasi_admin.php"
                        title="Histori Aspirasi"
                    >
                        <img src="../ASSETS/historiaspirasi.png" alt="Histori Aspirasi">
                    </a>

                    <a
                        class="active"
                        href="../CONTROLLERS/c_siswa.php"
                        title="List Siswa"
                    >
                        <img src="../ASSETS/datasiswa.png" alt="List Siswa">
                    </a>

                </div>

                <small>Admin Panel</small>

            </div>
        <?php endif; ?>

        <?php if ($showAddForm): ?>

            <div class="card">
                <h3>Tambah Siswa</h3>

                <form action="../CONTROLLERS/c_siswa.php?aksi=tambah" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label>NIS</label>
                        <input type="number" name="nis" placeholder="NIS" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>Nama Siswa</label>
                        <input type="text" name="nama_siswa" placeholder="Nama Siswa" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>Kelas</label>
                        <input type="text" name="kelas" placeholder="Kelas" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>Jurusan</label>
                        <input type="text" name="jurusan" placeholder="Jurusan" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" required autocomplete="off">
                            <option value="L">L</option>
                            <option value="P">P</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Password" required autocomplete="new-password">
                    </div>

                    <div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;">
                        <button type="submit" class="btn-submit" style="width:auto;min-width:180px;">Tambah Siswa</button>
                        <a href="../CONTROLLERS/c_siswa.php" class="btn-logout" style="display:inline-flex;align-items:center;justify-content:center;width:120px;height:40px;padding:0;">Batal</a>
                    </div>
                </form>
            </div>

        <?php elseif ($showEditForm): ?>

            <div class="card">

                <h3>Edit Siswa</h3>

                <form
                    action="../CONTROLLERS/c_siswa.php?aksi=update"
                    method="POST"
                    autocomplete="off"
                >

                    <?php if (!empty($editing_siswa)): ?>
                        <input type="hidden" name="nis_lama" value="<?= htmlspecialchars($editing_siswa['nis'] ?? '') ?>">
                    <?php endif; ?>

                    <div class="form-group">
                        <label>NIS</label>

                        <input
                            type="number"
                            name="nis"
                            placeholder="NIS"
                            value="<?= htmlspecialchars($editing_siswa['nis'] ?? '') ?>"
                            required
                            autocomplete="off"
                        >
                    </div>

                    <div class="form-group">
                        <label>Nama Siswa</label>

                        <input
                            type="text"
                            name="nama_siswa"
                            placeholder="Nama Siswa"
                            value="<?= htmlspecialchars($editing_siswa['nama_siswa'] ?? '') ?>"
                            required
                            autocomplete="off"
                        >
                    </div>

                    <div class="form-group">
                        <label>Kelas</label>

                        <input
                            type="text"
                            name="kelas"
                            placeholder="Kelas"
                            value="<?= htmlspecialchars($editing_siswa['kelas'] ?? '') ?>"
                            required
                            autocomplete="off"
                        >
                    </div>

                    <div class="form-group">
                        <label>Jurusan</label>

                        <input
                            type="text"
                            name="jurusan"
                            placeholder="Jurusan"
                            value="<?= htmlspecialchars($editing_siswa['jurusan'] ?? '') ?>"
                            required
                            autocomplete="off"
                        >
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin</label>

                        <select
                            name="jenis_kelamin"
                            required
                            autocomplete="off"
                        >
                            <option value="L" <?= (($editing_siswa['jenis_kelamin'] ?? '') === 'L') ? 'selected' : '' ?>>L</option>
                            <option value="P" <?= (($editing_siswa['jenis_kelamin'] ?? '') === 'P') ? 'selected' : '' ?>>P</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Password</label>

                        <input
                            type="password"
                            name="password"
                            placeholder="Password"
                            value="<?= htmlspecialchars($editing_siswa['password'] ?? '') ?>"
                            required
                            autocomplete="new-password"
                        >
                    </div>

                    <button type="submit" class="btn-submit">
                        Simpan Perubahan
                    </button>

                </form>

            </div>

        <?php else: ?>

            <div class="card">

                <h3>List Siswa</h3>

                <div style="margin-bottom:16px;">
                    <a href="../CONTROLLERS/c_siswa.php?aksi=tambah" class="btn-logout" title="Tambah Siswa" style="display:inline-flex;align-items:center;justify-content:center;width:48px;height:48px;padding:0;">
                        <img src="../ASSETS/tambah_datasiswa.png" alt="Tambah Siswa" style="width:24px;height:24px;object-fit:contain;display:block;filter:brightness(0) invert(1);">
                    </a>
                </div>

                <form method="GET" action="../CONTROLLERS/c_siswa.php" style="margin-bottom:16px;">
                    <div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;">
                        <input
                            type="text"
                            name="siswa_keyword"
                            value="<?= htmlspecialchars($siswaKeyword ?? '') ?>"
                            placeholder="Cari NIS, nama, kelas, jurusan..."
                            style="max-width:420px;"
                            autocomplete="off"
                        >
                        <button type="submit" class="btn-submit" title="Cari" style="width:auto;padding:10px 16px;display:inline-flex;align-items:center;justify-content:center;">
                            <img src="../ASSETS/search_aspirasi.png" alt="Cari" style="width:24px;height:24px;object-fit:contain;display:block;filter:brightness(0) invert(1);">
                        </button>
                        <?php if (($siswaKeyword ?? '') !== ''): ?>
                            <a href="../CONTROLLERS/c_siswa.php" class="btn-logout" title="Reset Pencarian" style="display:inline-flex;align-items:center;justify-content:center;width:44px;height:44px;padding:0;"><img src="../ASSETS/reset_search.png" alt="Reset Pencarian" style="width:24px;height:24px;object-fit:contain;display:block;filter:brightness(0) invert(1);"></a>
                        <?php endif; ?>
                    </div>
                </form>

                <div class="table-responsive">

                    <table class="table">

                        <thead>
                            <tr>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th>JK</th>
                                <th>Password</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php if (empty($list_siswa)): ?>

                                <tr>
                                    <td
                                        colspan="7"
                                        style="text-align:center;color:#888;padding:20px;"
                                    >
                                        Belum ada data siswa.
                                    </td>
                                </tr>

                            <?php else: ?>

                                <?php foreach ($list_siswa as $s): ?>

                                    <tr>

                                        <td>
                                            <?= htmlspecialchars($s['nis']) ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($s['nama_siswa']) ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($s['kelas']) ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($s['jurusan']) ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($s['jenis_kelamin']) ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($s['password']) ?>
                                        </td>

                                        <td>

                                            <a
                                                href="../CONTROLLERS/c_siswa.php?aksi=edit&nis=<?= urlencode($s['nis']) ?>"
                                                title="Edit Siswa"
                                                style="display:inline-flex;align-items:center;justify-content:center;width:28px;height:28px;border-radius:8px;background:#fdf4f5;border:1px solid #f0d7dd;"
                                            >
                                                <img src="../ASSETS/edit_datasiswa.png" alt="Edit Siswa" style="width:18px;height:18px;object-fit:contain;display:block;">
                                            </a>

                                            <a
                                                href="../CONTROLLERS/c_siswa.php?aksi=hapus&nis=<?= urlencode($s['nis']) ?>"
                                                onclick="return confirm('Hapus siswa ini?')"
                                                title="Hapus Siswa"
                                                style="display:inline-flex;align-items:center;justify-content:center;width:28px;height:28px;border-radius:8px;background:#fdf4f5;border:1px solid #f0d7dd;"
                                            >
                                                <img src="../ASSETS/hapus_datasiswa.png" alt="Hapus Siswa" style="width:18px;height:18px;object-fit:contain;display:block;">
                                            </a>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

                <div class="pagination" style="margin-top:14px;display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
                    <?php if ($siswaPage > 1): ?>
                        <a class="btn-logout" href="../CONTROLLERS/c_siswa.php?siswa_page=<?= (int)($siswaPage - 1) ?>&siswa_keyword=<?= urlencode($siswaKeyword ?? '') ?>">Sebelumnya</a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalSiswaPages; $i++): ?>
                        <a class="btn-logout" style="<?= $i === $siswaPage ? 'background:#6b1d2f;color:#fff;' : '' ?>" href="../CONTROLLERS/c_siswa.php?siswa_page=<?= $i ?>&siswa_keyword=<?= urlencode($siswaKeyword ?? '') ?>"><?= $i ?></a>
                    <?php endfor; ?>

                    <?php if ($siswaPage < $totalSiswaPages): ?>
                        <a class="btn-logout" href="../CONTROLLERS/c_siswa.php?siswa_page=<?= (int)($siswaPage + 1) ?>&siswa_keyword=<?= urlencode($siswaKeyword ?? '') ?>">Berikutnya</a>
                    <?php endif; ?>
                </div>

            </div>

        <?php endif; ?>

    </div>

<script src="../JS/theme.js"></script>
</body>

</html>
