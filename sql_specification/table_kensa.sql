-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2019 年 4 月 13 日 05:45
-- サーバのバージョン： 5.5.56-MariaDB
-- PHP Version: 7.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kensa_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `table_kensa`
--

CREATE TABLE `table_kensa` (
  `id_kensa` bigint(255) NOT NULL,
  `kankatsu` varchar(10) NOT NULL,
  `boutainame` varchar(30) NOT NULL,
  `beppyou` varchar(10) NOT NULL,
  `subject` varchar(5) NOT NULL,
  `naiyou` varchar(300) NOT NULL,
  `kensaday` date NOT NULL,
  `shokuinbangou1` smallint(4) UNSIGNED NOT NULL,
  `tantou2` varchar(10) NOT NULL,
  `kaishu1` date NOT NULL,
  `kaishu2` date NOT NULL,
  `kaishu3` date NOT NULL,
  `kaishu4` date NOT NULL,
  `renrakuday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_kensa`
--
ALTER TABLE `table_kensa`
  ADD PRIMARY KEY (`id_kensa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_kensa`
--
ALTER TABLE `table_kensa`
  MODIFY `id_kensa` bigint(255) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
