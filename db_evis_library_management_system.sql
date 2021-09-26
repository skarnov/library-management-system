-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 02, 2016 at 03:33 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.5.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_evis_library_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(1) NOT NULL,
  `admin_name` varchar(20) NOT NULL,
  `admin_image` varchar(200) NOT NULL,
  `admin_email` varchar(20) NOT NULL,
  `admin_password` varchar(32) NOT NULL,
  `admin_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `admin_level` tinyint(1) NOT NULL,
  `admin_status` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_name`, `admin_image`, `admin_email`, `admin_password`, `admin_date_time`, `admin_level`, `admin_status`) VALUES
(1, 'Admin', 'img/admin_image/arnov_thumb.jpg', 'admin@evis.com', '111111', '2016-05-02 12:58:41', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_allocate`
--

CREATE TABLE `tbl_allocate` (
  `allocate_id` int(2) NOT NULL,
  `reader_id` int(2) NOT NULL,
  `book_id` int(2) NOT NULL,
  `allocate_start_date` varchar(11) NOT NULL,
  `allocate_end_date` varchar(11) NOT NULL,
  `refund_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_allocate`
--

INSERT INTO `tbl_allocate` (`allocate_id`, `reader_id`, `book_id`, `allocate_start_date`, `allocate_end_date`, `refund_status`) VALUES
(1, 1, 5, ' 02-05-2016', ' 03-05-2017', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_author`
--

CREATE TABLE `tbl_author` (
  `author_id` int(2) NOT NULL,
  `author_name` varchar(50) NOT NULL,
  `author_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_author`
--

INSERT INTO `tbl_author` (`author_id`, `author_name`, `author_status`) VALUES
(1, 'Lan Fleming', 1),
(2, 'Humayun Ahmed', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_book`
--

CREATE TABLE `tbl_book` (
  `book_id` int(2) NOT NULL,
  `category_id` int(2) NOT NULL,
  `author_id` int(2) NOT NULL,
  `publisher_id` int(2) NOT NULL,
  `book_name` varchar(50) NOT NULL,
  `book_edition` varchar(4) NOT NULL,
  `book_year` varchar(4) NOT NULL,
  `book_image` varchar(200) NOT NULL,
  `book_country` varchar(20) NOT NULL,
  `book_language` varchar(10) NOT NULL,
  `book_availability` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_book`
--

INSERT INTO `tbl_book` (`book_id`, `category_id`, `author_id`, `publisher_id`, `book_name`, `book_edition`, `book_year`, `book_image`, `book_country`, `book_language`, `book_availability`) VALUES
(1, 1, 1, 1, 'Goldfinger', 'Firs', '1959', 'img/book_image/goldfinger_thumb.jpg', 'United Kingdom', 'English', 1),
(2, 1, 1, 1, 'From Russia, with Love', 'Firs', '1957', 'img/book_image/russia_with_love_thumb.jpg', 'United Kingdom', 'English', 1),
(3, 1, 1, 1, 'Dr. No', 'Firs', '1958', 'img/book_image/Dr_No_thumb.jpg', 'United Kingdom', 'English', 1),
(4, 1, 1, 1, 'Casino Royale', 'Firs', '1953', 'img/book_image/Casino_Royale_thumb.jpg', 'United Kingdom', 'English', 1),
(5, 2, 2, 2, 'Dwitiyo Manob', 'Firs', '2002', 'img/book_image/Dwitiyo_Manob_thumb.png', 'Bangladesh', 'Bengali', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(2) NOT NULL,
  `category_name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `category_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`, `category_status`) VALUES
(1, 'Spy Fiction', 1),
(2, 'Science Fiction', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_publisher`
--

CREATE TABLE `tbl_publisher` (
  `publisher_id` int(2) NOT NULL,
  `publisher_name` varchar(50) NOT NULL,
  `publisher_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_publisher`
--

INSERT INTO `tbl_publisher` (`publisher_id`, `publisher_name`, `publisher_status`) VALUES
(1, 'Jonathan Cape', 1),
(2, 'Annyaprokash', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reader`
--

CREATE TABLE `tbl_reader` (
  `reader_id` int(2) NOT NULL,
  `reader_library_no` varchar(20) NOT NULL,
  `reader_name` varchar(20) NOT NULL,
  `reader_email` varchar(20) NOT NULL,
  `reader_password` varchar(32) NOT NULL,
  `reader_mobile` varchar(11) NOT NULL,
  `reader_address` text NOT NULL,
  `reader_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_reader`
--

INSERT INTO `tbl_reader` (`reader_id`, `reader_library_no`, `reader_name`, `reader_email`, `reader_password`, `reader_mobile`, `reader_address`, `reader_status`) VALUES
(1, '01719020278', 'Modhu', 'arnob@evis.com', '111111', '01611020278', 'Magura, Bangladesh', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_allocate`
--
ALTER TABLE `tbl_allocate`
  ADD PRIMARY KEY (`allocate_id`);

--
-- Indexes for table `tbl_author`
--
ALTER TABLE `tbl_author`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `tbl_book`
--
ALTER TABLE `tbl_book`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_publisher`
--
ALTER TABLE `tbl_publisher`
  ADD PRIMARY KEY (`publisher_id`);

--
-- Indexes for table `tbl_reader`
--
ALTER TABLE `tbl_reader`
  ADD PRIMARY KEY (`reader_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_allocate`
--
ALTER TABLE `tbl_allocate`
  MODIFY `allocate_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_author`
--
ALTER TABLE `tbl_author`
  MODIFY `author_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_book`
--
ALTER TABLE `tbl_book`
  MODIFY `book_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_publisher`
--
ALTER TABLE `tbl_publisher`
  MODIFY `publisher_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_reader`
--
ALTER TABLE `tbl_reader`
  MODIFY `reader_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
