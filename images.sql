-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2019 at 08:07 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `images`
--

-- --------------------------------------------------------

--
-- Table structure for table `boardcomments`
--

CREATE TABLE `boardcomments` (
  `ID` bigint(20) NOT NULL,
  `boardID` bigint(20) NOT NULL,
  `author` bigint(20) NOT NULL,
  `postDate` date NOT NULL,
  `contents` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `boardcomments`
--

INSERT INTO `boardcomments` (`ID`, `boardID`, `author`, `postDate`, `contents`) VALUES
(1, 8, 7, '2019-08-14', 'test'),
(2, 8, 7, '2019-08-14', ':3'),
(5, 8, 2, '2019-08-18', 'Suppies'),
(6, 8, 2, '2019-08-18', 'kok'),
(7, 9, 2, '2019-08-18', 'toast'),
(8, 8, 2, '2019-08-18', '\r\nTop Tutorials\r\nHTML Tutorial\r\nCSS Tutorial\r\nJavaScript Tutorial\r\nHow To Tutorial\r\nSQL Tutorial\r\nPython Tutorial\r\nW3.CSS Tutorial\r\nBootstrap Tutorial\r\nPHP 5 Tutorial\r\nPHP 7 Tutorial\r\njQuery Tutorial\r\nJava Tutorial\r\nTop References\r\nHTML Reference\r\nCSS Reference\r\nJavaScript Reference\r\nSQL Reference\r\nPython Reference\r\nW3.CSS Reference\r\nBootstrap Reference\r\nPHP Reference\r\nHTML Colors\r\njQuery Reference\r\nAngular Reference\r\nJava Reference\r\nTop Examples\r\nHTML Examples\r\nCSS Examples\r\nJavaScript Examples\r\nHow To Examples\r\nSQL Examples\r\nPython Examples\r\nW3.CSS Examples\r\nBootstrap Examples\r\nPHP Examples\r\njQuery Examples\r\nJava Examples\r\nXML Examples\r\nWeb Certificates\r\nHTML Certificate\r\nCSS Certificate\r\nJavaScript Certificate\r\nSQL Certificate\r\nPython Certificate\r\njQuery Certificate\r\nPHP Certificate\r\nBootstrap Certificate\r\nXML Certificate\r\n'),
(9, 8, 2, '2019-08-18', '<script>alert(\"sup\");</script>');

-- --------------------------------------------------------

--
-- Table structure for table `boards`
--

CREATE TABLE `boards` (
  `ID` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `creatorID` bigint(20) NOT NULL,
  `creationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `boards`
--

INSERT INTO `boards` (`ID`, `name`, `creatorID`, `creationDate`) VALUES
(8, 'Foxe Boarde', 7, '2019-08-14'),
(9, 'Testo', 2, '2019-08-18'),
(10, '<script>alert(\"sup\");</script>', 2, '2019-08-18');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `ID` bigint(20) NOT NULL,
  `path` longtext NOT NULL,
  `additionDate` datetime NOT NULL,
  `name` text NOT NULL,
  `userID` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`ID`, `path`, `additionDate`, `name`, `userID`) VALUES
(21, 'images/0e38a08b3703a077b2e782663a3584c26c4b1db3.gif', '2019-08-12 23:54:57', 'English', 7),
(22, 'images/6b0c28f8996a95811f18fa87e8d903301073aef4.png', '2019-08-12 23:55:11', 'Ant', 7),
(23, 'images/028a194812670ca7c91e9cea934c612e3e0a9826.png', '2019-08-12 23:56:53', 'lisa', 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` bigint(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `passwordHash` varchar(32000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `passwordHash`) VALUES
(2, 'TestUser', '$2y$10$BKPplVFDtR65fCmXEcYrGeGOjZyrXQXqgitswILggFjRcMXw0FzQ.'),
(7, 'Foxe', '$2y$10$V4PuUyxIl6/WtVVRLfvGO.tLkKLVGGBwnzG4zT5sKAtN5ytkHaaMK'),
(10, 'Faxe', '$2y$10$L2nr91.8muQH1GJaisov0OzxXvYYYOfQpHEF5KkNn2N8Qwn0UBveW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boardcomments`
--
ALTER TABLE `boardcomments`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `authorConstraint` (`author`),
  ADD KEY `boardConstraint` (`boardID`);

--
-- Indexes for table `boards`
--
ALTER TABLE `boards`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `creatorConstraint` (`creatorID`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userConstraint` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `boardcomments`
--
ALTER TABLE `boardcomments`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `boards`
--
ALTER TABLE `boards`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `boardcomments`
--
ALTER TABLE `boardcomments`
  ADD CONSTRAINT `authorConstraint` FOREIGN KEY (`author`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `boardConstraint` FOREIGN KEY (`boardID`) REFERENCES `boards` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `boards`
--
ALTER TABLE `boards`
  ADD CONSTRAINT `creatorConstraint` FOREIGN KEY (`creatorID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `userConstraint` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
