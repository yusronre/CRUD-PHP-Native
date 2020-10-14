-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2020 at 01:05 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_restoran`
--

-- --------------------------------------------------------

--
-- Table structure for table `query_hasil`
--

CREATE TABLE `query_hasil` (
  `kd_transaksi` tinyint(4) NOT NULL,
  `kd_menu` tinyint(4) NOT NULL,
  `menu` tinyint(4) NOT NULL,
  `harga` tinyint(4) NOT NULL,
  `jumlah` tinyint(4) NOT NULL,
  `subtotal` tinyint(4) NOT NULL,
  `kd_user` tinyint(4) NOT NULL,
  `nama` tinyint(4) NOT NULL,
  `no_meja` tinyint(4) NOT NULL,
  `tgl_transaksi` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `query_struk`
--

CREATE TABLE `query_struk` (
  `menu` tinyint(4) NOT NULL,
  `jumlah` tinyint(4) NOT NULL,
  `harga` tinyint(4) NOT NULL,
  `subtotal` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `kd_kategori` int(11) NOT NULL,
  `kategori` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`kd_kategori`, `kategori`) VALUES
(1, 'Makanan Berat'),
(2, 'Makanan Ringan'),
(4, 'Minuman Biasa'),
(3, 'Minuman Dingin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_keranjang`
--

CREATE TABLE `tb_keranjang` (
  `kd_transaksi` int(11) DEFAULT NULL,
  `kd_menu` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL,
  `tgl_transaksi` datetime DEFAULT NULL,
  `kd_user` int(11) DEFAULT NULL,
  `no_meja` int(11) DEFAULT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_menu`
--

CREATE TABLE `tb_menu` (
  `kd_menu` int(11) NOT NULL,
  `menu` varchar(100) DEFAULT NULL,
  `jenis` varchar(20) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `kd_kategori` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_menu`
--

INSERT INTO `tb_menu` (`kd_menu`, `menu`, `jenis`, `harga`, `status`, `foto`, `kd_kategori`) VALUES
(16, 'Nasi Goreng', 'Makanan', 20000, 'Tersedia', '3.jpg', 1),
(17, 'Jus Mangga', 'Minuman', 10000, 'Tersedia', '1.png', 3),
(18, 'Jus Melon', 'Minuman', 10000, 'Tersedia', '2.jpg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `kd_transaksi` int(11) DEFAULT NULL,
  `kd_menu` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL,
  `tgl_transaksi` datetime DEFAULT NULL,
  `kd_user` int(11) DEFAULT NULL,
  `no_meja` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `kd_user` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `level` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`kd_user`, `nama`, `no_hp`, `username`, `password`, `level`) VALUES
(3, 'Asep', '0846464646', 'asep', '1230', 'Kasir'),
(6, 'James', '087885511858', 'admin', 'admin', 'Admin'),
(7, 'secret', '080808', 'secret', 'secret', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`kd_kategori`),
  ADD UNIQUE KEY `kategori` (`kategori`);

--
-- Indexes for table `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  ADD KEY `kd_user` (`kd_user`),
  ADD KEY `kd_menu` (`kd_menu`);

--
-- Indexes for table `tb_menu`
--
ALTER TABLE `tb_menu`
  ADD PRIMARY KEY (`kd_menu`),
  ADD KEY `kd_kategori` (`kd_kategori`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD KEY `kd_user` (`kd_user`),
  ADD KEY `kd_menu` (`kd_menu`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`kd_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `kd_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_menu`
--
ALTER TABLE `tb_menu`
  MODIFY `kd_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `kd_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_menu`
--
ALTER TABLE `tb_menu`
  ADD CONSTRAINT `tb_menu_ibfk_1` FOREIGN KEY (`kd_kategori`) REFERENCES `tb_kategori` (`kd_kategori`);

--
-- Constraints for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `tb_transaksi_ibfk_1` FOREIGN KEY (`kd_user`) REFERENCES `tb_user` (`kd_user`),
  ADD CONSTRAINT `tb_transaksi_ibfk_2` FOREIGN KEY (`kd_menu`) REFERENCES `tb_menu` (`kd_menu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
