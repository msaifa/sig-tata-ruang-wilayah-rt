-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2021 at 01:48 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cobaregionmaps`
--

-- --------------------------------------------------------

--
-- Table structure for table `lahan_petani`
--

CREATE TABLE `lahan_petani` (
  `kode_lahan` int(11) NOT NULL,
  `nama_pemilik` varchar(200) NOT NULL,
  `warna` varchar(200) NOT NULL,
  `points` text NOT NULL,
  `luas_lahan` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lahan_petani`
--

INSERT INTO `lahan_petani` (`kode_lahan`, `nama_pemilik`, `warna`, `points`, `luas_lahan`) VALUES
(5, 'gedung c3', '588e10', '(-7.315137793929014, 112.72558062444152)(-7.3152920958308885, 112.72592931161346)(-7.315137793929014, 112.72599368462981)(-7.31497551083673, 112.7256503618759)', 900),
(6, 'gedung c2', '225530', '(-7.315228471293131, 112.72553927788533)(-7.315380112787029, 112.7258933294753)(-7.315587622116237, 112.7258048165778)(-7.315449282574152, 112.72544808277883)', 500);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lahan_petani`
--
ALTER TABLE `lahan_petani`
  ADD PRIMARY KEY (`kode_lahan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lahan_petani`
--
ALTER TABLE `lahan_petani`
  MODIFY `kode_lahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
