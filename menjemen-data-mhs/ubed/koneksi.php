<?php
// Dikerjakan: Ubed. Koneksi MySQL + fungsi bantu (escape, flash, validasi).
session_start();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $db = new mysqli('localhost', 'root', '', 'biodata_db');
    $db->set_charset('utf8mb4');
} catch (mysqli_sql_exception $ex) {
    http_response_code(500);
    exit('Koneksi gagal. Pastikan MySQL aktif dan database.sql sudah diimpor.');
}
const FIELD = ['nim', 'nama', 'jurusan', 'email', 'telepon', 'alamat'];

function e($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

// flash('ok','teks') menyimpan pesan; flash() tanpa argumen membaca lalu menghapusnya.
function flash($tipe = null, $pesan = null) {
    if ($tipe) { $_SESSION['flash'] = [$tipe, $pesan]; return null; }
    $f = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $f;
}
function id_valid($v) {
    return filter_var($v, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
}
function ambil_input() {
    $d = [];
    foreach (FIELD as $k) { $d[$k] = trim($_POST[$k] ?? ''); }
    return $d;
}
function validasi($d) {
    $err = [];
    if (!preg_match('/^\d{5,20}$/', $d['nim'])) $err[] = 'NIM harus 5-20 digit angka.';
    $n = preg_match_all('/./su', $d['nama']); // hitung karakter tanpa ekstensi mbstring
    if ($n < 3 || $n > 100) $err[] = 'Nama harus 3-100 karakter.';
    if ($d['jurusan'] === '') $err[] = 'Jurusan wajib diisi.';
    if ($d['email'] !== '' && !filter_var($d['email'], FILTER_VALIDATE_EMAIL)) $err[] = 'Format email tidak valid.';
    if ($d['telepon'] !== '' && !preg_match('/^\+?\d{8,15}$/', $d['telepon'])) $err[] = 'Telepon harus 8-15 digit.';
    return $err;
}
