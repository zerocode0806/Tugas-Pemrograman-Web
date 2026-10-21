<?php
// Dikerjakan: Ubed. GET ?id= mengambil data, POST menyimpan perubahan (UPDATE).
require __DIR__ . '/koneksi.php';
require __DIR__ . '/../rehan/layout.php';
$id = id_valid($_GET['id'] ?? null);
if (!$id) { flash('err', 'ID tidak valid.'); header('Location: ' . url('agung/data.php')); exit; }
$s = $db->prepare('SELECT nim,nama,jurusan,email,telepon,alamat FROM mahasiswa WHERE id=?');
$s->bind_param('i', $id);
$s->execute();
$d = $s->get_result()->fetch_assoc();
if (!$d) { flash('err', 'Data tidak ditemukan.'); header('Location: ' . url('agung/data.php')); exit; }
$err = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $d = ambil_input();
    $err = validasi($d);
    if (!$err) {
        try {
            $v = array_values($d);
            $v[] = $id;
            $u = $db->prepare('UPDATE mahasiswa SET nim=?,nama=?,jurusan=?,email=?,telepon=?,alamat=? WHERE id=?');
            $u->bind_param('ssssssi', ...$v);
            $u->execute();
            flash('ok', 'Biodata berhasil diperbarui.');
            header('Location: ' . url('ihya/detail.php?id=' . $id));
            exit;
        } catch (mysqli_sql_exception $ex) {
            $err[] = ($ex->getCode() == 1062) ? 'NIM sudah dipakai mahasiswa lain.' : 'Gagal menyimpan perubahan.';
        }
    }
}
$tombol = 'Simpan Perubahan';
tampil_header('Edit Biodata');
echo '<h1>Edit Biodata</h1>';
include __DIR__ . '/form.php';
tampil_footer();
