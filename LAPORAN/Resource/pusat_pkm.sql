-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2020 at 01:48 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pusat_pkm`
--
CREATE DATABASE IF NOT EXISTS `pusat_pkm` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pusat_pkm`;

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nidn` char(10) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `prodi_id` char(3) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nidn`, `nama`, `prodi_id`, `user_id`) VALUES
('0701066001', 'Ir. Yayok Suryo Purnomo, MS.', '034', NULL),
('9907010710', 'Dosen Mantab Mantab', '071', 5),
('9907010716', 'Tukiman, S.Sos., M.Si', '041', 3);

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id` char(2) NOT NULL,
  `nama` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id`, `nama`) VALUES
('01', 'Fakultas Ekonomi dan Bisnis'),
('02', 'Fakultas Pertanian'),
('03', 'Fakultas Teknik'),
('04', 'Fakultas Ilmu Sosial dan Ilmu Politik'),
('05', 'Fakultas Arsitektur dan Desain'),
('07', 'Fakultas Hukum'),
('08', 'Fakultas Ilmu Komputer');

-- --------------------------------------------------------

--
-- Table structure for table `hibah`
--

CREATE TABLE `hibah` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hibah`
--

INSERT INTO `hibah` (`id`, `nama`) VALUES
(1, 'PKM');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(64) NOT NULL,
  `hibah_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `hibah_id`) VALUES
(1, 'PKM Penelitian', 1),
(2, 'PKM Artikel Ilmiah', 1),
(3, 'PKM Pengabdian Kepada Masyarakat', 1);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(10) UNSIGNED NOT NULL,
  `pengajuan_id` int(10) UNSIGNED NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `berita` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `pengajuan_id`, `waktu`, `berita`) VALUES
(1, 2, '2020-07-11 18:00:36', 'Pengajuan Dibuat'),
(2, 12, '2020-08-07 15:23:52', 'Pengajuan Dibuat'),
(3, 13, '2020-08-07 12:24:34', 'pengajuan dibuat'),
(4, 14, '2020-08-07 12:26:31', 'pengajuan dibuat');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `npm` char(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `prodi_id` char(3) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`npm`, `nama`, `prodi_id`, `user_id`) VALUES
('1634010056', 'Rizqi Chandra Pramana', '081', 2),
('1634010067', 'Ahmad Sidqi', '081', 4),
('1634010090', 'Ahmad santoso', '081', 6),
('1634010095', 'Fierly Ramadhani Pramanda', '081', 7),
('1671010060', 'Indriana', '071', 9),
('1671010070', 'Indah Octaviani', '071', 8),
('19081010038', 'Achmad Arsa Abdillah Madjid', '081', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id` int(10) UNSIGNED NOT NULL,
  `periode_id` int(10) UNSIGNED NOT NULL,
  `kategori_id` int(10) UNSIGNED NOT NULL,
  `tahap_id` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `dosen_nidn` char(10) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `abstraksi` text DEFAULT NULL,
  `dana` int(10) UNSIGNED DEFAULT 0,
  `file` varchar(255) DEFAULT NULL,
  `belmawa_username` varchar(64) DEFAULT NULL,
  `belmawa_password` varchar(64) DEFAULT NULL,
  `file_laporan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengajuan`
--

INSERT INTO `pengajuan` (`id`, `periode_id`, `kategori_id`, `tahap_id`, `dosen_nidn`, `judul`, `abstraksi`, `dana`, `file`, `belmawa_username`, `belmawa_password`, `file_laporan`) VALUES
(2, 2, 2, 1, '0701066001', 'Pemanfaatan Serabut Kelapa Menjadi Mie Instan', NULL, 7500000, 'temp/pengajuan-2.docx', NULL, NULL, NULL),
(7, 2, 3, 2, '9907010710', 'KKN Mengabdi Kepada Masyarakat', NULL, 12500000, NULL, NULL, NULL, NULL),
(12, 3, 2, 1, '9907010710', 'penjelasan ilmiah tentang amonium nitrat', 'amonium nitrat menyebabkan ledakan besar di lebanon', 25000000, 'pengajuan_12.doc', NULL, NULL, NULL),
(13, 3, 1, 1, '9907010710', 'penelitian penyakit anxiety pada anak muda', 'anak muda saat ini suka rewel dikit dikit ngambek', 50000000, 'pengajuan_13.doc', NULL, NULL, NULL),
(14, 3, 2, 1, '0701066001', 'robot pembantu rumah tangga', 'robot ini digunakan untuk keperluan rumah tangga', 12500000, 'pengajuan_14.doc', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` int(10) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text DEFAULT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('aktif','pasif') NOT NULL DEFAULT 'pasif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `judul`, `isi`, `waktu`, `status`) VALUES
(1, 'Pembukaan Pengajuan Proposal PKM Periode 2020', NULL, '2020-07-11 18:05:51', 'pasif');

-- --------------------------------------------------------

--
-- Table structure for table `pengusul`
--

CREATE TABLE `pengusul` (
  `id` int(10) UNSIGNED NOT NULL,
  `pengajuan_id` int(10) UNSIGNED NOT NULL,
  `mahasiswa_npm` char(11) NOT NULL,
  `anggota` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengusul`
--

INSERT INTO `pengusul` (`id`, `pengajuan_id`, `mahasiswa_npm`, `anggota`) VALUES
(1, 2, '1634010056', 1),
(2, 2, '19081010038', 2),
(3, 7, '1634010056', 1),
(4, 12, '1634010056', 1),
(5, 13, '1634010056', 1),
(6, 14, '1634010067', 1);

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE `periode` (
  `id` int(10) UNSIGNED NOT NULL,
  `tahun` smallint(5) UNSIGNED NOT NULL,
  `status` enum('aktif','pasif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`id`, `tahun`, `status`) VALUES
(1, 2019, 'pasif'),
(2, 2020, 'aktif'),
(3, 2021, 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id` char(3) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `fakultas_id` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id`, `nama`, `fakultas_id`) VALUES
('011', 'Ekonomi Pembangunan', '01'),
('012', 'Manajemen', '01'),
('013', 'Akuntansi', '01'),
('024', 'Agribisnis', '02'),
('025', 'Agroteknologi', '02'),
('031', 'Teknik Kimia', '03'),
('032', 'Teknik Industri', '03'),
('033', 'Teknologi Pangan', '03'),
('034', 'Teknik Lingkungan', '03'),
('035', 'Teknik Sipil', '03'),
('041', 'Administrasi Negara', '04'),
('042', 'Administrasi Bisnis', '04'),
('043', 'Ilmu Komunikasi', '04'),
('044', 'Hubungan Internasional', '04'),
('051', 'Arsitektur', '05'),
('052', 'Desain Komunikasi Visual', '05'),
('071', 'Ilmu Hukum', '07'),
('081', 'Teknik Informatika', '08'),
('082', 'Sistem Informasi', '08');

-- --------------------------------------------------------

--
-- Table structure for table `tahap`
--

CREATE TABLE `tahap` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tahap`
--

INSERT INTO `tahap` (`id`, `nama`) VALUES
(1, 'Belum Ditugaskan'),
(2, 'Sedang Diulas'),
(3, 'Permintaan Revisi'),
(4, 'Pengajuan Ditolak'),
(5, 'Pengajuan Diterima'),
(6, 'Kegiatan Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id` int(10) UNSIGNED NOT NULL,
  `pengajuan_id` int(10) UNSIGNED NOT NULL,
  `dosen_nidn` char(10) NOT NULL,
  `komentar` text DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `status` enum('aktif','pasif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`id`, `pengajuan_id`, `dosen_nidn`, `komentar`, `file`, `status`) VALUES
(1, 2, '9907010716', 'Bagus', NULL, 'pasif');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','mahasiswa','dosen') NOT NULL,
  `status` enum('aktif','pasif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `role`, `status`) VALUES
(1, 'admin@gmail.com', '$2y$10$qBRkmQ0.He5MejRAnkH2WOoCc8Z9X0dUCylvZ9ywjLzmvyBZ7glLm', 'admin', 'aktif'),
(2, 'rizqi@gmail.com', '$2y$10$qBRkmQ0.He5MejRAnkH2WOoCc8Z9X0dUCylvZ9ywjLzmvyBZ7glLm', 'mahasiswa', 'aktif'),
(3, 'tukiman@gmail.com', '$2y$10$qBRkmQ0.He5MejRAnkH2WOoCc8Z9X0dUCylvZ9ywjLzmvyBZ7glLm', 'dosen', 'aktif'),
(4, 'sidqi@gmail.com', '$2y$10$qBRkmQ0.He5MejRAnkH2WOoCc8Z9X0dUCylvZ9ywjLzmvyBZ7glLm', 'mahasiswa', 'aktif'),
(5, 'mantab@gmail.com', '$2y$10$58XioxgEZxdfAwJMMJdSmO77eIhgtMJiQMR2gla.FqhvsbHYQXlJW', 'dosen', 'pasif'),
(6, 'santoso@gmail.com', '$2y$10$USNKLh97hkWEZm.P0meINeN3Bd2f33g6tUQRIAUzp9DOd2ILpoJaW', 'mahasiswa', 'pasif'),
(7, 'Fierly@gmail.com', '$2y$10$c560lgeMCIGgEnM9oijBOurRLgxc8G62K/mIDRGGJ9DIxk8FS.4Ue', 'mahasiswa', 'pasif'),
(8, 'indah@gmail.com', '$2y$10$MtVOnMou3GSX9Ptx8PySHOzg9DmqAT6vXfNEn2UV9aLjn7QUvpgmi', 'mahasiswa', 'pasif'),
(9, 'indriana@gmail.com', '$2y$10$FWrTH4u1sA8hHyirI7ywOujqxgHwQIRTOhjcTw/.ssglVVfWH/RtW', 'mahasiswa', 'pasif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nidn`),
  ADD KEY `fk_dosen_prodi` (`prodi_id`),
  ADD KEY `fk_dosen_user` (`user_id`);

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hibah`
--
ALTER TABLE `hibah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kategori_hibah` (`hibah_id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_log_pengajuan` (`pengajuan_id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`npm`),
  ADD KEY `fk_mahasiswa_prodi` (`prodi_id`),
  ADD KEY `fk_mahasiswa_user` (`user_id`);

--
-- Indexes for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pengajuan_periode` (`periode_id`),
  ADD KEY `fk_pengajuan_kategori` (`kategori_id`),
  ADD KEY `fk_pengajuan_tahap` (`tahap_id`),
  ADD KEY `fk_pengajuan_dosen` (`dosen_nidn`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengusul`
--
ALTER TABLE `pengusul`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pengusul_pengajuan` (`pengajuan_id`),
  ADD KEY `fk_pengusul_mahasiswa` (`mahasiswa_npm`);

--
-- Indexes for table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fakultas_id` (`fakultas_id`);

--
-- Indexes for table `tahap`
--
ALTER TABLE `tahap`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ulasan_pengajuan` (`pengajuan_id`),
  ADD KEY `fk_ulasan_dosen` (`dosen_nidn`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hibah`
--
ALTER TABLE `hibah`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengusul`
--
ALTER TABLE `pengusul`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `periode`
--
ALTER TABLE `periode`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `fk_dosen_prodi` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dosen_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `kategori`
--
ALTER TABLE `kategori`
  ADD CONSTRAINT `fk_kategori_hibah` FOREIGN KEY (`hibah_id`) REFERENCES `hibah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `fk_log_pengajuan` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `fk_mahasiswa_prodi` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_mahasiswa_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD CONSTRAINT `fk_pengajuan_dosen` FOREIGN KEY (`dosen_nidn`) REFERENCES `dosen` (`nidn`),
  ADD CONSTRAINT `fk_pengajuan_kategori` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`),
  ADD CONSTRAINT `fk_pengajuan_periode` FOREIGN KEY (`periode_id`) REFERENCES `periode` (`id`),
  ADD CONSTRAINT `fk_pengajuan_tahap` FOREIGN KEY (`tahap_id`) REFERENCES `tahap` (`id`);

--
-- Constraints for table `pengusul`
--
ALTER TABLE `pengusul`
  ADD CONSTRAINT `fk_pengusul_mahasiswa` FOREIGN KEY (`mahasiswa_npm`) REFERENCES `mahasiswa` (`npm`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pengusul_pengajuan` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prodi`
--
ALTER TABLE `prodi`
  ADD CONSTRAINT `fk_prodi_fakultas` FOREIGN KEY (`fakultas_id`) REFERENCES `fakultas` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD CONSTRAINT `fk_ulasan_dosen` FOREIGN KEY (`dosen_nidn`) REFERENCES `dosen` (`nidn`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ulasan_pengajuan` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Database: `siapkm`
--
CREATE DATABASE IF NOT EXISTS `siapkm` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `siapkm`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID_ADMIN` varchar(20) NOT NULL,
  `PASSWORD_ADMIN` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID_ADMIN`, `PASSWORD_ADMIN`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `anggota_pkm`
--

CREATE TABLE `anggota_pkm` (
  `NPM_ANGGOTA` varchar(20) NOT NULL,
  `NPM_KETUA` varchar(20) DEFAULT NULL,
  `NAMA_ANGGOTA` varchar(50) DEFAULT NULL,
  `JENIS_KELAMIN_ANGGOTA` char(1) DEFAULT NULL,
  `TEMPAT_LAHIR_ANGGOTA` varchar(30) DEFAULT NULL,
  `TANGGAL_LAHIR_ANGGOTA` date DEFAULT NULL,
  `EMAIL_ANGGOTA` varchar(50) DEFAULT NULL,
  `TELEPON_ANGGOTA` decimal(15,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dosen_pembimbing`
--

CREATE TABLE `dosen_pembimbing` (
  `NPT` varchar(20) NOT NULL,
  `ID_PRODI` varchar(10) DEFAULT NULL,
  `PASSWORD_DOSEN` varchar(50) DEFAULT NULL,
  `NAMA_DOSEN` varchar(50) DEFAULT NULL,
  `JENIS_KELAMIN_DOSEN` varchar(1) DEFAULT NULL,
  `TEMPAT_LAHIR_DOSEN` varchar(30) DEFAULT NULL,
  `TANGGAL_LAHIR_DOSEN` date DEFAULT NULL,
  `EMAIL_DOSEN` varchar(50) DEFAULT NULL,
  `NO_TELEPON_DOSEN` decimal(15,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dosen_pembimbing`
--

INSERT INTO `dosen_pembimbing` (`NPT`, `ID_PRODI`, `PASSWORD_DOSEN`, `NAMA_DOSEN`, `JENIS_KELAMIN_DOSEN`, `TEMPAT_LAHIR_DOSEN`, `TANGGAL_LAHIR_DOSEN`, `EMAIL_DOSEN`, `NO_TELEPON_DOSEN`) VALUES
('DOSEN001', 'PRODI0001', 'DIDIN', 'DIDIN', 'L', 'SURABAYA', '1998-01-31', 'ssuhadak31@gmail.com', '813303030');

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `ID_FAKULTAS` varchar(10) NOT NULL,
  `NAMA_FAKULTAS` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`ID_FAKULTAS`, `NAMA_FAKULTAS`) VALUES
('FAK0001', 'FIK');

-- --------------------------------------------------------

--
-- Table structure for table `ketua_pkm`
--

CREATE TABLE `ketua_pkm` (
  `NPM_KETUA` varchar(20) NOT NULL,
  `NPT` varchar(20) DEFAULT NULL,
  `ID_PRODI` varchar(10) DEFAULT NULL,
  `NAMA_KETUA` varchar(50) DEFAULT NULL,
  `JENIS_KELAMIN_KETUA` char(1) DEFAULT NULL,
  `TEMPAT_LAHIR_KETUA` varchar(30) DEFAULT NULL,
  `TANGGAL_LAHIR_KETUA` date DEFAULT NULL,
  `EMAIL_KETUA` varchar(50) DEFAULT NULL,
  `TELEPON_KETUA` decimal(15,0) DEFAULT NULL,
  `USERNAME_SIMBELMAWA` varchar(30) DEFAULT NULL,
  `PASSWORD_SIMBELMAWA` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ketua_pkm`
--

INSERT INTO `ketua_pkm` (`NPM_KETUA`, `NPT`, `ID_PRODI`, `NAMA_KETUA`, `JENIS_KELAMIN_KETUA`, `TEMPAT_LAHIR_KETUA`, `TANGGAL_LAHIR_KETUA`, `EMAIL_KETUA`, `TELEPON_KETUA`, `USERNAME_SIMBELMAWA`, `PASSWORD_SIMBELMAWA`) VALUES
('1634010030', 'DOSEN001', 'PRODI0001', 'ERLINDA', 'P', 'SURABAYA', '1999-08-03', 'erlinda@gmail.com', '85853772668', 'erlinda', 'erlinda');

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan_pengajaran`
--

CREATE TABLE `pendidikan_pengajaran` (
  `ID_PENDIDIKAN` varchar(50) NOT NULL,
  `NPT` varchar(20) DEFAULT NULL,
  `MATKUL` varchar(30) DEFAULT NULL,
  `WAJIB_PILIHAN` varchar(7) DEFAULT NULL,
  `SKS` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `penelitian`
--

CREATE TABLE `penelitian` (
  `ID_PENELITIAN` varchar(50) NOT NULL,
  `NPT` varchar(20) DEFAULT NULL,
  `JUDUL_PENELITIAN` varchar(100) DEFAULT NULL,
  `P_DANA_PENELITIAN` varchar(100) DEFAULT NULL,
  `TAHUN_PENELITIAN` char(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pengabdian_kepada_masyarakat`
--

CREATE TABLE `pengabdian_kepada_masyarakat` (
  `ID_PKMD` varchar(50) NOT NULL,
  `NPT` varchar(20) DEFAULT NULL,
  `JUDUL_PKMD` varchar(100) DEFAULT NULL,
  `P_DANA_PKMD` varchar(100) DEFAULT NULL,
  `TAHUN_PKMD` char(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `ID_PENGUMUMAN` varchar(10) NOT NULL,
  `ID_ADMIN` varchar(20) DEFAULT NULL,
  `JUDUL_PENGUMUMAN` text DEFAULT NULL,
  `ISI_PENGUMUMAN` text DEFAULT NULL,
  `GAMBAR_PENGUMUMAN` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `program_studi`
--

CREATE TABLE `program_studi` (
  `ID_PRODI` varchar(10) NOT NULL,
  `ID_FAKULTAS` varchar(10) DEFAULT NULL,
  `NAMA_PRODI` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program_studi`
--

INSERT INTO `program_studi` (`ID_PRODI`, `ID_FAKULTAS`, `NAMA_PRODI`) VALUES
('PRODI0001', 'FAK0001', 'TEKNIK INFORMATIKA');

-- --------------------------------------------------------

--
-- Table structure for table `proposal`
--

CREATE TABLE `proposal` (
  `ID_PROPOSAL` varchar(10) NOT NULL,
  `NPM_KETUA` varchar(20) DEFAULT NULL,
  `ID_ADMIN` varchar(20) DEFAULT NULL,
  `JUDUL_PROPOSAL` varchar(50) DEFAULT NULL,
  `JENIS_PKM` varchar(10) DEFAULT NULL,
  `STATUS_PROPOSAL` varchar(8) DEFAULT NULL,
  `FILE_PROPOSAL` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_pendidikan`
--

CREATE TABLE `riwayat_pendidikan` (
  `ID_RPD` varchar(10) NOT NULL,
  `NPT` varchar(20) DEFAULT NULL,
  `NAMA_INSTITUSI` varchar(50) DEFAULT NULL,
  `TAHUN_PENDIDIKAN` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID_ADMIN`);

--
-- Indexes for table `anggota_pkm`
--
ALTER TABLE `anggota_pkm`
  ADD PRIMARY KEY (`NPM_ANGGOTA`),
  ADD KEY `FK_MEMILIKI4` (`NPM_KETUA`);

--
-- Indexes for table `dosen_pembimbing`
--
ALTER TABLE `dosen_pembimbing`
  ADD PRIMARY KEY (`NPT`),
  ADD KEY `FK_MEMPUNYAI3` (`ID_PRODI`);

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`ID_FAKULTAS`);

--
-- Indexes for table `ketua_pkm`
--
ALTER TABLE `ketua_pkm`
  ADD PRIMARY KEY (`NPM_KETUA`),
  ADD KEY `FK_MEMBIMBING` (`NPT`),
  ADD KEY `FK_MEMPUNYAI4` (`ID_PRODI`);

--
-- Indexes for table `pendidikan_pengajaran`
--
ALTER TABLE `pendidikan_pengajaran`
  ADD PRIMARY KEY (`ID_PENDIDIKAN`),
  ADD KEY `FK_MEMPUNYAI2` (`NPT`);

--
-- Indexes for table `penelitian`
--
ALTER TABLE `penelitian`
  ADD PRIMARY KEY (`ID_PENELITIAN`),
  ADD KEY `FK_MEMILIKI` (`NPT`);

--
-- Indexes for table `pengabdian_kepada_masyarakat`
--
ALTER TABLE `pengabdian_kepada_masyarakat`
  ADD PRIMARY KEY (`ID_PKMD`),
  ADD KEY `FK_MEMILIKI2` (`NPT`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`ID_PENGUMUMAN`),
  ADD KEY `FK_MEMPUBLISH` (`ID_ADMIN`);

--
-- Indexes for table `program_studi`
--
ALTER TABLE `program_studi`
  ADD PRIMARY KEY (`ID_PRODI`),
  ADD KEY `FK_MEMILIKI3` (`ID_FAKULTAS`);

--
-- Indexes for table `proposal`
--
ALTER TABLE `proposal`
  ADD PRIMARY KEY (`ID_PROPOSAL`),
  ADD KEY `FK_MENGAJUKAN` (`NPM_KETUA`),
  ADD KEY `FK_MENYELEKSI` (`ID_ADMIN`);

--
-- Indexes for table `riwayat_pendidikan`
--
ALTER TABLE `riwayat_pendidikan`
  ADD PRIMARY KEY (`ID_RPD`),
  ADD KEY `FK_MEMPUNYAI` (`NPT`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anggota_pkm`
--
ALTER TABLE `anggota_pkm`
  ADD CONSTRAINT `FK_MEMILIKI4` FOREIGN KEY (`NPM_KETUA`) REFERENCES `ketua_pkm` (`NPM_KETUA`);

--
-- Constraints for table `dosen_pembimbing`
--
ALTER TABLE `dosen_pembimbing`
  ADD CONSTRAINT `FK_MEMPUNYAI3` FOREIGN KEY (`ID_PRODI`) REFERENCES `program_studi` (`ID_PRODI`);

--
-- Constraints for table `ketua_pkm`
--
ALTER TABLE `ketua_pkm`
  ADD CONSTRAINT `FK_MEMBIMBING` FOREIGN KEY (`NPT`) REFERENCES `dosen_pembimbing` (`NPT`),
  ADD CONSTRAINT `FK_MEMPUNYAI4` FOREIGN KEY (`ID_PRODI`) REFERENCES `program_studi` (`ID_PRODI`);

--
-- Constraints for table `pendidikan_pengajaran`
--
ALTER TABLE `pendidikan_pengajaran`
  ADD CONSTRAINT `FK_MEMPUNYAI2` FOREIGN KEY (`NPT`) REFERENCES `dosen_pembimbing` (`NPT`);

--
-- Constraints for table `penelitian`
--
ALTER TABLE `penelitian`
  ADD CONSTRAINT `FK_MEMILIKI` FOREIGN KEY (`NPT`) REFERENCES `dosen_pembimbing` (`NPT`);

--
-- Constraints for table `pengabdian_kepada_masyarakat`
--
ALTER TABLE `pengabdian_kepada_masyarakat`
  ADD CONSTRAINT `FK_MEMILIKI2` FOREIGN KEY (`NPT`) REFERENCES `dosen_pembimbing` (`NPT`);

--
-- Constraints for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD CONSTRAINT `FK_MEMPUBLISH` FOREIGN KEY (`ID_ADMIN`) REFERENCES `admin` (`ID_ADMIN`);

--
-- Constraints for table `program_studi`
--
ALTER TABLE `program_studi`
  ADD CONSTRAINT `FK_MEMILIKI3` FOREIGN KEY (`ID_FAKULTAS`) REFERENCES `fakultas` (`ID_FAKULTAS`);

--
-- Constraints for table `proposal`
--
ALTER TABLE `proposal`
  ADD CONSTRAINT `FK_MENGAJUKAN` FOREIGN KEY (`NPM_KETUA`) REFERENCES `ketua_pkm` (`NPM_KETUA`),
  ADD CONSTRAINT `FK_MENYELEKSI` FOREIGN KEY (`ID_ADMIN`) REFERENCES `admin` (`ID_ADMIN`);

--
-- Constraints for table `riwayat_pendidikan`
--
ALTER TABLE `riwayat_pendidikan`
  ADD CONSTRAINT `FK_MEMPUNYAI` FOREIGN KEY (`NPT`) REFERENCES `dosen_pembimbing` (`NPT`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
