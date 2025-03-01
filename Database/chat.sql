-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2024 at 03:20 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `full_name`, `email`, `password`, `photo`, `status`) VALUES
(1, 'Leo Odaya', 'odayaleo117@gmail.com', '$2y$10$h/DgEqcs.8fd4G02QjWglugrGZL2p4oqf4T51iasLcVaaOc/ovCV2', '', 'Active'),
(2, 'Mark Tahimik Lang', '1@gmail.com', '$2y$10$q7xToZ5HU6L5rcHJzvCDr.yfMxB3mbHDPy8tbXCShH/gvWzSpc8u2', '', 'Offline'),
(3, 'Jaden Smith', '2@gmail.com', '$2y$10$BdjNetRRwL9In4Tlucfvu.mOUDiHtS2.VMVJO4ogOqsd/JRX7YwVS', '', 'Offline'),
(4, 'Ben Ten', '3@gmail.com', '$2y$10$U2KNLtHd7emW84V2E57EnOpnFAQD.PjrCCN0qMxp3KXUYrOlxmD6a', '', 'Offline'),
(5, 'Don Jose', '4@gmail.com', '$2y$10$Tr/I.ymraYmsfNWy4kcJV.w.v8SSb0HUB1aUBRpHAdtVl7DuohKrO', '', 'Offline'),
(6, 'Hans Estrabela', 'estrabelah@gmail.com', '$2y$10$ulplRMX2Wse9D5sTwAaQVelzTYSDh/MrC8XnW4KEmEetyI941TqOq', '', 'Offline'),
(7, 'Kwischan deth', 'detuyachristian@gmail.com', '$2y$10$TgEQaa6096eTMIKE4ZqIOez6PqVP0rA66yp4wtNp1HolUjfW3M.e2', '', 'Offline'),
(8, 'Albert James', 'nurcracker2233@gmail.com', '$2y$10$GLewH3sYJHk6Zs5Z9h2.vexiGSc81brpwLpALhLoEahF2IWih9LWO', '', 'Offline'),
(9, 'Test Test', '6@gmail.com', '$2y$10$uB6qfteXitU.P4rzqEaeu.Fed.fqgkb6wR4iUTUCzfIXckFLiq.n.', '', 'Offline'),
(10, 'Jose Pilato', '5@gmail.com', '$2y$10$jmo6T34ckxw2P5W6N9PcEepGMy5KakKItlC5l71SqpZsCGcCyFXwG', '', 'Offline');

-- --------------------------------------------------------

--
-- Table structure for table `chathistory`
--

CREATE TABLE `chathistory` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` varchar(500) NOT NULL,
  `message_to_id` varchar(100) NOT NULL,
  `send_datetime` datetime NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chathistory`
--

INSERT INTO `chathistory` (`id`, `user_id`, `message`, `message_to_id`, `send_datetime`, `status`) VALUES
(42, 2, 'SRUQ KXE', '1', '2024-02-09 09:58:49', ''),
(43, 2, 'DB VRUUB EDVWRV', '1', '2024-02-09 09:59:08', ''),
(44, 1, 'DEDB EDVWRV NDQJ EDWD ND', '2', '2024-02-09 10:02:13', ''),
(45, 1, 'BRZ', '6', '2024-02-09 10:03:14', ''),
(46, 1, 'DBRV SDQJDODQ PR DK', '6', '2024-02-09 10:03:37', ''),
(47, 6, 'SUH', '1', '2024-02-09 10:03:38', ''),
(48, 6, 'KDKDKDDKDKDKDKD', '1', '2024-02-09 10:03:42', ''),
(49, 1, 'KDKDKDKD', '6', '2024-02-09 10:03:44', ''),
(50, 6, 'ZDOD DNRQJ PDLVLS HK', '1', '2024-02-09 10:03:46', ''),
(51, 6, 'EDNLW EDND FDSLWDO ODKDW', '1', '2024-02-09 10:03:53', ''),
(52, 1, 'PDNLWD WR QL PDDP SDWDB WDBR', '6', '2024-02-09 10:03:57', ''),
(53, 1, 'VD PDB HQFRGLQJ BDQ', '6', '2024-02-09 10:04:14', ''),
(54, 1, 'DBXVLQ NR SD PDPDBD', '6', '2024-02-09 10:04:16', ''),
(55, 6, 'VLJH VLJZ', '1', '2024-02-09 17:06:51', ''),
(56, 6, 'KLQGL BDQ PDNLNLWD QL PDP ZDOD QDPDQJ QDJ FFS VD URRP HK', '1', '2024-02-09 17:07:03', ''),
(60, 1, 'EDG BDQ KXK', '2', '2024-02-09 17:17:01', ''),
(64, 1, 'dvgi', '2', '2024-02-09 17:42:02', ''),
(65, 1, 'Ervvlqj', '2', '2024-02-09 17:42:06', ''),
(66, 1, 'Jrrgv qd', '6', '2024-02-09 17:42:29', ''),
(67, 3, 'Ervv', '1', '2024-02-09 18:27:44', ''),
(68, 1, 'Rk! Ndpxvwd qd?', '3', '2024-02-09 18:27:54', ''),
(69, 3, 'Rn odqj ervv.', '1', '2024-02-09 18:28:17', ''),
(70, 1, 'Brz', '7', '2024-02-09 20:47:34', ''),
(71, 1, 'Ndsdj Juhhq Rqolqh', '7', '2024-02-09 20:48:00', ''),
(72, 7, 'jzhqfkdqd', '1', '2024-02-09 20:49:41', ''),
(73, 7, 'jzhqfkdqdbr', '1', '2024-02-09 20:49:50', ''),
(74, 1, 'jzhqfkdqd', '7', '2024-02-09 20:49:51', ''),
(75, 1, 'odjbdq nr vdqd qj vhqglqj qj slfwxuh wr ndvr ednd gl ndbdqlq kdkdkd', '7', '2024-02-09 20:50:19', ''),
(76, 7, 'nxodqj qj qdph nxqj vlqr qdj vhqg', '1', '2024-02-09 20:50:30', ''),
(77, 7, 'KDKDKDKDKD', '1', '2024-02-09 20:50:36', ''),
(78, 1, 'qdvd wddv kdkdkd', '7', '2024-02-09 20:50:47', ''),
(79, 1, 'vd skrqh nd ed/', '7', '2024-02-09 20:50:50', ''),
(80, 7, 'sp odqj ed wr?', '1', '2024-02-09 20:50:50', ''),
(81, 1, 'rr', '7', '2024-02-09 20:50:57', ''),
(82, 1, 'shur szhgh fkdw urrp', '7', '2024-02-09 20:51:02', ''),
(83, 7, 'zdod sdqj jf?', '1', '2024-02-09 20:51:04', ''),
(84, 1, 'szhgh jdzdq', '7', '2024-02-09 20:51:15', ''),
(85, 1, 'db rr qjd odjbdq nr qjd qdph qd qdnd erog sdud gl qdndndolwr qr', '7', '2024-02-09 20:51:38', ''),
(86, 7, 'rr KDKDKDKD', '1', '2024-02-09 20:52:34', ''),
(87, 1, 'odjbdq nr qjdbxq sdwl jf kdkdkd', '7', '2024-02-09 20:53:18', ''),
(88, 7, 'jhk jhk wdv whvw diwhu', '1', '2024-02-09 20:53:58', ''),
(89, 7, 'sureohpd odqj sdj qdj ededfn dnr qdj hhalw', '1', '2024-02-09 20:54:33', ''),
(90, 1, 'vdq qd sxqwdqj sdjh?', '7', '2024-02-09 20:55:13', ''),
(91, 7, 'qdsxsxqwd vd krph sdjh qj hgjh', '1', '2024-02-09 20:56:39', ''),
(92, 7, 'sdj bxqj edfn qj skrqh jlqdplw nr klqgh bxq qdvd vbvwhp', '1', '2024-02-09 20:57:30', ''),
(93, 1, 'vljh fkhfn nr', '7', '2024-02-09 20:58:33', ''),
(94, 1, 'jrrgv qd', '7', '2024-02-09 21:46:39', ''),
(95, 1, 'Nlwd qdph', '7', '2024-02-09 21:47:02', ''),
(96, 1, 'jzhqfkdqdqdqd', '2', '2024-02-09 22:50:58', ''),
(97, 1, 'Brz', '8', '2024-02-09 23:15:56', ''),
(98, 8, 'Ohbrz ohbrz', '1', '2024-02-09 23:16:47', ''),
(99, 8, 'Ohacjrz', '1', '2024-02-09 23:16:50', ''),
(100, 1, 'fkhfn pr bxqj jf qd wkhvlv jurxs', '8', '2024-02-09 23:17:27', ''),
(101, 1, 'whvw', '9', '2024-02-09 23:56:56', ''),
(102, 10, 'Khb', '1', '2024-02-10 14:14:12', ''),
(103, 10, 'Wklv lv d phvvdjh iurp Khdyhq', '1', '2024-02-10 14:15:53', ''),
(104, 1, 'Wkhq dp L lq Khdyhq qrz?', '10', '2024-02-10 16:02:04', ''),
(105, 1, '', '7', '2024-02-11 18:33:33', ''),
(106, 1, '', '7', '2024-02-11 18:33:34', ''),
(107, 1, '', '7', '2024-02-11 18:33:34', ''),
(108, 1, '', '7', '2024-02-11 18:33:34', ''),
(109, 10, 'Ervv', '1', '2024-02-11 18:38:41', ''),
(110, 2, 'Edg nd', '1', '2024-02-11 18:55:06', '');

-- --------------------------------------------------------

--
-- Table structure for table `friend_list`
--

CREATE TABLE `friend_list` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `friend_list`
--

INSERT INTO `friend_list` (`id`, `user_id`, `friend_id`) VALUES
(1, 1, 8),
(2, 1, 4),
(3, 1, 6),
(4, 1, 7),
(5, 1, 0),
(6, 10, 1),
(7, 10, 8),
(8, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gc`
--

CREATE TABLE `gc` (
  `id` int(11) NOT NULL,
  `gc_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gc`
--

INSERT INTO `gc` (`id`, `gc_name`) VALUES
(1, 'Thesis Group');

-- --------------------------------------------------------

--
-- Table structure for table `gc_chat_history`
--

CREATE TABLE `gc_chat_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `message` varchar(500) NOT NULL,
  `send_datetime` datetime NOT NULL,
  `gc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gc_chat_history`
--

INSERT INTO `gc_chat_history` (`id`, `user_id`, `full_name`, `message`, `send_datetime`, `gc_id`) VALUES
(18, 2, 'Mark Tahimik Lang', 'Brz', '2024-02-09 23:10:27', 1),
(19, 1, 'Leo Odaya', 'Brz pdb JF qd', '2024-02-09 23:10:41', 1),
(20, 9, 'Test Test', 'Whvw Whvw', '2024-02-09 23:15:30', 1),
(21, 1, 'Leo Odaya', 'Glwr', '2024-02-09 23:17:33', 1),
(22, 1, 'Leo Odaya', 'szhgh qdwlq odjdb vd frpode wr kdkdkdkd', '2024-02-09 23:18:41', 1),
(23, 1, 'Leo Odaya', 'qdnd hqfubsw qdpdq bxqj pjd phvvdjh gl pdededvd vd gdwdedvh kdkdkd', '2024-02-09 23:19:28', 1),
(24, 8, 'Albert James', 'Rr suh. Sdqdor wr kdkdkdkd', '2024-02-09 23:43:07', 1),
(25, 8, 'Albert James', 'Lor-orfdo odqj qdwlq', '2024-02-09 23:43:26', 1),
(26, 8, 'Albert James', '', '2024-02-09 23:43:27', 1),
(27, 1, 'Leo Odaya', 'lqvsludwlrqdo wkhph qlwr SKxe KDKDKD', '2024-02-09 23:47:12', 1),
(28, 8, 'Albert James', 'KDKDKDKDKDKD wdpd wdpd! Sdpsdwdolqr brq', '2024-02-09 23:48:04', 1),
(29, 8, 'Albert James', 'SlqrbKxe kdkdkdkd', '2024-02-09 23:48:11', 1),
(30, 1, 'Leo Odaya', 'KDKDKDKD', '2024-02-09 23:48:59', 1),
(33, 1, 'Leo Odaya', 'whvw whvw', '2024-02-11 18:09:40', 1),
(34, 1, 'Leo Odaya', 'dvgidvgi', '2024-02-11 18:33:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_gc`
--

CREATE TABLE `user_gc` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_gc`
--

INSERT INTO `user_gc` (`id`, `user_id`, `gc_id`) VALUES
(1, 1, 1),
(2, 8, 1),
(3, 6, 1),
(4, 7, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chathistory`
--
ALTER TABLE `chathistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friend_list`
--
ALTER TABLE `friend_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gc`
--
ALTER TABLE `gc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gc_chat_history`
--
ALTER TABLE `gc_chat_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_gc`
--
ALTER TABLE `user_gc`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `chathistory`
--
ALTER TABLE `chathistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `friend_list`
--
ALTER TABLE `friend_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `gc`
--
ALTER TABLE `gc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `gc_chat_history`
--
ALTER TABLE `gc_chat_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `user_gc`
--
ALTER TABLE `user_gc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
