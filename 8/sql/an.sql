-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016 年 1 朁E21 日 13:34
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
(22, '男性', '30代', 'Rails', '2016-01-14 23:03:26'),
(23, '女性', '10代', 'js', '2016-01-16 14:12:20'),
(24, '男性', '10代', 'みえる化', '2016-01-16 17:49:35'),
(25, '男性', '10代', 'javascript', '2016-01-17 19:01:42'),
(26, '女性', '20代', 'php', '2016-01-17 19:02:23'),
(27, '男性', '30代', 'php', '2016-01-17 19:09:02'),
(28, '女性', '30代', 'java', '2016-01-17 20:02:56'),
(29, '女性', '30代', 'Java', '2016-01-19 21:03:36'),
(30, '女性', '30代', 'ruby', '2016-01-19 21:04:50'),
(31, '女性', '20代', 'php', '2016-01-19 21:23:10'),
(32, '女性', '20代', 'java', '2016-01-19 21:27:06'),
(33, '女性', '20代', 'ruby', '2016-01-19 21:30:52'),
(34, '男性', '40代', 'jQuery', '2016-01-19 21:32:12'),
(35, '女性', '50代', 'java', '2016-01-19 21:36:48'),
(36, '男性', '30代', 'php', '2016-01-19 21:38:49'),
(37, '男性', '10代', 'ruby', '2016-01-19 21:40:03'),
(38, '女性', '20代', 'php', '2016-01-19 22:34:22'),
(39, '男性', '40代', 'java', '2016-01-19 22:46:57'),
(40, '女性', '40代', 'IoT', '2016-01-19 22:53:33'),
(41, '女性', '30代', 'ruby', '2016-01-20 23:34:09'),
(42, '女性', '10代', 'rails', '2016-01-20 23:37:13'),
(43, '男性', '20代', 'php', '2016-01-20 23:39:06'),
(44, '男性', '20代', 'クラウド', '2016-01-21 00:20:03'),
(45, '女性', '20代', 'ruby', '2016-01-21 20:30:25'),
(46, '男性', '10代', 'jQuery', '2016-01-21 20:37:06'),
(47, '男性', '30代', 'jQuery', '2016-01-21 21:11:02'),
(48, '男性', '20代', 'Rails', '2016-01-21 21:27:41'),
(49, '女性', '20代', 'Perl', '2016-01-21 21:31:36');

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
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
