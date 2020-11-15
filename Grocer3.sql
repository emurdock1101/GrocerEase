-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 16, 2020 at 12:28 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grocerease_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `adds`
--

CREATE TABLE `adds` (
  `itemId` int(11) NOT NULL,
  `shoppingUsername` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `adds`
--

INSERT INTO `adds` (`itemId`, `shoppingUsername`) VALUES
(1101, 'username4'),
(1102, 'sarkaria101'),
(1103, 'brownsNation'),
(1103, 'sundayfootball'),
(1104, 'johnsmith13');

-- --------------------------------------------------------

--
-- Table structure for table `authenticates`
--

CREATE TABLE `authenticates` (
  `userUsername` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `loginUsername` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authenticates`
--

INSERT INTO `authenticates` (`userUsername`, `email`, `loginUsername`) VALUES
('brownsNation', 'browns4life@gmail.com', ''),
('goatbron', 'lebronagoat@yahoo.com', 'goatbron'),
('johnSmith', 'johnsmith@gmail.com', 'johnSmith'),
('jsarkaria99', 'jsarkaria99@gmail.com', 'jsarkaria99'),
('sarkaria101', 'sarkss@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `defines`
--

CREATE TABLE `defines` (
  `username` varchar(30) NOT NULL,
  `itemId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `defines`
--

INSERT INTO `defines` (`username`, `itemId`) VALUES
('brownsNation', 1),
('brownsNation', 3),
('goatbron', 4),
('jamesharden', 1);

-- --------------------------------------------------------

--
-- Table structure for table `home_inventory_list`
--

CREATE TABLE `home_inventory_list` (
  `username` varchar(30) NOT NULL,
  `itemName` varchar(30) NOT NULL,
  `remaining` int(11) NOT NULL,
  `itemId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `home_inventory_list`
--

INSERT INTO `home_inventory_list` (`username`, `itemName`, `remaining`, `itemId`) VALUES
('brownsNation', 'bread', 1, 1),
('brownsNation', 'spaghetti', 4, 2),
('brownsNation', 'chicken soup', 15, 3),
('goatbron', 'apple', 1, 4),
('goatbron', 'mango', 5, 5),
('goatbron', 'eggplant', 3, 6),
('goatbron', 'onions', 1, 7),
('googoo', 'beer', 0, 8),
('googoo', 'banana', 1, 9),
('googoo', 'apple juice', 1, 10),
('googoo', 'milk', 1, 11),
('googoo', 'lettuce', 1, 12),
('googoo', 'apple', 1, 13),
('test1', 'banana', 1, 16),
('test1', 'apple juice', 1, 17),
('test1', 'bread', 1, 18),
('test1', 'oatmeal', 1, 19);

-- --------------------------------------------------------

--
-- Table structure for table `item_list`
--

CREATE TABLE `item_list` (
  `name` varchar(50) NOT NULL,
  `catagory` varchar(30) NOT NULL,
  `itemId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_list`
--

INSERT INTO `item_list` (`name`, `catagory`, `itemId`) VALUES
('banana', 'Fruit', 2),
('apple juice', 'Beverages', 4),
('bread', 'Grains', 5),
('oatmeal', 'Grains', 6),
('spaghetti', 'Grains', 7),
('mango', 'Fruit', 8),
('lettuce', 'Vegetables', 9),
('tomatoes', 'Vegetables', 10),
('eggplant', 'Vegetables', 11),
('onions', 'Vegetables', 12),
('spinach', 'Vegetables', 61),
('salad mix', 'Vegetables', 62),
('beer', 'Beverages', 63);

-- --------------------------------------------------------

--
-- Table structure for table `item_list_category`
--

CREATE TABLE `item_list_category` (
  `itemId` int(11) NOT NULL,
  `category` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_list_category`
--

INSERT INTO `item_list_category` (`itemId`, `category`) VALUES
(1, 'Fruit'),
(2, 'Vegetables'),
(3, 'Beverages'),
(4, 'Household'),
(5, 'Grains'),
(6, 'Dairy'),
(7, 'Other'),
(8, 'Meat');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`, `time`) VALUES
('brownsNation', 'browns4life@gmail.com', '2020-11-11 17:25:59'),
('chrismurdock1', 'masterband', '2020-11-13 12:18:27'),
('emurdock3', 'password3', '2020-11-11 16:15:54'),
('goatbron', 'lebronagoat@yahoo.com', '2020-10-01 08:05:20'),
('googoo', 'random33', '2020-11-15 13:10:54'),
('johnSmith', 'johnsmith@gmail.com', '2020-10-24 20:59:59'),
('jsarkaria99', 'jsarkaria99@gmail.com', '2020-10-11 13:23:44'),
('sarkaria101', 'sarkss@gmail.com', '2020-10-20 17:11:55'),
('sundayfootball', 'nflseason@yahoo.com', '2020-09-17 18:20:52'),
('test1', '$2y$10$bAjMwH9KfgyGuC1egv/GdedxkvPzJFz2dvKXR47zCItQM4SncDHF.', '2020-11-15 18:09:27');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_list`
--

CREATE TABLE `shopping_list` (
  `username` varchar(30) NOT NULL,
  `itemName` varchar(30) NOT NULL,
  `quantity` int(11) NOT NULL,
  `bought` tinyint(1) DEFAULT NULL,
  `itemId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shopping_list`
--

INSERT INTO `shopping_list` (`username`, `itemName`, `quantity`, `bought`, `itemId`) VALUES
('brownsNation', 'milk', 1, 0, 2),
('brownsNation', 'lettuce', 1, 0, 3),
('goatbron', 'apple juice', 1, 0, 5),
('googoo', 'banana', 4, 0, 10),
('googoo', 'apple', 6, 0, 11),
('test1', 'banana', 4, 0, 12),
('test1', 'milk', 1, 0, 14),
('test1', 'lettuce', 1, 0, 15),
('test1', 'bread', 1, 0, 16);

-- --------------------------------------------------------

--
-- Table structure for table `tracks`
--

CREATE TABLE `tracks` (
  `itemId` int(11) NOT NULL,
  `inventoryUsername` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tracks`
--

INSERT INTO `tracks` (`itemId`, `inventoryUsername`) VALUES
(1101, 'jsarkaria99'),
(1102, 'sarkaria101'),
(1103, 'brownsNation'),
(1103, 'sundayfootball'),
(1104, 'johnsmith13');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `phone` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `email`, `password`, `phone`) VALUES
('brownsNation', 'browns4life@gmail.com', 'brownsSeason', '4403297618'),
('goatbron', 'lebronagoat@yahoo.com', 'mypassword', ''),
('johnSmith', 'johnsmith@gmail.com', 'thisisunbreakable', '3301123121'),
('jsarkaria99', 'jsarkaria99@gmail.com', 'password1', '5712681950'),
('sarkaria101', 'sarkss@gmail.com', 'letsgitthis9', '5715892058'),
('sundayfootball', 'nflseason@yahoo.com', 'password', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adds`
--
ALTER TABLE `adds`
  ADD PRIMARY KEY (`itemId`,`shoppingUsername`);

--
-- Indexes for table `authenticates`
--
ALTER TABLE `authenticates`
  ADD PRIMARY KEY (`userUsername`,`email`,`loginUsername`);

--
-- Indexes for table `defines`
--
ALTER TABLE `defines`
  ADD PRIMARY KEY (`username`,`itemId`);

--
-- Indexes for table `home_inventory_list`
--
ALTER TABLE `home_inventory_list`
  ADD PRIMARY KEY (`itemId`);

--
-- Indexes for table `item_list`
--
ALTER TABLE `item_list`
  ADD PRIMARY KEY (`itemId`);

--
-- Indexes for table `item_list_category`
--
ALTER TABLE `item_list_category`
  ADD PRIMARY KEY (`itemId`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `shopping_list`
--
ALTER TABLE `shopping_list`
  ADD PRIMARY KEY (`itemId`);

--
-- Indexes for table `tracks`
--
ALTER TABLE `tracks`
  ADD PRIMARY KEY (`itemId`,`inventoryUsername`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `home_inventory_list`
--
ALTER TABLE `home_inventory_list`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `item_list`
--
ALTER TABLE `item_list`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `shopping_list`
--
ALTER TABLE `shopping_list`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
