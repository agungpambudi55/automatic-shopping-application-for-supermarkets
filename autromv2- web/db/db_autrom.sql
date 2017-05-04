-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2017 at 04:06 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_autrom`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_kasir`
--

CREATE TABLE IF NOT EXISTS `tb_kasir` (
  `id_kasir` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`id_kasir`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tb_kasir`
--

INSERT INTO `tb_kasir` (`id_kasir`, `username`, `password`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `alamat`) VALUES
(1, 'admin', '0cc175b9c0f1b6a831c399e269772661', 'Agung Pambudi', 'Ponorogo', '15-05-1995', 'Jl. Letj. S. Sukowati 49 Ponorogo');

-- --------------------------------------------------------

--
-- Table structure for table `tb_lokasi`
--

CREATE TABLE IF NOT EXISTS `tb_lokasi` (
  `id_lokasi` int(10) NOT NULL AUTO_INCREMENT,
  `lokasi_block` varchar(10) NOT NULL,
  `jumlah_sekat` varchar(10) NOT NULL,
  PRIMARY KEY (`id_lokasi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tb_lokasi`
--

INSERT INTO `tb_lokasi` (`id_lokasi`, `lokasi_block`, `jumlah_sekat`) VALUES
(3, 'C', '10'),
(4, 'D', '10'),
(6, 'B', '10'),
(8, 'A', '10');

-- --------------------------------------------------------

--
-- Table structure for table `tb_merk`
--

CREATE TABLE IF NOT EXISTS `tb_merk` (
  `id_merk` int(10) NOT NULL AUTO_INCREMENT,
  `nama_merk` varchar(50) NOT NULL,
  PRIMARY KEY (`id_merk`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `tb_merk`
--

INSERT INTO `tb_merk` (`id_merk`, `nama_merk`) VALUES
(1, 'Wings Food'),
(2, 'Indomilk'),
(3, 'Wong Coco'),
(4, 'Yakult'),
(5, 'Ultra Milk'),
(6, 'Ultra Jaya'),
(7, 'Sarimi'),
(8, 'Siantar Top'),
(9, 'Sido Muncul'),
(10, 'Sari Roti'),
(11, 'Aqua'),
(12, 'Coca Cola'),
(13, 'Abc'),
(14, 'Adem Sari'),
(15, 'AdeS'),
(16, 'Buavita'),
(17, 'Bango'),
(18, 'Campina'),
(19, 'Chiki'),
(20, 'Dancow'),
(21, 'Fiesta'),
(22, 'Fanta'),
(23, 'Energen'),
(24, 'Danone'),
(55, 'Sprite'),
(56, 'Attack'),
(57, 'Gum'),
(58, 'MENS'),
(59, 'Indofood'),
(60, 'Vaseline'),
(61, 'Marjan'),
(62, 'Hit'),
(63, 'Soklin'),
(64, 'Pond''s');

-- --------------------------------------------------------

--
-- Table structure for table `tb_produk`
--

CREATE TABLE IF NOT EXISTS `tb_produk` (
  `id_produk` int(10) NOT NULL AUTO_INCREMENT,
  `id_merk` int(10) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `harga` int(100) NOT NULL,
  `exp` date NOT NULL,
  `barcode` varchar(50) NOT NULL,
  `stok_barang` int(10) NOT NULL,
  `gambar` text NOT NULL,
  `lokasi_block` varchar(10) NOT NULL,
  `lokasi_sekat` varchar(10) NOT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `id_merk`, `nama_produk`, `harga`, `exp`, `barcode`, `stok_barang`, `gambar`, `lokasi_block`, `lokasi_sekat`) VALUES
(32, 1, 'Floridina Florida Orange', 3000, '2020-05-15', '9182739861312', 2, 'floridina.jpg', 'A', '5'),
(33, 55, 'Sprite 390ML-3900', 3000, '2019-07-03', '8992761002022', 10, 'sprite.jpg', 'B', '2'),
(34, 1, 'Tanggo', 10500, '2018-07-04', '899110238484', 16, 'tango.jpg', 'C', '3'),
(35, 56, 'Attack Detergent 800 GR-19500', 12000, '2020-04-04', '0192837128381', 10, 'ATTACK DETERGENT 800 GR-19500.jpg', 'B', '2'),
(36, 57, 'Big Babol Gum 105G-10950', 4500, '2019-10-05', '899111501002', 30, 'big babol gum 105g-10950.jpg', 'D', '3'),
(37, 58, 'Biore Mens Bocy Foam SPARKLINGB-19600', 9000, '2019-03-03', '9273189839041', 15, 'BIORE MENS BODYFOAM SPARKLINGB-19600.jpg', 'A', '8'),
(38, 12, 'Coca Cola Pet 1500 ML-13200', 3000, '2018-05-06', '2983479283982', 3, 'COCA COLA PET 1500 ML-13200.jpg', 'B', '8'),
(39, 12, 'Fanta Strawberry Pet 1500 ML-13000', 3500, '2018-12-05', '9871928379832', 10, 'FANTA STRAWBERRY PET 1500 ML-13000.jpg', 'D', '7'),
(40, 59, 'Sambal Pedas Indofood ML-6000', 9500, '2018-09-16', '089686400427', 7, 'sambal.jpg', 'C', '3'),
(41, 60, 'Vaseline Men Facial Foam Oil C-21600', 28000, '2020-06-07', '981239812731', 9, 'VASELINE MEN FACIAL FOAM OIL C-21600.jpg', 'D', '7'),
(42, 60, 'Vaseline Lotion Healthy Whites-27900', 31500, '2020-06-06', '192389213739', 17, 'VASELINE LOTION HEALTHY WHITES-27900.jpg', 'C', '7'),
(43, 61, 'POND''S Facial Foam 100Gr', 16500, '2020-07-07', '981826837162', 120, 'ponds.jpg', 'C', '7'),
(44, 62, 'Hit Pouch Classic 700 ML-25200', 12000, '2022-10-03', '1298397382018', 20, 'HIT POUCH CLASSIC 700 ML-25200.jpg', 'C', '4'),
(45, 63, 'Soklin Pemutih Btl 500ML-4400', 6800, '2022-04-04', '9273917239399', 15, 'SOKLIN PEMUTIH BTL 500ML-4400.jpg', 'C', '3'),
(46, 59, 'Indomie Mie Goreng 85Gr', 2300, '2017-12-07', '089686010947', 37, 'MieIndomie.png', 'A', '1'),
(47, 59, 'Gekikara Ramen Goreng Rasa Pedas', 4700, '2017-12-25', '899271885353', 0, 'ramen.png', 'A', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE IF NOT EXISTS `tb_transaksi` (
  `id_transaksi` int(10) NOT NULL AUTO_INCREMENT,
  `id_kasir` int(10) NOT NULL,
  `tanggal_waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `jenis_transaksi` varchar(20) NOT NULL,
  `total_harga` int(100) NOT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `id_kasir`, `tanggal_waktu`, `jenis_transaksi`, `total_harga`) VALUES
(1, 1, '2017-04-28 15:30:25', 'Penjualan', 3000),
(2, 1, '2017-04-27 17:45:15', 'Pembelian', 15000),
(3, 1, '2017-04-28 15:33:13', 'Penjualan', 52500),
(4, 1, '2017-04-28 17:47:48', 'Pembelian', 15000),
(5, 1, '2017-04-29 10:00:33', 'Pembelian', 15000),
(6, 1, '2017-04-29 15:33:13', 'Penjualan', 120000),
(7, 1, '2017-04-29 15:33:13', 'Penjualan', 40500),
(8, 1, '2017-04-29 04:00:20', 'Pembelian', 210000),
(9, 1, '2017-04-04 05:08:54', 'Pembelian', 120000),
(10, 1, '2017-04-29 05:09:11', 'Pembelian', 135000),
(11, 1, '2017-04-29 05:09:24', 'Pembelian', 135000),
(12, 1, '2017-04-29 05:09:37', 'Pembelian', 30000),
(13, 1, '2017-04-29 05:09:49', 'Pembelian', 35000),
(14, 1, '2017-04-29 05:09:59', 'Pembelian', 120000),
(15, 1, '2017-04-29 05:10:12', 'Pembelian', 547500),
(16, 1, '2017-04-29 05:10:22', 'Pembelian', 142500),
(17, 1, '2017-04-29 05:10:29', 'Pembelian', 102000),
(18, 1, '2017-04-29 05:10:44', 'Pembelian', 30000),
(19, 1, '2017-04-29 05:10:57', 'Pembelian', 630000),
(20, 1, '2017-04-29 05:11:11', 'Pembelian', 560000),
(21, 1, '2017-04-30 15:33:13', 'Penjualan', 15000),
(22, 1, '2017-04-30 15:33:13', 'Penjualan', 87500),
(23, 1, '2017-04-30 15:33:13', 'Penjualan', 109500),
(24, 1, '2017-05-01 14:23:33', 'Penjualan', 11500),
(25, 1, '2017-05-01 14:25:08', 'Penjualan', 56000),
(26, 1, '2017-05-02 14:26:09', 'Penjualan', 56000),
(27, 1, '2017-05-02 14:28:33', 'Penjualan', 94500),
(28, 1, '2017-05-03 14:44:29', 'Penjualan', 62000),
(29, 1, '2017-05-04 15:09:05', 'Penjualan', 140000),
(30, 1, '2017-05-04 18:10:43', 'Penjualan', 6900),
(31, 1, '2017-05-05 18:28:19', 'Pembelian', 115000),
(32, 1, '2017-05-06 00:29:37', 'Penjualan', 6000),
(33, 1, '2017-05-06 00:35:35', 'Pembelian', 120000),
(34, 1, '2017-05-06 01:29:24', 'Pembelian', 1650000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi_detail`
--

CREATE TABLE IF NOT EXISTS `tb_transaksi_detail` (
  `id_transaksi_detail` int(10) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(10) NOT NULL,
  `id_produk` int(10) NOT NULL,
  `jumlah` int(10) NOT NULL,
  PRIMARY KEY (`id_transaksi_detail`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `tb_transaksi_detail`
--

INSERT INTO `tb_transaksi_detail` (`id_transaksi_detail`, `id_transaksi`, `id_produk`, `jumlah`) VALUES
(1, 1, 32, 1),
(2, 2, 32, 5),
(3, 3, 32, 5),
(4, 3, 33, 2),
(5, 3, 34, 3),
(6, 4, 32, 5),
(7, 5, 33, 5),
(8, 6, 32, 5),
(9, 6, 34, 10),
(10, 7, 32, 5),
(11, 7, 33, 5),
(12, 7, 34, 1),
(13, 8, 34, 20),
(14, 9, 35, 10),
(15, 10, 36, 30),
(16, 11, 37, 15),
(17, 12, 38, 10),
(18, 13, 39, 10),
(19, 14, 44, 10),
(20, 15, 43, 25),
(21, 16, 40, 15),
(22, 17, 45, 15),
(23, 18, 33, 10),
(24, 19, 42, 20),
(25, 20, 41, 20),
(26, 21, 38, 5),
(27, 22, 46, 5),
(28, 22, 40, 8),
(29, 23, 43, 5),
(30, 24, 46, 5),
(31, 25, 41, 2),
(32, 26, 41, 2),
(33, 27, 42, 3),
(34, 28, 32, 2),
(35, 28, 41, 2),
(36, 29, 41, 5),
(37, 30, 46, 3),
(38, 31, 46, 50),
(39, 32, 38, 2),
(40, 33, 44, 10),
(41, 34, 43, 100);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi_sementara`
--

CREATE TABLE IF NOT EXISTS `tb_transaksi_sementara` (
  `id_transaksi_sementara` int(10) NOT NULL AUTO_INCREMENT,
  `id_troli` int(10) NOT NULL,
  `id_produk` int(10) NOT NULL,
  `jumlah` int(10) NOT NULL,
  PRIMARY KEY (`id_transaksi_sementara`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
