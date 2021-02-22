-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2021 at 03:42 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nidn` char(10) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `fungsional_id` char(2) NOT NULL,
  `prodi_id` char(3) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nidn`, `nama`, `fungsional_id`, `prodi_id`, `user_id`) VALUES
('0019067008', 'Dr. I Gede Susrama Mas Diyasa S.t, M.t', '03', '081', 52),
('0023076907', 'Dr. Basuki Rahmat S.si, M.t', '03', '081', 54),
('0702068002', 'Intan Yuniar Purbasari S.kom, M.sc', '03', '081', 55),
('0707098003', 'Budi Nugroho S.kom, M.kom', '04', '081', 56),
('0711028201', 'Fetty Tri Anggraeny S.kom, M.kom', '03', '081', 57),
('0714028703', 'Sugiarto S.kom, M.kom', '03', '081', 58),
('0718058401', 'Rizky Parlika S.kom, M.kom', '03', '081', 59),
('1234567890', 'Dosen Uji Coba', '04', '011', 73),
('9937000068', 'Mohammad Idhom S.kom, M.t', '03', '081', 53);

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id` char(2) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `kependekan` varchar(32) DEFAULT NULL,
  `status` enum('aktif','pasif') NOT NULL DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id`, `nama`, `kependekan`, `status`) VALUES
('01', 'Ekonomi dan Bisnis', NULL, 'aktif'),
('02', 'Pertanian', NULL, 'aktif'),
('03', 'Teknik', NULL, 'aktif'),
('04', 'Ilmu Sosial dan Ilmu Politik', NULL, 'aktif'),
('05', 'Arsitektur dan Desain', NULL, 'aktif'),
('07', 'Hukum', NULL, 'aktif'),
('08', 'Ilmu Komputer', NULL, 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `fungsional`
--

CREATE TABLE `fungsional` (
  `id` char(2) NOT NULL,
  `nama` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fungsional`
--

INSERT INTO `fungsional` (`id`, `nama`) VALUES
('01', 'Tenaga Pengajar'),
('02', 'Asisten Ahli'),
('03', 'Lektor'),
('04', 'Lektor Kepala'),
('05', 'Guru Besar');

-- --------------------------------------------------------

--
-- Table structure for table `hibah`
--

CREATE TABLE `hibah` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(64) NOT NULL,
  `file` varchar(255) NOT NULL,
  `status` enum('aktif','pasif') NOT NULL,
  `kategori_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hibah`
--

INSERT INTO `hibah` (`id`, `nama`, `file`, `status`, `kategori_id`) VALUES
(1, 'PKM Penelitian', '1_format_pkm_penelitian.docx', 'aktif', 1),
(2, 'PKM Artikel Ilmiah', '2_format_pkm_artikel_ilmiah.docx', 'aktif', 1),
(3, 'PKM Pengabdian Kepada Masyarakat', '3_format_pkm_pengabdian_kepada_masyarakat.docx', 'aktif', 1),
(4, 'PKM Karsa Cipta', '4_format_pkm_karsa_cipta.docx', 'aktif', 1),
(5, 'PKM Penerapan Teknologi', '5_format_pkm_penerapan_teknologi.docx', 'aktif', 1),
(16, 'KRTI A', '16_format_krti_a.docx', 'aktif', 14),
(17, 'KRTI B', '17_format_krti_b.docx', 'aktif', 14);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(64) NOT NULL,
  `kependekan` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `kependekan`) VALUES
(1, 'Program Kreativitas Mahasiswa', 'PKM'),
(14, 'Kontes Robot Terbang Indonesia', 'KRTI');

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
(115, 45, '2021-02-22 02:39:31', 'Pengajuan Dibuat'),
(116, 45, '2021-02-22 02:39:46', 'Pengulas Ditugaskan');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `npm` char(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `status` enum('aktif','pasif') NOT NULL DEFAULT 'aktif',
  `prodi_id` char(3) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`npm`, `nama`, `status`, `prodi_id`, `user_id`) VALUES
('1634010056', 'Rizqi Chandra Pramana', 'aktif', '081', 39),
('1634010058', 'Ahmad Sidqi Bahariawansyah', 'aktif', '081', 40),
('1634010066', 'Ardisty Palvelus Jumala', 'aktif', '081', 41),
('1634010067', 'Maratul Adila', 'aktif', '081', 42),
('1634010068', 'Muhammad Diky Setiyawahyudi', 'aktif', '081', 43),
('1634010069', 'Ilham Setia Rinaldhi', 'aktif', '081', 44),
('1634010073', 'Reza Achmad Gallanta', 'aktif', '081', 45),
('1634010074', 'Agam Syahputra', 'aktif', '081', 46),
('1634010083', 'Berryl Pamudya Firensha', 'aktif', '081', 47),
('1634010085', 'Nobel Humania Billah', 'aktif', '081', 48),
('1634010090', 'Fierly Ramadhani Pramanda', 'aktif', '081', 49),
('1634010094', 'Dwi Darma Ardiansyah', 'aktif', '081', 50),
('1634010095', 'Ahmad Santoso', 'aktif', '081', 51);

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id` int(10) UNSIGNED NOT NULL,
  `periode_id` int(10) UNSIGNED NOT NULL,
  `hibah_id` int(10) UNSIGNED NOT NULL,
  `tahap_id` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `dosen_nidn` char(10) DEFAULT NULL,
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

INSERT INTO `pengajuan` (`id`, `periode_id`, `hibah_id`, `tahap_id`, `dosen_nidn`, `judul`, `abstraksi`, `dana`, `file`, `belmawa_username`, `belmawa_password`, `file_laporan`) VALUES
(45, 3, 2, 2, '9937000068', 'tes', 'abstrak', 90000, 'pengajuan_45.docx', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` int(10) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text DEFAULT NULL,
  `gambar` varchar(64) DEFAULT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('aktif','pasif') NOT NULL DEFAULT 'pasif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `judul`, `isi`, `gambar`, `waktu`, `status`) VALUES
(21, 'Tim PKM Pengabdian Kepada Masyarakat 2020', 'Tim PKM UPN \"Veteran\" Jawa Timur meraih medali emas sebagai juara umum hasil PKM dalam bidang kategori Pengabdian Kepada Masyarakat yang diselenggarakan di kota blitar 20 November 2020.\r\nDengan membawa produk alat bantu \"Pengaduk Gula Merah\" yang dibangun oleh 7 anggota tim dari berbagai program studi.\r\nDiharapkan nantinya alat pengaduk gula merah ini dapat membantu dan menjadi contoh untuk pengembangan teknologi pemrosesan gula merah yang lebih maju di kota blitar.', 'pengumuman_21.jpg', '2020-12-03 07:46:17', 'aktif'),
(22, 'Pembukaan Proposal PKM Periode 2021', 'Dalam rangka memandu mahasiswa untuk menjadi pribadi yang tahu aturan, taat aturan, kreatif, inovatif, dan objektif kooperatif dalam membangun keragaman intelektual, Direktorat Pembelajaran dan Kemahasiswaan menyelenggarakan Program Kreativitas Mahasiswa (PKM) Tahun 2021.  Untuk itu, Direktorat Pembelajaran dan Kemahasiswaan, Direktorat Jenderal Pendidikan Tinggi telah melaksanakan penilaian proposal PKM 5 Bidang Tahun 2020. Bersama ini kami sampaikan judul peraih pendanaan sebagaimana daftar terlampir. Mohon kesediaan Saudara untuk menginformasikan hal tersebut kepada mahasiswa di Perguruan Tinggi Saudara. Bagi mahasiswa yang judulnya meraih pendanaan dimohon untuk menyesuaikan kegiatan yang akan dilaksanakan dengan Addendum Pedoman PKM 5 (lima) Bidang yang dapat diunduh di <a href=\"https://simbelmawa.kemdikbud.go.id\">https://simbelmawa.kemdikbud.go.id.</a>', NULL, '2020-12-03 07:49:30', 'aktif'),
(23, 'Tim Kompetisi Robot Terbang Indonesia 2020', 'Dalam Kontes Robot Terbang Indonesia (KRTI) 2020, Tim Codingers Universitas Pembangunan Nasional (UPN) \"Veteran\" Jawa Timur berhasil menjadi juara umum. Dalam kontes yang digelar di lapangan terbang TNI AL Grati, Pasuruan, Jawa Timur, 21-24 November itu pada gelaran KRTI, UPN berhasil mendominasi perolehan medali. Yaitu, 4 medali meliputi 2 medali emas, 1 perak, serta 1 perunggu.\r\n\r\nPengharhaan masih ditambah 1 penghargaan respons terbaik. KRTI 2020 mempertandingkan enam kategori lomba. Yakni, fixed wing, racing plane, vertikal take off landing, technology develepoment-airframe, technology development-flight controller, dan technology development-propulsion.', 'pengumuman_23.jpg', '2020-12-03 07:54:52', 'aktif'),
(24, 'Tim PKM Pengabdian Kepada Masyarakat 2020', 'Sejumlah mahasiswa UPN \"Veteran\" Jawa Timur kembali mengharumkan nama kampus Bela Negara di kancah nasional melalui prestasinya di PKM (Pekan Kreativitas Mahasiswa) – PIMNAS ke-33 yang diselenggarakan pada (23-28/11/20) di Universitas Muslim Indonesia, Makassar. PKM merupakan salah satu program Direktorat Pendidikan Tinggi (Dikti) bersama Program Kerja Menteri Riset dan Teknologi Indonesia dalam mewujudkan generasi muda yang berinovasi dan berkarya dalam keberagaman untuk kesejahteraan berkelanjutan.', 'pengumuman_24.jpg', '2020-12-03 07:58:10', 'aktif'),
(25, 'Uji Coba Pengumuman', 'Isi Dari Pengumuman Uji Coba Pengumuman', NULL, '2020-12-09 22:34:58', 'pasif');

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
(102, 45, '1634010056', 1),
(103, 45, '1634010058', 2);

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
(2, 2020, 'pasif'),
(3, 2021, 'aktif'),
(13, 2022, 'pasif');

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id` char(3) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `kependekan` varchar(32) DEFAULT NULL,
  `status` enum('aktif','pasif') NOT NULL DEFAULT 'aktif',
  `fakultas_id` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id`, `nama`, `kependekan`, `status`, `fakultas_id`) VALUES
('011', 'Ekonomi Pembangunan', NULL, 'aktif', '01'),
('012', 'Manajemen', NULL, 'aktif', '01'),
('013', 'Akuntansi', NULL, 'aktif', '01'),
('024', 'Agribisnis', NULL, 'aktif', '02'),
('025', 'Agroteknologi', NULL, 'aktif', '02'),
('031', 'Teknik Kimia', NULL, 'aktif', '03'),
('032', 'Teknik Industri', NULL, 'aktif', '03'),
('033', 'Teknologi Pangan', NULL, 'aktif', '03'),
('034', 'Teknik Lingkungan', NULL, 'aktif', '03'),
('035', 'Teknik Sipil', NULL, 'aktif', '03'),
('041', 'Administrasi Negara', NULL, 'aktif', '04'),
('042', 'Administrasi Bisnis', NULL, 'aktif', '04'),
('043', 'Ilmu Komunikasi', NULL, 'aktif', '04'),
('044', 'Hubungan Internasional', NULL, 'aktif', '04'),
('051', 'Arsitektur', NULL, 'aktif', '05'),
('052', 'Desain Komunikasi Visual', NULL, 'aktif', '05'),
('071', 'Ilmu Hukum', NULL, 'aktif', '07'),
('081', 'Teknik Informatika', NULL, 'aktif', '08'),
('082', 'Sistem Informasi', NULL, 'aktif', '08');

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
  `tahap_id` int(10) UNSIGNED NOT NULL,
  `komentar` text DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`id`, `pengajuan_id`, `dosen_nidn`, `tahap_id`, `komentar`, `file`) VALUES
(41, 45, '0019067008', 2, NULL, NULL);

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
(1, 'admin@gmail.com', '$2y$10$6UOveusqtadQoJ60Gb6r2uB5VY.aaVS5lp/Rgs.XoXopHgYYxVgpe', 'admin', 'aktif'),
(39, 'rizqi@gmail.com', '$2y$10$hXODljdFslKS3vf2XaGeWuIBgd9u.MpkkXx1rIJ69fWQVzvn9dZfO', 'mahasiswa', 'aktif'),
(40, 'sidqi@gmail.com', '$2y$10$la29PWLgQLSTx/krI8Ajaepgb.CXvJwV4cfsCtPeq.aDsBHV60wiu', 'mahasiswa', 'aktif'),
(41, 'ardisty@gmail.com', '$2y$10$XUidZ9mPlzixonQkwbQlBeSZ4RYjnlghvRCGzsPlIDe4JAMZ5XTIW', 'mahasiswa', 'aktif'),
(42, 'maratul@gmail.com', '$2y$10$.AMfEZC00wzlW2QeLNd13e7wD1iEQkK2hKLUCKshTvGabjmSTVVDi', 'mahasiswa', 'aktif'),
(43, 'diky@gmail.com', '$2y$10$apr0h1yKZwQnzTtvyUb//ec1dUd1sqGNA0V1WRUj4aXj6m7nU0Q3C', 'mahasiswa', 'aktif'),
(44, 'ilham@gmail.com', '$2y$10$xl2cAoRCPnINi2TM2pM.keJc1GmIAnKMl1zjJdi9bVQw7X7r9ycem', 'mahasiswa', 'aktif'),
(45, 'reza@gmail.com', '$2y$10$kCuAwhdkMv/0whPptjfQ8esrUDOvSYSAELZXWoTcFG4Yj9oz5gXAO', 'mahasiswa', 'aktif'),
(46, 'agam@gmail.com', '$2y$10$TmxumZetsERPhsYnkpOW5OFzpydp/fM6gRA.hV07Co5BNH2tgWecC', 'mahasiswa', 'aktif'),
(47, 'berryl@gmail.com', '$2y$10$RSggich6Ap6UByXYUevaM.Zot14m5lfsVNYNV9nvseUgUWM5Kgjh2', 'mahasiswa', 'aktif'),
(48, 'nobel@gmail.com', '$2y$10$3g2xCQWcFVvL2p.OvIhQcuGy5ISKF4Wsl.Vs3YzcZNgpsdGPwSMRK', 'mahasiswa', 'aktif'),
(49, 'fierly@gmail.com', '$2y$10$juODL383.SR0xnG1CcL0B.0bh5g8vqC5L3Gd1C4eZCXEl5023GInW', 'mahasiswa', 'aktif'),
(50, 'ardi@gmail.com', '$2y$10$X4zgBN.NFY6nrrA7s4GRlO0U2PTqTQgN59k.rF4h4JLCNxgdyJ./S', 'mahasiswa', 'aktif'),
(51, 'santoso@gmail.com', '$2y$10$b4W8TYMGcTxppQ23R2ri1OJtGO03lgzqppvPlxFhC5iP9D/CCz03y', 'mahasiswa', 'aktif'),
(52, 'gede@gmail.com', '$2y$10$SkUNY2o9wLkNzWs/02JppO/wBaGoKi90U1SKFs0q.0Ha61uiWqWtO', 'dosen', 'aktif'),
(53, 'idhom@gmail.com', '$2y$10$2Cd4fGUZGTSSpYznTrLEyurtclYIcglBjCiFPG97F1PVNuBt6m2Vi', 'dosen', 'aktif'),
(54, 'basuki@gmail.com', '$2y$10$LDjnl2sM8l13sGfnXdfCmeTh1MS01Sao1F02hRmYq8/Sa1s/Z2lIy', 'dosen', 'aktif'),
(55, 'intan@gmail.com', '$2y$10$JvFfAzPjvsduuQp9P7JaMu9U/Jb0Y7SLHOn90N4JEbz2yfxM5pv/K', 'dosen', 'aktif'),
(56, 'budi@gmail.com', '$2y$10$ArrtWwlnMeKYI3AL9taHo.hFZlOP5UfVulfnVGw7COjSLREJXogpi', 'dosen', 'aktif'),
(57, 'fetty@gmail.com', '$2y$10$NW/KaX5m3KKuBYcoPgxMBurtf45TVLfFNyWIyfHuQVYaSojjclrLK', 'dosen', 'aktif'),
(58, 'sugiarto@gmail.com', '$2y$10$81.RAL1k2WIgIZwrM9odd.HH92DB1NWkcoibSW1MI/4UIKTYajM7K', 'dosen', 'aktif'),
(59, 'rizky@gmail.com', '$2y$10$1KzTXDHEOf0OQoafhXb1BOG904TOBS.Dm95O0hLNANdUBzcpcQOzm', 'dosen', 'aktif'),
(73, 'lektor@gmail.com', '$2y$10$eGStvT5VEUJNGWWlbaxP0uagJz1WC5qHv1oqRIKoIhiKPp0Nig2su', 'dosen', 'aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nidn`),
  ADD KEY `fk_dosen_prodi` (`prodi_id`),
  ADD KEY `fk_dosen_user` (`user_id`),
  ADD KEY `fk_dosen_fungsional` (`fungsional_id`);

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fungsional`
--
ALTER TABLE `fungsional`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hibah`
--
ALTER TABLE `hibah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_hibah_kategori` (`kategori_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `fk_pengajuan_dosen` (`dosen_nidn`),
  ADD KEY `fk_pengajuan_periode` (`periode_id`),
  ADD KEY `fk_pengajuan_tahap` (`tahap_id`),
  ADD KEY `fk_pengajuan_hibah` (`hibah_id`);

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
  ADD KEY `fk_ulasan_dosen` (`dosen_nidn`),
  ADD KEY `fk_ulasan_tahap` (`tahap_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `pengusul`
--
ALTER TABLE `pengusul`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `periode`
--
ALTER TABLE `periode`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `fk_dosen_fungsional` FOREIGN KEY (`fungsional_id`) REFERENCES `fungsional` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dosen_prodi` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dosen_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hibah`
--
ALTER TABLE `hibah`
  ADD CONSTRAINT `fk_hibah_kategori` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `fk_log_pengajuan` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `fk_mahasiswa_prodi` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_mahasiswa_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD CONSTRAINT `fk_pengajuan_dosen` FOREIGN KEY (`dosen_nidn`) REFERENCES `dosen` (`nidn`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pengajuan_hibah` FOREIGN KEY (`hibah_id`) REFERENCES `hibah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pengajuan_kategori` FOREIGN KEY (`hibah_id`) REFERENCES `hibah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pengajuan_periode` FOREIGN KEY (`periode_id`) REFERENCES `periode` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pengajuan_tahap` FOREIGN KEY (`tahap_id`) REFERENCES `tahap` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `fk_ulasan_pengajuan` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ulasan_tahap` FOREIGN KEY (`tahap_id`) REFERENCES `tahap` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
