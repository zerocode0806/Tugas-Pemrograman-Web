<?php
// Dikerjakan: Ihya. Detail biodata berdasarkan ?id=.
require __DIR__ . '/../ubed/koneksi.php';
require __DIR__ . '/../rehan/layout.php';

$id = id_valid($_GET['id'] ?? null);
$m = null;

if ($id) {
    $s = $db->prepare(
        'SELECT id,nim,nama,jurusan,email,telepon,alamat,dibuat
         FROM mahasiswa WHERE id=?'
    );
    $s->bind_param('i', $id);
    $s->execute();
    $m = $s->get_result()->fetch_assoc();
}

if (!$m) http_response_code($id ? 404 : 400);

tampil_header('Detail Biodata', ['ihya/detail.css']);
?>

<main class="detail">
<?php if (!$m): ?>
    <h1>Data tidak tersedia</h1>
    <p><?= $id ? 'Biodata tidak ditemukan.' : 'ID tidak valid.' ?></p>
    <a class="btn" href="<?= e(url('agung/data.php')) ?>">Kembali</a>
<?php else: ?>
    <header class="detail-head">
        <p>PROFIL MAHASISWA</p>
        <h1><?= e($m['nama']) ?></h1>
    </header>

    <dl>
        <dt>NIM</dt>
        <dd><?= e($m['nim']) ?></dd>

        <dt>Jurusan</dt>
        <dd><?= e($m['jurusan']) ?></dd>

        <dt>Email</dt>
        <dd><?= e($m['email'] ?: '-') ?></dd>

        <dt>Telepon</dt>
        <dd><?= e($m['telepon'] ?: '-') ?></dd>

        <dt>Alamat</dt>
        <dd><?= $m['alamat'] ? nl2br(e($m['alamat'])) : '-' ?></dd>

        <dt>Dicatat pada</dt>
        <dd><?= e($m['dibuat']) ?></dd>
    </dl>

    <nav class="actions" aria-label="Aksi biodata">
        <a class="btn" href="<?= e(url('ubed/edit.php?id=' . (int) $m['id'])) ?>">Edit</a>
        <a class="btn btn-lain" href="<?= e(url('agung/data.php')) ?>">Kembali</a>
    </nav>
<?php endif; ?>
</main>

<?php tampil_footer(); ?>
