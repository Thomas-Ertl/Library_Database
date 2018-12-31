-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2018 at 09:48 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `group27db`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` smallint(6) NOT NULL COMMENT 'the book''s id',
  `ISBN` bigint(13) NOT NULL COMMENT 'the book''s isbn',
  `bookName` varchar(100) NOT NULL COMMENT 'the title of the book',
  `bookAuthor` varchar(50) NOT NULL COMMENT 'author of the book',
  `bookEdition` int(2) NOT NULL COMMENT 'edition number of the book'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `ISBN`, `bookName`, `bookAuthor`, `bookEdition`) VALUES
(101, 9780262033848, 'Introduction to Algorithms', 'Thomas H. Cormen', 3),
(102, 9780201558029, 'Concrete Mathematics: A Foundation for Computer Science', 'Ronald L. Graham', 2),
(103, 9780062856524, 'Fascism: A Warning', 'Madeleine Albright', 1),
(104, 9781503951815, 'The Tuscan Child', 'Rhys Bowen', 1),
(105, 9781981681006, 'Final Mission: Zion - The Pale Horse', 'Chuck Driskell', 1),
(106, 9781891830754, '110 Perc', 'Tony Consiglio', 1),
(107, 9781603090308, 'Hey, Mister: Come Hell or Highwater Pants', 'Tom Hart', 1);

-- --------------------------------------------------------

--
-- Table structure for table `issue`
--

CREATE TABLE `issue` (
  `issueID` int(11) NOT NULL COMMENT 'the issue''s id',
  `issueDate` varchar(12) NOT NULL COMMENT 'date book issued',
  `lateDate` varchar(12) NOT NULL COMMENT 'date before considered late',
  `bookID` int(11) NOT NULL COMMENT 'the book''s id',
  `student_id` varchar(12) NOT NULL COMMENT 'id of student who checked it out'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentID` varchar(11) NOT NULL COMMENT 'user''s student id',
  `studentName` varchar(50) NOT NULL COMMENT 'user''s name',
  `gender` char(1) NOT NULL COMMENT 'user''s gender',
  `address` varchar(100) NOT NULL COMMENT 'user''s street address',
  `city` varchar(50) NOT NULL COMMENT 'user''s city',
  `state` char(2) NOT NULL COMMENT 'user''s home state',
  `phone` int(10) NOT NULL COMMENT 'user''s phone #'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `studentName`, `gender`, `address`, `city`, `state`, `phone`) VALUES
('244', 'First Last', 'm', '502 Kentucky Blvd', 'Columbia', 'MO', 1234567890),
('454', 'jon basa', 'm', '502 Kentucky Blvd', 'Columbia', 'MO', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(16) NOT NULL COMMENT 'the username',
  `password` varchar(16) NOT NULL COMMENT 'user''s password',
  `firstname` varchar(16) NOT NULL COMMENT 'user''s first name',
  `lastname` varchar(16) NOT NULL COMMENT 'user''s last name',
  `studentID` varchar(11) NOT NULL COMMENT 'user''s student id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `firstname`, `lastname`, `studentID`) VALUES
('jon', 'basa', 'jon', 'basa', '454'),
('user', 'pass', 'First', 'Last', '244');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `issue`
--
ALTER TABLE `issue`
  ADD PRIMARY KEY (`issueID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
