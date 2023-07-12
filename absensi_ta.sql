-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2023 at 03:02 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi_ta`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `level` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `id_karyawan`, `nama`, `username`, `email`, `password`, `level`) VALUES
(56, 42, 'Bintang ', 'bintangemon', 'bintang@gmail.com', '$2y$10$h3YRepyGsb0HgxVfDCBr/OGgbhbWU0ttANRjNtcWzWJzE5E9eSrNG', '1'),
(57, 43, 'Admin', 'admin', 'admin@mail.com', '$2y$10$Ftpt/mlv.zNplWLE333xyedKgfVc9MDCjhm1mxSHa45FSxmM56amK', '1'),
(58, 44, 'Virlie Stephanie Manalu', 'virlie03', 'virliestephanie@gmail.com', '$2y$10$FL/Itj9vWM0rR04ZkHqOVO6KCPC43nWwnDD/4xpVePVJfkUxQyEry', '2'),
(65, 49, 'Raditya ', 'radit134', 'raditya123@gmail.com', '$2y$10$kOodhkwEim7fDYZAQ3Cyu.TzBqCVZHjZTRYjfqPeaQwURha1me.0y', '2');

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int(11) NOT NULL,
  `divisi` varchar(100) NOT NULL,
  `singkatan` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `divisi`, `singkatan`) VALUES
(5, 'Web Development', 'WT'),
(6, 'Digital Marketing', 'DM'),
(7, 'Data Analist', 'DA'),
(8, 'Personalia', 'PI'),
(9, 'Sales', 'SS'),
(10, 'Produksi', 'PR'),
(11, 'Human Resource Development', 'HR'),
(13, 'Mobile Development', 'MD'),
(15, 'Keuangan', 'KN');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jk` varchar(10) NOT NULL,
  `divisi` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama`, `jk`, `divisi`, `email`, `foto`) VALUES
(42, 'Bintang ', 'Laki-laki', 'Personalia', 'bintang@gmail.com', '6497296700805.jpg'),
(43, 'Admin', 'Perempuan', 'Human Resource Development', 'admin@mail.com', '649729cc0bdd2.png'),
(44, 'Virlie Stephanie Manalu', 'Perempuan', 'Web Development', 'virliestephanie@gmail.com', '649b293271e40.png'),
(49, 'Raditya ', 'Laki-laki', 'Digital Marketing', 'raditya123@gmail.com', '649b337d55a81.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
