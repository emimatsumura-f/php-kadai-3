-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2025 年 1 月 05 日 08:09
-- サーバのバージョン： 10.4.28-MariaDB
-- PHP のバージョン: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `php_kadai_3`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `healthcare`
--

CREATE TABLE `healthcare` (
  `id` int(11) NOT NULL,
  `input_date` date NOT NULL,
  `weight` longtext NOT NULL,
  `manual_pee_ratio` decimal(5,1) NOT NULL,
  `total_pee` decimal(5,1) NOT NULL,
  `poop` enum('yes','no') NOT NULL,
  `pee` longtext NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `healthcare`
--

INSERT INTO `healthcare` (`id`, `input_date`, `weight`, `manual_pee_ratio`, `total_pee`, `poop`, `pee`, `created_at`, `updated_at`) VALUES
(1, '2025-01-03', '[\"4.1\",\"4.1\",\"4.1\",\"4.1\"]', 27.6, 113.0, 'yes', '[\"20\",\"35\",\"40\",\"18\"]', NULL, NULL),
(2, '2025-01-03', '[\"4.1\",\"4.1\",\"4.1\",\"4.1\"]', 27.6, 113.0, 'yes', '[\"20\",\"35\",\"40\",\"18\"]', NULL, NULL),
(3, '2025-01-03', '[\"4.1\",\"4.1\",\"4.1\",\"4.1\"]', 27.6, 113.0, 'yes', '[\"20\",\"35\",\"40\",\"18\"]', NULL, NULL),
(5, '2025-01-04', '[\"4.1\",\"4.2\",\"4.1\",\"4.2\"]', 37.0, 95.0, 'yes', '[\"20\",\"40\",\"25\",\"10\"]', NULL, NULL),
(6, '2025-01-05', '\"4.1,4.2,4.1,4.1\"', 38.0, 120.0, 'no', '\"40,30,20,30\"', NULL, '2025-01-05 15:55:38');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `healthcare`
--
ALTER TABLE `healthcare`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `healthcare`
--
ALTER TABLE `healthcare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
