<?php
// Dikerjakan: Agung. Menampilkan semua biodata dalam tabel.
require __DIR__ . '/../ubed/koneksi.php';
require __DIR__ . '/../rehan/layout.php';
require __DIR__ . '/tabel.php';
$rows = $db->query('SELECT id,nim,nama,jurusan FROM mahasiswa ORDER BY nama')->fetch_all(MYSQLI_ASSOC);
tampil_header('Data Biodata', ['agung/data.css']);
?>
<div class="bar"><h1>Data Biodata</h1><a class="btn" href="<?= e(url('ubed/tambah.php')) ?>">Tambah Biodata</a></div>
<p><?= count($rows) ?> data ditemukan.</p>
<?php if ($rows) tabel_mahasiswa($rows); else echo '<p class="kosong">Belum ada data biodata.</p>'; ?>
<?php tampil_footer();
