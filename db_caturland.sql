-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2021 at 02:12 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_caturland`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_property`
--

CREATE TABLE `tb_property` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `daerah` varchar(255) NOT NULL,
  `luas_bangunan` varchar(255) NOT NULL,
  `luas_tanah` varchar(255) NOT NULL,
  `jenis_property` varchar(255) NOT NULL,
  `harga` int(100) NOT NULL,
  `kamar_tidur` int(11) NOT NULL,
  `kamar_mandi` int(11) NOT NULL,
  `lantai` int(11) NOT NULL,
  `image_sertifikat` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `fasilitas` varchar(255) NOT NULL,
  `status_property` varchar(255) NOT NULL,
  `id_pemilik` varchar(255) NOT NULL,
  `id_agent` int(11) NOT NULL,
  `tanggal` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_property`
--

INSERT INTO `tb_property` (`id`, `judul`, `alamat`, `daerah`, `luas_bangunan`, `luas_tanah`, `jenis_property`, `harga`, `kamar_tidur`, `kamar_mandi`, `lantai`, `image_sertifikat`, `image`, `fasilitas`, `status_property`, `id_pemilik`, `id_agent`, `tanggal`) VALUES
(2, 'Rumah Bayu', 'Dalung', 'Badung', '120 x 120', '100 x 100', 'Rumah', 300, 1, 2, 1, '1623341721.jpg', '1623341721.jpg', 'Kolam', 'Sudah Terjual', '10', 12, '2021-06-01 01:08:05'),
(4, 'Rumah Bayu', 'Dalung', 'Buleleng', '120 x 120', '100 x 100', 'Apartemen', 122, 4, 3, 1, '1623355246.jpg', '1623355246.jpg', 'Kolam', 'Sudah Terjual', '10', 12, '2021-06-11 19:44:34'),
(6, 'Rumah Bayu', 'Dalung', 'Buleleng', '120 x 120', '100 x 100', 'Rumah', 1212, 3, 3, 1, '1623355319.jpg', '1623355319.jpg', 'Kolam', 'Sudah Terjual', '10', 12, '2021-06-11 19:44:34'),
(7, 'Rumah Bayu', 'Dalung', 'Buleleng', '120 x 120', '100 x 100', 'Apartemen', 300, 2, 1, 2, '1623355347.jpg', '1623355347.jpg', 'Kolam', 'Disewakan', '10', 12, '2021-06-11 19:44:34'),
(8, 'Rumah Bayu', 'Dalung', 'Buleleng', '120 x 120', '100 x 100', 'Villa', 320, 4, 1, 1, '1623355381.jpg', '1623355381.jpg', 'Kolam', 'Disewakan', '10', 12, '2021-06-11 19:44:34'),
(9, 'Rumah Bayu', 'Dalung', 'Buleleng', '120 x 120', '100 x 100', 'Apartemen', 122, 3, 2, 11, '1623355424.jpg', '1623355424.jpg', 'Kolam', 'Dijual', '10', 12, '2021-06-11 19:44:34'),
(10, 'Rumah Bayu Ultimate', 'Dalung', 'Buleleng', '120 x 120', '100 x 100', 'Apartemen', 250, 4, 5, 111, '1623356246.jpg', '1623356246.jpg', 'Kolam', 'Dijual', '10', 12, '2021-06-11 19:44:34'),
(11, 'Rumah Bayu Ultimate', 'Dalung', 'Buleleng', '120 x 120', '100 x 100', 'Apartemen', 25000, 4, 5, 111, '1623356246.jpg', '1623356246.jpg', 'Kolam', 'Dijual', '10', 12, '2021-06-11 19:44:34'),
(12, 'Rumah Bayu', 'Dalung', 'Buleleng', '120 x 120', '100 x 100', 'Rumah', 1210, 3, 3, 1, '1623355319.jpg', '1623355319.jpg', 'Kolam', 'Disewakan', '10', 12, '2021-06-11 19:44:34'),
(13, 'Rumah Bayu', 'Dalung', 'Buleleng', '120 x 120', '100 x 100', 'Rumah', 1000, 3, 3, 1, '1623355319.jpg', '1623355319.jpg', 'Kolam', 'Disewakan', '10', 12, '2021-06-11 19:44:34');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_tlp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `laporan_penjualan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama`, `no_tlp`, `email`, `username`, `password`, `level`, `image`, `laporan_penjualan`) VALUES
(10, 'Suwindratama', '085739347311', 'suwin@gmail.com', 'suwin', '03c7c0ace395d80182db07ae2c30f034', 1, NULL, NULL),
(11, 'Admin', '085739347311', 'admin@gmail.com', 'superadmin', '0192023a7bbd73250516f069df18b500', 0, NULL, NULL),
(12, 'Rikka Takanashi', '085739347312', 'rikka@gmail.com', 'rikka', '213f4d3403b283fe510d168858e6fbb1', 2, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_property`
--
ALTER TABLE `tb_property`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_property`
--
ALTER TABLE `tb_property`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
