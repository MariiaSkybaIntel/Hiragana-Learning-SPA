-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hiragana`
--

-- --------------------------------------------------------

--
-- Table structure for table `characters`
--

CREATE TABLE `characters` (
  `charID` int(11) NOT NULL,
  `charName` varchar(10) NOT NULL,
  `charScore` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `characters`
--

INSERT INTO `characters` (`charID`, `charName`, `charScore`) VALUES
(1, 'a', NULL),
(2, 'i', NULL),
(3, 'u', NULL),
(4, 'e', NULL),
(5, 'o', NULL),
(6, 'ka', NULL),
(7, 'ki', NULL),
(8, 'ku', NULL),
(9, 'ke', NULL),
(10, 'ko', NULL),
(11, 'sa', NULL),
(12, 'shi', NULL),
(13, 'su', NULL),
(14, 'se', NULL),
(15, 'so', NULL),
(16, 'ta', NULL),
(17, 'chi', NULL),
(18, 'tsu', NULL),
(19, 'te', NULL),
(20, 'to', NULL),
(21, 'na', NULL),
(22, 'ni', NULL),
(23, 'nu', NULL),
(24, 'ne', NULL),
(25, 'no', NULL),
(26, 'ha', NULL),
(27, 'hi', NULL),
(28, 'fu', NULL),
(29, 'he', NULL),
(30, 'ho', NULL),
(31, 'ma', NULL),
(32, 'mi', NULL),
(33, 'mu', NULL),
(34, 'me', NULL),
(35, 'mo', NULL),
(36, 'ya', NULL),
(37, 'yu', NULL),
(38, 'yo', NULL),
(39, 'ra', NULL),
(40, 'ri', NULL),
(41, 'ru', NULL),
(42, 're', NULL),
(43, 'ro', NULL),
(44, 'wa', NULL),
(45, 'wo', NULL),
(46, 'n', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `sessionNumber` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `quizName` int(11) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`sessionNumber`, `userID`, `quizName`, `score`) VALUES
(54, 25, 1, 100),
(55, 25, 2, 40),
(56, 25, 3, 100),
(57, 25, 4, 40),
(58, 25, 5, 10),
(59, 23, 1, 90),
(60, 24, 5, 20),
(61, 23, 3, 20),
(62, 23, 4, 40);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `name`, `password`, `email`) VALUES
(23, 'admin', 'a', 'admin@mumail.ie'),
(24, 'user1', 'q', 'user1@mumail.ie'),
(25, 'user2', 'z', 'user2@mumail.ie');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `characters`
--
ALTER TABLE `characters`
  ADD PRIMARY KEY (`charID`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`sessionNumber`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `username` (`name`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `characters`
--
ALTER TABLE `characters`
  MODIFY `charID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `sessionNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
