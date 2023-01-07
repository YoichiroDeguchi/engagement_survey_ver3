-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2023 年 1 月 07 日 01:42
-- サーバのバージョン： 10.4.27-MariaDB
-- PHP のバージョン: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `engagement_survey`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `answer_table`
--

CREATE TABLE `answer_table` (
  `id` int(30) NOT NULL,
  `year` varchar(128) NOT NULL,
  `gender` varchar(128) NOT NULL,
  `age` varchar(128) NOT NULL,
  `affiliation` varchar(128) NOT NULL,
  `occupation` varchar(128) NOT NULL,
  `length` varchar(128) NOT NULL,
  `q1` int(30) NOT NULL,
  `q2` int(30) NOT NULL,
  `q3` int(30) NOT NULL,
  `q4` int(30) NOT NULL,
  `q5` int(30) NOT NULL,
  `q6` int(30) NOT NULL,
  `q7` int(30) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `answer_table`
--

INSERT INTO `answer_table` (`id`, `year`, `gender`, `age`, `affiliation`, `occupation`, `length`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `created_at`, `updated_at`) VALUES
(1, '2022年10月', '男性', '20代', '的場店', '看護師', '1-2年', 10, 5, 2, 8, 6, 7, 2, '2022-12-31 07:24:33', '2022-12-31 07:24:33'),
(2, '2022年10月', '女性', '30代', '的場店', '看護師', '1-2年', 4, 4, 4, 4, 4, 4, 4, '2022-12-31 14:55:02', '2022-12-31 14:55:02'),
(3, '2022年7月', '男性', '40代', '次郎丸店', 'セラピスト', '3年以上', 10, 9, 9, 10, 10, 8, 8, '2022-12-31 14:57:08', '2022-12-31 14:57:08'),
(4, '2022年10月', '男性', '20代', '的場店', '看護師', '1年未満', 10, 9, 8, 10, 6, 7, 7, '2023-01-01 14:44:20', '2023-01-01 14:44:20'),
(5, '2022年10月', '女性', '30代', '次郎丸店', 'セラピスト', '1-2年', 9, 6, 7, 5, 6, 8, 10, '2023-01-01 14:44:48', '2023-01-01 14:44:48'),
(6, '2022年10月', '女性', '40代', '的場店', '事務', '2-3年', 7, 2, 1, 6, 7, 8, 9, '2023-01-01 14:45:14', '2023-01-01 14:45:14'),
(7, '2022年10月', '男性', '50代', '次郎丸店', '看護師', '3年以上', 10, 1, 2, 9, 3, 6, 6, '2023-01-01 14:45:42', '2023-01-01 14:45:42'),
(8, '2022年4月', '女性', '40代', '次郎丸店', 'セラピスト', '2-3年', 3, 5, 3, 6, 8, 10, 10, '2023-01-01 15:09:52', '2023-01-01 15:09:52'),
(9, '2022年7月', '男性', '50代', '的場店', '看護師', '1年未満', 3, 1, 2, 9, 1, 10, 10, '2023-01-01 15:22:56', '2023-01-01 15:22:56');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `answer_table`
--
ALTER TABLE `answer_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `answer_table`
--
ALTER TABLE `answer_table`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
