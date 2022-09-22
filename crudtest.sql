-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2022 at 09:14 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crudtest`
--

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `nama`) VALUES
(1, 'Laki-laki'),
(2, 'Perempuan');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `nofaktur` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(255) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `saldo` int(255) NOT NULL,
  `address` text NOT NULL,
  `gender_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `nofaktur`, `tanggal`, `nama`, `phone`, `saldo`, `address`, `gender_id`) VALUES
(3, 'DSFDSF FDS S', '2022-09-17', 'REWREWR', '+62 786-8678-6678', 7667, 'F GDGFDG FGDRFGR', 1),
(4, 'LAMAMA', '2022-09-19', 'MDFTVBGT THRT RRTHRTTRH ', '+62 435-4334-4', 345345, 'DFGFDFDG', 1),
(5, 'SDFDSFSDF', '2022-09-19', 'FDFS', '+62 234-324', 324, '324324', 1),
(6, 'ASDSAD', '2022-09-19', 'WQEWQ', '+62 435-435', 435345, 'FGHFGHVB  TEWEWT', 1),
(18, 'ASDASD', '2022-09-19', 'QWEWQ', '+62 988-778', 345, '23423', 1),
(19, 'MNBMB', '2022-09-19', 'DGDSG', '+62 435-4', 56456, 'XCVXG', 1),
(20, 'CC234', '2022-09-19', '324', '+62 234-4', 3240, '342', 1),
(21, 'AAAD312 ', '2022-09-20', 'FGH', '+62 453-3', 4560, '654', 1),
(22, 'SSTOOJ', '2022-09-20', 'DGDSG', '+62 435-4', 56456, 'XCVXG', 1),
(27, 'HGF', '2022-09-20', 'GFH', '+62 435-453', 435, 'RETRE', 1),
(32, 'WTTRFD', '2022-09-20', 'DSFEWR', '+62 324-234', 434324, '3', 1),
(33, 'GDSFSD', '2022-09-20', 'SDFDSF', '+62 324-2343-24', 3243, '2342342323', 1),
(36, 'DATA BARU', '2022-09-20', 'FGDH FDG HBVNM', '+62 457-646', 6574, 'FGHX', 2),
(38, 'SALAH', '2022-09-20', 'ERERT', '+62 345-3', 43543, '43543', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id` int(11) NOT NULL,
  `barang` varchar(255) NOT NULL,
  `harga` int(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `transaksi_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id`, `barang`, `harga`, `quantity`, `transaksi_id`) VALUES
(6, 'SDFG', 1239876, 7, 4),
(7, 'YUIOU', 4567543, 4, 4),
(8, 'GFDFDGD', 54646, 546, 5),
(11, 'HGF  FG HF H FHTRHGF ', 1212213, 634, 3),
(12, 'TRTERE', 3234222, 327, 3),
(13, '5454GF HGFH', 3453434, 12, 6),
(14, '324324FDG ', 32432424, 2, 6),
(34, 'ERRORSDAAS', 45654, 1, 17),
(35, 'ERROR', 43543543, 54, 17),
(36, 'RETRET', 54654, 456, 18),
(37, 'FGHBGH', 435345, 43543, 18),
(38, 'REYSRY', 345435, 141, 18),
(39, '123123', 1123213, 1, 18),
(40, 'HGJHGJ', 5324234, 3, 18),
(41, 'FXHGFD', 45646, 4, 18),
(42, 'JKLJK', 45645543, 456, 19),
(43, 'YRTTRYH', 345345, 345, 19),
(44, '534543', 324324, 566, 19),
(45, '', 0, 0, 0),
(49, 'RETRRE', 44543, 12, 27),
(50, 'REWF DSFDS', 324234, 6, 27),
(53, '2DSF', 111, 2, 32),
(54, '234', 324132, 23, 33),
(59, 'PPOLJHRV', 345345, 345, 22),
(60, 'MMKHGF', 324324, 566, 22),
(62, '324', 2344, 23, 20),
(63, 'RTYRETY', 476654, 23, 36),
(64, 'FDGF', 224353, 21, 36),
(65, 'DFDYFH', 435345, 4, 38),
(68, 'SADSA', 42222, 234, 21);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gender_id` (`gender_id`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
