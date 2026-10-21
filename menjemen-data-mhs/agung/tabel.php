<?php
// Dikerjakan: Agung. Fungsi tabel_mahasiswa($rows), dipakai data.php dan cari.php.
function tabel_mahasiswa(array $rows) { ?>
<div class="tabel-wrap">
<table class="tabel">
<caption class="sr">Daftar biodata mahasiswa</caption>
<thead><tr><th scope="col">No</th><th scope="col">NIM</th><th scope="col">Nama</th><th scope="col" class="col-jurusan">Jurusan</th><th scope="col">Aksi</th></tr></thead>
<tbody>
<?php foreach ($rows as $i => $r): ?>
<tr>
<td><?= $i + 1 ?></td><td><?= e($r['nim']) ?></td><td><?= e($r['nama']) ?></td><td class="col-jurusan"><?= e($r['jurusan']) ?></td>
<td class="aksi"><a href="<?= e(url('ihya/detail.php?id=' . (int)$r['id'])) ?>">Detail</a> <a href="<?= e(url('ubed/edit.php?id=' . (int)$r['id'])) ?>">Edit</a></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
<?php }
