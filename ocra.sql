-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2021 at 03:52 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ocra`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_karyawan`
--

CREATE TABLE `tb_karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nik_karyawan` int(11) NOT NULL,
  `nama_karyawan` varchar(50) NOT NULL,
  `mitra` varchar(50) NOT NULL,
  `prod_c1` int(11) NOT NULL DEFAULT 0,
  `prod_c2` int(11) NOT NULL DEFAULT 0,
  `prod_c3` int(11) NOT NULL DEFAULT 0,
  `prod_c4` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_karyawan`
--

INSERT INTO `tb_karyawan` (`id_karyawan`, `nik_karyawan`, `nama_karyawan`, `mitra`, `prod_c1`, `prod_c2`, `prod_c3`, `prod_c4`) VALUES
(4, 985031, 'Abdul Ghofur', 'Telkom Akses', 17, 13, 11, 12),
(5, 985032, 'Abdullah Haidaruddin', 'Telkom Akses', 18, 1, 6, 2),
(6, 985033, 'Achmad Mukhlisin S', 'Telkom Akses', 30, 1, 7, 4),
(7, 985034, 'Adi Suprastiyo', 'Telkom Akses', 35, 9, 5, 13),
(8, 985035, 'Fatikhul Hasan', 'Telkom Akses', 32, 1, 1, 8),
(9, 985036, 'Ikhsanuddin Shabandar', 'Telkom Akses', 27, 0, 3, 5),
(10, 985037, 'Mahrur Rifqi Alfaruq', 'Telkom Akses', 31, 0, 3, 3),
(11, 985038, 'Moh. Velayati Sholahudin A.', 'Telkom Akses', 31, 2, 3, 11),
(12, 985039, 'Mohammad Ali Afandi', 'Telkom Akses', 18, 15, 11, 5),
(13, 985040, 'Muzaiyin', 'Telkom Akses', 43, 5, 1, 7),
(14, 985041, 'Sugianto', 'Telkom Akses', 53, 6, 1, 12),
(15, 985042, 'Sutrisno Wahyu Priambodo', 'Telkom Akses', 34, 4, 3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kode_kriteria` varchar(11) NOT NULL,
  `nama_kriteria` varchar(50) NOT NULL,
  `bobot_kriteria` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`id_kriteria`, `kode_kriteria`, `nama_kriteria`, `bobot_kriteria`) VALUES
(1, 'C1', 'Produktivitas Gangguan', 0.35),
(2, 'C2', 'Produktivitas Unspec', 0.2),
(3, 'C3', 'Produktivitas Validasi Data', 0.15),
(4, 'C4', 'Gaul', 0.3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`id_kriteria`),
  ADD UNIQUE KEY `kode_kriteria` (`kode_kriteria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
