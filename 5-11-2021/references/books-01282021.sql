--#books-01-28-2021.sql

-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: dodson.commongoldeneye.dreamhost.com
-- Generation Time: Jan 28, 2021 at 04:26 PM
-- Server version: 5.7.28-log
-- PHP Version: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `josh_client_protosite`
--


-- --------------------------------------------------------

--
-- Table structure for table `winter2021_Books`
--

DROP TABLE IF EXISTS `winter2021_Books`;
CREATE TABLE `winter2021_Books` (
  `BookID` int(10) UNSIGNED NOT NULL,
  `BookTitle` varchar(120) DEFAULT NULL,
  `Authors` varchar(120) DEFAULT NULL,
  `CategoryID` int(11) DEFAULT '0',
  `ISBN` varchar(30) DEFAULT NULL,
  `Edition` varchar(20) DEFAULT NULL,
  `Description` text,
  `Rating` int(11) DEFAULT NULL,
  `Price` float(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `winter2021_Books`
--

INSERT INTO `winter2021_Books` (`BookID`, `BookTitle`, `Authors`, `CategoryID`, `ISBN`, `Edition`, `Description`, `Rating`, `Price`) VALUES
(1, 'Professional ADO.NET', 'Smith', 1, '568524456', '2nd Edition', 'A great .NET book', 8, 23.50),
(2, 'Apache Server Unleashed', 'Jones', 2, '12345678', '1st Edition', 'A great PHP book', 7, 29.50),
(3, 'ASP.NET Unleashed', 'Doe', 1, '345678976', '1st Edition', 'A great .NET book', 9, 39.95),
(4, 'Introducing .NET', 'Wilson', 1, '67890567', '3rd Edition', 'A great .NET book', 8, 24.45),
(5, 'Professional C#', 'Jones', 1, '568524456', '1st Edition', 'A great .NET book', 6, 38.45),
(6, 'Beginning C++', 'Jackson', 3, '12345678', '1st Edition', 'A great programming book', 10, 41.40),
(7, 'Beginning J++', 'Johnson', 3, '345678976', '1st Edition', 'A great programming book', 8, 44.30),
(8, 'Beginning PHP', 'Smith', 2, '345678976', '2nd Edition', 'A great PHP book', 7, 55.50),
(9, 'Beginning MySQL', 'McDonald', 2, '67890567', '1st Edition', 'A great PHP book', 6, 98.20),
(10, 'Beginning Visual Basic', 'Cox', 3, '12345678', '1st Edition', 'A great .NET book', 8, 58.95),
(11, 'Beginning XHTML', 'Jones', 4, '12345678', '1st Edition', 'A great HTML book', 5, 39.95),
(12, 'Hacking Exposed', 'Evans', 5, '12345678', '2nd Edition', 'A great .NET book', 9, 22.20),
(13, 'Effective Java', 'Franklin', 3, '568524456', '1st Edition', 'A great programming book', 8, 91.20),
(14, 'JavaScript Bible', 'Jones', 4, '12345678', '1st Edition', 'A great HTML book', 6, 33.55),
(15, 'Beginning PHP4 and XML', 'Doe', 2, '12345678', '2nd Edition', 'A great PHP book', 7, 48.50),
(16, 'VBScript Regular Expressions', 'Smith', 3, '12345678', '1st Edition', 'A great programming book', 7, 49.50),
(17, 'Programming ASP', 'Johnson', 6, '67890567', '4th Edition', 'A great ASP book', 8, 49.50),
(18, 'Programming PHP', 'Doe', 2, '345678976', '1st Edition', 'A great PHP book', 9, 49.50),
(19, 'Programming C#', 'Jones', 1, '568524456', '1st Edition', 'A great .NET book', 7, 49.50),
(20, 'Programming Java', 'Smith', 3, '56780765', '5th Edition', 'A great programming book', 6, 49.50),
(21, 'Introducing XML', 'Evans', 4, '12345678', '1st Edition', 'A great HTML book', 8, 33.95);

-- --------------------------------------------------------

--
-- Table structure for table `winter2021_Categories`
--

DROP TABLE IF EXISTS `winter2021_Categories`;
CREATE TABLE `winter2021_Categories` (
  `CategoryID` int(10) UNSIGNED NOT NULL,
  `Category` varchar(120) DEFAULT NULL,
  `Description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `winter2021_Categories`
--

INSERT INTO `winter2021_Categories` (`CategoryID`, `Category`, `Description`) VALUES
(1, 'DotNet', 'Microsoft \'s flagship server technology.'),
(2, 'PHP', 'The world\'s most popular open source technology.'),
(3, 'Programming', 'Books of general programming interest.'),
(4, 'HTML', 'Web page architecture.'),
(5, 'Networking', 'How networks connect us.'),
(6, 'ASP', 'Microsofts classic server technology.');

/* 
Below are potential SQL commands that we could use with our app. 

#Shows all book titles and their categories

SELECT BookTitle, Category FROM winter2021_Books 
INNER JOIN winter2021_Categories 
ON winter2021_Books.CategoryID =winter2021_Categories.CategoryID


#shows title, authors, category, and description for one book 

SELECT BookTitle, Category, AUTHORS, b.Description as `BookDescription` FROM              //`description` renames column only when looking at results
winter2021_Books as b INNER JOIN winter2021_Categories as c ON
b.CategoryID =c.CategoryID
WHERE BookID = 6

#same command, shorter aliasing 
SELECT BookTitle, Category, AUTHORS, b.Description as `BookDescription` FROM              //`description` renames column only when looking at results
winter2021_Books  b INNER JOIN winter2021_Categories  c ON
b.CategoryID =c.CategoryID
WHERE BookID = 6 

#Shows all book titles and their categories, sorted by title

SELECT BookTitle, Category, Authors FROM 
winter2021_Books b INNER JOIN winter2021_Categories ON  c 
b.CategoryID = c.CategoryID
Order by BookTitle asc 


#Shows all books, including books with no category
SELECT BookTitle, Category, Authors From 
winter2021_Books as b LEFT JOIN winter2021_Categories as c ON 
b.CategoryID = c.CategoryID
ORDER BY Category asc

#show number of Books by Category 
Select Category, count(*) as `NumberOfBooks` FROM 
winter2021_Books as b left JOIN winter2021_Categories as c ON 
b.CategoryID = c.CategoryID 
GROUP BY category asc 

*/ 

