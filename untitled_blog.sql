-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2022 at 06:33 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `untitled blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `PostID` int(11) NOT NULL,
  `Title` varchar(40) NOT NULL,
  `Content` varchar(2000) NOT NULL,
  `CreationDate` date NOT NULL,
  `Upvotes` int(11) NOT NULL,
  `Downvotes` int(11) NOT NULL,
  `Author` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`PostID`, `Title`, `Content`, `CreationDate`, `Upvotes`, `Downvotes`, `Author`) VALUES
(3, 'Welcome!', 'Welcome to Techbit! You can rate / create posts by registering an account. Enjoy! :)', '2022-11-23', 1, 0, 'test_user');

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `UserID` varchar(40) NOT NULL,
  `PostID` int(11) NOT NULL,
  `VoteType` int(11) NOT NULL COMMENT '1 = upvote, 0 = downvote'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`UserID`, `PostID`, `VoteType`) VALUES
('test_user', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserName` varchar(40) NOT NULL,
  `EmailAddress` varchar(100) NOT NULL,
  `PhoneNumber` int(11) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserName`, `EmailAddress`, `PhoneNumber`, `Password`, `Role`) VALUES
('test_user', 'test_user@email.com', 12345678, '$1$kit202$VTm19nLrRsMZ7L3i0u6rV/', 'Member');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`PostID`),
  ADD KEY `Author` (`Author`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`UserID`,`PostID`),
  ADD KEY `PostID` (`PostID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `PostID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`Author`) REFERENCES `user` (`UserName`);

--
-- Constraints for table `rates`
--
ALTER TABLE `rates`
  ADD CONSTRAINT `rates_ibfk_1` FOREIGN KEY (`PostID`) REFERENCES `post` (`PostID`),
  ADD CONSTRAINT `rates_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserName`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
