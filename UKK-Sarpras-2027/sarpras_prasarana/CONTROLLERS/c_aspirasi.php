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
$aksi = $_GET['aksi'] ?? '';


// =====================================================
// MELIHAT HISTORI ASPIRASI
// =====================================================

if ($aksi === 'histori') {

    // Mengambil data aspirasi milik siswa yang sedang login.
    $list_aspirasi = $modelAspirasi->getAspirasiByNis($nis);

    // Menampilkan halaman histori.
    require_once '../VIEWS/v_histori_aspirasi.php';
    exit();
}


// =====================================================
// MENAMBAH / MENGIRIM ASPIRASI
// =====================================================

if ($aksi === 'tambah' && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_kategori = trim($_POST['id_kategori'] ?? '');
    $lokasi = trim($_POST['lokasi'] ?? '');
    $ket = trim($_POST['ket'] ?? '');

    if ($nis === '' || $id_kategori === '' || $lokasi === '' || $ket === '') {
        header('Location: c_beranda.php?page=form&status=data_tidak_lengkap');
        exit();
    }

    if ($modelAspirasi->tambahAspirasi($nis, $id_kategori, $lokasi, $ket)) {
        header('Location: c_beranda.php?page=dashboard&status=berhasil');
        exit();
    }

    header('Location: c_beranda.php?page=form&status=gagal');
    exit();
}


// =====================================================
// AKSI TIDAK DIKENALI
// =====================================================

header('Location: c_beranda.php?page=dashboard');
exit();
?>
