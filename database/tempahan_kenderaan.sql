-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2024 at 10:21 AM
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
(11, 'NUR BATRISYA', '444444444444', '44444444444', 'nurbatrisya@gmail.com', 'F', 'NEGERI TERENGGANU', '$2y$10$gIHIfofp7RwXvzcXo7kWkuu7r2TH50Y3Njq/.aDNHAzXiNy5.8tLy'),
(12, 'MOHD AZMI BIN AB KADIR', '555555555555', '55555555555', 'mazmi@lktn.gov.my', 'Y', '', '$2y$10$xAFM9GpsD.e3/.aPnCJpJugxOKbvvf76c7Ui/qkwfbTQthgWodLfK'),
(14, 'AZHAR BIN HAMAT', '777777777777', '77777777777', '', 'Y', '', '$2y$10$HHb9tKUCW/7UsaLhGCh4YuxK0daiytaVqz6bYwukLjX5BaFClbPAq');

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
(9, 'Z', 'SUPER ADMIN', 'indexZ.php');

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
('11', 'Log masuk sebagai ADMIN (F)', '2024-09-22 21:44:02', '::1'),
('11', 'Log masuk sebagai ADMIN (F)', '2024-09-22 21:47:43', '::1'),
('11', 'Log masuk sebagai ADMIN (F)', '2024-09-22 21:49:55', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-09-15 00:05:31', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-09-18 00:28:55', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-09-18 02:04:18', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-09-19 01:17:29', '::1'),
('12', 'Log masuk sebagai ADMIN (Y)', '2024-09-23 01:07:32', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-09-18 00:16:29', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-09-18 00:24:13', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-09-19 01:44:49', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-09-21 20:50:56', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-09-21 21:42:15', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-09-21 22:14:56', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-09-22 21:55:40', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-09-22 22:01:21', '::1'),
('14', 'Log masuk sebagai ADMIN (Y)', '2024-09-23 01:05:30', '::1'),
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
('9', 'Log masuk sebagai ADMIN (A)', '2024-09-18 01:47:28', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-09-19 00:09:42', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-09-22 20:27:27', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-09-22 20:50:34', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-09-23 00:57:57', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-09-23 01:01:27', '::1'),
('9', 'Log masuk sebagai ADMIN (A)', '2024-09-23 01:37:23', '::1');

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
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penyewa`
--

INSERT INTO `penyewa` (`id`, `nama`, `no_kp`, `contact_no`, `email`, `alamat`, `password`) VALUES
(1, 'TESTING PENYEWA', '666666666666', '66666666666', NULL, 'testing alamat penyewa', '$2y$10$mGZkE2ALUBkZ64puDbKES.AVhgHBErzMX4i18ysBLvyuu6c7Dl50y'),
(2, 'MUHAMMAD DZULKARNAIN', '999999999999', '99999999999', NULL, 'pengkalan batu, pasir mas,', '$2y$10$joT4JcenTgyly1.eGtropezk0Rt2ZEyf6kXaEwWUdXd2bfKt6zpnC');

-- --------------------------------------------------------

--
-- Table structure for table `resit_pembayaran`
--

CREATE TABLE `resit_pembayaran` (
  `resit_id` int(11) NOT NULL,
  `tempahan_id` int(11) NOT NULL,
  `jenis_pembayaran` varchar(20) NOT NULL,
  `jumlah` decimal(10,2) NOT NULL,
  `cara_pembayaran` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resit_pembayaran`
--

INSERT INTO `resit_pembayaran` (`resit_id`, `tempahan_id`, `jenis_pembayaran`, `jumlah`, `cara_pembayaran`, `created_at`) VALUES
(8, 17, 'deposit', 200.00, 'online banking', '2024-09-23 15:38:09');

-- --------------------------------------------------------

--
-- Table structure for table `tempahan`
--

CREATE TABLE `tempahan` (
  `tempahan_id` int(11) NOT NULL,
  `penyewa_id` int(11) DEFAULT NULL,
  `tarikh_kerja` date DEFAULT NULL,
  `negeri` varchar(100) DEFAULT NULL,
  `lokasi_kerja` varchar(255) DEFAULT NULL,
  `luas_tanah` decimal(10,2) DEFAULT NULL,
  `total_harga_anggaran` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_harga_sebenar` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_deposit` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_baki` decimal(10,2) NOT NULL DEFAULT 0.00,
  `catatan` text DEFAULT NULL,
  `status_tempahan` enum('pengesahan pee','pengesahan kpp','bayaran deposit','deposit diproses','kerja dijalankan','kerja selesai','bayaran diproses','selesai','ditolak','dibatalkan') DEFAULT 'pengesahan pee',
  `status_bayaran` enum('dalam pengesahan','bayaran deposit','deposit diproses','deposit selesai','belum bayar','bayaran diproses','selesai','ditolak','dibatalkan','bayaran balik') NOT NULL DEFAULT 'dalam pengesahan',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tempahan`
--

INSERT INTO `tempahan` (`tempahan_id`, `penyewa_id`, `tarikh_kerja`, `negeri`, `lokasi_kerja`, `luas_tanah`, `total_harga_anggaran`, `total_harga_sebenar`, `total_deposit`, `total_baki`, `catatan`, `status_tempahan`, `status_bayaran`, `created_at`, `updated_at`) VALUES
(17, 2, '2024-09-29', 'NEGERI KELANTAN', 'pasiasdas', 2.00, 400.00, 0.00, 200.00, 0.00, '', 'deposit diproses', 'deposit diproses', '2024-09-23 07:33:18', '2024-09-23 07:38:09');

-- --------------------------------------------------------

--
-- Table structure for table `tempahan_kerja`
--

CREATE TABLE `tempahan_kerja` (
  `tempahan_kerja_id` int(11) NOT NULL,
  `tempahan_id` int(11) DEFAULT NULL,
  `nama_kerja` varchar(255) DEFAULT NULL,
  `kenderaan_id` int(11) DEFAULT NULL,
  `pemandu_id` int(11) DEFAULT NULL,
  `jam_anggaran` int(11) NOT NULL DEFAULT 0,
  `harga_anggaran` decimal(10,2) DEFAULT 0.00,
  `tarikh_kerja_cadangan` date DEFAULT current_timestamp(),
  `status_kerja` enum('tempahan diproses','dijalankan','selesai','ditolak','dibatalkan') DEFAULT 'tempahan diproses',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `masa_mula_odometer` time NOT NULL DEFAULT '00:00:00',
  `masa_akhir_odometer` time NOT NULL DEFAULT '00:00:00',
  `jumlah_jam` decimal(5,2) DEFAULT 0.00,
  `jumlah_bayaran` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tempahan_kerja`
--

INSERT INTO `tempahan_kerja` (`tempahan_kerja_id`, `tempahan_id`, `nama_kerja`, `kenderaan_id`, `pemandu_id`, `jam_anggaran`, `harga_anggaran`, `tarikh_kerja_cadangan`, `status_kerja`, `created_at`, `updated_at`, `masa_mula_odometer`, `masa_akhir_odometer`, `jumlah_jam`, `jumlah_bayaran`) VALUES
(25, 17, 'Piring', 5, 14, 2, 200.00, '2024-09-29', 'tempahan diproses', '2024-09-23 07:33:18', '2024-09-23 07:37:07', '00:00:00', '00:00:00', 0.00, 0.00),
(26, 17, 'Piring Batas Besar', 5, 14, 2, 200.00, '2024-09-30', 'tempahan diproses', '2024-09-23 07:33:18', '2024-09-23 07:37:07', '00:00:00', '00:00:00', 0.00, 0.00);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  MODIFY `kump_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `resit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tempahan`
--
ALTER TABLE `tempahan`
  MODIFY `tempahan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tempahan_kerja`
--
ALTER TABLE `tempahan_kerja`
  MODIFY `tempahan_kerja_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tugasan`
--
ALTER TABLE `tugasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

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
