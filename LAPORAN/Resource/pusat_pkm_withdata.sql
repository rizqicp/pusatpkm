-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2020 at 09:58 AM
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
  `prodi_id` char(3) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nidn`, `nama`, `prodi_id`, `user_id`) VALUES
('0019067008', 'Dr. I Gede Susrama Mas Diyasa S.t, M.t', '081', 52),
('0023076907', 'Dr. Basuki Rahmat S.si, M.t', '081', 54),
('0702068002', 'Intan Yuniar Purbasari S.kom, M.sc', '081', 55),
('0707098003', 'Budi Nugroho S.kom, M.kom', '081', 56),
('0711028201', 'Fetty Tri Anggraeny S.kom, M.kom', '081', 57),
('0714028703', 'Sugiarto S.kom, M.kom', '081', 58),
('0718058401', 'Rizky Parlika S.kom, M.kom', '081', 59),
('9937000068', 'Mohammad Idhom S.kom, M.t', '081', 53);

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
('01', 'Ekonomi dan Bisnis'),
('02', 'Pertanian'),
('03', 'Teknik'),
('04', 'Ilmu Sosial dan Ilmu Politik'),
('05', 'Arsitektur dan Desain'),
('07', 'Hukum'),
('08', 'Ilmu Komputer');

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
(1, 'PKM'),
(2, 'KRTI');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(64) NOT NULL,
  `hibah_id` int(10) UNSIGNED NOT NULL,
  `status` enum('aktif','pasif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `hibah_id`, `status`) VALUES
(1, 'PKM Penelitian', 1, 'aktif'),
(2, 'PKM Artikel Ilmiah', 1, 'aktif'),
(3, 'PKM Pengabdian Kepada Masyarakat', 1, 'aktif'),
(4, 'PKM Karsa Cipta', 1, 'aktif'),
(5, 'PKM Penerapan Teknologi', 1, 'aktif');

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
(22, 19, '2020-12-03 08:03:37', 'Pengajuan Dibuat'),
(23, 20, '2020-12-03 08:08:30', 'Pengajuan Dibuat'),
(24, 21, '2020-12-03 08:11:11', 'Pengajuan Dibuat'),
(25, 22, '2020-12-03 08:15:33', 'Pengajuan Dibuat'),
(26, 23, '2020-12-03 08:18:29', 'Pengajuan Dibuat'),
(27, 24, '2020-12-03 08:20:14', 'Pengajuan Dibuat'),
(28, 19, '2020-12-03 08:21:32', 'Pengajuan Ditugaskan'),
(29, 20, '2020-12-03 08:21:49', 'Pengajuan Ditugaskan'),
(30, 21, '2020-12-03 08:22:05', 'Pengajuan Ditugaskan'),
(31, 22, '2020-12-03 08:22:14', 'Pengajuan Ditugaskan'),
(32, 23, '2020-12-03 08:22:30', 'Pengajuan Ditugaskan'),
(33, 19, '2020-12-03 08:23:31', 'Pengajuan Diterima'),
(34, 20, '2020-12-03 08:23:50', 'Pengajuan Diterima'),
(35, 21, '2020-12-03 08:24:39', 'Pengajuan Ditolak'),
(36, 22, '2020-12-03 08:26:36', 'Permintaan Revisi'),
(37, 19, '2020-12-03 08:28:12', 'Akun Simbelmawa Dikirim'),
(38, 19, '2020-12-03 08:36:38', 'Laporan Akhir Dikirim');

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
('1634010056', 'Rizqi Chandra Pramana', '081', 39),
('1634010058', 'Ahmad Sidqi Bahariawansyah', '081', 40),
('1634010066', 'Ardisty Palvelus Jumala', '081', 41),
('1634010067', 'Maratul Adila', '081', 42),
('1634010068', 'Muhammad Diky Setiyawahyudi', '081', 43),
('1634010069', 'Ilham Setia Rinaldhi', '081', 44),
('1634010073', 'Reza Achmad Gallanta', '081', 45),
('1634010074', 'Agam Syahputra', '081', 46),
('1634010083', 'Berryl Pamudya Firensha', '081', 47),
('1634010085', 'Nobel Humania Billah', '081', 48),
('1634010090', 'Fierly Ramadhani Pramanda', '081', 49),
('1634010094', 'Dwi Darma Ardiansyah', '081', 50),
('1634010095', 'Ahmad Santoso', '081', 51);

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id` int(10) UNSIGNED NOT NULL,
  `periode_id` int(10) UNSIGNED NOT NULL,
  `kategori_id` int(10) UNSIGNED NOT NULL,
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

INSERT INTO `pengajuan` (`id`, `periode_id`, `kategori_id`, `tahap_id`, `dosen_nidn`, `judul`, `abstraksi`, `dana`, `file`, `belmawa_username`, `belmawa_password`, `file_laporan`) VALUES
(19, 2, 5, 6, '9937000068', 'Perencanaan Sistem Evaluasi Usulan Kegiatan Mahasiswa Dengan Menggunakan Teknologi Barcode Scanner', 'Program Kreativitas Mahasiswa (PKM) merupakan kegiatan yang dibentuk oleh Kementerian Riset dan Teknologi Republik Indonesia. Kegiatan ini dibentuk untuk memfasilitasi berbagai potensi yang dimiliki mahasiswa untuk mengaplikasikan dan mengembangkan ilmu yang diperoleh dalam perkuliahan kepada masyarakat luas. PKM Center adalah lembaga yang mengelola proposal program kreativitas mahasiswa di lingkungan Universitas Pembangunan Nasional “Veteran” Jawa Timur. Namun pengelolaan data proposal mahasiswa yang dilakukan oleh PKM Pusat masih dilakukan secara manual. Sehingga sulit untuk mengevaluasi sejarah proposal siswa. Karena permasalahan tersebut, sistem informasi perlu dikembangkan untuk memastikan bahwa permasalahan tersebut dapat diselesaikan. Sehingga pengelolaan data proposal siswa dapat terlaksana dengan baik. Pembuatan sistem evaluasi proposal mahasiswa memiliki beberapa tahapan yang dilakukan, diantaranya studi pustaka untuk mendapatkan referensi fitur-fitur yang digunakan dalam sistem evaluasi proposal. Setelah itu dilanjutkan dengan desain proses bisnis hingga desain aplikasi. Pemindai kode batang sebagai teknologi pendukung digunakan dalam sistem untuk meningkatkan akurasi data. Hasil akhir dari penelitian ini adalah sistem evaluasi proposal yang telah diajukan oleh mahasiswa pengusul berbasis web, sehingga data proposal dapat digunakan oleh pusat dalam menentukan proposal mana yang dapat lolos ke tahap selanjutnya.', 15000000, 'pengajuan_19.doc', 'qwerty123', 'asdfgh456', 'laporan_19.doc'),
(20, 2, 4, 5, '9937000068', 'Perancangan Dan Bangunan Aplikasi Peminjaman Fasilitas Kamar Berbasis Android', 'Android merupakan platform yang saat ini banyak digunakan oleh banyak pengguna, sehingga hampir setiap aplikasi yang dibuat menggunakan platform Android karena mudah digunakan dan juga efektif. Fakultas Ilmu Komputer UPN “Veteran” Jawa Timur memiliki 2 gedung dan banyak ruangan serta fasilitas lainnya seperti laboratorium, ruang seminar, dan terdapat pinjaman peralatan yang dapat membantu jalannya acara baik perkuliahan maupun non akademik. Hingga saat ini proses peminjaman ruangan dan fasilitas di Fakultas Ilmu Komputer masih dilakukan secara manual, seperti menggunakan surat dan beberapa proses lainnya. Hal ini juga menyebabkan pemborosan kertas dan waktu karena belum tentu ruang atau peralatan tersebut akan dipinjam terlebih dahulu oleh orang lain. Tujuan perancangan dan pembangunan aplikasi pinjaman fasilitas kamar adalah untuk meningkatkan atau mengoptimalkan layanan TU (Administrasi) kepada peminjam kamar. Metodologi penelitian dilakukan dengan pengumpulan data berupa wawancara, studi pustaka, observasi dan perancangan sistem dengan menggunakan model waterfall. Hasil penelitian ini adalah memudahkan pelayanan, nyaman dan aman dalam meminjam ruang', 8500000, 'pengajuan_20.docx', NULL, NULL, NULL),
(21, 2, 1, 4, '0714028703', 'Sistem Penerimaan Penyewa Inkubator Bisnis Berbasis Pencocokan Profil', 'Inkubator bisnis merupakan salah satu institusi yang saat ini lebih dibutuhkan untuk meningkatkan semua jenis wirausaha dan startup. Tenant adalah nama mitra binaan dalam Inkubator Bisnis, kinerja Inkubator Bisnis ditingkatkan, sehingga tenant yang masuk pendaftaran di Inkubator Bisnis juga meningkat. Kriteria menjadi tenant memiliki banyak variabel, sehingga membutuhkan waktu yang lama dalam proses perhitungannya, dengan adanya matching profile yang dapat disesuaikan dengan beberapa variabel yang dibutuhkan dalam inkubator bisnis ini, prosesnya menjadi lebih singkat dan memberikan nilai rekomendasi untuk direktur inkubator bisnis dalam memutuskan apakah penyewa diterima atau ditolak. Pada tabel 2 pada makalah ini dijelaskan bahwa nilai uji validitas sistem informasi pendaftaran tenant menggunakan algoritma profile matching mendapatkan nilai diatas 0,6 sebesar 1, sehingga pencocokan profil yang sesuai dengan pendaftaran studi kasus dapat diterapkan untuk penentuan inkubator bisnis technopark binaan tenant.', 25000000, 'pengajuan_21.doc', NULL, NULL, NULL),
(22, 2, 1, 3, '0714028703', 'Perencanaan Pembangkit Listrik Tenaga Surya Dengan Sistem On-Grid Di Gedung Keempat Universitas PGRI Semarang', 'Sistem on-grid adalah sistem yang digunakan oleh PLTS yang terhubung langsung ke jaringan listrik yang ada (PLN). Oleh karena itu, sistem on-grid tidak menggunakan sistem penyimpanan baterai atau superkapasitor. Dengan menggunakan sistem on-grid ini, masyarakat telah membantu pemerintah dalam mengurangi beban listrik PLN. Tujuan utama dalam penelitian ini adalah merencanakan sistem on-grid menggunakan fotovoltaik pada empat gedung Universitas PGRI Semarang. Metode penelitian yang dilakukan dalam penelitian ini adalah pengumpulan data sebagai penunjang penelitian meliputi data identifikasi beban listrik per jam dan sistem inverter on grid serta spesifikasi fotovoltaik yang digunakan, penentuan besarnya daya yang akan dibangkitkan pada sistem on grid, menghitung jumlah panel surya yang akan digunakan, tentukan susunan panel surya. Berdasarkan data beban Gedung 4 direncanakan memiliki panel surya monokristalin berkapasitas 200 Wp modul PV sebanyak 166 unit. Dalam pemasangan modul PV ada yang dihubungkan secara seri atau paralel dan tergantung besar kecilnya tegangan input inverter on grid yang digunakan. Berdasarkan spesifikasi inverter Sunny Tripower 60, tegangan input inverter adalah 685 V hingga 800 V DC. Berdasarkan hasil perhitungan luas PV diperoleh nilai 254,19 m2. Jika dawai disusun maka total daya yang dihasilkan oleh area PV adalah 33,15 KWP. Pemilihan lokasi didasarkan pada pertimbangan bahwa panel surya menghadap ke utara dengan sudut kemiringan 17,45⁰ dan dekat dengan ruang instalasi gedung.', 200000000, 'pengajuan_22.doc', NULL, NULL, NULL),
(23, 2, 1, 2, '0019067008', 'Sistem Parkir Cerdas menggunakan Android dan QR Code untuk Universitas Widyatama', 'With so many vehicle users, a new problem arises, namely the unorganized parking lot with the lack of a proper parking management system. These create various problems for vehicle users who want to park their vehicles, such as losing much time to find an empty parking space, besides that a manual parking payment system can result in long queues at payment counters and this happened at Widyatama University because it needs the right solution to overcome these problems. With the concept of a smart parking system that uses the QR Code for user convenience. This system can run on cellular platforms with a visual display that makes it easy for users. Besides, users can reserve a parking space before parking their vehicle. With additional features of the automatic payment system (E-money). This system can streamline time and efficiency. The research method was carried out using a prototype method in the method of making the system a structured process and has several stages that must be passed. Therefore this method aims to design cellular applications, \"Parkirin Aja!\".', 17500000, 'pengajuan_23.doc', NULL, NULL, NULL),
(24, 2, 2, 1, '0019067008', 'Aplikasi Rumus Matematika Untuk Siswa Sekolah Dasar Menggunakan Framework Codeigniter', 'Matematika merupakan salah satu ilmu yang banyak dimanfaatkan dalam kehidupan sehari-hari. Baik secara umum maupun khusus. Dengan menggunakan rumus matematika dasar, disini penulis mencoba mereview rumus-rumus yang telah dipelajari oleh siswa dari sekolah dasar sampai dengan sekolah menengah atas. Aplikasi berbasis web ini menggunakan codeigniter yang berisi 30 rumus matematika dasar.', 2500000, 'pengajuan_24.doc', NULL, NULL, NULL);

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
(24, 'Tim PKM Pengabdian Kepada Masyarakat 2020', 'Sejumlah mahasiswa UPN \"Veteran\" Jawa Timur kembali mengharumkan nama kampus Bela Negara di kancah nasional melalui prestasinya di PKM (Pekan Kreativitas Mahasiswa) – PIMNAS ke-33 yang diselenggarakan pada (23-28/11/20) di Universitas Muslim Indonesia, Makassar. PKM merupakan salah satu program Direktorat Pendidikan Tinggi (Dikti) bersama Program Kerja Menteri Riset dan Teknologi Indonesia dalam mewujudkan generasi muda yang berinovasi dan berkarya dalam keberagaman untuk kesejahteraan berkelanjutan.', 'pengumuman_24.jpg', '2020-12-03 07:58:10', 'aktif');

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
(59, 19, '1634010056', 1),
(60, 19, '1634010058', 2),
(61, 19, '1634010066', 3),
(62, 20, '1634010056', 1),
(63, 20, '1634010058', 2),
(64, 20, '1634010066', 3),
(65, 21, '1634010056', 1),
(66, 21, '1634010085', 2),
(67, 21, '1634010094', 3),
(68, 22, '1634010056', 1),
(69, 22, '1634010085', 2),
(70, 22, '1634010094', 3),
(71, 23, '1634010056', 1),
(72, 23, '1634010058', 2),
(73, 23, '1634010068', 3),
(74, 23, '1634010069', 4),
(75, 23, '1634010083', 5),
(76, 24, '1634010056', 1),
(77, 24, '1634010058', 2),
(78, 24, '1634010068', 3),
(79, 24, '1634010069', 4),
(80, 24, '1634010083', 5);

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
  `file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`id`, `pengajuan_id`, `dosen_nidn`, `komentar`, `file`) VALUES
(5, 19, '0023076907', 'Topik penelitian tidak sesuai dengan kategori PKM', NULL),
(6, 20, '0023076907', NULL, NULL),
(7, 21, '0023076907', NULL, NULL),
(8, 22, '0702068002', 'Format proposal mohon disesuaikan dengan format yang ada di Pusat PKM', 'ulasan_8.docx'),
(9, 23, '0702068002', NULL, NULL);

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
(59, 'rizky@gmail.com', '$2y$10$1KzTXDHEOf0OQoafhXb1BOG904TOBS.Dm95O0hLNANdUBzcpcQOzm', 'dosen', 'aktif');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pengusul`
--
ALTER TABLE `pengusul`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `periode`
--
ALTER TABLE `periode`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `fk_dosen_prodi` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dosen_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kategori`
--
ALTER TABLE `kategori`
  ADD CONSTRAINT `fk_kategori_hibah` FOREIGN KEY (`hibah_id`) REFERENCES `hibah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
