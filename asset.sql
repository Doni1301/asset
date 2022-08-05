-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2022 at 02:08 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asset`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_iden`
--

CREATE TABLE `detail_iden` (
  `id` int(11) NOT NULL,
  `id_iden` int(11) NOT NULL,
  `no_iden` varchar(50) NOT NULL,
  `komponen` varchar(100) NOT NULL,
  `sub` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `sn` varchar(100) NOT NULL,
  `exp` varchar(100) NOT NULL,
  `vendor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_iden`
--

INSERT INTO `detail_iden` (`id`, `id_iden`, `no_iden`, `komponen`, `sub`, `keterangan`, `sn`, `exp`, `vendor`) VALUES
(15, 14, 'IDN1659585503', 'PC Desktop', 'CPU', 'asd', 'asd', 'asd', 'asd'),
(16, 14, 'IDN1659585503', 'PC Desktop', 'Motherboard', 'asdas', 'asdasd', 'asdasd', 'asdasd'),
(17, 15, 'IDN1659600561', 'PC Desktop', 'CPU', 'asd', 'asd', 'asd', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `detail_soft`
--

CREATE TABLE `detail_soft` (
  `id` int(11) NOT NULL,
  `id_input` int(11) NOT NULL,
  `no_input` varchar(50) NOT NULL,
  `komponen` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `produk` varchar(100) NOT NULL,
  `vendor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_soft`
--

INSERT INTO `detail_soft` (`id`, `id_input`, `no_input`, `komponen`, `keterangan`, `produk`, `vendor`) VALUES
(16, 28, 'SFT1659598281', 'Microsoft Office 365', 'asd', 'asd', 'asd'),
(17, 29, 'SFT1659695846', 'Adobe Family', 'asd', 'asd', 'asd'),
(18, 29, 'SFT1659695846', 'Antivirus', 'asd', 'asd', 'asd'),
(19, 29, 'SFT1659695846', 'Adobe Family', 'asd', 'asd', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `detail_up`
--

CREATE TABLE `detail_up` (
  `id` int(11) NOT NULL,
  `id_up` int(11) NOT NULL,
  `no_up` varchar(50) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `status` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `det_soft`
--

CREATE TABLE `det_soft` (
  `id` int(11) NOT NULL,
  `id_iden` int(11) NOT NULL,
  `no_input` varchar(50) NOT NULL,
  `no_iden` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `dept` varchar(100) NOT NULL,
  `pic` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `det_soft`
--

INSERT INTO `det_soft` (`id`, `id_iden`, `no_input`, `no_iden`, `nama`, `kode`, `dept`, `pic`) VALUES
(28, 14, 'SFT1659598281', 'IDN1659585503', 'Doni', 'bwk-user-5682', 'HRIT', 'Staff IT'),
(29, 15, 'SFT1659695846', 'IDN1659600561', 'Gede', 'bwk-user-5354', 'HRIT', 'Spv IT');

-- --------------------------------------------------------

--
-- Table structure for table `identifikasi`
--

CREATE TABLE `identifikasi` (
  `id` int(11) NOT NULL,
  `no_iden` varchar(50) NOT NULL,
  `tgl_iden` varchar(50) NOT NULL,
  `jam_iden` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `dept` varchar(100) NOT NULL,
  `pic` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `identifikasi`
--

INSERT INTO `identifikasi` (`id`, `no_iden`, `tgl_iden`, `jam_iden`, `nama`, `kode`, `dept`, `pic`) VALUES
(14, 'IDN1659585503', '04/08/2022', '11:58:23', 'Doni', 'bwk-user-5682', 'HRIT', 'Staff IT'),
(15, 'IDN1659600561', '04/08/2022', '16:09:21', 'Gede', 'bwk-user-5354', 'HRIT', 'Spv IT');

-- --------------------------------------------------------

--
-- Table structure for table `komponen`
--

CREATE TABLE `komponen` (
  `id` int(11) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komponen`
--

INSERT INTO `komponen` (`id`, `kode`, `nama`) VALUES
(2, 'bwk-it-8053', 'PC Desktop'),
(3, 'bwk-it-8039', 'Monitor'),
(4, 'bwk-it-4816', 'UPS'),
(5, 'bwk-it-1184', 'Not Book / Laptop'),
(6, 'bwk-it-2962', 'Mouse'),
(7, 'bwk-it-6935', 'Keyboard'),
(8, 'bwk-it-7600', 'Printer');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `kode` varchar(20) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `kode`, `nama`, `username`, `password`) VALUES
(3, 'BWK656999', 'admin', 'admin', '$2y$10$frTYX2Ki3pMV8kE3eHjvhuz7rs.V8Qe0nDhRSuaXjD1mpsHkavT4i');

-- --------------------------------------------------------

--
-- Table structure for table `software`
--

CREATE TABLE `software` (
  `id` int(11) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `software`
--

INSERT INTO `software` (`id`, `kode`, `nama`) VALUES
(1, 'bwk-soft-8562', 'Microsoft Office 365'),
(2, 'bwk-soft-1044', 'Antivirus'),
(5, 'bwk-soft-1461', 'Adobe Family');

-- --------------------------------------------------------

--
-- Table structure for table `sub`
--

CREATE TABLE `sub` (
  `id` int(11) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub`
--

INSERT INTO `sub` (`id`, `kode`, `nama`) VALUES
(1, 'bwk-sub-9220', 'CPU'),
(2, 'bwk-sub-3719', 'Motherboard'),
(3, 'bwk-sub-5146', 'Processor'),
(4, 'bwk-sub-8783', 'Memori'),
(5, 'bwk-sub-6068', 'Hardisk'),
(8, 'bwk-sub-7099', 'Baterai'),
(13, 'bwk-sub-5526', 'Charger');

-- --------------------------------------------------------

--
-- Table structure for table `upgrade`
--

CREATE TABLE `upgrade` (
  `id` int(11) NOT NULL,
  `id_iden` int(11) NOT NULL,
  `no_up` varchar(50) NOT NULL,
  `no_iden` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `dept` varchar(100) NOT NULL,
  `pic` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `dept` varchar(100) NOT NULL,
  `pic` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `kode`, `nama`, `dept`, `pic`, `email`) VALUES
(1, 'bwk-user-5682', 'Doni', 'HRIT', 'Staff IT', 'doni.heriansyah@beachwalkbali.com'),
(2, 'bwk-user-5354', 'Gede', 'HRIT', 'Spv IT', 'it@beachwalkbali.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_iden`
--
ALTER TABLE `detail_iden`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_soft`
--
ALTER TABLE `detail_soft`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_up`
--
ALTER TABLE `detail_up`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `det_soft`
--
ALTER TABLE `det_soft`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `identifikasi`
--
ALTER TABLE `identifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komponen`
--
ALTER TABLE `komponen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `software`
--
ALTER TABLE `software`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub`
--
ALTER TABLE `sub`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upgrade`
--
ALTER TABLE `upgrade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_iden`
--
ALTER TABLE `detail_iden`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `detail_soft`
--
ALTER TABLE `detail_soft`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `detail_up`
--
ALTER TABLE `detail_up`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `det_soft`
--
ALTER TABLE `det_soft`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `identifikasi`
--
ALTER TABLE `identifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `komponen`
--
ALTER TABLE `komponen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `software`
--
ALTER TABLE `software`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sub`
--
ALTER TABLE `sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `upgrade`
--
ALTER TABLE `upgrade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
