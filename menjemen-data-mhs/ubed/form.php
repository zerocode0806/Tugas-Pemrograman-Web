<?php /* Dikerjakan: Ubed. Partial form, dipakai tambah.php dan edit.php. Butuh $d, $err, $tombol. */ ?>
<?php if ($err): ?>
<ul class="alert err" role="alert"><?php foreach ($err as $m): ?><li><?= e($m) ?></li><?php endforeach; ?></ul>
<?php endif; ?>
<form method="post" class="form" novalidate>
  <label for="nim">NIM</label>
  <input type="text" id="nim" name="nim" value="<?= e($d['nim']) ?>" inputmode="numeric" required>
  <label for="nama">Nama Lengkap</label>
  <input type="text" id="nama" name="nama" value="<?= e($d['nama']) ?>" required>
  <label for="jurusan">Jurusan</label>
  <input type="text" id="jurusan" name="jurusan" value="<?= e($d['jurusan']) ?>" list="daftar-jurusan" required>
  <datalist id="daftar-jurusan"><option value="Informatika"><option value="Sistem Informasi"><option value="Teknik Elektro"><option value="Teknik Industri"></datalist>
  <label for="email">Email (opsional)</label>
  <input type="email" id="email" name="email" value="<?= e($d['email']) ?>">
  <label for="telepon">Telepon (opsional)</label>
  <input type="tel" id="telepon" name="telepon" value="<?= e($d['telepon']) ?>">
  <label for="alamat">Alamat (opsional)</label>
  <textarea id="alamat" name="alamat" rows="3"><?= e($d['alamat']) ?></textarea>
  <div class="aksi-form"><button type="submit" class="btn"><?= e($tombol) ?></button> <a class="btn btn-lain" href="<?= e(url('agung/data.php')) ?>">Batal</a></div>
</form>
