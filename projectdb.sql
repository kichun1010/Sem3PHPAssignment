-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 
-- 伺服器版本： 10.1.40-MariaDB
-- PHP 版本： 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `projectdb`
--

-- --------------------------------------------------------

--
-- 資料表結構 `administrator`
--

CREATE TABLE `administrator` (
  `email` varchar(100) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `administrator`
--

INSERT INTO `administrator` (`email`, `firstName`, `lastName`, `password`) VALUES
('abc@gmail.com', 'Lesley', 'Yiu', 'Test1234'),
('test@gmail.com', 'Panny', 'Wu', 'Test1234');

-- --------------------------------------------------------

--
-- 資料表結構 `dealer`
--

CREATE TABLE `dealer` (
  `dealerID` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phoneNumber` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `dealer`
--

INSERT INTO `dealer` (`dealerID`, `password`, `name`, `phoneNumber`, `address`) VALUES
('123@gmail.com', 'Test1234', 'Amy', '11323323', 'TY'),
('abcd@gmail.com', 'Test1234', 'Ruby', '12345678', 'TKO');

-- --------------------------------------------------------

--
-- 資料表結構 `orderpart`
--

CREATE TABLE `orderpart` (
  `orderID` int(11) NOT NULL,
  `partNumber` int(11) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `orderpart`
--

INSERT INTO `orderpart` (`orderID`, `partNumber`, `quantity`, `price`) VALUES
(9, 1, 150, '60000.00'),
(10, 1, 400, '160000.00'),
(10, 7, 300, '45000.00');

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `dealerID` varchar(50) NOT NULL,
  `orderDate` date NOT NULL,
  `deliveryAddress` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `orders`
--

INSERT INTO `orders` (`orderID`, `dealerID`, `orderDate`, `deliveryAddress`, `status`) VALUES
(9, 'abcd@gmail.com', '2019-07-15', 'SMP', 0),
(10, '123@gmail.com', '2019-07-15', 'TY', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `part`
--

CREATE TABLE `part` (
  `partNumber` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `partName` varchar(100) NOT NULL,
  `stockQuantity` int(11) NOT NULL,
  `stockPrice` decimal(10,2) NOT NULL,
  `stockStatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `part`
--

INSERT INTO `part` (`partNumber`, `email`, `partName`, `stockQuantity`, `stockPrice`, `stockStatus`) VALUES
(1, 'abc@gmail.com', 'AB', 86000, '400.00', 0),
(7, 'abc@gmail.com', 'AASSSA', 59300, '150.00', 0);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`email`);

--
-- 資料表索引 `dealer`
--
ALTER TABLE `dealer`
  ADD PRIMARY KEY (`dealerID`);

--
-- 資料表索引 `orderpart`
--
ALTER TABLE `orderpart`
  ADD KEY `FKOrderPart106296` (`orderID`),
  ADD KEY `FKOrderPart737123` (`partNumber`);

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `FKOrders795865` (`dealerID`);

--
-- 資料表索引 `part`
--
ALTER TABLE `part`
  ADD PRIMARY KEY (`partNumber`),
  ADD UNIQUE KEY `partName` (`partName`),
  ADD KEY `FKPart451022` (`email`);

--
-- 在傾印的資料表使用自動增長(AUTO_INCREMENT)
--

--
-- 使用資料表自動增長(AUTO_INCREMENT) `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `part`
--
ALTER TABLE `part`
  MODIFY `partNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 已傾印資料表的限制(constraint)
--

--
-- 資料表的限制(constraint) `orderpart`
--
ALTER TABLE `orderpart`
  ADD CONSTRAINT `FKOrderPart106296` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`),
  ADD CONSTRAINT `FKOrderPart737123` FOREIGN KEY (`partNumber`) REFERENCES `part` (`partNumber`);

--
-- 資料表的限制(constraint) `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FKOrders795865` FOREIGN KEY (`dealerID`) REFERENCES `dealer` (`dealerID`);

--
-- 資料表的限制(constraint) `part`
--
ALTER TABLE `part`
  ADD CONSTRAINT `FKPart451022` FOREIGN KEY (`email`) REFERENCES `administrator` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
