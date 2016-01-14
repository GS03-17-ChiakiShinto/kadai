-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016 年 1 朁E14 日 15:12
-- サーバのバージョン： 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `an`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `an_table`
--

CREATE TABLE `an_table` (
  `id` int(12) NOT NULL,
  `sex` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `age` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `kotoba` text COLLATE utf8_unicode_ci NOT NULL,
  `indate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `an_table`
--

INSERT INTO `an_table` (`id`, `sex`, `age`, `kotoba`, `indate`) VALUES
(1, '女性', '10代', 'php', '2016-01-11 11:20:18'),
(2, '女性', '40代', 'jQuery', '2016-01-11 11:20:51'),
(3, '男性', '30代', 'js', '2016-01-11 11:38:55'),
(4, '女性', '40代', 'ruby', '2016-01-11 11:46:49'),
(5, '女性', '40代', 'ruby', '2016-01-11 11:47:04'),
(6, '女性', '40代', 'ruby', '2016-01-11 11:47:05'),
(7, '女性', '40代', 'ruby', '2016-01-11 11:53:30'),
(8, '女性', '40代', 'ruby', '2016-01-11 11:54:56'),
(9, '女性', '10代', 'perl', '2016-01-11 11:56:39'),
(10, '女性', '10代', 'perl', '2016-01-11 11:57:12'),
(11, '女性', '10代', 'perl', '2016-01-11 11:57:28'),
(12, '女性', '10代', 'perl', '2016-01-11 12:08:04'),
(13, '女性', '30代', 'JavaScript', '2016-01-11 14:35:03'),
(14, '男性', '20代', 'jQuery', '2016-01-11 15:26:03'),
(15, '男性', '10代', 'jQuery', '2016-01-11 15:26:28'),
(16, '男性', '30代', 'jQuery', '2016-01-11 15:26:44'),
(17, '男性', '40代', 'jQuery', '2016-01-11 15:28:06'),
(18, '男性', '10代', 'jQuery', '2016-01-11 15:28:17'),
(19, '男性', '20代', 'jQuery', '2016-01-11 15:28:31'),
(20, '男性', '20代', 'js', '2016-01-11 15:34:23'),
(21, '男性', '10代', 'IoT', '2016-01-14 22:02:32'),
(22, '男性', '30代', 'Rails', '2016-01-14 23:03:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `an_table`
--
ALTER TABLE `an_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `an_table`
--
ALTER TABLE `an_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
