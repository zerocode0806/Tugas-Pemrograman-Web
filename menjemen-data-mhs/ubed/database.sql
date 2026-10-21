CREATE DATABASE IF NOT EXISTS biodata_db CHARACTER SET utf8mb4;
USE biodata_db;
CREATE TABLE IF NOT EXISTS mahasiswa (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nim VARCHAR(20) NOT NULL UNIQUE,
  nama VARCHAR(100) NOT NULL,
  jurusan VARCHAR(60) NOT NULL,
  email VARCHAR(100) NULL,
  telepon VARCHAR(16) NULL,
  alamat TEXT NULL,
  dibuat TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO mahasiswa (nim,nama,jurusan,email,telepon,alamat) VALUES
('2024001001','Contoh Satu','Informatika','satu@contoh.ac.id','081234567890','Sidoarjo'),
('2024001002','Contoh Dua','Sistem Informasi','dua@contoh.ac.id','081298765432','Surabaya');
