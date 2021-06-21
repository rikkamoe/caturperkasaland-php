-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Jun 2021 pada 12.55
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Struktur dari tabel `tb_property`
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
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_property`
--

INSERT INTO `tb_property` (`id`, `judul`, `alamat`, `daerah`, `luas_bangunan`, `luas_tanah`, `jenis_property`, `harga`, `kamar_tidur`, `kamar_mandi`, `lantai`, `image_sertifikat`, `image`, `fasilitas`, `status_property`, `id_pemilik`, `id_agent`, `tanggal`) VALUES
(2, 'Rumah Bayu', 'Dalung', 'Badung', '120 x 120', '100 x 100', 'Rumah', 300, 1, 2, 1, '1623341721.jpg', '1623341721.jpg', 'Kolam', '5', '10', 13, '2021-06-01 01:08:05'),
(4, 'Rumah Bayu', 'Dalung', 'Buleleng', '120 x 120', '100 x 100', 'Apartemen', 122, 4, 3, 1, '1623355246.jpg', '1623355246.jpg', 'Kolam', '5', '10', 13, '2021-06-11 19:44:34'),
(6, 'Rumah Bayu', 'Dalung', 'Buleleng', '120 x 120', '100 x 100', 'Rumah', 1212, 3, 3, 1, '1623355319.jpg', '1623355319.jpg', 'Kolam', '5', '10', 13, '2021-06-11 19:44:34'),
(7, 'Rumah Bayu', 'Dalung', 'Buleleng', '120 x 120', '100 x 100', 'Apartemen', 300, 2, 1, 2, '1623355347.jpg', '1623355347.jpg', 'Kolam', '1', '10', 13, '2021-06-11 19:44:34'),
(8, 'Rumah Bayu', 'Dalung', 'Buleleng', '120 x 120', '100 x 100', 'Villa', 320, 4, 1, 1, '1623355381.jpg', '1623355381.jpg', 'Kolam', '4', '10', 12, '2021-06-11 19:44:34'),
(9, 'Rumah Bayu', 'Dalung', 'Buleleng', '120 x 120', '100 x 100', 'Apartemen', 122, 3, 2, 11, '1623355424.jpg', '1623355424.jpg', 'Kolam', '3', '10', 12, '2021-06-11 19:44:34'),
(10, 'Rumah Bayu Ultimate', 'Dalung', 'Buleleng', '120 x 120', '100 x 100', 'Apartemen', 250, 4, 5, 111, '1623356246.jpg', '1623356246.jpg', 'Kolam', '4', '10', 13, '2021-06-11 19:44:34'),
(11, 'Rumah Bayu Ultimate', 'Dalung', 'Buleleng', '120 x 120', '100 x 100', 'Apartemen', 25000, 4, 5, 111, '1623356246.jpg', '1623356246.jpg', 'Kolam', '3', '10', 13, '2021-06-11 19:44:34'),
(12, 'Rumah Bayu', 'Dalung', 'Buleleng', '120 x 120', '100 x 100', 'Rumah', 1210, 3, 3, 1, '1623355319.jpg', '1623355319.jpg', 'Kolam', '4', '10', 12, '2021-06-11 19:44:34'),
(13, 'Rumah Bayu', 'Dalung', 'Buleleng', '120 x 120', '100 x 100', 'Rumah', 1000, 3, 3, 1, '1623355319.jpg', '1623355319.jpg', 'Kolam', '4', '10', 12, '2021-06-11 19:44:34'),
(15, 'Rumah Bayu Ultimate', 'Dalung', 'Jembrana', '120 x 120', '100 x 100', 'Rumah', 320, 2, 2, 1, '1623598405.jpg', '1623598405.jpg', 'Kolam', '3', '10', 12, '2021-06-13 23:33:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
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
  `deskripsi` longtext NOT NULL,
  `laporan_penjualan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama`, `no_tlp`, `email`, `username`, `password`, `level`, `image`, `deskripsi`, `laporan_penjualan`) VALUES
(11, 'Admin', '085739347311', 'admin@gmail.com', 'superadmin', '0192023a7bbd73250516f069df18b500', 0, NULL, '', NULL),
(13, 'Ariel Adrinata', '895368757184', 'ariel@caturperkasaland', 'ariel', '4310c803740f4622bf66e2e222a5439c', 2, NULL, 'Saya Pilih Catur Perkasa Land karena CPL adalah situs Property Terbaik di BALI. Sekain itu sangat membantu saya dalam mendapatkan Database Konsumen', NULL),
(14, 'Patricia ', '89686052130', 'patricia@caturprakasaland', 'patri', '9674280e76fbb7c1029e6d0e1cbe6569', 2, NULL, 'Catur Perkasa Land itu bagus banget! Saya sangat terbantu karena banyak orang mencari property CPL. Informasi yang ditawarkan sangan mendetail jadi orang ga perlu ragu lagi.', NULL),
(15, 'Suminiasih', '08123672537467', 'sumini@gmail.com', 'sumini', '1833795d2e9b5e708ae2fdb1547d2e30', 1, NULL, '', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_property`
--
ALTER TABLE `tb_property`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_property`
--
ALTER TABLE `tb_property`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
