-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2024 at 05:35 AM
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
  `nama` varchar(100) DEFAULT NULL,
  `no_kp` varchar(20) DEFAULT NULL,
  `contact_no` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `kumpulan` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `no_kp`, `contact_no`, `email`, `kumpulan`, `password`) VALUES
(7, 'SUPERRRR ADMINNNN', '000000000000', '00000000000', '', 'Z', '$2y$10$0XDhKgg28va1fQGxtnt.JOKe4KZYnCdAbLmnSL3UNnH8C9a1JN0..'),
(8, 'AHMAD ABU PEE', '111111111111', '11111111111', 'ahmadabu@gmail.com', 'D', '$2y$10$0ip5cb/lRWinJvgG8qq/zOBYgCXtakjQrdE2IJebKoJgpAiXfgZ06'),
(9, 'MUHD KAMARUL KPP', '222222222222', '22222222222', 'ahmadkamarul@gmail.com', 'A', '$2y$10$TrDN27ZVlYsD2cJH358yDOVK0KaCuPglEYBxSrWNSxbqMWe2oBZn2'),
(10, 'SITI SYAFIQAH PT', '333333333333', '33333333333', 'sitisyafiqah@gmail.com', 'F', '$2y$10$Y4L9wiWd9HPbLgStWveiiOBjs/8eg8w0yAqKgpNZB8IkFxdJcCWom'),
(12, 'MOHD AZMI BIN AB KADIR', '555555555555', '55555555555', 'mazmi@lktn.gov.my', 'Y', '$2y$10$xAFM9GpsD.e3/.aPnCJpJugxOKbvvf76c7Ui/qkwfbTQthgWodLfK'),
(14, 'AZHAR BIN HAMAT', '777777777777', '77777777777', '', 'Y', '$2y$10$HHb9tKUCW/7UsaLhGCh4YuxK0daiytaVqz6bYwukLjX5BaFClbPAq'),
(15, 'PENGARAH PENGARAH', '888888888888', '88888888888', '', 'E', '$2y$10$99VpyCBFP/JHbvhxjp3MM.er2iBsqpv3Ad5OkacvUzOsPtvsGcUvm'),
(16, 'XINWEN LIAU KEWANGAN', '666666666666', '66666666666', '', 'G', '$2y$10$uQRo3I9B98HaJaOoG4JUleNogIrScAxX8AtJVTzm5Q8ngt0tZtH1S');

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
  `jam` int(5) DEFAULT NULL,
  `minit` int(5) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `catatan` varchar(100) DEFAULT NULL,
  `status_jobsheet` enum('pengesahan','dijalankan','selesai') NOT NULL DEFAULT 'pengesahan',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobsheet`
--

INSERT INTO `jobsheet` (`jobsheet_id`, `tempahan_id`, `tempahan_kerja_id`, `pemandu_id`, `kenderaan_id`, `tarikh_kerja_dijalankan`, `jam`, `minit`, `harga`, `catatan`, `status_jobsheet`, `created_at`) VALUES
(151, 91, 161, 12, 6, '2024-12-19', 1, 0, 40.00, NULL, 'selesai', '2024-12-18 08:32:03'),
(153, 91, 162, 12, 5, '2024-12-19', 1, 0, 100.00, NULL, 'selesai', '2024-12-18 08:33:00'),
(156, 92, 163, 12, 6, '2024-12-20', 2, 15, 90.00, NULL, 'selesai', '2024-12-19 01:09:47'),
(157, 92, 164, 14, 5, '2024-12-20', 4, 0, 400.00, NULL, 'selesai', '2024-12-19 02:13:26'),
(158, 93, 165, 12, 5, '2024-12-19', 4, 0, 400.00, NULL, 'selesai', '2024-12-19 02:35:24'),
(159, 93, 166, 12, 5, '2024-12-20', 4, 0, 400.00, NULL, 'selesai', '2024-12-19 02:35:54'),
(160, 94, 167, 12, 6, '2024-12-20', 2, 0, 80.00, NULL, 'selesai', '2024-12-19 02:39:59'),
(162, 94, 168, 12, 5, '2024-12-20', 2, 0, 200.00, NULL, 'selesai', '2024-12-19 02:40:28'),
(163, 95, 169, 12, 5, '2024-12-20', 4, 0, 400.00, NULL, 'selesai', '2024-12-19 02:47:21'),
(164, 95, 170, 12, 5, '2024-12-20', 3, 0, 300.00, NULL, 'selesai', '2024-12-19 02:48:02');

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
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `pid` int(11) NOT NULL,
  `rsp_appln_id` varchar(3) NOT NULL,
  `rsp_org_id` varchar(10) NOT NULL,
  `rsp_orderid` varchar(20) DEFAULT NULL,
  `rsp_amount` decimal(8,2) NOT NULL,
  `rsp_trxstatus` varchar(15) NOT NULL,
  `rsp_stcode` varchar(3) NOT NULL,
  `rsp_bankid` varchar(15) NOT NULL,
  `rsp_bankname` varchar(50) DEFAULT NULL,
  `rsp_fpxid` varchar(30) NOT NULL,
  `rsp_fpxorderno` varchar(30) NOT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  `type` int(11) NOT NULL DEFAULT 0 COMMENT '0 = fpx, 1 = cek, 2 = cash, 3 = EFT, 4= Kad',
  `doc` text DEFAULT NULL,
  `tarikh_cek` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`pid`, `rsp_appln_id`, `rsp_org_id`, `rsp_orderid`, `rsp_amount`, `rsp_trxstatus`, `rsp_stcode`, `rsp_bankid`, `rsp_bankname`, `rsp_fpxid`, `rsp_fpxorderno`, `date_created`, `type`, `doc`, `tarikh_cek`) VALUES
(1, 'ETJ', 'LKTN', 'KJBP00090', 400.00, 'SUCCESSFUL', '0', 'MB2U0227', 'Maybank', 'FPX123456', 'FPXORD987654', '2024-12-18 10:47:59', 0, NULL, NULL),
(2, 'ETJ', 'LKTN', 'KJBP00092', 280.00, 'SUCCESSFUL', '0', 'MB2U0227', 'Maybank', 'FPX123456', 'FPXORD987654', '2024-12-19 09:09:13', 0, NULL, NULL),
(3, 'ETJ', 'LKTN', 'KJBT00092', 210.00, 'SUCCESSFUL', '0', 'MB2U0227', 'Maybank', 'FPX123456', 'FPXORD987654', '2024-12-19 10:25:46', 0, NULL, NULL),
(4, 'ETJ', 'LKTN', 'KJBP00093', 400.00, 'SUCCESSFUL', '0', 'MB2U0227', 'Maybank', 'FPX123456', 'FPXORD987654', '2024-12-19 10:35:07', 0, NULL, NULL),
(5, 'ETJ', 'LKTN', 'KJBT00093', 400.00, 'SUCCESSFUL', '0', 'MB2U0227', 'Maybank', 'FPX123456', 'FPXORD987654', '2024-12-19 10:36:43', 0, NULL, NULL),
(6, 'ETJ', 'LKTN', 'KJBP00094', 560.00, 'SUCCESSFUL', '0', 'MB2U0227', 'Maybank', 'FPX123456', 'FPXORD987654', '2024-12-19 10:39:46', 0, NULL, NULL),
(7, 'ETJ', 'LKTN', 'KJR00094', 280.00, 'SUCCESSFUL', '0', 'MB2U0227', 'Maybank', 'FPX123456', 'FPXORD987654', '2024-12-19 10:42:26', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penyewa`
--

CREATE TABLE `penyewa` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `no_kp` varchar(20) DEFAULT NULL,
  `contact_no` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `nama_bank` varchar(100) DEFAULT NULL,
  `no_bank` varchar(30) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penyewa`
--

INSERT INTO `penyewa` (`id`, `nama`, `no_kp`, `contact_no`, `email`, `alamat`, `nama_bank`, `no_bank`, `password`) VALUES
(2, 'MUHAMMAD DZULKARNAIN', '999999999999', '99999999999', '', 'pengkalan batu, pasir mas,', 'Maybang', '212132132', '$2y$10$joT4JcenTgyly1.eGtropezk0Rt2ZEyf6kXaEwWUdXd2bfKt6zpnC');

-- --------------------------------------------------------

--
-- Table structure for table `quotation`
--

CREATE TABLE `quotation` (
  `quotation_id` int(11) NOT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `reference_number` varchar(50) DEFAULT NULL,
  `jenis_pembayaran` enum('bayaran muka','bayaran tambahan') DEFAULT NULL,
  `tempahan_id` int(11) DEFAULT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `status` enum('belum bayar','pengesahan','selesai') NOT NULL DEFAULT 'belum bayar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quotation`
--

INSERT INTO `quotation` (`quotation_id`, `total`, `reference_number`, `jenis_pembayaran`, `tempahan_id`, `created_at`, `status`) VALUES
(7, 280.00, 'KJBP00091', 'bayaran muka', 91, '2024-12-18', 'selesai'),
(8, 280.00, 'KJBP00092', 'bayaran muka', 92, '2024-12-19', 'selesai'),
(9, 210.00, 'KJBT00092', 'bayaran tambahan', 92, '2024-12-19', 'selesai'),
(10, 400.00, 'KJBP00093', 'bayaran muka', 93, '2024-12-19', 'selesai'),
(11, 400.00, 'KJBT00093', 'bayaran tambahan', 93, '2024-12-19', 'selesai'),
(12, 560.00, 'KJBP00094', 'bayaran muka', 94, '2024-12-19', 'selesai'),
(13, 400.00, 'KJBP00095', 'bayaran muka', 95, '2024-12-19', 'selesai'),
(14, 300.00, 'KJBT00095', 'bayaran tambahan', 95, '2024-12-19', 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `resit_pembayaran`
--

CREATE TABLE `resit_pembayaran` (
  `resit_id` int(11) NOT NULL,
  `tempahan_id` int(11) NOT NULL,
  `jenis_pembayaran` enum('bayaran muka','refund','bayaran tambahan') DEFAULT NULL,
  `jumlah` decimal(10,2) DEFAULT NULL,
  `cara_bayar` enum('tunai','fpx') DEFAULT NULL,
  `nombor_rujukan` varchar(255) DEFAULT NULL,
  `bukti_pembayaran_tunai` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resit_pembayaran`
--

INSERT INTO `resit_pembayaran` (`resit_id`, `tempahan_id`, `jenis_pembayaran`, `jumlah`, `cara_bayar`, `nombor_rujukan`, `bukti_pembayaran_tunai`, `created_at`) VALUES
(70, 91, 'bayaran muka', 280.00, 'tunai', 'KJBP00091', NULL, '2024-12-18 16:30:06'),
(71, 91, 'refund', 140.00, 'fpx', 'KJR00091', NULL, '2024-12-18 17:32:06'),
(72, 92, 'bayaran muka', 280.00, 'fpx', 'KJBP00092', NULL, '2024-12-19 09:09:13'),
(73, 92, 'bayaran tambahan', 210.00, 'fpx', 'KJBT00092', NULL, '2024-12-19 10:25:46'),
(74, 93, 'bayaran muka', 400.00, 'fpx', 'KJBP00093', NULL, '2024-12-19 10:35:07'),
(75, 93, 'bayaran tambahan', 400.00, 'fpx', 'KJBT00093', NULL, '2024-12-19 10:36:43'),
(76, 94, 'bayaran muka', 560.00, 'fpx', 'KJBP00094', NULL, '2024-12-19 10:39:46'),
(77, 94, 'refund', 280.00, 'fpx', 'KJR00094', NULL, '2024-12-19 10:42:26'),
(78, 95, 'bayaran muka', 400.00, 'tunai', 'KJBP00095', NULL, '2024-12-19 10:45:58'),
(79, 95, 'bayaran tambahan', 300.00, 'tunai', 'KJBT00095', NULL, '2024-12-19 10:49:33');

-- --------------------------------------------------------

--
-- Table structure for table `tempahan`
--

CREATE TABLE `tempahan` (
  `tempahan_id` int(11) NOT NULL,
  `penyewa_id` int(11) DEFAULT NULL,
  `lokasi_tanah` varchar(255) DEFAULT NULL,
  `luas_tanah` decimal(10,1) DEFAULT NULL,
  `total_harga_anggaran` decimal(10,2) DEFAULT NULL,
  `total_harga_sebenar` decimal(10,2) DEFAULT NULL,
  `total_baki` decimal(10,2) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `disahkan_oleh` varchar(100) DEFAULT NULL,
  `status_tempahan` enum('pengesahan pee','pengesahan kpp','bayaran penyewa','pengesahan pt','pengesahan pengarah','penjanaan resit','pengesahan jobsheet','kemaskini jobsheet','refund kewangan','ditolak','dibatalkan','selesai') DEFAULT 'pengesahan pee',
  `status_bayaran` enum('dalam pengesahan','belum bayar','bayaran diproses','selesai bayaran','ditolak','dibatalkan','selesai','refund','bayaran tambahan') NOT NULL DEFAULT 'dalam pengesahan',
  `sebab_ditolak` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tempahan`
--

INSERT INTO `tempahan` (`tempahan_id`, `penyewa_id`, `lokasi_tanah`, `luas_tanah`, `total_harga_anggaran`, `total_harga_sebenar`, `total_baki`, `catatan`, `disahkan_oleh`, `status_tempahan`, `status_bayaran`, `sebab_ditolak`, `created_at`, `updated_at`) VALUES
(91, 2, 'pasir mas', 2.0, 280.00, 140.00, -140.00, '', 'AHMAD ABU PEE', 'selesai', 'selesai', NULL, '2024-12-18 08:16:26', '2024-12-18 09:32:06'),
(92, 2, 'ASDASDASD', 2.0, 280.00, 490.00, 210.00, '', 'AHMAD ABU PEE', 'selesai', 'selesai', NULL, '2024-12-19 00:59:46', '2024-12-19 02:33:18'),
(93, 2, 'testing last', 4.0, 400.00, 800.00, 400.00, '', 'AHMAD ABU PEE', 'selesai', 'selesai', NULL, '2024-12-19 02:33:59', '2024-12-19 02:36:43'),
(94, 2, 'TESTING REFUND', 1231.0, 560.00, 280.00, -280.00, '', 'AHMAD ABU PEE', 'selesai', 'selesai', NULL, '2024-12-19 02:38:44', '2024-12-19 02:42:26'),
(95, 2, 'TESTING CASH', 2.0, 400.00, 700.00, 300.00, '', 'AHMAD ABU PEE', 'selesai', 'selesai', NULL, '2024-12-19 02:43:26', '2024-12-19 02:49:33');

-- --------------------------------------------------------

--
-- Table structure for table `tempahan_kerja`
--

CREATE TABLE `tempahan_kerja` (
  `tempahan_kerja_id` int(11) NOT NULL,
  `tempahan_id` int(11) DEFAULT NULL,
  `nama_kerja` varchar(255) DEFAULT NULL,
  `jam_anggaran` int(5) DEFAULT NULL,
  `minit_anggaran` int(5) DEFAULT NULL,
  `harga_anggaran` decimal(10,2) DEFAULT NULL,
  `total_jam` int(5) DEFAULT NULL,
  `total_minit` int(5) DEFAULT NULL,
  `total_harga` decimal(10,2) DEFAULT NULL,
  `cadangan_tarikh_kerja` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tempahan_kerja`
--

INSERT INTO `tempahan_kerja` (`tempahan_kerja_id`, `tempahan_id`, `nama_kerja`, `jam_anggaran`, `minit_anggaran`, `harga_anggaran`, `total_jam`, `total_minit`, `total_harga`, `cadangan_tarikh_kerja`, `created_at`, `updated_at`) VALUES
(161, 91, 'Parit Baru', 2, 0, 80.00, 1, 0, 40.00, '2024-12-20', '2024-12-18 08:16:26', '2024-12-18 08:32:54'),
(162, 91, 'Piring', 2, 0, 200.00, 1, 0, 100.00, '2024-12-21', '2024-12-18 08:16:26', '2024-12-18 08:33:21'),
(163, 92, 'Parit Baru', 2, 0, 80.00, 2, 15, 90.00, '2024-12-21', '2024-12-19 00:59:46', '2024-12-19 02:12:01'),
(164, 92, 'Piring Batas Besar', 2, 0, 200.00, 4, 0, 400.00, '2024-12-22', '2024-12-19 00:59:46', '2024-12-19 02:13:39'),
(165, 93, 'Piring', 2, 0, 200.00, 4, 0, 400.00, '2024-12-20', '2024-12-19 02:33:59', '2024-12-19 02:35:37'),
(166, 93, 'Piring Batas Besar', 2, 0, 200.00, 4, 0, 400.00, '2024-12-28', '2024-12-19 02:33:59', '2024-12-19 02:36:05'),
(167, 94, 'Baikpulih Parit', 4, 0, 160.00, 2, 0, 80.00, '2024-12-20', '2024-12-19 02:38:44', '2024-12-19 02:40:12'),
(168, 94, 'Piring', 4, 0, 400.00, 2, 0, 200.00, '2024-12-21', '2024-12-19 02:38:44', '2024-12-19 02:40:40'),
(169, 95, 'Piring Batas Besar', 2, 0, 200.00, 4, 0, 400.00, '2024-12-20', '2024-12-19 02:43:26', '2024-12-19 02:47:50'),
(170, 95, 'Rotor 1', 2, 0, 200.00, 3, 0, 300.00, '2024-12-21', '2024-12-19 02:43:26', '2024-12-19 02:48:19');

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
-- Indexes for table `negeri`
--
ALTER TABLE `negeri`
  ADD PRIMARY KEY (`id_negeri`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `rsp_orderid` (`rsp_orderid`);

--
-- Indexes for table `penyewa`
--
ALTER TABLE `penyewa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotation`
--
ALTER TABLE `quotation`
  ADD PRIMARY KEY (`quotation_id`),
  ADD KEY `tempahan_id` (`tempahan_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `jobsheet`
--
ALTER TABLE `jobsheet`
  MODIFY `jobsheet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `penyewa`
--
ALTER TABLE `penyewa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `quotation`
--
ALTER TABLE `quotation`
  MODIFY `quotation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `resit_pembayaran`
--
ALTER TABLE `resit_pembayaran`
  MODIFY `resit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `tempahan`
--
ALTER TABLE `tempahan`
  MODIFY `tempahan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `tempahan_kerja`
--
ALTER TABLE `tempahan_kerja`
  MODIFY `tempahan_kerja_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `tugasan`
--
ALTER TABLE `tugasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jobsheet`
--
ALTER TABLE `jobsheet`
  ADD CONSTRAINT `fk_tempahan_kerja_id` FOREIGN KEY (`tempahan_kerja_id`) REFERENCES `tempahan_kerja` (`tempahan_kerja_id`) ON DELETE CASCADE;

--
-- Constraints for table `quotation`
--
ALTER TABLE `quotation`
  ADD CONSTRAINT `quotation_ibfk_1` FOREIGN KEY (`tempahan_id`) REFERENCES `tempahan` (`tempahan_id`);

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
