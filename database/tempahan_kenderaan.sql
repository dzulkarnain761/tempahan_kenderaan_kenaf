-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2024 at 08:18 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tempahan_kenderaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_kp` varchar(20) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `kumpulan` varchar(50) NOT NULL,
  `negeri` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `no_kp`, `contact_no`, `email`, `kumpulan`, `negeri`, `password`) VALUES
(7, 'SUPERRRR ADMINNNN', '000000000000', '00000000000', '', 'Z', 'NEGERI KELANTAN', '$2y$10$0XDhKgg28va1fQGxtnt.JOKe4KZYnCdAbLmnSL3UNnH8C9a1JN0..'),
(8, 'AHMAD ABU PEE', '111111111111', '11111111111', 'ahmadabu@gmail.com', 'D', 'NEGERI KELANTAN', '$2y$10$0ip5cb/lRWinJvgG8qq/zOBYgCXtakjQrdE2IJebKoJgpAiXfgZ06'),
(9, 'MUHD KAMARUL KPP', '222222222222', '22222222222', 'ahmadkamarul@gmail.com', 'A', 'NEGERI KELANTAN', '$2y$10$TrDN27ZVlYsD2cJH358yDOVK0KaCuPglEYBxSrWNSxbqMWe2oBZn2'),
(10, 'SITI SYAFIQAH PT', '333333333333', '33333333333', 'sitisyafiqah@gmail.com', 'F', 'NEGERI KELANTAN', '$2y$10$Y4L9wiWd9HPbLgStWveiiOBjs/8eg8w0yAqKgpNZB8IkFxdJcCWom'),
(12, 'MOHD AZMI BIN AB KADIR', '555555555555', '55555555555', 'mazmi@lktn.gov.my', 'Y', '', '$2y$10$xAFM9GpsD.e3/.aPnCJpJugxOKbvvf76c7Ui/qkwfbTQthgWodLfK'),
(14, 'AZHAR BIN HAMAT', '777777777777', '77777777777', '', 'Y', '', '$2y$10$HHb9tKUCW/7UsaLhGCh4YuxK0daiytaVqz6bYwukLjX5BaFClbPAq'),
(15, 'PENGARAH PENGARAH', '888888888888', '88888888888', '', 'E', 'NEGERI KELANTAN', '$2y$10$99VpyCBFP/JHbvhxjp3MM.er2iBsqpv3Ad5OkacvUzOsPtvsGcUvm'),
(16, 'XINWEN LIAU KEWANGAN', '666666666666', '66666666666', '', 'G', 'NEGERI KELANTAN', '$2y$10$uQRo3I9B98HaJaOoG4JUleNogIrScAxX8AtJVTzm5Q8ngt0tZtH1S');

-- --------------------------------------------------------

--
-- Table structure for table `fpx_payments`
--

CREATE TABLE `fpx_payments` (
  `id` int(11) NOT NULL,
  `fpx_id_transaksi` varchar(255) NOT NULL,
  `fpx_id_bank` varchar(50) NOT NULL,
  `fpx_nama_bank` varchar(255) NOT NULL,
  `fpx_nama_pembeli` varchar(255) NOT NULL,
  `fpx_akaun_bank_pembeli` varchar(255) NOT NULL,
  `jumlah_bayaran` decimal(10,2) NOT NULL,
  `fpx_masa_transaksi` datetime NOT NULL DEFAULT current_timestamp(),
  `fpx_tandatangan` text NOT NULL,
  `fpx_kod_respon` varchar(50) NOT NULL,
  `nombor_rujukan` varchar(255) DEFAULT NULL,
  `alamat_ip` varchar(50) DEFAULT NULL,
  `tujuan` varchar(255) NOT NULL DEFAULT 'tempahan kenderaan',
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobsheet`
--

CREATE TABLE `jobsheet` (
  `jobsheet_id` int(11) NOT NULL,
  `tempahan_id` int(11) DEFAULT NULL,
  `tempahan_kerja_id` int(11) DEFAULT NULL,
  `pemandu_id` int(11) DEFAULT NULL,
  `kenderaan_id` int(11) DEFAULT NULL,
  `tarikh_kerja_dijalankan` date DEFAULT NULL,
  `jam` int(5) DEFAULT 0,
  `minit` int(5) NOT NULL DEFAULT 0,
  `harga` decimal(10,2) DEFAULT NULL,
  `catatan` varchar(100) NOT NULL,
  `status_jobsheet` enum('pengesahan','dijalankan','selesai') NOT NULL DEFAULT 'pengesahan',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_kenderaan`
--

CREATE TABLE `kategori_kenderaan` (
  `id` int(11) NOT NULL,
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_kenderaan`
--

INSERT INTO `kategori_kenderaan` (`id`, `kategori`) VALUES
(1, 'Jengkaut'),
(2, 'Traktor');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_lesen`
--

CREATE TABLE `kategori_lesen` (
  `id` int(11) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_lesen`
--

INSERT INTO `kategori_lesen` (`id`, `kategori`, `description`) VALUES
(7, 'D', 'Motokar dengan berat tanpa muatan (BTM) tidak melebihi 3000 kg'),
(8, 'E', 'Motokar berat dengan BTM melebihi 7500 kg'),
(9, 'E1', 'Motokar berat dengan BTM tidak melebihi 7500 kg'),
(10, 'E2', 'Motokar berat dengan BTM tidak melebihi 5000 kg'),
(11, 'F', 'Traktor / Jentera bermotor ringan (beroda) dengan BTM tidak melebihi 5000 kg'),
(12, 'G', 'Traktor / Jentera bermotor ringan (berantai) dengan BTM tidak melebihi 5000 kg'),
(13, 'H', 'Traktor / Jentera bermotor berat (beroda) dengan BTM melebihi 5000 kg'),
(14, 'I', 'Traktor / Jentera bermotor berat (berantai) dengan BTM tidak 5000 kg'),
(16, 'Z', 'DSADSADSDASDASDADADASDASDDAS');

-- --------------------------------------------------------

--
-- Table structure for table `kawasan`
--

CREATE TABLE `kawasan` (
  `id_kaw` int(11) NOT NULL,
  `nama_kaw` varchar(255) DEFAULT NULL,
  `id_negeri` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kawasan`
--

INSERT INTO `kawasan` (`id_kaw`, `nama_kaw`, `id_negeri`) VALUES
(1, 'IBU PEJABAT LKTN', 1),
(2, 'UNIT ASET', 3),
(3, 'PEJABAT KETUA PENGARAH\r\n', 3),
(4, 'UNIT KOMUNIKASI KORPORAT\r\n', 3),
(5, 'UNIT AUDIT DALAM\r\n', 3),
(6, 'UNIT INTEGRITI\r\n', 3),
(7, 'UNIT UNDANG-UNDANG\r\n', 3),
(8, 'PEJABAT TIMBALAN KETUA PENGARAH (PEMBANGUNAN)		\r\n', 3),
(9, 'BAHAGIAN PEMBANGUNAN & PENGEMBANGAN (BPP)		\r\n', 3),
(10, 'BAHAGIAN PENYELIDIKAN & PEMBANGUNAN (BRD)		\r\n', 3),
(11, 'BAHAGIAN PEMASARAN (BPM)', 3),
(12, 'BAHAGIAN KEJURUTERAAN DAN KILANG (BKK)		\r\n', 3),
(13, 'PUSAT PENGUMPULAN KENAF IN-SITU (PPKI)		\r\n', 3),
(14, 'PEJABAT TIMBALAN KETUA PENGARAH (PENGURUSAN/ OPERASI)		\r\n', 3),
(15, 'BAHAGIAN KHIDMAT PENGURUSAN\r\n', 3),
(16, 'UNIT PENTADBIRAN\r\n', 3),
(17, 'UNIT PSM\r\n', 3),
(18, 'UNIT KEWANGAN\r\n', 3),
(19, 'UNIT PEROLEHAN\r\n', 3),
(20, 'UNIT LATIHAN\r\n', 3),
(21, 'UNIT LATIHAN\r\n', 3),
(22, 'INSTITUT LATIHAN KENAF DAN TEMBAKAU (INSKET)		\r\n', 3),
(23, 'BAHAGIAN PERANCANGAN STRATEGIK (BPS)		\r\n', 3),
(24, 'BAHAGIAN PELESENAN DAN PENGUATKUASAAN (BPK)		\r\n', 3),
(25, 'PEJABAT NEGERI TERENGGANU\r\n', 2),
(26, 'KAWASAN SETIU\r\n', 2),
(27, 'RMCC SAUJANA\r\n', 2),
(28, 'KAWASAN MARANG\r\n', 2),
(29, 'KAWASAN BESUT\r\n', 2),
(30, 'PEJABAT NEGERI KELANTAN\r\n', 1),
(31, 'KAWASAN PASIR MAS\r\n', 1),
(32, 'RMCC GUAL MESA\r\n', 1),
(33, 'KAWASAN PASIR PUTEH\r\n', 1),
(34, 'RMCC BUKIT MERBAU\r\n', 1),
(35, 'PEJABAT NEGERI PAHANG\r\n', 4),
(36, 'KAWASAN ROMPIN\r\n', 4),
(38, 'PEJABAT NEGERI KEDAH\r\n', 5),
(40, 'PEJABAT NEGERI PERLIS\r\n', 6),
(41, 'PEJABAT NEGERI PERAK\r\n', 7),
(42, 'PEJABAT NEGERI JOHOR\r\n', 8),
(43, 'PEJABAT NEGERI MELAKA\r\n', 9),
(44, 'PEJABAT NEGERI SELANGOR DAN WILAYAH PERSEKUTUAN\r\n', 10),
(45, 'BAHAGIAN KEJURUTERAAN DAN KILANG', 11);

-- --------------------------------------------------------

--
-- Table structure for table `kenderaan`
--

CREATE TABLE `kenderaan` (
  `id` int(11) NOT NULL,
  `kategori_kenderaan` varchar(50) NOT NULL,
  `no_aset` varchar(50) NOT NULL,
  `no_pendaftaran` varchar(20) NOT NULL,
  `tahun_daftar` year(4) NOT NULL,
  `negeri_penempatan` varchar(50) NOT NULL,
  `kawasan_penempatan` varchar(50) NOT NULL,
  `catatan` varchar(50) NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kenderaan`
--

INSERT INTO `kenderaan` (`id`, `kategori_kenderaan`, `no_aset`, `no_pendaftaran`, `tahun_daftar`, `negeri_penempatan`, `kawasan_penempatan`, `catatan`, `status`) VALUES
(4, 'Traktor', '001364', 'DAE9475', '1998', 'BKK', '45', 'ROSAKKK', 'Aktif'),
(5, 'Traktor', 'LKTN/H/11/016737', 'WVD859', '2011', 'BKK', 'BAHAGIAN KEJURUTERAAN DAN KILANG', 'AZHAR', 'Aktif'),
(6, 'Jengkaut', 'LKTN/H/11/016790', 'WVC1192', '2011', 'BKK', 'BAHAGIAN KEJURUTERAAN DAN KILANG', 'AZMI', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `kumpulan`
--

CREATE TABLE `kumpulan` (
  `kump_id` int(11) NOT NULL,
  `kump_kod` varchar(50) DEFAULT NULL,
  `kump_desc` text DEFAULT NULL,
  `kump_dash` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kumpulan`
--

INSERT INTO `kumpulan` (`kump_id`, `kump_kod`, `kump_desc`, `kump_dash`) VALUES
(1, 'A', 'KETUA PENOLONG PENGARAH (KPP)', 'indexA.php'),
(2, 'B', 'KETUA UNIT PEMBAIKIAN (KUP)', 'indexB.php'),
(3, 'C', 'KETUA UNIT ASET (KUA)', 'indexC.php'),
(4, 'D', 'PEMBANTU EHWAL EKONOMI (PEE)', 'indexD.php'),
(5, 'E', 'KETUA PENGARAH (KP)', 'indexE.php'),
(6, 'F', 'PEMBANTU TADBIR (PT)', 'indexF.php'),
(8, 'Y', 'PEMANDU', 'indexY.php'),
(9, 'Z', 'SUPER ADMIN', 'indexZ.php'),
(10, 'G', 'KEWANGAN', 'kewangan.php');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `pengguna_id` varchar(15) NOT NULL,
  `action` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`pengguna_id`, `action`, `date_created`, `ip_address`) VALUES
('000000000000', 'Log masuk sebagai ADMIN (Z)', '2024-09-02 01:07:27', '::1'),
('1', 'Log masuk sebagai PENYEWA', '2024-09-02 22:48:02', '::1'),
('1', 'Log masuk sebagai PENYEWA', '2024-09-02 22:49:07', '::1'),
('1', 'Log masuk sebagai PENYEWA', '2024-09-02 22:49:33', '::1'),
('1', 'Log masuk sebagai PENYEWA', '2024-09-02 23:07:00', '::1'),
('1', 'Log masuk sebagai PENYEWA', '2024-09-04 03:05:55', '::1'),
('1', 'Log masuk sebagai PENYEWA', '2024-09-04 19:23:45', '::1'),
('1', 'Log masuk sebagai PENYEWA', '2024-09-09 02:08:19', '::1'),
('1', 'Log masuk sebagai PENYEWA', '2024-09-09 19:20:25', '::1'),
('1', 'Log masuk sebagai PENYEWA', '2024-09-10 01:40:19', '::1'),
('1', 'Log masuk sebagai PENYEWA', '2024-09-11 01:09:43', '::1'),
('1', 'Log masuk sebagai PENYEWA', '2024-09-11 18:40:27', '::1'),
('1', 'Log masuk sebagai PENYEWA', '2024-09-11 20:02:16', '::1'),
('1', 'Log masuk sebagai PENYEWA', '2024-09-14 19:17:54', '::1'),
('1', 'Log masuk sebagai PENYEWA', '2024-09-17 20:10:53', '::1'),
('1', 'Log masuk sebagai PENYEWA', '2024-09-18 01:09:39', '::1'),
('1', 'Log masuk sebagai PENYEWA', '2024-09-18 01:12:04', '::1'),
('1', 'Log masuk sebagai PENYEWA', '2024-09-18 01:17:30', '::1'),
('1', 'Log masuk sebagai PENYEWA', '2024-10-29 00:35:10', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-09-18 01:48:52', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-09-18 02:03:10', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-09-19 00:50:42', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-09-21 21:14:02', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-09-22 21:43:51', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-09-22 21:47:32', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-09-22 21:48:30', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-09-22 21:50:04', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-09-22 22:29:51', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-09-23 00:40:30', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-09-23 01:04:45', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-09-23 01:09:14', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-09-23 01:09:52', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-09-23 01:37:39', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-09-23 01:38:23', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-09-23 03:18:06', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-09-23 03:24:18', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-09-23 03:34:21', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-09-23 03:40:17', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-09-23 20:13:40', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-09-23 20:30:07', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-09-23 20:34:28', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-09-23 20:46:28', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-09-23 21:35:24', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-09-24 02:16:07', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-09-24 19:03:09', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-09-24 21:34:30', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-09-24 21:35:16', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-09-24 21:57:49', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-09-25 00:08:16', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-09-25 00:27:55', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-09-25 00:38:21', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-09-25 00:42:16', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-10-02 21:05:32', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-10-06 19:45:23', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-10-06 20:28:44', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-10-06 20:29:37', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-10-06 20:33:49', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-10-07 02:13:35', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-10-07 02:15:21', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-10-07 22:13:51', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-10-07 22:53:02', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-10-08 02:59:58', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-10-08 03:23:47', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-10-08 19:20:01', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-10-08 21:12:07', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-10-08 21:52:39', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-10-09 00:47:29', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-10-09 01:00:21', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-10-09 01:01:02', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-10-09 01:11:22', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-10-09 01:17:09', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-10-09 14:54:21', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-10-20 03:28:21', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-10-20 18:56:59', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-10-20 22:20:16', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-10-21 00:22:42', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-10-21 00:58:24', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-10-21 01:36:04', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-10-21 01:40:00', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-10-21 20:13:46', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-10-22 02:14:59', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-10-23 18:57:15', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-10-28 23:37:59', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-10-28 23:41:02', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-11-02 19:17:47', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-11-02 19:39:07', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-11-02 20:54:11', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-11-02 20:56:10', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-11-03 18:47:11', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-11-03 23:27:40', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-11-03 23:30:07', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-11-04 00:10:19', '::1'),
('10', 'Log masuk sebagai ADMIN (F)', '2024-11-04 00:11:32', '::1'),
('11', 'Log masuk sebagai ADMIN (F)', '2024-09-22 21:44:02', '::1'),
('11', 'Log masuk sebagai ADMIN (F)', '2024-09-22 21:47:43', '::1'),
('11', 'Log masuk sebagai ADMIN (F)', '2024-09-22 21:49:55', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-09-15 00:05:31', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-09-18 00:28:55', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-09-18 02:04:18', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-09-19 01:17:29', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-09-23 01:07:32', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-09-23 03:26:08', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-10-06 20:02:30', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-10-06 20:31:18', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-10-06 20:34:02', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-10-06 21:45:11', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-10-06 21:45:30', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-10-07 00:27:54', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-10-07 02:14:36', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-10-07 02:15:47', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-10-07 19:42:34', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-10-07 19:43:47', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-10-07 20:27:37', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-10-07 22:15:05', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-10-07 23:01:42', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-10-08 00:32:06', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-10-08 02:57:24', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-10-08 21:18:34', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-10-09 00:50:02', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-10-09 00:51:19', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-10-09 00:51:31', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-10-09 00:52:40', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-10-09 00:53:14', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-10-09 00:55:22', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-10-09 01:12:49', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-10-09 18:21:25', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-09-18 00:16:29', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-09-18 00:24:13', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-09-19 01:44:49', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-09-21 20:50:56', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-09-21 21:42:15', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-09-21 22:14:56', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-09-22 21:55:40', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-09-22 22:01:21', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-09-23 01:05:30', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-09-23 20:13:58', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-09-23 20:30:32', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-09-23 21:08:33', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-09-23 21:20:21', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-09-23 21:22:57', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-09-23 21:33:44', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-09-24 22:22:22', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-09-24 22:44:02', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-09-25 00:39:59', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-10-06 20:03:18', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-10-06 21:45:18', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-10-07 00:09:19', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-10-07 19:43:31', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-10-07 19:44:01', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-10-08 00:32:14', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-10-08 02:57:41', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-10-08 21:18:42', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-10-09 00:50:10', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-10-09 00:51:25', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-10-09 01:13:00', '::1'),
('15', 'Log masuk sebagai ADMIN (E)', '2024-10-20 21:38:47', '::1'),
('15', 'Log masuk sebagai ADMIN (E)', '2024-10-20 21:39:23', '::1'),
('15', 'Log masuk sebagai ADMIN (E)', '2024-10-20 21:42:53', '::1'),
('15', 'Log masuk sebagai ADMIN (E)', '2024-10-20 21:43:07', '::1'),
('15', 'Log masuk sebagai ADMIN (E)', '2024-10-21 00:16:30', '::1'),
('15', 'Log masuk sebagai ADMIN (E)', '2024-10-21 00:26:19', '::1'),
('15', 'Log masuk sebagai ADMIN (E)', '2024-10-21 00:56:53', '::1'),
('15', 'Log masuk sebagai ADMIN (E)', '2024-10-21 01:37:55', '::1'),
('15', 'Log masuk sebagai ADMIN (E)', '2024-10-28 23:39:03', '::1'),
('15', 'Log masuk sebagai ADMIN (E)', '2024-11-02 19:38:25', '::1'),
('15', 'Log masuk sebagai ADMIN (E)', '2024-11-02 20:54:04', '::1'),
('15', 'Log masuk sebagai ADMIN (E)', '2024-11-02 20:57:24', '::1'),
('15', 'Log masuk sebagai ADMIN (E)', '2024-11-03 20:49:11', '::1'),
('15', 'Log masuk sebagai ADMIN (E)', '2024-11-03 23:28:15', '::1'),
('15', 'Log masuk sebagai ADMIN (E)', '2024-11-04 00:10:50', '::1'),
('16', 'Log masuk sebagai ADMIN (G)', '2024-10-29 00:35:42', '::1'),
('16', 'Log masuk sebagai ADMIN (G)', '2024-10-29 00:35:51', '::1'),
('16', 'Log masuk sebagai ADMIN (G)', '2024-10-29 00:36:35', '::1'),
('16', 'Log masuk sebagai ADMIN (G)', '2024-10-29 00:36:52', '::1'),
('16', 'Log masuk sebagai ADMIN (G)', '2024-10-29 18:17:32', '::1'),
('16', 'Log masuk sebagai ADMIN (G)', '2024-10-30 01:06:20', '::1'),
('16', 'Log masuk sebagai ADMIN (G)', '2024-11-02 19:41:56', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-09 20:16:40', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-18 00:16:06', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-18 01:17:59', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-18 02:03:58', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-18 22:27:09', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-19 00:20:38', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-19 01:46:54', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-21 20:28:46', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-21 21:12:39', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-21 21:12:52', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-21 21:14:18', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-21 21:26:48', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-22 01:27:58', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-22 19:11:23', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-22 20:29:23', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-22 20:51:07', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-22 21:51:19', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-22 22:00:02', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-22 22:02:21', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-22 22:53:05', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-23 00:52:20', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-23 00:59:16', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-23 01:03:34', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-23 01:09:35', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-23 01:25:35', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-23 01:37:47', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-23 02:10:22', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-23 02:52:27', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-23 02:52:36', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-23 03:13:08', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-23 03:16:33', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-23 03:23:31', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-23 03:29:46', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-23 03:40:33', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-23 20:10:29', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-23 20:13:16', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-23 20:14:44', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-23 20:29:36', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-23 20:33:08', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-23 20:37:41', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-23 20:46:07', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-23 21:10:26', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-23 21:33:29', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-23 21:34:21', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-23 21:35:50', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-24 00:25:16', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-24 21:25:57', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-24 21:39:36', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-24 22:25:23', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-24 22:44:59', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-25 00:01:49', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-25 00:16:46', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-25 00:28:09', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-25 00:34:43', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-25 00:39:42', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-25 00:41:31', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-09-25 00:42:58', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-01 19:36:45', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-01 20:12:17', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-01 21:57:47', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-02 21:05:18', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-02 21:07:34', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-02 21:50:10', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-02 21:54:26', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-06 03:00:02', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-06 03:06:32', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-06 03:15:39', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-06 03:27:43', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-06 18:56:38', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-06 19:33:19', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-06 19:42:09', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-06 20:02:54', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-06 20:17:14', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-06 20:28:10', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-06 20:29:09', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-06 20:29:26', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-07 01:30:46', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-07 02:12:43', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-07 19:30:23', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-07 19:43:01', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-07 22:09:00', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-08 02:59:19', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-08 03:01:11', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-08 20:09:10', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-08 21:19:35', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-08 21:32:35', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-08 21:36:27', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-08 22:07:05', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-09 00:44:28', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-09 00:49:42', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-09 00:51:07', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-09 00:54:56', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-09 00:59:48', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-09 01:00:52', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-09 01:01:23', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-09 01:07:45', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-09 01:10:47', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-09 01:12:23', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-09 01:16:49', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-09 01:20:33', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-12 19:45:48', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-13 19:21:16', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-13 20:12:57', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-15 02:10:32', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-15 19:26:43', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-15 19:32:11', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-15 22:27:36', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-15 22:35:30', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-17 01:49:23', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-17 01:57:16', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-19 20:11:57', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-20 02:45:58', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-21 01:15:11', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-21 01:21:10', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-21 01:22:28', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-21 01:29:16', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-21 01:35:24', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-10-29 19:32:00', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-11-02 18:31:16', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-11-02 18:41:34', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-11-02 20:43:38', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-11-02 20:54:25', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-11-02 21:07:23', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-11-03 18:37:39', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-11-03 23:22:04', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-11-03 23:27:19', '::1'),
('2', 'Log masuk sebagai PENYEWA', '2024-11-04 00:09:09', '::1'),
('666666666666', 'Log masuk sebagai PENYEWA', '2024-09-02 01:01:33', '::1'),
('666666666666', 'Log masuk sebagai PENYEWA', '2024-09-02 01:13:30', '::1'),
('666666666666', 'Log masuk sebagai PENYEWA', '2024-09-02 18:57:38', '::1'),
('7', 'Log masuk sebagai ADMIN (Z)', '2024-09-17 22:55:21', '::1'),
('7', 'Log masuk sebagai ADMIN (Z)', '2024-09-18 00:22:09', '::1'),
('7', 'Log masuk sebagai ADMIN (Z)', '2024-09-18 00:31:51', '::1'),
('7', 'Log masuk sebagai ADMIN (Z)', '2024-09-18 01:19:00', '::1'),
('7', 'Log masuk sebagai ADMIN (Z)', '2024-09-18 01:34:26', '::1'),
('7', 'Log masuk sebagai ADMIN (Z)', '2024-09-18 22:25:10', '::1'),
('7', 'Log masuk sebagai ADMIN (Z)', '2024-09-19 01:46:09', '::1'),
('7', 'Log masuk sebagai ADMIN (Z)', '2024-09-21 19:12:33', '::1'),
('7', 'Log masuk sebagai ADMIN (Z)', '2024-09-21 19:14:00', '::1'),
('7', 'Log masuk sebagai ADMIN (Z)', '2024-09-21 19:48:29', '::1'),
('7', 'Log masuk sebagai ADMIN (Z)', '2024-09-21 20:29:42', '::1'),
('7', 'Log masuk sebagai ADMIN (Z)', '2024-09-21 21:08:42', '::1'),
('7', 'Log masuk sebagai ADMIN (Z)', '2024-09-21 21:17:20', '::1'),
('7', 'Log masuk sebagai ADMIN (Z)', '2024-09-21 21:37:20', '::1'),
('7', 'Log masuk sebagai ADMIN (Z)', '2024-09-21 21:46:39', '::1'),
('7', 'Log masuk sebagai ADMIN (Z)', '2024-09-21 22:31:28', '::1'),
('7', 'Log masuk sebagai ADMIN (Z)', '2024-09-23 02:11:57', '::1'),
('7', 'Log masuk sebagai ADMIN (Z)', '2024-09-23 02:14:33', '::1'),
('7', 'Log masuk sebagai ADMIN (Z)', '2024-10-20 21:32:43', '::1'),
('7', 'Log masuk sebagai ADMIN (Z)', '2024-10-29 00:04:00', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-09-18 00:35:00', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-09-18 01:10:40', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-09-18 01:41:32', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-09-18 22:56:53', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-09-21 19:13:26', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-09-21 21:10:12', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-09-21 21:12:14', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-09-21 21:16:20', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-09-22 20:21:09', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-09-23 00:56:38', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-09-23 01:00:12', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-09-23 01:36:46', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-09-23 03:11:49', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-09-23 03:13:25', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-09-23 03:18:14', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-09-23 20:11:40', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-09-23 20:27:13', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-09-23 20:27:31', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-09-23 20:45:27', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-09-24 00:23:52', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-09-24 21:29:20', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-09-25 00:00:42', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-09-25 00:25:47', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-09-25 00:33:54', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-01 19:40:41', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-01 20:13:44', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-01 20:42:50', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-01 22:06:43', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-02 21:05:47', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-02 21:07:24', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-02 21:13:07', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-02 21:52:10', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-02 21:54:09', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-02 21:55:16', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-05 19:37:08', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-06 03:04:01', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-06 03:09:28', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-06 03:26:55', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-06 03:28:51', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-06 18:58:48', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-06 19:34:20', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-06 20:19:00', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-07 01:20:15', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-07 01:31:20', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-07 03:12:34', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-07 22:10:16', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-07 22:12:58', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-07 22:31:37', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-07 23:01:58', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-08 00:24:11', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-08 19:18:51', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-08 20:36:52', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-08 21:50:05', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-09 00:42:32', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-09 00:55:12', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-09 01:01:15', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-09 01:08:16', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-09 18:01:56', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-09 18:11:01', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-12 20:12:47', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-13 19:21:33', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-14 21:07:58', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-15 19:07:43', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-15 19:26:33', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-15 19:28:12', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-15 19:32:05', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-15 19:32:37', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-15 22:36:02', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-16 00:23:50', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-16 01:08:13', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-16 19:17:46', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-17 01:57:04', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-19 20:10:16', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-21 00:58:45', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-21 01:14:58', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-21 01:17:35', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-21 01:32:05', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-22 01:22:26', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-23 00:11:09', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-23 18:57:29', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-23 20:14:35', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-10-28 17:58:15', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-11-02 18:39:54', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-11-02 19:40:21', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-11-02 20:51:18', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-11-02 20:58:03', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-11-03 23:25:18', '::1'),
('8', 'Log masuk sebagai ADMIN (D)', '2024-11-04 00:03:55', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-09-18 01:47:28', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-09-19 00:09:42', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-09-22 20:27:27', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-09-22 20:50:34', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-09-23 00:57:57', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-09-23 01:01:27', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-09-23 01:37:23', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-09-23 03:21:02', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-09-23 20:12:28', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-09-23 20:29:15', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-09-23 20:45:52', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-09-24 00:24:56', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-09-24 21:34:01', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-09-25 00:01:34', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-09-25 00:27:33', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-09-25 00:34:23', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-10-06 03:13:42', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-10-06 19:01:27', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-10-06 19:40:41', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-10-06 20:28:33', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-10-06 20:29:03', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-10-07 02:12:04', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-10-07 22:13:08', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-10-08 21:11:59', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-10-08 21:52:46', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-10-09 00:43:45', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-10-09 01:10:03', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-10-09 18:08:45', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-10-09 18:18:11', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-10-16 00:03:04', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-10-16 00:23:41', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-10-16 00:46:59', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-10-16 01:34:41', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-10-16 19:18:17', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-10-17 01:56:34', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-10-19 20:10:29', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-10-21 01:21:45', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-10-21 01:23:18', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-10-21 01:34:46', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-11-02 18:40:56', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-11-02 19:40:13', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-11-02 20:52:18', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-11-02 20:53:54', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-11-03 23:26:15', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `negeri`
--

CREATE TABLE `negeri` (
  `id_negeri` int(11) NOT NULL,
  `nama_negeri` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `negeri`
--

INSERT INTO `negeri` (`id_negeri`, `nama_negeri`) VALUES
(1, 'NEGERI KELANTAN'),
(2, 'NEGERI TERENGGANU'),
(4, 'NEGERI PAHANG'),
(5, 'NEGERI KEDAH'),
(6, 'NEGERI PERLIS'),
(7, 'NEGERI PERAK'),
(8, 'NEGERI JOHOR'),
(9, 'NEGERI MELAKA'),
(10, 'NEGERI SELANGOR DAN WILAYAH PERSEKUTUAN'),
(11, 'BKK');

-- --------------------------------------------------------

--
-- Table structure for table `penyewa`
--

CREATE TABLE `penyewa` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_kp` varchar(20) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `nama_bank` varchar(100) DEFAULT NULL,
  `no_bank` varchar(30) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penyewa`
--

INSERT INTO `penyewa` (`id`, `nama`, `no_kp`, `contact_no`, `email`, `alamat`, `nama_bank`, `no_bank`, `password`) VALUES
(2, 'MUHAMMAD DZULKARNAIN', '999999999999', '99999999999', NULL, 'pengkalan batu, pasir mas,', 'Maybank', '212132132', '$2y$10$joT4JcenTgyly1.eGtropezk0Rt2ZEyf6kXaEwWUdXd2bfKt6zpnC');

-- --------------------------------------------------------

--
-- Table structure for table `resit_pembayaran`
--

CREATE TABLE `resit_pembayaran` (
  `resit_id` int(11) NOT NULL,
  `tempahan_id` int(11) NOT NULL,
  `jenis_pembayaran` enum('bayaran penuh','refund','bayaran tambahan') NOT NULL,
  `jumlah` decimal(10,2) NOT NULL,
  `cara_bayar` enum('tunai','fpx') DEFAULT NULL,
  `nombor_rujukan` varchar(255) NOT NULL,
  `bukti_resit_path` varchar(255) NOT NULL,
  `status_resit` enum('pengesahan','selesai') NOT NULL DEFAULT 'pengesahan',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tempahan`
--

CREATE TABLE `tempahan` (
  `tempahan_id` int(11) NOT NULL,
  `penyewa_id` int(11) DEFAULT NULL,
  `tarikh_kerja` date DEFAULT NULL,
  `negeri` varchar(100) NOT NULL,
  `lokasi_kerja` varchar(255) DEFAULT NULL,
  `luas_tanah` decimal(10,1) DEFAULT 0.0,
  `total_harga_anggaran` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_harga_sebenar` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_baki` decimal(10,2) NOT NULL DEFAULT 0.00,
  `catatan` varchar(255) DEFAULT NULL,
  `disahkan_oleh` varchar(100) NOT NULL,
  `status_tempahan` enum('pengesahan pee','pengesahan kpp','bayaran penyewa','pengesahan pt','pengesahan pengarah','penjanaan resit','pengesahan jobsheet','kemaskini jobsheet','refund kewangan','ditolak','dibatalkan','selesai') DEFAULT 'pengesahan pee',
  `status_bayaran` enum('dalam pengesahan','belum bayar','bayaran diproses','selesai bayaran','ditolak','dibatalkan','selesai','refund','bayaran tambahan') NOT NULL DEFAULT 'dalam pengesahan',
  `sebab_ditolak` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tempahan_kerja`
--

CREATE TABLE `tempahan_kerja` (
  `tempahan_kerja_id` int(11) NOT NULL,
  `tempahan_id` int(11) DEFAULT NULL,
  `nama_kerja` varchar(255) DEFAULT NULL,
  `jam_anggaran` int(5) NOT NULL DEFAULT 0,
  `minit_anggaran` int(5) NOT NULL DEFAULT 0,
  `harga_anggaran` decimal(10,2) DEFAULT 0.00,
  `total_jam` int(5) NOT NULL DEFAULT 0,
  `total_minit` int(5) NOT NULL DEFAULT 0,
  `total_harga` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tarikh_kerja_cadangan` date DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tugasan`
--

CREATE TABLE `tugasan` (
  `id` int(11) NOT NULL,
  `kerja` varchar(255) NOT NULL,
  `harga_per_jam` decimal(10,2) NOT NULL,
  `kategori_kenderaan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tugasan`
--

INSERT INTO `tugasan` (`id`, `kerja`, `harga_per_jam`, `kategori_kenderaan`) VALUES
(1, 'Parit Baru', 40.00, 'Jengkaut'),
(2, 'Baikpulih Parit', 40.00, 'Jengkaut'),
(3, 'Gali Kolam', 40.00, 'Jengkaut'),
(4, 'Bersih Kawasan', 40.00, 'Jengkaut'),
(6, 'Piring', 100.00, 'Traktor'),
(7, 'Piring Batas Besar', 100.00, 'Traktor'),
(8, 'Rotor 1', 100.00, 'Traktor'),
(9, 'Rotor 2', 100.00, 'Traktor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fpx_payments`
--
ALTER TABLE `fpx_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobsheet`
--
ALTER TABLE `jobsheet`
  ADD PRIMARY KEY (`jobsheet_id`),
  ADD KEY `fk_tempahan_kerja_id` (`tempahan_kerja_id`);

--
-- Indexes for table `kategori_kenderaan`
--
ALTER TABLE `kategori_kenderaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_lesen`
--
ALTER TABLE `kategori_lesen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kawasan`
--
ALTER TABLE `kawasan`
  ADD PRIMARY KEY (`id_kaw`);

--
-- Indexes for table `kenderaan`
--
ALTER TABLE `kenderaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kumpulan`
--
ALTER TABLE `kumpulan`
  ADD PRIMARY KEY (`kump_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`pengguna_id`,`date_created`);

--
-- Indexes for table `negeri`
--
ALTER TABLE `negeri`
  ADD PRIMARY KEY (`id_negeri`);

--
-- Indexes for table `penyewa`
--
ALTER TABLE `penyewa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resit_pembayaran`
--
ALTER TABLE `resit_pembayaran`
  ADD PRIMARY KEY (`resit_id`),
  ADD KEY `fk_pembayaran_tempahan` (`tempahan_id`);

--
-- Indexes for table `tempahan`
--
ALTER TABLE `tempahan`
  ADD PRIMARY KEY (`tempahan_id`),
  ADD KEY `fk_penyewa` (`penyewa_id`);

--
-- Indexes for table `tempahan_kerja`
--
ALTER TABLE `tempahan_kerja`
  ADD PRIMARY KEY (`tempahan_kerja_id`),
  ADD KEY `fk_tempahan` (`tempahan_id`);

--
-- Indexes for table `tugasan`
--
ALTER TABLE `tugasan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `fpx_payments`
--
ALTER TABLE `fpx_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobsheet`
--
ALTER TABLE `jobsheet`
  MODIFY `jobsheet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `kategori_kenderaan`
--
ALTER TABLE `kategori_kenderaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategori_lesen`
--
ALTER TABLE `kategori_lesen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kawasan`
--
ALTER TABLE `kawasan`
  MODIFY `id_kaw` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `kenderaan`
--
ALTER TABLE `kenderaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kumpulan`
--
ALTER TABLE `kumpulan`
  MODIFY `kump_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `negeri`
--
ALTER TABLE `negeri`
  MODIFY `id_negeri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `penyewa`
--
ALTER TABLE `penyewa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `resit_pembayaran`
--
ALTER TABLE `resit_pembayaran`
  MODIFY `resit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tempahan`
--
ALTER TABLE `tempahan`
  MODIFY `tempahan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `tempahan_kerja`
--
ALTER TABLE `tempahan_kerja`
  MODIFY `tempahan_kerja_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `tugasan`
--
ALTER TABLE `tugasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jobsheet`
--
ALTER TABLE `jobsheet`
  ADD CONSTRAINT `fk_tempahan_kerja_id` FOREIGN KEY (`tempahan_kerja_id`) REFERENCES `tempahan_kerja` (`tempahan_kerja_id`) ON DELETE CASCADE;

--
-- Constraints for table `resit_pembayaran`
--
ALTER TABLE `resit_pembayaran`
  ADD CONSTRAINT `fk_pembayaran_tempahan` FOREIGN KEY (`tempahan_id`) REFERENCES `tempahan` (`tempahan_id`);

--
-- Constraints for table `tempahan`
--
ALTER TABLE `tempahan`
  ADD CONSTRAINT `fk_penyewa` FOREIGN KEY (`penyewa_id`) REFERENCES `penyewa` (`id`);

--
-- Constraints for table `tempahan_kerja`
--
ALTER TABLE `tempahan_kerja`
  ADD CONSTRAINT `fk_tempahan` FOREIGN KEY (`tempahan_id`) REFERENCES `tempahan` (`tempahan_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
