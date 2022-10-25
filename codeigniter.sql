-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 25, 2022 at 01:58 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codeigniter`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_active` int NOT NULL COMMENT '1:actived \r\n0:not active',
  `gender` int NOT NULL COMMENT '1:male 0:female',
  `day_of_birth` date NOT NULL,
  `job` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_readed_at` timestamp NULL DEFAULT NULL,
  `downloaded` int DEFAULT NULL COMMENT '1:downloaded\r\n0:not download',
  `downloaded_at` timestamp NULL DEFAULT NULL,
  `code` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `mail_active`, `gender`, `day_of_birth`, `job`, `email_readed_at`, `downloaded`, `downloaded_at`, `code`) VALUES
(3, 's', 'chonchon@gmail.comsd', 0, 1, '2022-11-13', 'ty', NULL, 0, NULL, 2069774),
(15, 'df', 'leekimchon01@gmail.comm', 0, 1, '0000-00-00', 'sf', NULL, 0, NULL, 1044255172),
(16, 'sdfs', 'leekimchon01@gmail.comdssds', 0, 1, '0000-00-00', 'sf', NULL, 0, NULL, 1771897890),
(17, 'sfds', 'leekimchon01@gmail.comdssdsdsfsfsdf', 0, 1, '0000-00-00', 'sdf', NULL, 0, NULL, 1391321718),
(18, 'sfds', 'leekimchon01@gmail.comdssdsdsfsfsdfsdf', 0, 1, '0000-00-00', 'sdf', NULL, 0, NULL, 616416948),
(19, 'sdaf', 'sfs@fsd.ffg', 0, 1, '0000-00-00', 'asfd', NULL, 0, NULL, 1938846491),
(20, 'sfg', 'asdf@sgsdfd.sdfdsg', 0, 1, '0000-00-00', 'sdg', NULL, 0, NULL, 838336606),
(22, 'chơn', 'lechonit02@gmail.com', 0, 1, '0000-00-00', 'sd', NULL, 0, NULL, 534839410),
(26, 'sdf', 'dfas@fsdfs.sdf', 0, 1, '0000-00-00', 'sdf', NULL, 0, NULL, 677085637),
(27, 'sdfs', 'sdfas@fsfsdfdsfds.sdfsdf', 0, 1, '0000-00-00', 'sdf', NULL, 0, NULL, 722333510),
(28, 'sdf', 'sdasfs@aweq.safd', 0, 1, '0000-00-00', 'sadf', NULL, 0, NULL, 1734046008),
(29, 'asdfa', 'asf@sdfsd.sdfas', 0, 1, '0000-00-00', 'asd', NULL, 0, NULL, 1321606559),
(30, 'sdf', 'asf@sdfsd.sdfasds', 0, 1, '0000-00-00', 'sdf', NULL, 0, NULL, 1332634013),
(31, 'fdh', 'sadf@fdseryt.jh', 0, 1, '0000-00-00', 'sfd', NULL, 0, NULL, 1262076469),
(32, 'sf', 'dfas@fds.fgh', 0, 1, '0000-00-00', 'asdf', NULL, 0, NULL, 1656616764),
(33, 'r', 'leekimchon01@gmail.dfd', 0, 1, '0000-00-00', 're', NULL, 0, NULL, 945867899),
(35, 'df', 'asfa2f@gd.dsfg', 0, 1, '2022-10-05', 'asf', NULL, 0, NULL, 1472402992),
(36, 'dfg', 'saf@sddf.ghjhgj', 0, 0, '2022-10-24', 'dfh', NULL, 0, NULL, 134883999),
(37, 'ghf', 'sdgf@yjfgj.gh', 0, 1, '2022-10-24', 'dfhg', NULL, 0, NULL, 1239343985),
(38, 'cgon', 'leekimchon01@gmail.com', 1, 0, '2022-10-25', 'df', NULL, 1, '2022-10-25 01:57:34', 901599452);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
