-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2020 年 6 月 27 日 15:48
-- サーバのバージョン： 5.5.64-MariaDB
-- PHP のバージョン: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `kensa_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `table_shokuin`
--

CREATE TABLE `table_shokuin` (
  `shokuinid` tinyint(255) UNSIGNED NOT NULL,
  `bangou` tinyint(255) UNSIGNED NOT NULL,
  `shokuin` varchar(10) NOT NULL,
  `shozoku` tinyint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `table_shokuin`
--

INSERT INTO `table_shokuin` (`shokuinid`, `bangou`, `shokuin`, `shozoku`) VALUES
(2, 19, '青木茂生', 3),
(4, 20, 'あああああ', 4);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `table_shokuin`
--
ALTER TABLE `table_shokuin`
  ADD PRIMARY KEY (`shokuinid`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `table_shokuin`
--
ALTER TABLE `table_shokuin`
  MODIFY `shokuinid` tinyint(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
