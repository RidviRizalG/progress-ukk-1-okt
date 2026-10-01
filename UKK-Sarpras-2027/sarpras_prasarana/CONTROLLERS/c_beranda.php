<?php
session_start();
require_once '../MODELS/m_koneksi.php';
require_once '../MODELS/m_aspirasi.php';

if (!isset($_SESSION['nis']) || ($_SESSION['role'] ?? '') !== 'siswa') {
    header("Location: ../VIEWS/v_login.php");
    exit();
}

$modelAspirasi = new M_Aspirasi($conn);

$nis = $_SESSION['nis'];
$nama_siswa = $_SESSION['nama_siswa'] ?? 'Siswa';
$kelas = $_SESSION['kelas'] ?? '-';

$page = $_GET['page'] ?? 'dashboard';

if ($page === 'form') {
    // Kategori hanya dibutuhkan oleh form pengaduan.
    $list_kategori = $modelAspirasi->getKategori();
    require_once '../VIEWS/v_aspirasi.php';

} elseif ($page === 'histori') {
    // Data histori sekarang ditangani oleh c_aspirasi.
    header("Location: c_aspirasi.php?aksi=histori");
    exit();

} else {
    require_once '../VIEWS/v_beranda.php';
}
?>
