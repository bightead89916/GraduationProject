-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-11-27 03:47:11
-- 伺服器版本： 10.4.24-MariaDB
-- PHP 版本： 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `graduation_project`
--

-- --------------------------------------------------------

--
-- 資料表結構 `blockchainlogs`
--

CREATE TABLE `blockchainlogs` (
  `id` int(11) NOT NULL,
  `uploadTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `blockHeight` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `blockchainlogs`
--

INSERT INTO `blockchainlogs` (`id`, `uploadTime`, `blockHeight`) VALUES
(0, '2022-11-18 12:40:20', 15996938);

-- --------------------------------------------------------

--
-- 資料表結構 `office`
--

CREATE TABLE `office` (
  `oName` varchar(30) NOT NULL,
  `oId` int(11) NOT NULL,
  `oAddress` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `office`
--

INSERT INTO `office` (`oName`, `oId`, `oAddress`) VALUES
('學務處', 1, '0x5B38Da6a701c568545dCfcB03FcB875f56beddC4'),
('資訊管理系', 2, ''),
('體育室', 3, ''),
('學餐', 4, '');

-- --------------------------------------------------------

--
-- 資料表結構 `prize`
--

CREATE TABLE `prize` (
  `pId` int(11) NOT NULL,
  `pName` varchar(100) NOT NULL,
  `content` varchar(5000) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `price` int(11) NOT NULL DEFAULT 0,
  `updateTime` datetime NOT NULL DEFAULT current_timestamp(),
  `addTime` datetime NOT NULL DEFAULT current_timestamp(),
  `oId` int(11) NOT NULL,
  `wAccount` varchar(20) NOT NULL,
  `expiryDate` datetime NOT NULL DEFAULT current_timestamp(),
  `pictureAddress` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `prize`
--

INSERT INTO `prize` (`pId`, `pName`, `content`, `stock`, `price`, `updateTime`, `addTime`, `oId`, `wAccount`, `expiryDate`, `pictureAddress`) VALUES
(0, '列印成績單費10元折抵券', '可抵免10元手續費，不得連續使用，於學務處兌換', 1000, 100, '2022-11-09 20:00:26', '2022-11-09 20:00:26', 1, 'A123456789', '2023-02-09 20:00:00', 'uploads/1667995226.jpg'),
(1, '健身房10元折價券', '健身房10元折價券，在體育館健身房使用。', 2985, 100, '2022-11-12 17:19:28', '2022-11-12 17:19:28', 3, 'A123456789', '2023-02-16 17:19:00', 'uploads/1668244768.jpg'),
(2, '游泳池門票10元折價券', '游泳池門票10元折價券，在學校泳池使用。', 2998, 100, '2022-11-18 12:43:00', '2022-11-18 12:43:00', 3, 'A123456789', '2023-06-17 12:42:00', 'uploads/1668746580.jpg'),
(3, '學餐10元折價券', '學餐10元折價券，可在校內餐廳使用。', 4993, 100, '2022-11-18 12:47:17', '2022-11-18 12:47:17', 4, 'A123456789', '2023-06-18 12:47:00', 'uploads/1668746837.jpg');

-- --------------------------------------------------------

--
-- 資料表結構 `prizelogs`
--

CREATE TABLE `prizelogs` (
  `id` int(11) NOT NULL,
  `pId` int(11) NOT NULL,
  `sId` varchar(12) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT 0,
  `price` int(11) NOT NULL,
  `point` int(11) NOT NULL,
  `oId` int(11) NOT NULL,
  `transactionTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `prizelogs`
--

INSERT INTO `prizelogs` (`id`, `pId`, `sId`, `amount`, `price`, `point`, `oId`, `transactionTime`) VALUES
(0, 1, 'B10856056', 2, 100, 200, 3, '2022-11-18 11:26:46'),
(1, 2, 'B10856056', 1, 100, 100, 3, '2022-11-18 11:26:52'),
(2, 0, 'B10856056', 3, 100, 300, 1, '2022-11-18 11:26:59'),
(3, 3, 'B10856056', 3, 100, 300, 4, '2022-11-18 11:27:04'),
(4, 3, 'B10856056', 1, 100, 100, 4, '2022-11-18 11:27:11'),
(5, 0, 'B10856056', 1, 100, 100, 1, '2022-11-26 17:37:51'),
(6, 0, 'B10856056', 1, 100, 100, 1, '2022-11-27 03:40:58');

-- --------------------------------------------------------

--
-- 資料表結構 `rewardslogs`
--

CREATE TABLE `rewardslogs` (
  `rId` int(11) NOT NULL,
  `sId` varchar(12) NOT NULL,
  `Commendation` int(11) DEFAULT 0,
  `MinorMerit` int(11) DEFAULT 0,
  `MajorMerit` int(11) DEFAULT 0,
  `Admonition` int(11) DEFAULT 0,
  `MinorDemerit` int(11) DEFAULT 0,
  `MajorDemerit` int(11) DEFAULT 0,
  `updateTime` datetime NOT NULL DEFAULT current_timestamp(),
  `wAccount` varchar(20) NOT NULL,
  `reason` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `rewardslogs`
--

INSERT INTO `rewardslogs` (`rId`, `sId`, `Commendation`, `MinorMerit`, `MajorMerit`, `Admonition`, `MinorDemerit`, `MajorDemerit`, `updateTime`, `wAccount`, `reason`) VALUES
(0, 'B10856056', 1, 0, 0, 0, 0, 0, '2022-10-30 23:56:28', 'A123456789', 'test'),
(1, 'B10856056', 0, 0, 1, 0, 0, 0, '2022-10-30 17:00:08', 'A123456789', '1'),
(2, 'B10856056', 0, 3, 0, 0, 0, 0, '2022-10-30 17:15:58', 'A123456789', '4'),
(3, 'B10856056', 0, 0, 0, 0, 0, 3, '2022-11-12 14:22:31', 'A123456789', ''),
(4, 'B10856056', 0, 0, 3, 0, 0, 0, '2022-11-17 09:30:24', 'A123456789', '太棒了'),
(5, 'B10856056', 0, 0, 3, 0, 0, 0, '2022-11-17 09:31:19', 'A123456789', '太棒了'),
(6, 'B10856056', 1, 0, 0, 0, 0, 0, '2022-11-26 17:39:38', 'A123456789', '用功'),
(7, 'B10856056', 1, 0, 0, 0, 0, 0, '2022-11-26 17:39:54', 'A123456789', '用功'),
(8, 'B10856056', 1, 0, 0, 0, 0, 0, '2022-11-26 17:41:09', 'A123456789', '用功'),
(9, 'B12345678', 0, 0, 1, 0, 0, 0, '2022-11-26 17:44:17', 'A123456789', '太曉明了'),
(10, 'B12345678', 1, 0, 0, 0, 0, 0, '2022-11-26 17:44:35', 'A123456789', ''),
(11, 'B12345678', 1, 0, 0, 0, 0, 0, '2022-11-26 17:44:54', 'A123456789', '');

-- --------------------------------------------------------

--
-- 資料表結構 `student`
--

CREATE TABLE `student` (
  `sId` varchar(12) NOT NULL,
  `sName` varchar(30) NOT NULL,
  `sPassword` varchar(20) NOT NULL DEFAULT '123',
  `IDnumber` varchar(12) NOT NULL,
  `InDay` datetime NOT NULL DEFAULT current_timestamp(),
  `oId` int(11) NOT NULL,
  `Commendation` int(11) NOT NULL DEFAULT 0,
  `MinorMerit` int(11) NOT NULL DEFAULT 0,
  `MajorMerit` int(11) NOT NULL DEFAULT 0,
  `Admonition` int(11) NOT NULL DEFAULT 0,
  `MinorDemerit` int(11) NOT NULL DEFAULT 0,
  `MajorDemerit` int(11) NOT NULL DEFAULT 0,
  `point` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `student`
--

INSERT INTO `student` (`sId`, `sName`, `sPassword`, `IDnumber`, `InDay`, `oId`, `Commendation`, `MinorMerit`, `MajorMerit`, `Admonition`, `MinorDemerit`, `MajorDemerit`, `point`) VALUES
('B10856056', '羅文佑', '1234', 'H123456789', '2022-06-02 00:00:00', 2, 0, 0, 0, 0, 0, 0, 65100),
('B12345678', '王曉明', '123', 'H987654321', '2022-11-17 19:59:46', 2, 0, 0, 0, 0, 0, 0, 66200);

-- --------------------------------------------------------

--
-- 資料表結構 `student_prize`
--

CREATE TABLE `student_prize` (
  `id` int(10) NOT NULL,
  `sId` varchar(12) NOT NULL,
  `pId` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `updateTime` datetime NOT NULL,
  `oId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `student_prize`
--

INSERT INTO `student_prize` (`id`, `sId`, `pId`, `amount`, `updateTime`, `oId`) VALUES
(1, 'B10856056', 1, 5, '2022-11-18 11:26:46', 3),
(2, 'B10856056', 2, 1, '2022-11-18 11:26:52', 3),
(3, 'B10856056', 0, 5, '2022-11-18 11:26:59', 1),
(4, 'B10856056', 3, 4, '2022-11-18 11:27:04', 4);

-- --------------------------------------------------------

--
-- 資料表結構 `uselogs`
--

CREATE TABLE `uselogs` (
  `id` int(11) NOT NULL,
  `transactionTime` datetime NOT NULL,
  `pId` int(11) NOT NULL,
  `sId` varchar(12) NOT NULL,
  `amount` int(11) NOT NULL,
  `oId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `uselogs`
--

INSERT INTO `uselogs` (`id`, `transactionTime`, `pId`, `sId`, `amount`, `oId`) VALUES
(0, '2022-11-26 12:56:26', 1, 'B10856056', 10, 1),
(1, '2022-11-26 12:59:52', 1, 'B10856056', 2, 3),
(2, '2022-11-26 13:06:51', 1, 'B10856056', 1, 3),
(3, '2022-11-26 13:06:58', 1, 'B10856056', 1, 3),
(4, '2022-11-26 17:08:33', 1, 'B10856056', 1, 3),
(5, '2022-11-26 17:09:27', 1, 'B10856056', 1, 3),
(6, '2022-11-26 17:11:29', 1, 'B10856056', 1, 3),
(7, '2022-11-26 17:12:35', 1, 'B10856056', 1, 3),
(8, '2022-11-26 17:38:31', 1, 'B10856056', 3, 3);

-- --------------------------------------------------------

--
-- 資料表結構 `worker`
--

CREATE TABLE `worker` (
  `wName` varchar(30) NOT NULL,
  `wAccount` varchar(20) NOT NULL,
  `wPassword` varchar(20) NOT NULL,
  `inDay` datetime NOT NULL DEFAULT current_timestamp(),
  `oId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `worker`
--

INSERT INTO `worker` (`wName`, `wAccount`, `wPassword`, `inDay`, `oId`) VALUES
('王主任', 'A123456789', '123', '2022-06-02 00:00:00', 1),
('體育主任', 'B123456789', '123', '2022-11-18 20:09:10', 3),
('學餐阿姨', 'C123456789', '123', '2022-11-18 20:09:44', 4),
('資管系主任', 'D123456789', '123', '2022-11-18 20:46:38', 2);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `blockchainlogs`
--
ALTER TABLE `blockchainlogs`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `office`
--
ALTER TABLE `office`
  ADD PRIMARY KEY (`oId`);

--
-- 資料表索引 `prize`
--
ALTER TABLE `prize`
  ADD PRIMARY KEY (`pId`),
  ADD KEY `FKprize_oId` (`oId`),
  ADD KEY `FKprize_wAccount` (`wAccount`);

--
-- 資料表索引 `prizelogs`
--
ALTER TABLE `prizelogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKprizelogs_sId` (`sId`),
  ADD KEY `FKprizelogs_oId` (`oId`),
  ADD KEY `FKrewards_pId` (`pId`);

--
-- 資料表索引 `rewardslogs`
--
ALTER TABLE `rewardslogs`
  ADD PRIMARY KEY (`rId`),
  ADD KEY `FK_rewards_wAccount` (`wAccount`),
  ADD KEY `FK_rewards_sId` (`sId`);

--
-- 資料表索引 `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`sId`),
  ADD KEY `FKstudentOId` (`oId`);

--
-- 資料表索引 `student_prize`
--
ALTER TABLE `student_prize`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_student_prize_sId` (`sId`),
  ADD KEY `FK_student_prize_pId` (`pId`),
  ADD KEY `FK_student_prize_oId` (`oId`);

--
-- 資料表索引 `uselogs`
--
ALTER TABLE `uselogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_uselogs_pId` (`pId`),
  ADD KEY `FK_uselogs_sId` (`sId`),
  ADD KEY `FK_uselogs_oId` (`oId`);

--
-- 資料表索引 `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`wAccount`),
  ADD KEY `FK` (`oId`);

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `prize`
--
ALTER TABLE `prize`
  ADD CONSTRAINT `FKprize_oId` FOREIGN KEY (`oId`) REFERENCES `office` (`oId`),
  ADD CONSTRAINT `FKprize_wAccount` FOREIGN KEY (`wAccount`) REFERENCES `worker` (`wAccount`);

--
-- 資料表的限制式 `prizelogs`
--
ALTER TABLE `prizelogs`
  ADD CONSTRAINT `FK_rewards_pId` FOREIGN KEY (`pId`) REFERENCES `prize` (`pId`),
  ADD CONSTRAINT `FKprizelogs_oId` FOREIGN KEY (`oId`) REFERENCES `office` (`oId`),
  ADD CONSTRAINT `FKprizelogs_sId` FOREIGN KEY (`sId`) REFERENCES `student` (`sId`),
  ADD CONSTRAINT `FKrewards_pId` FOREIGN KEY (`pId`) REFERENCES `prize` (`pId`);

--
-- 資料表的限制式 `rewardslogs`
--
ALTER TABLE `rewardslogs`
  ADD CONSTRAINT `FK_rewards_sId` FOREIGN KEY (`sId`) REFERENCES `student` (`sId`),
  ADD CONSTRAINT `FK_rewards_wAccount` FOREIGN KEY (`wAccount`) REFERENCES `worker` (`wAccount`);

--
-- 資料表的限制式 `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `FKstudentOId` FOREIGN KEY (`oId`) REFERENCES `office` (`oId`);

--
-- 資料表的限制式 `student_prize`
--
ALTER TABLE `student_prize`
  ADD CONSTRAINT `FK_student_prize_oId` FOREIGN KEY (`oId`) REFERENCES `office` (`oId`),
  ADD CONSTRAINT `FK_student_prize_pId` FOREIGN KEY (`pId`) REFERENCES `prize` (`pId`),
  ADD CONSTRAINT `FK_student_prize_sId` FOREIGN KEY (`sId`) REFERENCES `student` (`sId`);

--
-- 資料表的限制式 `uselogs`
--
ALTER TABLE `uselogs`
  ADD CONSTRAINT `FK_uselogs_oId` FOREIGN KEY (`oId`) REFERENCES `office` (`oId`),
  ADD CONSTRAINT `FK_uselogs_pId` FOREIGN KEY (`pId`) REFERENCES `prize` (`pId`),
  ADD CONSTRAINT `FK_uselogs_sId` FOREIGN KEY (`sId`) REFERENCES `student` (`sId`);

--
-- 資料表的限制式 `worker`
--
ALTER TABLE `worker`
  ADD CONSTRAINT `FK` FOREIGN KEY (`oId`) REFERENCES `office` (`oId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
