<?php
// Dikerjakan: Ubed. Form POST -> validasi -> INSERT (prepared statement) -> redirect.
require __DIR__ . '/koneksi.php';
require __DIR__ . '/../rehan/layout.php';
$d = array_fill_keys(FIELD, '');
$err = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $d = ambil_input();
    $err = validasi($d);
    if (!$err) {
        try {
            $v = array_values($d);
            $s = $db->prepare('INSERT INTO mahasiswa (nim,nama,jurusan,email,telepon,alamat) VALUES (?,?,?,?,?,?)');
            $s->bind_param('ssssss', ...$v);
            $s->execute();
            flash('ok', 'Biodata berhasil ditambahkan.');
            header('Location: ' . url('agung/data.php'));
            exit;
        } catch (mysqli_sql_exception $ex) {
            $err[] = ($ex->getCode() == 1062) ? 'NIM sudah terdaftar.' : 'Gagal menyimpan data.';
        }
    }
}
$tombol = 'Simpan';
tampil_header('Tambah Biodata');
echo '<h1>Tambah Biodata</h1>';
include __DIR__ . '/form.php';
tampil_footer();
