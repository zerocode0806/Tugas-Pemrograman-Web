# Pembagian Tugas: Sistem Manajemen Biodata Mahasiswa

Stack: PHP native + MySQL (mysqli), HTML, CSS. Tanpa framework.

## Tabel pembagian

| Anggota | Tingkat | File | Tugas |
|---|---|---|---|
| **Ubed** | Kompleks | `database.sql`, `koneksi.php`, `form.php`, `tambah.php`, `edit.php` | Skema DB, koneksi, validasi, INSERT/UPDATE dengan prepared statement, pesan sukses/gagal |
| **Agung** | Menengah | `tabel.php`, `data.php`, `data.css` | Tabel biodata, tampilan responsif, tautan Detail dan Edit |
| **Dedi** | Menengah | `cari.php`, `cari.css` | Form pencarian GET (nama/NIM), hasil, kondisi tidak ditemukan |
| **Ihya** | Menengah | `detail.php`, `detail.css` | Ambil satu data via GET id, layout detail, ID tidak valid/tidak ditemukan |
| **Rehan** | Dasar | `index.php`, `layout.php`, `global.css` | Beranda, navigasi, ringkasan jumlah, penyamaan gaya, uji tautan |

Tulis nama pembuat di komentar baris atas tiap file (sudah ada, ganti sesuai nama).

## Urutan pengerjaan
1. Ubed: `database.sql` dan `koneksi.php` lebih dulu (dipakai semua). Lalu `form.php`, `tambah.php`, `edit.php`.
2. Rehan: `layout.php` dan `global.css` (kerangka semua halaman).
3. Agung: `tabel.php` (dipakai juga oleh `cari.php`), lalu `data.php`.
4. Dedi dan Ihya: `cari.php` dan `detail.php`, bisa paralel setelah langkah 1 dan 2.
5. Semua: uji tautan antarhalaman bersama.

## Kontrak antar-file (jangan diubah tanpa kabar)
- Tabel `mahasiswa`: `id, nim, nama, jurusan, email, telepon, alamat, dibuat`.
- `koneksi.php` menyediakan `$db`, `e()`, `flash()`, `id_valid()`, `validasi()`.
- `layout.php`: `tampil_header($judul, ['halaman.css'])` dan `tampil_footer()`.
- `tabel.php`: `tabel_mahasiswa($rows)`; tiap baris butuh `id, nim, nama, jurusan`.

## Bagian kompleks, dijelaskan oleh Ubed
1. **Prepared statement**: `prepare`, `bind_param`, `execute` untuk mencegah SQL injection.
2. **Validasi di server**: fungsi `validasi()` (NIM angka 5-20 digit, nama, email, telepon).
3. **NIM unik**: kolom `UNIQUE`; error 1062 ditangkap lalu diubah jadi pesan "NIM sudah terdaftar".
4. **Alur edit**: GET `?id=` mengambil data, POST menyimpan, lalu redirect (pola Post-Redirect-Get).
5. **Pesan flash** lewat session, dan `e()` (`htmlspecialchars`) untuk mencegah XSS.

## Cara menjalankan
1. Pasang XAMPP, aktifkan Apache dan MySQL.
2. Salin folder ke `htdocs/biodata-mahasiswa/`.
3. phpMyAdmin: Import `database.sql`.
4. Buka `http://localhost/biodata-mahasiswa/`.

## Checklist uji
- [ ] Tambah biodata valid berhasil; NIM ganda ditolak.
- [ ] Input salah menampilkan daftar error dan isian tidak hilang.
- [ ] Edit mengubah data; `edit.php?id=999` kembali ke Data dengan pesan.
- [ ] Tabel rapi di HP dan desktop; Detail dan Edit berfungsi.
- [ ] Cari nama atau NIM berhasil; kata kunci tak ada menampilkan pesan.
- [ ] `detail.php?id=abc` dan `id=999` menampilkan pesan, bukan error.
- [ ] Semua tautan navigasi benar.