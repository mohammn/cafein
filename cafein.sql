-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2022 at 05:31 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cafein`
--

-- --------------------------------------------------------

--
-- Table structure for table `antrian`
--

CREATE TABLE `antrian` (
  `id` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `noMeja` int(11) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL DEFAULT 0,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `antrian`
--

INSERT INTO `antrian` (`id`, `nama`, `noMeja`, `tanggal`, `status`, `idUser`) VALUES
(8, 'mhm', 12, '2022-01-17 23:26:22', 2, 3),
(9, 'tes aja', 1, '2022-01-17 23:28:18', 2, 3),
(10, 'hehe', 23, '2022-01-17 23:29:23', 2, 1),
(11, 'tes', 12, '2022-01-17 23:36:48', 2, 1),
(12, 'FIndri', 12, '2022-01-17 23:37:49', 2, 1),
(13, 'a', 2, '2022-01-17 23:38:51', 2, 3),
(14, 'moham', 1, '2022-01-23 12:01:00', 2, 3),
(15, 'moham', 12, '2022-01-17 23:40:58', 2, 1),
(16, 'andi', 12, '2022-01-23 12:01:00', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `jenis` int(1) NOT NULL,
  `harga` int(11) NOT NULL,
  `foto` varchar(32) NOT NULL,
  `status` int(1) NOT NULL,
  `hapus` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `nama`, `jenis`, `harga`, `foto`, `status`, `hapus`) VALUES
(1, 'Chiken Katsu', 1, 20000, 'chickenkatsu1.jpg', 1, NULL),
(2, 'Kentang Goreng', 2, 12000, 'kentanggoreng.jpg', 0, NULL),
(3, 'Chesee Tea', 3, 10000, 'cheseetea.jpg', 0, NULL),
(4, 'Espresso', 4, 10000, 'espresso.jpg', 0, NULL),
(5, 'Mie Goreng Telur', 1, 8000, 'miegorengtelur.jpg', 0, NULL),
(6, 'Nasi Goreng Keju', 1, 12000, 'nasigorengkeju.jpg', 1, NULL),
(7, 'Ayam Goreng Tepung', 1, 20000, 'ayamgorengtepung.jpg', 1, NULL),
(8, 'Sate Ayam', 1, 15000, 'sateayam.jpg', 1, NULL),
(9, 'Tahu Bakso', 2, 10000, 'tahubakso.jpg', 0, NULL),
(10, 'Kulit Ayam', 2, 10000, 'kulitayam.jpg', 0, NULL),
(11, 'Banana Roll', 2, 10000, 'bananaroll.jpg', 0, NULL),
(12, 'Sosis Bakar', 2, 10000, 'sosisbakar.jpg', 0, NULL),
(13, 'Martabak Ayam', 2, 15000, 'martabakayam.jpg', 0, NULL),
(14, 'Pisang Keju', 2, 12000, 'pisangkeju.jpg', 0, NULL),
(15, 'Coklat Keju', 3, 12000, 'coklatkeju.jpg', 0, NULL),
(16, 'Greentea keju', 3, 10000, 'greenteakeju.jpg', 0, NULL),
(17, 'Milk Tea', 3, 10000, 'milktea.jpg', 0, NULL),
(18, 'Cappucino Cincau', 3, 10000, 'cappucinocincau.jpg', 0, NULL),
(19, 'Teh Keju Susu', 3, 12000, 'tehkejususu.jpg', 0, NULL),
(20, 'Jus Melon', 3, 10000, 'jusmelon.jpg', 0, NULL),
(21, 'Jus Semangka', 3, 10000, 'jussemangka.jpg', 0, NULL),
(22, 'Jus Buah Naga', 3, 10000, 'jusbuahnaga.jpg', 0, NULL),
(23, 'Jus Sirsak', 3, 10000, 'jussirsak.jpg', 0, NULL),
(24, 'Cappucino Latte', 4, 10000, 'cappucinolatte.jpg', 0, NULL),
(25, 'Green tea latte', 4, 10000, 'greentealatte.jpg', 1, NULL),
(26, 'Kopi Americano', 4, 8000, 'kopiamericano.jpg', 0, NULL),
(27, 'Kopi Susu', 4, 8000, 'kopisusu.jpg', 1, NULL),
(28, 'ayam bakar', 1, 20000, 'default.jpg', 0, '2022-01-20 12:01:00'),
(29, 'Kopi Tubruk', 4, 8000, 'default.jpg', 0, '2022-01-20 12:01:00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `pembelian`
-- (See below for the actual view)
--
CREATE TABLE `pembelian` (
`idAntrian` int(11)
,`namaAntrian` varchar(32)
,`noMeja` int(11)
,`statusAntrian` int(1)
,`tanggal` datetime
,`idMenu` int(11)
,`foto` varchar(32)
,`hapus` datetime
,`harga` int(11)
,`jenis` int(1)
,`namaMenu` varchar(32)
,`statusMenu` int(1)
,`idTransaksi` int(11)
,`jumlah` int(11)
,`idUser` int(11)
,`namaUser` varchar(32)
,`rule` int(1)
);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `idMenu` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `idAntrian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `idMenu`, `jumlah`, `idAntrian`) VALUES
(1, 5, 0, 8),
(2, 6, 0, 8),
(3, 6, 0, 9),
(4, 7, 0, 9),
(5, 7, 1, 10),
(6, 8, 1, 10),
(7, 2, 1, 10),
(8, 5, 1, 11),
(9, 6, 1, 11),
(10, 7, 1, 11),
(11, 1, 1, 12),
(12, 6, 1, 13),
(13, 6, 1, 14),
(14, 8, 1, 15),
(15, 1, 1, 16),
(16, 25, 2, 16),
(17, 27, 1, 16),
(18, 7, 1, 16);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `password` varchar(256) NOT NULL,
  `rule` int(1) NOT NULL,
  `hapus` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `password`, `rule`, `hapus`) VALUES
(1, 'Moham', '$2y$10$MuR.3IpT.1xLJbeUYs6V6.KcCw0A6OO3Vv6K4L9dCuXgDum1eBf/G', 1, NULL),
(2, 'findri', '$2y$10$tNdOYtHXIcaDMaG9F74E9ucomT55HJQh49A/hc9NCosDXTPp4EX0O', 0, NULL),
(3, 'Moh. Nikmat', '$2y$10$N8XuFBEzrTLVccSYXgBoeuSk85r1ZmG/ouiq2hFbbiTpj4WB0yLGS', 1, NULL),
(4, 'Krocket ayam', '$2y$10$qC5Xlz80E7BuC/1cfkI5KOeyi/BQ9lw4nvmtYMmAUb0ijhq2NwMDi', 0, '2022-01-20 12:01:00');

-- --------------------------------------------------------

--
-- Structure for view `pembelian`
--
DROP TABLE IF EXISTS `pembelian`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pembelian`  AS SELECT `antrian`.`id` AS `idAntrian`, `antrian`.`nama` AS `namaAntrian`, `antrian`.`noMeja` AS `noMeja`, `antrian`.`status` AS `statusAntrian`, `antrian`.`tanggal` AS `tanggal`, `menu`.`id` AS `idMenu`, `menu`.`foto` AS `foto`, `menu`.`hapus` AS `hapus`, `menu`.`harga` AS `harga`, `menu`.`jenis` AS `jenis`, `menu`.`nama` AS `namaMenu`, `menu`.`status` AS `statusMenu`, `transaksi`.`id` AS `idTransaksi`, `transaksi`.`jumlah` AS `jumlah`, `user`.`id` AS `idUser`, `user`.`nama` AS `namaUser`, `user`.`rule` AS `rule` FROM (((`antrian` join `transaksi` on(`antrian`.`id` = `transaksi`.`idAntrian`)) join `menu` on(`transaksi`.`idMenu` = `menu`.`id`)) join `user` on(`antrian`.`idUser` = `user`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idMenu` (`idMenu`) USING BTREE,
  ADD KEY `idAntrian` (`idAntrian`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `antrian`
--
ALTER TABLE `antrian`
  ADD CONSTRAINT `antrian_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`idAntrian`) REFERENCES `antrian` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`idMenu`) REFERENCES `menu` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
