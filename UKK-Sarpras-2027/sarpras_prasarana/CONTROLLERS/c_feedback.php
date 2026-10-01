<?php
// Khusus fitur Admin: form untuk memberi status dan feedback pada satu aspirasi.
session_start();
require_once '../MODELS/m_koneksi.php';
require_once '../MODELS/m_aspirasi.php';

if (($_SESSION['role'] ?? '') !== 'admin') {
    header('Location: ../VIEWS/v_login.php');
    exit();
}

$modelAspirasi = new M_Aspirasi($conn);

// Halaman daftar aspirasi yang dituju setelah selesai / batal.
function urlDaftarAspirasi($halaman) {
    $halaman = (int)$halaman;
    return 'c_aspirasi_admin.php' . ($halaman > 1 ? '?aspirasi_page=' . $halaman : '');
}

// ---------- Simpan status + feedback ----------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_input = (int)($_POST['id_input'] ?? 0);
    $status = trim($_POST['status'] ?? '');
    $feedback = trim($_POST['feedback'] ?? '');
    $id_admin = (int)($_SESSION['id_admin'] ?? 0);
    $aspirasiPage = max(1, (int)($_POST['aspirasi_page'] ?? 1));

    if ($id_input <= 0) {
        header('Location: ' . urlDaftarAspirasi($aspirasiPage));
        exit();
    }

    $formUrl = 'c_feedback.php?id=' . $id_input . '&aspirasi_page=' . $aspirasiPage;

    if (!in_array($status, ['Menunggu', 'Proses', 'Selesai'], true)) {
        header('Location: ' . $formUrl . '&pesan=status_tidak_valid');
        exit();
    }

    if ($modelAspirasi->updateAspirasi($id_input, $status, $feedback, $id_admin)) {
        header('Location: ' . urlDaftarAspirasi($aspirasiPage));
        exit();
    }

    header('Location: ' . $formUrl . '&pesan=gagal');
    exit();
}

// ---------- Tampilkan form ----------
$id_input = (int)($_GET['id'] ?? 0);
$aspirasiPage = max(1, (int)($_GET['aspirasi_page'] ?? 1));
$detail = $id_input > 0 ? $modelAspirasi->getAspirasiById($id_input) : null;

if (!$detail) {
    header('Location: ' . urlDaftarAspirasi($aspirasiPage));
    exit();
}

$pesan = $_GET['pesan'] ?? '';
$batalUrl = urlDaftarAspirasi($aspirasiPage);

$nama_admin = $_SESSION['nama_admin'] ?? 'Admin';
$role_admin = $_SESSION['role_admin'] ?? 'Admin';

require_once '../VIEWS/v_form_feedback.php';
?>
