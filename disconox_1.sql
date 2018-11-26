-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 26, 2018 at 04:49 AM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `disconox_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

DROP TABLE IF EXISTS `artist`;
CREATE TABLE IF NOT EXISTS `artist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `specialization` varchar(30) NOT NULL,
  `experience` int(11) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partner_id` varchar(30) NOT NULL,
  `userId` int(5) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` int(16) NOT NULL,
  `comment` tinytext NOT NULL,
  `rating` varchar(5) DEFAULT NULL,
  `category_id` int(5) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `partner_id`, `userId`, `email`, `phone`, `comment`, `rating`, `category_id`, `createdAt`) VALUES
(1, '34', 0, 'raju@gmail.com', 2147483647, 'Its providing Nicer services', NULL, 0, '2018-05-17 08:02:34'),
(2, '34', 0, 'raju@gmail.com', 2147483647, 'Its providing Nicer services', NULL, 0, '2018-05-17 08:02:52'),
(3, '34', 0, 'raju@gmail.com', 2147483647, 'Its providing Nicer services', NULL, 0, '2018-05-17 08:03:06'),
(4, '34', 0, 'raju@gmail.com', 2147483647, 'its providing nice services', NULL, 0, '2018-05-17 08:04:21'),
(5, '34', 0, 'raju@gmail.com', 2147483647, 'its providing nice services', NULL, 0, '2018-05-17 08:11:50'),
(6, '34', 0, 'raju@gmail.com', 2147483647, 'its providing nice services', NULL, 0, '2018-05-17 08:14:41'),
(7, '34', 0, 'raju@gmail.com', 2147483647, 'it', NULL, 0, '2018-05-17 08:54:01'),
(8, '127', 0, 'arnold@gmail.com', 2147483647, 'sample rating\r\n', NULL, 0, '2018-10-01 09:57:45'),
(9, '127', 17, 'mendu.sriram@gmail.com', 904221622, 'it\'s good.', '4', 1, '2018-11-26 03:53:29'),
(10, '127', 17, 'mendu.sriram@gmail.com', 2147483647, 'it\'s good.', '4', 1, '2018-11-26 03:54:21');

-- --------------------------------------------------------

--
-- Table structure for table `partner_profile`
--

DROP TABLE IF EXISTS `partner_profile`;
CREATE TABLE IF NOT EXISTS `partner_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(35) DEFAULT NULL,
  `Title` varchar(35) DEFAULT NULL,
  `Address` text,
  `description` text,
  `partner_pic` varchar(255) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `venue_name` varchar(200) DEFAULT NULL,
  `street_name` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `createdby` int(11) NOT NULL,
  `music_genre` varchar(75) DEFAULT NULL,
  `dress_code` varchar(75) DEFAULT NULL,
  `facilities` varchar(75) DEFAULT NULL,
  `menu` varchar(100) DEFAULT NULL,
  `partner_instructions` varchar(100) DEFAULT NULL COMMENT 'partner specific instructions',
  `avg_cost` int(10) DEFAULT NULL,
  `cuisines` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `partner_profile`
--

INSERT INTO `partner_profile` (`id`, `Name`, `Title`, `Address`, `description`, `partner_pic`, `location`, `venue_name`, `street_name`, `city`, `state`, `createdby`, `music_genre`, `dress_code`, `facilities`, `menu`, `partner_instructions`, `avg_cost`, `cuisines`) VALUES
(18, 'HyLife Brewing Company', '', '800 Jubilee, Road No 36, Jubilee Hills, Hyderabad\r\nMore in 800 Jubilee, Jubilee... (1)', 'All days of the week \r\n11:00 AM - 12:00 PM\r\n', 'assets/uploads/avatar_1526347322.jpg', 'location map', NULL, NULL, NULL, NULL, 1, 'martial music,world music', 'Dress Code', 'Live Sports Screening Valet Parking Available Outdoor Seating', 'assets/uploads/avatar_1526354261803202558774.jpg', NULL, 600, 'noth indian'),
(19, 'Repete Brewery & Kitchen', 'What people love here', 'Plot 644, Road 36, Jubilee Hills, Hyderabad', 'All days of the week\r\n11:00 AM - 12:00 PM\r\n', 'assets/uploads/avatar_1526596892.png', 'location map', NULL, NULL, NULL, NULL, 66, 'martial music,world music', 'Dress Code', 'Live Sports Screening Valet Parking Available Outdoor Seating', NULL, NULL, 0, ''),
(20, 'partnername', 'What people love here', '2nd Floor, 644, Road 36, Jubilee Hills, Hyderabad neerus emporium.', 'Full Bar Available\r\nValet Parking Available\r\nLive Sports Screening\r\nSmoking Area', 'assets/uploads/avatar_1526354261.jpg', 'location map', NULL, NULL, NULL, NULL, 67, 'world music', 'Dress Code', 'Full Bar Available Smoking Area Live Sports Screening', NULL, NULL, NULL, NULL),
(23, 'Turning 21', 'What people love here', 'Plot 18, Sector 2, Hardhick Crown, Opposite Cyber Pearl, Hitech City, Hyderabad', 'All days of the week\r\n11:00 AM - 12:00 PM\r\n', 'assets/uploads/cbdc57a1f7ffc473af0f7a7e93c6e727.png', 'location map', NULL, NULL, NULL, NULL, 71, 'martial music,world music', 'Dress Code', 'Continental, American, Italian, North Indian, Arabian', 'assets/uploads/avatar_1526354261803202558774.jpg', NULL, 800, 'north indian'),
(24, 'OJs Club', 'What people love here', 'Opposite Mind Space, Phase 2, Hitech City, Hyderabad', 'All days of the week\r\n11:00 AM - 12:00 PM\r\n', 'assets/uploads/0c49f173a87388291e363e5012dbce9c.jpg', 'location map', NULL, NULL, NULL, NULL, 72, 'martial music,world music', 'Dress Code', 'Full Bar Available Smoking Area Live Sports Screening', 'assets/uploads/avatar_1526354261803202558774.jpg', NULL, 1000, 'chinese cuisines'),
(25, 'The Big Mataka', 'What people love here', '724/A, Road 37, Jubilee Hills, Hyderabad', 'All days of the week\r\n11:00 AM - 12:00 PM\r\n', 'assets/uploads/a969edf41ea34c85632d248fadd51ab1.jpeg', 'location map', NULL, NULL, NULL, NULL, 73, 'martial music,world music', 'Dress Code', 'Full Bar Available Live Music Outdoor Seating Smoking Area', NULL, NULL, 1200, 'chinese cuisines'),
(26, 'Smokey House', 'What people love here', 'Opposite Raheja Mind Space, Hitech City, Hyderabad', 'All days of the week\r\n11:00 AM - 12:00 PM\r\n', 'assets/uploads/05496600e3548312331da2b6b7b554d7.jpg', 'location map', NULL, NULL, NULL, NULL, 74, 'martial music,world music', 'Dress Code', ' Brunch Private Dining Area Available', NULL, NULL, 1500, 'noth indian chinese'),
(27, 'Spoil', 'What people love here', '8-3-293/82/A/70, 4th Floor, Anshu Colours, Jubilee Hills, Hyderabad', 'All days of the week\r\n11:00 AM - 12:00 PM\r\n', 'assets/uploads/13f028b1f9d3c78887b9b59b4c0b3ec5.jpg', 'location map', NULL, NULL, NULL, NULL, 75, 'martial music,world music', 'Dress Code', 'Full Bar Available Smoking Area Live Sports Screening', 'assets/uploads/avatar_1526354261803202558774.jpg', NULL, 2000, 'chinese cuisines'),
(28, 'Hyderabad', 'What people love here', '3rd Floor, Jyoti Elegance, Kavuri Hills, Road 36 Extension, Madhapur, Hyderabad', 'All days of the week\r\n11:00 AM - 12:00 PM\r\n', 'assets/uploads/5745d513939f866a8379a0b81640554a.jpg', 'location map', NULL, NULL, NULL, NULL, 76, 'martial music,world music', 'Dress Code', 'Wallet Accepted Dance Floor Valet Parking Available', NULL, NULL, NULL, NULL),
(29, '', 'arnold_schwarzengger', '', 'partner cb desc', 'assets/uploads/image_163.jpg', '', NULL, NULL, NULL, NULL, 0, 'music Genre', 'smart black', 'valetparking,ac', 'assets/uploads/image_332.jpg', 'descriptions about  specific partner instructions', 400, 'cuisines'),
(30, '', '', '', '', '', '', 'Hyderabad', 'V Srinivasa Rao Kandula, 8-4-368/14 3rd floor, Hemavathi Nagar, Mothinagar, HYDERABAD, TELANGANA 500', 'HYDERABAD', 'Andhra Pradesh', 89, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, '', '', '', '', '', '', 'Hyderabad', 'V Srinivasa Rao Kandula, 8-4-368/14 3rd floor, Hemavathi Nagar, Mothinagar, HYDERABAD, TELANGANA 500', 'HYDERABAD', 'Andhra Pradesh', 90, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'V Srinivasa-Kandula', 'Testing_title', 'V Srinivasa Rao Kandula, 8-4-368/14 3rd floor, Hemavathi Nagar, Mothinagar, HYDERABAD, TELANGANA 500018, India,HYDERABAD,Andhra Pradesh', 'tESTIN dESC', 'assets/uploads/add193.jpg', 'Testing_VenueLoc', 'Hyderabad', 'V Srinivasa Rao Kandula, 8-4-368/14 3rd floor, Hemavathi Nagar, Mothinagar, HYDERABAD, TELANGANA 500', 'HYDERABAD', 'Andhra Pradesh', 91, 'Testin_Center', 'Testing_dressCode', 'Testing_facilities', 'assets/uploads/E-logo-bg82.png', NULL, 0, 'Testing_cuisines'),
(33, '', '', '', '', '', '', 'Testing Purpose Only', 'V Srinivasa Rao Kandula, 8-4-368/14 3rd floor, Hemavathi Nagar, Mothinagar, HYDERABAD, TELANGANA 500', 'HYDERABAD', 'Andhra Pradesh', 92, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, '', '', '', '', '', '', '', '', '', '', 93, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, '', '', '', '', '', '', '', '', '', '', 94, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, '', '', '', '', '', '', '', '', '', '', 95, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, '', '', '', '', '', '', 'Tester Venue Name', 'Tester Street', 'Tester City', 'Telangana', 95, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 'ronald-R', 'Testing_title Ronald Testing_title ', 'V Srinivasa Rao Kandula,HYDERABAD,Andhra Pradesh', 'Testing Purpose Ronald Description', 'assets/uploads/E-logo88.png', 'Hyderabad', 'V Srinivasa Rao Kandula, 8-4-368/14 3rd floor, Hemavathi Nagar, Mothinagar, HYDERABAD, TELANGANA 500018, India', 'V Srinivasa Rao Kandula', 'HYDERABAD', 'Andhra Pradesh', 96, 'Testin_Center', 'Testing_dressCode', 'Testing_facilities', 'assets/uploads/E-logo-bg30.png', NULL, 1000, 'Testing_cuisines'),
(39, '', '', '', '', '', '', 'V Srinivasa Rao Kandula, 8-4-368/14 3rd floor, Hemavathi Nagar, Mothinagar, HYDERABAD, TELANGANA 500018, India', 'V Srinivasa Rao Kandula', 'HYDERABAD', 'Andhra Pradesh', 98, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, NULL, NULL, NULL, NULL, NULL, 'Ashok Nagar', 'Venue Siva', 'Siva', 'HYDERABAD', 'Telangana', 102, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 103, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 104, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 105, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 106, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 107, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 108, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 109, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 110, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 111, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 112, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 113, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(52, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 114, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(53, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 115, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(54, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 116, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 117, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(56, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 118, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 119, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 120, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59, NULL, NULL, NULL, NULL, NULL, 'Hyderabad', 'test Venue', 'Testing Purpose Only', 'Hyderabad', 'Telangana', 121, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60, NULL, NULL, NULL, NULL, NULL, 'Hyderabad2', 'test Venue', 'Testing Purpose Only', 'Hyderabad', 'Telangana', 122, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(61, NULL, NULL, NULL, NULL, NULL, 'LB NAGAR', 'Testing Venue', 'Testing Street', 'Mothi Nagar', 'Telangana', 123, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(62, 'Venkata-Ravi', 'Venkata_ravi_Title', 'Testing Address', 'Short Description', 'assets/uploads/quinoa_children-153363165833.jpg', 'LB NAGAR', 'Test Name', 'V Srinivasa Rao Kandula, 8-4-368/14 3rd floor, Hemavathi Nagar, Mothinagar, HYDERABAD, TELANGANA 500', 'HYDERABAD', 'Andhra Pradesh', 124, 'Testin_Music_Center', 'Testing_dressCode', 'Testing_facilities', 'assets/uploads/quinoa_elderly-153363119417.jpg', NULL, 0, 'Testing_cuisines'),
(63, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 125, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(64, NULL, NULL, NULL, NULL, NULL, 'Hyderabad', 'Banjarahills', 'Banajara', 'Hyderabad', 'Telangana', 126, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(65, 'tester', 'lounges,clubs', 'hyderabad', 'shor description', 'assets/uploads/0584.jpg', '', 'Banjarahills', 'Banajara', 'Hyderabad', 'Telangana', 127, 'music genre', 'smar black', 'valetparking,ac', 'assets/uploads/0478.jpg', 'partner terms and conditions', 400, 'cuisines'),
(66, NULL, NULL, NULL, NULL, NULL, 'Hyderabad', 'Banjarahills', 'Banajara', 'Hyderabad', 'Telangana', 128, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(67, 'bruce lee-B', 'bruce lee', 'Banajara,Hyderabad,Telangana', 'partner description', 'assets/uploads/image_110.jpg', 'Hyderabad', 'Banjarahills', 'Banajara', 'Hyderabad', 'Telangana', 129, 'Music Genre', 'smart black', 'valetparking,ac', 'assets/uploads/image_351.jpg', NULL, 500, 'Cuisines'),
(68, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 130, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(69, NULL, NULL, NULL, NULL, NULL, 'hyderabad', 'hyderabad', 'srnagar', 'hyderabad', 'Telangana', 131, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(70, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 132, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(71, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 133, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `address` text,
  `highlights` text,
  `location` varchar(50) DEFAULT NULL,
  `closed_date` varchar(20) DEFAULT NULL,
  `tags` text,
  `description` text,
  `booking_days` varchar(10) DEFAULT NULL,
  `artist_info` text,
  `uid` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `end_date_time` varchar(25) DEFAULT NULL,
  `start_date_time` varchar(25) DEFAULT NULL,
  `start_time` varchar(25) DEFAULT NULL,
  `end_time` varchar(25) DEFAULT NULL,
  `offer_days` varchar(255) DEFAULT NULL,
  `today` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_ibfk_1` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `category_id`, `address`, `highlights`, `location`, `closed_date`, `tags`, `description`, `booking_days`, `artist_info`, `uid`, `status`, `created`, `end_date_time`, `start_date_time`, `start_time`, `end_time`, `offer_days`, `today`) VALUES
(77, 'Arnold 1+1 Deal', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 12:34:28', '2018-11-28:10:57 10:14 pm', '2018-11-26:12:08 03:22 am', '03:22 am', '10:14 pm', '0,2', NULL),
(78, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 12:43:08', '2018-11-26 07:40 am', '2018-11-26 02:00 am', '02:00 am', '07:40 am', '0,2', '0'),
(79, 'selvi\'s surprise', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 13:52:26', '2018-11-27 08:00 am', '2018-11-27 04:16 am', '04:16 am', '08:00 am', '0,2', '0'),
(80, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 13:53:54', '2018-11-26 07:40 am', '2018-11-26 02:00 am', '02:00 am', '07:40 am', '0,2', '0'),
(83, 'selvi\'s surprise', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 14:13:06', '2018-11-27 08:00 am', '2018-11-27 04:16 am', '04:16 am', '08:00 am', '0,2', NULL),
(84, 'selvi\'s surprise', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 14:13:54', '2018-11-27 08:00 am', '2018-11-27 04:16 am', '04:16 am', '08:00 am', '0,2', NULL),
(85, '', 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 14:42:37', ' ', ' ', '', '', NULL, NULL),
(86, '', 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 14:44:24', ' ', ' ', '', '', NULL, NULL),
(87, '', 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 14:45:42', ' ', ' ', '', '', NULL, NULL),
(88, '', 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 14:46:04', ' ', ' ', '', '', NULL, NULL),
(89, '', 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 14:48:19', ' ', ' ', '', '', NULL, NULL),
(90, '', 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 14:48:36', ' ', ' ', '', '', NULL, NULL),
(91, '', 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 14:48:51', ' ', ' ', '', '', NULL, NULL),
(92, '', 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 14:49:00', ' ', ' ', '', '', NULL, NULL),
(93, '', 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 14:51:30', ' ', ' ', '', '', NULL, NULL),
(94, '', 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 14:55:47', ' ', ' ', '', '', NULL, NULL),
(95, '', 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 15:01:07', ' ', ' ', '', '', NULL, NULL),
(96, '', 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 15:01:27', ' ', ' ', '', '', NULL, NULL),
(97, '', 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 15:01:53', ' ', ' ', '', '', NULL, NULL),
(98, 'Entry_title', 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 15:02:23', '11/25/2018', '11/25/2018', '12:03 am', '10:54 pm', '1,2', ''),
(99, 'Entry_title', 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 15:02:32', '11/29/2018', '11/26/2018', '12:07 am', '12:02 am', '1,2', ''),
(100, 'new guest list', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 15:09:41', '11/25/2018 10:54 pm', '11/25/2018 12:03 am', '12:03 am', '10:54 pm', NULL, NULL),
(101, 'new guest list', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 15:11:18', '11/25/2018 10:54 pm', '11/25/2018 12:03 am', '12:03 am', '10:54 pm', NULL, NULL),
(102, 'new guest list', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 15:16:29', '11/25/2018 10:54 pm', '11/25/2018 12:03 am', '12:03 am', '10:54 pm', NULL, NULL),
(103, 'new guest list', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 15:16:36', '11/25/2018 10:54 pm', '11/25/2018 12:03 am', '12:03 am', '10:54 pm', NULL, NULL),
(104, 'new guest list', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 15:19:31', '11/25/2018 10:54 pm', '11/25/2018 12:03 am', '12:03 am', '10:54 pm', NULL, NULL),
(105, 'new guest list', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 15:22:32', '11/25/2018 10:54 pm', '11/25/2018 12:03 am', '12:03 am', '10:54 pm', NULL, NULL),
(106, 'new guest list', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 15:22:54', '11/25/2018 10:54 pm', '11/25/2018 12:03 am', '12:03 am', '10:54 pm', NULL, NULL),
(107, 'new guest list', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 15:23:30', '11/25/2018', '11/25/2018', '12:03 am', '10:54 pm', '1,2', ''),
(108, 'new table booking', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 15:30:35', '2018-11-29 10:00 pm', '2018-11-26 01:09 am', '01:09 am', '10:00 pm', '0,2', '0'),
(109, 'new table booking', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 15:30:59', '2018-11-29 10:00 pm', '2018-11-26 01:09 am', '01:09 am', '10:00 pm', '0,2', '0'),
(110, 'new table booking', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 15:32:54', '2018-11-29 10:00 pm', '2018-11-26 01:09 am', '01:09 am', '10:00 pm', '0,2', '0'),
(111, 'new table booking', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 15:35:45', '2018-11-29 10:00 pm', '2018-11-26 01:09 am', '01:09 am', '10:00 pm', '0,2', '0'),
(112, 'new table booking.', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 15:36:36', '11/12/2018 10:54', '11/07/2018 12:07', '12:07', '10:54', 'Array/', ''),
(113, 'new table booking', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 15:39:26', '2018-11-29 10:00', '2018-11-26 01:09', '01:09', '10:00', 'Array/', ''),
(114, 'arnold book a bottle', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 17:26:44', '2018-11-29 10:54 pm', '2018-11-26 12:04 am', '12:04 am', '10:54 pm', '0,2', '0'),
(115, '1+1 Arnold Surprise', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 17:29:20', '2018-11-29 11:59 pm', '2018-11-06 01:09 am', '01:09 am', '11:59 pm', '0,2', '0'),
(116, '1+1 Arnold Surprise', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 17:30:01', '2018-11-29 11:59 pm', '2018-11-06 01:09 am', '01:09 am', '11:59 pm', '0,2', NULL),
(117, '1+1 Arnold Surprise', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-25 17:32:08', '2018-11-29 11:59 pm', '2018-11-06 01:09 am', '01:09 am', '11:59 pm', '0,2', '0'),
(118, 'Narayana R', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-26 02:24:40', '2018-10-23 05:43 am', '2018-11-19 12:04 am', '12:04 am', '05:43 am', '0,2', '0'),
(119, 'Narayana R', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-26 02:25:12', '2018-10-23 05:43 am', '2018-11-19 12:04 am', '12:04 am', '05:43 am', '0,2', '0'),
(120, 'Narayana R', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, 1, '2018-11-26 02:27:24', '2018-10-23 05:43 am', '2018-11-19 12:04 am', '12:04 am', '05:43 am', '0,2', '0');

-- --------------------------------------------------------

--
-- Table structure for table `product_book_a_bottle`
--

DROP TABLE IF EXISTS `product_book_a_bottle`;
CREATE TABLE IF NOT EXISTS `product_book_a_bottle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `actual_price` decimal(10,2) NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_book_a_bottle_ibfk_1` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_book_a_bottle`
--

INSERT INTO `product_book_a_bottle` (`id`, `pid`, `name`, `price`, `actual_price`, `description`) VALUES
(2, 116, 'Bottle Name.', '3000.00', '6000.00', 'dsfsdfsd.'),
(3, 117, 'Bottle Name', '2000.00', '3000.00', 'dsfsdfsd');

-- --------------------------------------------------------

--
-- Table structure for table `product_book_a_table`
--

DROP TABLE IF EXISTS `product_book_a_table`;
CREATE TABLE IF NOT EXISTS `product_book_a_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_book_a_table_ibfk_1` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_book_a_table`
--

INSERT INTO `product_book_a_table` (`id`, `pid`, `price`, `category_id`) VALUES
(13, 112, '1000.00', 2),
(14, 112, '2000.00', 4),
(15, 112, '2000.00', 6),
(16, 112, '2000.00', 11),
(17, 112, '5000.00', 12),
(18, 112, '3000.00', 13),
(19, 112, '3000.00', 14),
(20, 113, '2000.00', 2),
(21, 113, '4000.00', 4),
(22, 113, '6000.00', 6),
(23, 113, '11000.00', 11),
(24, 113, '12000.00', 12),
(25, 113, '13000.00', 13),
(26, 113, '14000.00', 14);

-- --------------------------------------------------------

--
-- Table structure for table `product_book_a_table_categories`
--

DROP TABLE IF EXISTS `product_book_a_table_categories`;
CREATE TABLE IF NOT EXISTS `product_book_a_table_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_book_a_table_categories`
--

INSERT INTO `product_book_a_table_categories` (`id`, `name`, `status`) VALUES
(1, '2SETER', 1),
(2, '4SETER', 1),
(3, '6SETER', 1),
(4, '8SETER', 1),
(5, '10SETER', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
CREATE TABLE IF NOT EXISTS `product_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `images` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `images`, `status`) VALUES
(1, 'Deal&offers', '', 1),
(2, 'surprises', '', 1),
(3, 'guestlist', '', 1),
(4, 'book a table', '', 1),
(5, 'book bottle', '', 1),
(6, 'package', '', 1),
(7, 'entry', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_deals_offers`
--

DROP TABLE IF EXISTS `product_deals_offers`;
CREATE TABLE IF NOT EXISTS `product_deals_offers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` int(11) NOT NULL COMMENT 'deals=1,offers=2',
  `subtitle` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `start_date_time` varchar(40) NOT NULL,
  `end_date_time` varchar(40) NOT NULL,
  `tags` text,
  `about_deal` text NOT NULL,
  `start_time` varchar(40) NOT NULL,
  `end_time` varchar(40) NOT NULL,
  `offer_days` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_deals_offers_ibfk_1` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_deals_offers`
--

INSERT INTO `product_deals_offers` (`id`, `pid`, `name`, `type`, `subtitle`, `price`, `start_date_time`, `end_date_time`, `tags`, `about_deal`, `start_time`, `end_time`, `offer_days`) VALUES
(18, 77, 'Offer Desc', 2, '70%', '1000.00', '2018-11-26:12:08 am', '2018-11-28:10:57 pm', NULL, 'Offer Desc', '12:08 am', '10:57 pm', '0,2'),
(19, 77, 'lead Deal', 1, '70%', '2000.00', '2018-11-27:03:22 am', '2018-11-27:10:14 pm', NULL, 'Deal Desc', '03:22 am', '10:14 pm', '0,2'),
(20, 78, 'HAPPY OFFER', 2, '50%', '2000.00', '2018-11-27:12:05 am', '2018-11-20:10:00 pm', NULL, 'Offer Desc', '12:05 am', '10:00 pm', '0,2'),
(21, 78, 'deal name', 1, '50% off', '1000.00', '2018-11-26:02:00 am', '2018-11-26:07:40 am', NULL, 'Deal description', '02:00 am', '07:40 am', '0,2'),
(24, 78, 'OfferCheck', 2, '50%', '10000.00', '2018-11-28:12:03', '2018-11-28:08:15', NULL, 'Offer desc', '12:03 am', '08:15 am', '0,2');

-- --------------------------------------------------------

--
-- Table structure for table `product_entry`
--

DROP TABLE IF EXISTS `product_entry`;
CREATE TABLE IF NOT EXISTS `product_entry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `event_description` varchar(40) DEFAULT NULL,
  `event_image` varchar(100) NOT NULL,
  `event_date` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_entry_ibfk_1` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_entry`
--

INSERT INTO `product_entry` (`id`, `pid`, `name`, `price`, `description`, `event_description`, `event_image`, `event_date`) VALUES
(12, 98, 'single girl', '2500.00', 'couple ticket Description', 'couple ticket Description', 'assets/uploads/567c10a3a3d1ba051853574afc9808a4.jpg', '2018-11-25 15:06:26'),
(13, 98, 'couple ticket', '3000.00', 'couple ticket Description.', 'couple ticket Description', 'assets/uploads/567c10a3a3d1ba051853574afc9808a4.jpg', '2018-11-25 15:06:26'),
(14, 98, 'stag ticket name', '3500.00', 'single ticket description', 'couple ticket Description', 'assets/uploads/567c10a3a3d1ba051853574afc9808a4.jpg', '2018-11-25 15:06:26'),
(15, 99, 'single girl', '2500.00', 'couple ticket Description', 'couple ticket Description', 'assets/uploads/a6c2c54ab39490208b96aba277481921.jpg', '2018-11-25 15:06:47'),
(16, 99, 'couple ticket', '3000.00', 'couple ticket Description.', 'couple ticket Description', 'assets/uploads/a6c2c54ab39490208b96aba277481921.jpg', '2018-11-25 15:06:47'),
(17, 99, 'stag ticket name', '3500.00', 'single ticket description', 'couple ticket Description', 'assets/uploads/a6c2c54ab39490208b96aba277481921.jpg', '2018-11-25 15:06:47');

-- --------------------------------------------------------

--
-- Table structure for table `product_guest_list`
--

DROP TABLE IF EXISTS `product_guest_list`;
CREATE TABLE IF NOT EXISTS `product_guest_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `event_date_time` varchar(30) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `actual_price` decimal(10,2) NOT NULL,
  `event_id` int(11) NOT NULL,
  `event_description` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_guest_list_ibfk_1` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_guest_list`
--

INSERT INTO `product_guest_list` (`id`, `pid`, `name`, `event_date_time`, `price`, `actual_price`, `event_id`, `event_description`) VALUES
(11, 107, 'single firl', NULL, '10000.00', '4500.00', 98, 'couple ticket Description'),
(12, 107, 'couple', NULL, '2000.00', '4000.00', 98, 'couple ticket Description'),
(13, 107, 'couple.', NULL, '4000.00', '4500.00', 98, 'couple ticket Description');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
CREATE TABLE IF NOT EXISTS `product_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `image` varchar(250) NOT NULL,
  `type` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `pid`, `image`, `type`) VALUES
(1, 124, 'assets/uploads/a0532455084380.jpg', 'jpg'),
(2, 124, 'assets/uploads/a1862611701246.jpg', 'jpg'),
(3, 124, 'assets/uploads/a2303416516166.jpg', 'jpg'),
(4, 127, 'assets/uploads/03-544114311.jpg', 'jpg'),
(5, 127, 'assets/uploads/01-664715366.jpg', 'jpg'),
(6, 127, 'assets/uploads/07-524180619.jpg', 'jpg'),
(7, 127, 'assets/uploads/02-514968501.jpg', 'jpg'),
(8, 127, 'assets/uploads/02-317784777.jpg', 'jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_notification`
--

DROP TABLE IF EXISTS `product_notification`;
CREATE TABLE IF NOT EXISTS `product_notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notification` varchar(300) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_orders`
--

DROP TABLE IF EXISTS `product_orders`;
CREATE TABLE IF NOT EXISTS `product_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_id` varchar(100) DEFAULT NULL,
  `payment_request_id` varchar(100) DEFAULT NULL,
  `pid` int(11) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `uid` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `customer_address` text,
  `status` tinytext,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_packages`
--

DROP TABLE IF EXISTS `product_packages`;
CREATE TABLE IF NOT EXISTS `product_packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `category_id` tinyint(4) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `description` text,
  `tags` text,
  `capacity` int(11) DEFAULT NULL,
  `NoOfItemsSelect` int(10) DEFAULT NULL,
  `ImagePath` varchar(50) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `offer_days` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_packages_ibfk_1` (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_package_categories`
--

DROP TABLE IF EXISTS `product_package_categories`;
CREATE TABLE IF NOT EXISTS `product_package_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_package_categories`
--

INSERT INTO `product_package_categories` (`id`, `name`, `status`) VALUES
(1, 'TITANIUM', 1),
(2, 'PLATINUM', 1),
(3, 'GOLD', 1),
(4, 'SILVER', 1),
(5, 'BRONZE', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

DROP TABLE IF EXISTS `product_reviews`;
CREATE TABLE IF NOT EXISTS `product_reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_reviews_ibfk_1` (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_surprise`
--

DROP TABLE IF EXISTS `product_surprise`;
CREATE TABLE IF NOT EXISTS `product_surprise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `category_id` tinyint(4) NOT NULL,
  `price` varchar(30) NOT NULL,
  `price2` decimal(10,2) DEFAULT NULL,
  `price3` varchar(30) DEFAULT NULL,
  `capture_event` decimal(10,2) DEFAULT NULL,
  `description` text NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_surprise_ibfk_1` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_surprise`
--

INSERT INTO `product_surprise` (`id`, `pid`, `category_id`, `price`, `price2`, `price3`, `capture_event`, `description`, `note`) VALUES
(30, 83, 5, 'Bottle Tag Name', '2700.00', 'NO', '200.00', 'bottle desc', NULL),
(31, 83, 6, 'Custom Sur.', '2600.00', 'NO', '200.00', 'custom desc', NULL),
(32, 83, 7, '1,2', '3001.00', 'special chef+2600', '200.00', 'other desc', NULL),
(33, 84, 5, 'Bottle Tag Name', '2500.00', 'NO', '200.00', 'bottle desc', NULL),
(34, 84, 6, 'Custom Sur.', '2500.00', 'NO', '200.00', 'custom desc', NULL),
(35, 84, 7, '1,2', '3000.00', 'special chef+2500', '200.00', 'other desc', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_surprise_categories`
--

DROP TABLE IF EXISTS `product_surprise_categories`;
CREATE TABLE IF NOT EXISTS `product_surprise_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_surprise_categories`
--

INSERT INTO `product_surprise_categories` (`id`, `name`, `status`) VALUES
(1, 'BOQUET', 1),
(2, 'CAKE', 1),
(3, 'BALOONS', 1),
(4, 'LIVE ARTISTS', 1),
(5, 'BOTTLE OF WINE', 1),
(6, 'CUSTOM SURPRISE', 1),
(7, 'Other', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_terms`
--

DROP TABLE IF EXISTS `product_terms`;
CREATE TABLE IF NOT EXISTS `product_terms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `discription` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_terms_ibfk_1` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_terms`
--

INSERT INTO `product_terms` (`id`, `pid`, `discription`) VALUES
(16, 77, '1+1 Terms and Conditions'),
(17, 77, '.1+1 Terms and Conditions.'),
(18, 78, '1+1 Description.'),
(19, 78, '1+1 Description.'),
(20, 77, '1+1 Terms and Conditions'),
(21, 77, '.1+1 Terms and Conditions'),
(22, 78, '1+1 Description.'),
(23, 79, '2+2 Description'),
(24, 79, '2+2 Description'),
(25, 83, '2+2 Description.'),
(26, 84, '2+2 Description'),
(27, 96, '1+1 entry description.'),
(28, 97, '1+1 entry description.'),
(29, 98, '1+1 entry description.'),
(30, 99, '1+1 entry description.'),
(31, 105, 'guest lsit terms and conditions'),
(32, 106, 'guest lsit terms and conditions'),
(33, 107, 'guest lsit terms and conditions'),
(34, 112, 'table booking description'),
(35, 112, 'table booking description'),
(36, 113, 'table booking description'),
(37, 116, 'bottle booking.'),
(38, 117, 'bottle booking');

-- --------------------------------------------------------

--
-- Table structure for table `product_videos`
--

DROP TABLE IF EXISTS `product_videos`;
CREATE TABLE IF NOT EXISTS `product_videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `url` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_videos`
--

INSERT INTO `product_videos` (`id`, `pid`, `url`) VALUES
(1, 124, 'https://www.youtube.com/watch?v=mIY4IS0Q0sM'),
(2, 124, 'https://www.youtube.com/watch?v=tjtXqFaPRf8'),
(3, 124, 'https://www.youtube.com/watch?v=zPrIex59TSo'),
(4, 127, 'https://www.youtube.com/channel/UCdyMFilM1tVjjhMpQOLyYKQ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text,
  `password` varchar(100) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `status` tinytext,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `password`, `role`, `image`, `status`, `created`) VALUES
(1, 'Amnesia Lounge Bar-', 'partner1@gmail.com', ' 040 33165787', '', '098f6bcd4621d373cade4e832627b4f6', 2, 'assets/uploads/8b575042cae751df94f87cc0834c56b1.jpg', '1', '2018-04-05 01:49:56'),
(17, 'Saikrishna Pothuri', 'mendu.sriram@gmail.com', '9494156214', 'hyderabd,hyderbad,', 'e10adc3949ba59abbe56e057f20f883e', 3, '', '1', '2018-04-05 22:31:41'),
(18, 'Revolt', 'partner2@gmail.com', '8985740230', 'Bapu nagar,Hyderabad,Telangana', 'e10adc3949ba59abbe56e057f20f883e', 2, '', '1', '2018-04-06 01:41:22'),
(19, 'Repete Brewery & Kitchen', 'partner3@gmail.com', '9876543210', '2nd Floor, 644, Road 36, Jubilee Hills,.,Hyderabad ,Telangana', 'e10adc3949ba59abbe56e057f20f883e', 2, '', '1', '2018-04-06 02:41:41'),
(20, 'SKYHY', 'partner4@gmail.com', ' 040 33165787', 'Plot 644, Road 36, Jubilee Hills,Hyderabad,Telangana', 'e10adc3949ba59abbe56e057f20f883e', 2, '', '1', '2018-04-06 03:54:11'),
(21, 'News Cafe', 'partner5@gmail.com', ' 040 33165787', '822, Manjeera Majestic Commericial,, Hitech City Road, Kukatpally, JNTU,,Hyderabad,Andhra Pradesh', 'e10adc3949ba59abbe56e057f20f883e', 2, '', '1', '2018-04-06 03:56:16'),
(22, 'Beer House', 'partner6@gmail.com', ' 040 30676381', '822, Manjeera Majestic Commericial,, Hitech City Road, Kukatpally, JNTU,,Hyderabad,Andhra Pradesh', 'e10adc3949ba59abbe56e057f20f883e', 2, '', '1', '2018-04-06 04:18:11'),
(24, 'Vapour - Brew Pub', 'partner7@gmail.com', '8885155653', '822, Manjeera Majestic Commericial,, Hitech City Road, Kukatpally, JNTU,,Hyderabad,Andhra Pradesh', 'e10adc3949ba59abbe56e057f20f883e', 2, '', '1', '2018-04-06 13:37:31'),
(25, '10 Downing Street', 'partner8@gmail.com', '9951193849', 'Swarnajayanthi Complex, Sanjeeva Reddy Nagar Rd, Srinivasa Nagar, Ameerpet, Hyderabad, Telangana 500038,Hyderabad,--Select--', 'e10adc3949ba59abbe56e057f20f883e', 2, '', '1', '2018-04-06 14:00:38'),
(26, 'Repete Brewery & Kitchen', 'partner9@gmail.com', '9876543', '822, Manjeera Majestic Commericial,, Hitech City Road, Kukatpally, JNTU,,Hyderabad,Andhra Pradesh', 'e10adc3949ba59abbe56e057f20f883e', 2, '', '1', '2018-04-06 14:23:43'),
(29, 'Sunil Gentyala', 'partner10@gmail.com', '8985740230', 'bapunagar,srnagar,bapunagar,Telangana', 'e10adc3949ba59abbe56e057f20f883e', 3, '', '1', '2018-04-08 13:59:16'),
(31, 'Harshitha Kumble', 'test@gmail.com', '', '822, Manjeera Majestic Commericial,, Hitech City Road, Kukatpally, JNTU,,Hyderabad,Andhra Pradesh', '', 3, '', '1', '2018-04-12 20:44:46'),
(32, 'raju', 'raju@gmail.com', '8985740230', '822, Manjeera Majestic Commericial,, Hitech City Road, Kukatpally, JNTU,,Hyderabad,Andhra Pradesh', 'e10adc3949ba59abbe56e057f20f883e', 3, '', '1', '2018-04-13 11:28:14'),
(33, 'raju-r', 'raju1@gmail.com', '987654321', '822, Manjeera Majestic Commericial,, Hitech City Road, Kukatpally, JNTU,,Hyderabad,Andhra Pradesh', 'e10adc3949ba59abbe56e057f20f883e', 2, '', '1', '2018-04-13 17:55:50'),
(34, 'raju-r', 'raju@gmail.com', '9876543219', '822, Manjeera Majestic Commericial,, Hitech City Road, Kukatpally, JNTU,,Hyderabad,Andhra Pradesh', 'e10adc3949ba59abbe56e057f20f883e', 2, 'assets/uploads/edf05c5a1b8899db2f85d1d8b0b95562.jpg', '1', '2018-04-15 09:22:00'),
(35, 'The Big Mataka', 'partner11@gmail.com', '989889899', '724/A, Road 37, Jubilee Hills, Hyderabad', 'e10adc3949ba59abbe56e057f20f883e', 2, '', '1', '2018-04-15 20:40:53'),
(36, 'sriram-mendu', 'sriram08534@gmail.com', '9494156214', 'hyderabad,Hyderabad,', '098f6bcd4621d373cade4e832627b4f6', 3, '', '1', '2018-04-17 11:08:29'),
(37, 'sriram123-mendu123', 'mendu.sriram@gmail.com', '9494156216', ',,Hyderabad', 'fcea920f7412b5da7be0cf42b8c93759', 2, '', '1', '2018-04-17 11:18:05'),
(38, 'narayana', 'medisettipavan@gmail.com', '8885155653', '', 'e10adc3949ba59abbe56e057f20f883e', 3, '', '1', '2018-04-17 20:19:31'),
(39, 'Pavan', 'narayanaphp90@gmail.com', '8885155653', '', 'e10adc3949ba59abbe56e057f20f883e', 3, '', '1', '2018-04-17 20:40:58'),
(40, 'narayana', 'narayanaphp90@gmail.com', '8985740230', '', 'e10adc3949ba59abbe56e057f20f883e', 3, '', '1', '2018-04-17 20:43:55'),
(41, 'narayana', 'narayanaphp90@gmail.com', '8985740230', '', 'e10adc3949ba59abbe56e057f20f883e', 3, '', '1', '2018-04-17 20:49:54'),
(46, 'admin', 'admin@gmail.com', '8985740230', '', 'e10adc3949ba59abbe56e057f20f883e', 1, '', '1', '2018-04-17 21:13:46'),
(47, 'partner-K', 'partner@gmail.com', '8985740230', ',,', 'e10adc3949ba59abbe56e057f20f883e', 2, '', '1', '2018-04-17 21:46:39'),
(48, 'sss', 'narasimha.pargi@gmail.com', '6785673456', '', 'e10adc3949ba59abbe56e057f20f883e', 3, '', '1', '2018-04-18 02:47:52'),
(49, 'demo-demo', 'demo@partner.com', '0123456789', 'hyderbad, Telangana,hyderabad,Telangana', 'e10adc3949ba59abbe56e057f20f883e', 2, '', '1', '2018-04-26 14:07:31'),
(50, 'abcd', 'qrstu@gmail.com', '1234567890', '', 'e10adc3949ba59abbe56e057f20f883e', 3, '', '1', '2018-04-27 05:25:32'),
(51, 'ash', 'a.k.thakur007@gmail.com', '1234567890', '', 'e10adc3949ba59abbe56e057f20f883e', 3, '', '1', '2018-04-27 05:27:08'),
(52, 'navin chandra', 'navin.jula@mail.com', '9989878980', '', 'e10adc3949ba59abbe56e057f20f883e', 3, '', '1', '2018-05-04 06:50:05'),
(53, 'Ashu', 'a.k.thakur007@gmail.com', '8886806364', '', 'e10adc3949ba59abbe56e057f20f883e', 3, '', '1', '2018-05-11 03:08:42'),
(54, 'hylife-.', 'hylife@gmail.com', '7331143106,', '800 Jubilee, Road No 36, Jubilee Hills, Hyderabad,Telangana', 'e10adc3949ba59abbe56e057f20f883e', 2, '', '1', '2018-05-14 04:18:48'),
(55, 'Repete-..', 'Repete@gmail.com', '040 33165787', ',, Jubilee Hills', 'e10adc3949ba59abbe56e057f20f883e', 2, 'assets/uploads/4d593c207fb17c5e1d8b308d1d0e2a09.jpg', '1', '2018-05-14 04:59:02'),
(56, 'revolt-.', 'revolt@gmail.com', '040 33165649', ',, Road 36', 'e10adc3949ba59abbe56e057f20f883e', 2, 'assets/uploads/a673e765e9512ac041e3208dff747588.jpg', '1', '2018-05-14 05:33:02'),
(57, 'turning21-.', 'turning21@gmail.com', '.', ',, Hardhick Crown', 'e10adc3949ba59abbe56e057f20f883e', 2, 'assets/uploads/37ece8b52043b188cf08ca2ec569b4f3.jpg', '1', '2018-05-14 06:02:21'),
(58, 'ojclub-.', 'objsclub@gmail.com', '040 33165117', 'Opposite Mind Space, Phase 2, ,Hitech City, Hyderabad,Telangana', 'e10adc3949ba59abbe56e057f20f883e', 2, '', '1', '2018-05-14 06:15:06'),
(59, 'The Big Mataka-..', 'bigmataka@gmail.com', '.', ',, Jubilee Hills', 'e10adc3949ba59abbe56e057f20f883e', 2, 'assets/uploads/3de1533ace690429f33990b0b26db53d.jpeg', '1', '2018-05-14 06:29:03'),
(60, 'Smokey House-.', 'smookyhouse@gmail.com', '040 33165825', ',,Hitech City', 'e10adc3949ba59abbe56e057f20f883e', 2, 'assets/uploads/4945e3b53ce12827c0b03635adfe9753.jpg', '1', '2018-05-14 06:40:27'),
(61, 'spoil-.', 'spoil@gmail.com', '040 33165292', ',, Anshu Colours', '4266bf8d3dc65bc84fd3badf2edfdbe7', 2, 'assets/uploads/7a4f986826b9e1b5a15fc04b2b0e2c0a.jpg', '1', '2018-05-14 06:57:26'),
(62, 'sounda & spirit-.', 'soundsspirite@gmail.com', '040 33194199', '3rd Floor, Jyoti Elegance, Kavuri Hills, Road 36 Extension, Madhapur, ,Hyderabad,Telangana', 'e10adc3949ba59abbe56e057f20f883e', 2, '', '1', '2018-05-14 07:14:03'),
(63, 'narayana-r', 'narayana@gmail.com', '8985740230', ',,Hyderabad', 'e10adc3949ba59abbe56e057f20f883e', 2, 'assets/uploads/3c5098cfc0741324c845d4fa111737bd.jpg', '1', '2018-05-14 11:53:19'),
(64, 'Hylife-.', 'hylife@gmail.com', '7331143106,', ',, Jubilee Hills', 'e10adc3949ba59abbe56e057f20f883e', 2, 'assets/uploads/60c64cf3ad964ed9c452758910ac5afc.png', '1', '2018-05-14 19:46:35'),
(65, 'Repete Brewery-.', 'repeat@gmail.com', '040 33165787', 'Plot 644, Road 36, Jubilee Hills, ,Hyderabad,Telangana', 'e10adc3949ba59abbe56e057f20f883e', 2, '', '1', '2018-05-14 20:27:39'),
(66, 'Repete Brewery-.', 'repeat@gmail.com', '040 33165787', ',, Jubilee Hills', 'e10adc3949ba59abbe56e057f20f883e', 2, 'assets/uploads/db45afd32aad8cc520ed3c616508d045.png', '1', '2018-05-14 20:59:29'),
(67, 'Revolt-.', 'revolt@gmail.com', '040 33165649', ',, Road 36', 'e10adc3949ba59abbe56e057f20f883e', 2, 'assets/uploads/05d9ba50ebb7f908c31f6bd0fa930b33.jpg', '1', '2018-05-14 21:45:09'),
(68, 'Turning 21-.', 'Turning21@gmail.com', '040 33165128', ',, Hardhick Crown', 'e10adc3949ba59abbe56e057f20f883e', 2, 'assets/uploads/addaefea0b3ecca15b829c7cf43b7e04.jpg', '1', '2018-05-14 21:57:16'),
(69, 'Oj s club-.', 'Ojsclub@gmail.com', '040 33165117', ',, ', 'e10adc3949ba59abbe56e057f20f883e', 2, 'assets/uploads/00318cf9328c57e8116dbfb327402a93.jpg', '1', '2018-05-14 22:53:49'),
(70, 'karan-k', 'karan@gmail.com', '87456321', ',,Telangana', 'e10adc3949ba59abbe56e057f20f883e', 2, 'assets/uploads/9549a7503e165f3d6204d74788b184a4.jpg', '1', '2018-05-15 01:26:38'),
(71, 'Turning 21-.', 'turning21@gmail.com', '040 33165128', ',, Hardhick Crown', 'e10adc3949ba59abbe56e057f20f883e', 2, 'assets/uploads/ceaadbc307261f30def1ce03273b7474.jpg', '1', '2018-05-15 01:34:49'),
(72, 'OJ\'s Club-.', 'Ojsclub@gmail.com', '040 33165117', ',, Hitech City', 'e10adc3949ba59abbe56e057f20f883e', 2, 'assets/uploads/addaefea0b3ecca15b829c7cf43b7e04.jpg', '1', '2018-05-15 02:02:00'),
(73, 'The Big Mataka-.', 'thebigmataka@gmail.com', '9874563210', ',, Jubilee Hills', 'e10adc3949ba59abbe56e057f20f883e', 2, 'assets/uploads/a969edf41ea34c85632d248fadd51ab1.jpeg', '1', '2018-05-15 03:03:50'),
(74, 'Smokey House-.', 'smokyhouse@gmail.com', '040 33165825', ',,Hitech City', 'e10adc3949ba59abbe56e057f20f883e', 2, 'assets/uploads/05496600e3548312331da2b6b7b554d7.jpg', '1', '2018-05-15 03:14:59'),
(75, 'Spoil-.', 'spoil@gmail.com', '040 33165292', ',, Anshu Colours', 'e10adc3949ba59abbe56e057f20f883e', 2, 'assets/uploads/13f028b1f9d3c78887b9b59b4c0b3ec5.jpg', '1', '2018-05-15 03:22:22'),
(76, 'Sounds & Spirits-.', 'soundsspirits@gmail.com', '040 33194199', ',, Kavuri Hills', 'e10adc3949ba59abbe56e057f20f883e', 2, 'assets/uploads/5745d513939f866a8379a0b81640554a.jpg', '1', '2018-05-15 03:32:47'),
(77, 'sai', 'saikamal.wings@gmail.com', '9246522511', '', 'ed2b1f468c5f915f3f1cf75d7068baae', 3, '', '1', '2018-05-17 09:38:05'),
(78, 'narayana-R', 'narayana@gmail.com', '8985740230', 'street name,hyderabad,Telangana', 'e10adc3949ba59abbe56e057f20f883e', 2, '', '1', '2018-05-18 05:48:07'),
(79, 'narayana-R', 'narayana@gmail.com', '8985740230', 'street name,Hyderabad,Telangana', 'e10adc3949ba59abbe56e057f20f883e', 2, '', '1', '2018-05-18 07:34:16'),
(80, 'karan-k', 'karan@gmail.com', '8985740230', 'street,Hyderabad,Telangana', 'e10adc3949ba59abbe56e057f20f883e', 2, '', '1', '2018-05-18 07:36:11'),
(81, 'karan-k', 'karan@gmail.com', '8985740230', 'spnagar,Hyderabad,Telangana', 'e10adc3949ba59abbe56e057f20f883e', 2, '', '1', '2018-05-18 10:13:15'),
(82, 'karan-k', 'karan@gmail.com', '8985740230', ',,Telangana', 'e10adc3949ba59abbe56e057f20f883e', 2, 'assets/uploads/dee27decd655f535ec9a2ee6e6f56340.jpg', '1', '2018-05-25 13:23:07'),
(83, 'karan-k', 'karan@gmail.com', '8985740230', ',,Telangana', 'e10adc3949ba59abbe56e057f20f883e', 2, 'assets/uploads/355ca6da4a4574fd4959e95e343a4841.jpeg', '1', '2018-05-25 19:52:20'),
(84, 'V Srinivasa-Kandula', 'vsraok1983@gmail.com', '9494694658', 'V Srinivasa Rao Kandula, 8-4-368/14 3rd floor, Hemavathi Nagar, Mothinagar, HYDERABAD, TELANGANA 500018, India,HYDERABAD,Andhra Pradesh', '0f463f798bd1681e2682b4a59c4be9f9', 2, '', '1', '2018-08-21 10:31:14'),
(85, 'V Srinivasa-Kandula', 'vsraok1984@gmail.com', '9494694658', 'V Srinivasa Rao Kandula, 8-4-368/14 3rd floor, Hemavathi Nagar, Mothinagar, HYDERABAD, TELANGANA 500018, India,HYDERABAD,Andhra Pradesh', 'ceb6c970658f31504a901b89dcd3e461', 2, '', '1', '2018-08-21 11:26:05'),
(86, 'V Srinivasa-Kandula', 'vsraok1985@gmail.com', '9494694658', 'V Srinivasa Rao Kandula, 8-4-368/14 3rd floor, Hemavathi Nagar, Mothinagar, HYDERABAD, TELANGANA 500018, India,HYDERABAD,Andhra Pradesh', 'ceb6c970658f31504a901b89dcd3e461', 2, '', '1', '2018-08-21 11:28:14'),
(87, 'V Srinivasa-Kandula', 'vsraok1986@gmail.com', '9494694658', 'V Srinivasa Rao Kandula, 8-4-368/14 3rd floor, Hemavathi Nagar, Mothinagar, HYDERABAD, TELANGANA 500018, India,HYDERABAD,Andhra Pradesh', 'ceb6c970658f31504a901b89dcd3e461', 2, '', '1', '2018-08-21 11:30:40'),
(88, 'V Srinivasa-Kandula', 'vsraok1988@gmail.com', '9494694658', 'V Srinivasa Rao Kandula, 8-4-368/14 3rd floor, Hemavathi Nagar, Mothinagar, HYDERABAD, TELANGANA 500018, India,HYDERABAD,Andhra Pradesh', 'ceb6c970658f31504a901b89dcd3e461', 2, '', '1', '2018-08-21 11:33:18'),
(89, 'V Srinivasa-Kandula', 'vsraok1989@gmail.com', '9494694658', 'V Srinivasa Rao Kandula, 8-4-368/14 3rd floor, Hemavathi Nagar, Mothinagar, HYDERABAD, TELANGANA 500018, India,HYDERABAD,Andhra Pradesh', 'ceb6c970658f31504a901b89dcd3e461', 2, '', '1', '2018-08-21 11:47:28'),
(90, 'V Srinivasa-Kandula', 'vsraok1919@gmail.com', '9494694658', 'V Srinivasa Rao Kandula, 8-4-368/14 3rd floor, Hemavathi Nagar, Mothinagar, HYDERABAD, TELANGANA 500018, India,HYDERABAD,Andhra Pradesh', 'ceb6c970658f31504a901b89dcd3e461', 2, '', '1', '2018-08-21 11:50:53'),
(91, 'V Srinivasa-Kandula', 'vsraok1916@gmail.com', '9494694657', 'V Srinivasa Rao Kandula, 8-4-368/14 3rd floor, Hemavathi Nagar, Mothinagar, HYDERABAD, TELANGANA 500018, India,HYDERABAD,Andhra Pradesh', '68a24878cc568766b735c62be5f306ed', 2, 'assets/uploads/a73c74b0806b84deff37e89b61cd45ef.jpg', '1', '2018-08-21 11:54:02'),
(92, 'V Srinivasa-Kandula', 'vsraok1963@gmail.com', '9494694658', 'V Srinivasa Rao Kandula, 8-4-368/14 3rd floor, Hemavathi Nagar, Mothinagar, HYDERABAD, TELANGANA 500018, India,HYDERABAD,Andhra Pradesh', 'ceb6c970658f31504a901b89dcd3e461', 2, 'assets/uploads/f9e304ce197ce4a816821efbe8e36fc7.jpg', '1', '2018-08-23 08:25:57'),
(93, 'ganesh', 'ganesh@gmail.com', '9494694658', '', 'ceb6c970658f31504a901b89dcd3e461', 3, '', '1', '2018-08-23 09:24:42'),
(94, 'venkata', 'venkata@gmail.com', '9494694658', '', '098f6bcd4621d373cade4e832627b4f6', 3, '', '1', '2018-08-23 09:34:43'),
(95, 'hema-Kandula', 'hema@gmail.com', '9494694656', 'V, 8-4-368/14 3rd floor', '098f6bcd4621d373cade4e832627b4f6', 3, 'assets/uploads/db4791a3ea5f06591fe7077e4c349b02.png', '1', '2018-08-23 09:40:28'),
(96, 'tester-tester2', 'tester@gmail.com', '7812345678', 'Tester Street,Tester City,Telangana', '098f6bcd4621d373cade4e832627b4f6', 2, '', '1', '2018-08-24 10:40:27'),
(97, 'ronald-R', 'ronald@gmail.com', '1234567890', 'V Srinivasa Rao Kandula,HYDERABAD,Andhra Pradesh', '098f6bcd4621d373cade4e832627b4f6', 2, 'assets/uploads/527ee8510d485b7cff5f227e3f9ba7ee.jpg', '1', '2018-08-26 06:49:17'),
(98, 'Hema-Kandula', 'hemak@gmail.com', '8889996668', 'V Srinivasa Rao Kandula,HYDERABAD,Andhra Pradesh', '098f6bcd4621d373cade4e832627b4f6', 2, '', '1', '2018-08-26 07:53:04'),
(99, 'prasad-kandula', 'prasad_k@gmail.com', '7386048815', 'V Srinivasa Rao Kandula, 8-4-368/14 3rd floor, Hemavathi Nagar, Mothinagar, HYDERABAD, TELANGANA 500018, India,HYDERABAD,Telangana', '098f6bcd4621d373cade4e832627b4f6', 2, '', '1', '2018-08-27 10:45:08'),
(100, 'prasad-kandula', 'prasadk@gmail.com', '7386048815', 'V Srinivasa Rao Kandula, 8-4-368/14 3rd floor, Hemavathi Nagar, Mothinagar, HYDERABAD, TELANGANA 500018, India,HYDERABAD,Telangana', '098f6bcd4621d373cade4e832627b4f6', 2, '', '1', '2018-08-27 10:48:12'),
(101, 'lalith-testing', 'test1@gmail.com', '7386048815', 'V Srinivasa Rao Kandula, 8-4-368/14 3rd floor, Hemavathi Nagar, Mothinagar, HYDERABAD, TELANGANA 500018, India,HYDERABAD,Telangana', '098f6bcd4621d373cade4e832627b4f6', 2, '', '1', '2018-08-27 11:11:54'),
(102, 'siva-prasad', 'sivap@gmail.com', '89123456', 'Siva,HYDERABAD,Telangana', '098f6bcd4621d373cade4e832627b4f6', 2, '', '1', '2018-08-27 11:14:04'),
(103, 'ganesh', 'ganesh12@gmail.com', '8912345678', '', '16d7a4fca7442dda3ad93c9a726597e4', 3, '', '1', '2018-09-16 02:42:20'),
(104, 'ganesh', 'ganesh13@gmail.com', '7386048816', '', 'cc03e747a6afbbcbf8be7668acfebee5', 3, '', '1', '2018-09-16 02:49:22'),
(105, 'ganesh', 'ganesh14@gmail.com', '7386048818', '', 'cc03e747a6afbbcbf8be7668acfebee5', 3, '', '1', '2018-09-16 02:50:30'),
(106, 'ganesh', 'ganesh123@gmail.com', '7386048819', '', 'cc03e747a6afbbcbf8be7668acfebee5', 3, '', '1', '2018-09-16 02:55:27'),
(107, 'ganesh', 'ganesh45@gmail.com', '7386048812', '', 'cc03e747a6afbbcbf8be7668acfebee5', 3, '', '1', '2018-09-16 03:04:44'),
(108, 'ganesh', 'ganesh8@gmail.com', '7386048811', '', 'cc03e747a6afbbcbf8be7668acfebee5', 3, '', '1', '2018-09-16 03:09:58'),
(109, 'ganesh', 'ganesh9@gmail.com', '7386048811', '', 'cc03e747a6afbbcbf8be7668acfebee5', 3, '', '1', '2018-09-16 03:11:40'),
(110, 'ganesh', 'ganesh5@gmail.com', '7386048811', '', 'cc03e747a6afbbcbf8be7668acfebee5', 3, '', '1', '2018-09-16 03:14:34'),
(111, 'ganesh', 'ganesh4@gmail.com', '7386048818', '', 'cc03e747a6afbbcbf8be7668acfebee5', 3, '', '1', '2018-09-16 03:20:19'),
(112, 'ganesh One', 'ganeshg@gmail.com', '7386048814', '', 'cc03e747a6afbbcbf8be7668acfebee5', 3, '', '1', '2018-09-16 03:26:20'),
(113, 'hema', 'hema123@gmail.com', '7386048815', '', 'cc03e747a6afbbcbf8be7668acfebee5', 3, '', '1', '2018-09-16 04:43:47'),
(114, 'hemaone', 'hemaone@gmail.com', '7386048815', '', 'cc03e747a6afbbcbf8be7668acfebee5', 3, '', '1', '2018-09-16 04:45:31'),
(115, 'ganesh', 'ganesh1211@gmail.com', '8912345678', '', '16d7a4fca7442dda3ad93c9a726597e4', 3, '', '1', '2018-09-16 04:53:49'),
(116, 'ganesh', 'ganesh1212@gmail.com', '8912345678', '', '16d7a4fca7442dda3ad93c9a726597e4', 3, '', '1', '2018-09-16 04:57:04'),
(117, 'NareshBojja', 'naresh34@gmail.com', '121212122', '', '532c28d5412dd75bf975fb951c740a30', 3, '', '1', '2018-09-18 17:46:10'),
(118, 'naresh', 'uoiu@Hj', '12121212', '', 'c20ad4d76fe97759aa27a0c99bff6710', 3, '', '1', '2018-09-19 18:28:22'),
(119, 'iui', 'iu@ui', '9898', '', 'c20ad4d76fe97759aa27a0c99bff6710', 3, '', '1', '2018-09-19 18:32:07'),
(120, 'Naresh', 'bojja1@gmail.com', '122121212', '', '202cb962ac59075b964b07152d234b70', 3, '', '1', '2018-09-19 18:35:53'),
(121, 'testing-tester', 'testing@gmail.com', '7123456789', 'Testing Purpose Only,Hyderabad,Telangana', 'cc03e747a6afbbcbf8be7668acfebee5', 2, '', '1', '2018-09-24 07:32:48'),
(122, 'Yellow-dirtyyellow', 'yellow@gmail.com', '7812345689', 'Testing Purpose Only,Hyderabad,Telangana', 'cc03e747a6afbbcbf8be7668acfebee5', 2, '', '1', '2018-09-24 07:38:48'),
(123, 'hema-kandula', 'he@gmail.com', '7813241234', 'Testing Street,Mothi Nagar,Telangana', 'cc03e747a6afbbcbf8be7668acfebee5', 2, '', '1', '2018-09-24 07:47:28'),
(124, 'Venkata-Ravi', 'venkata_ravi@gmail.com', '7812345690', '', 'cc03e747a6afbbcbf8be7668acfebee5', 2, 'assets/uploads/dcfa66e4667150f703aa502be1877377.png', '1', '2018-09-24 08:20:54'),
(125, 'naresh', 'bojja@gmail.com', '1231212', '', '202cb962ac59075b964b07152d234b70', 3, '', '1', '2018-09-24 17:06:40'),
(126, 'Narayana-R', 'narayanaphp91@gmail.com', '8985740230', 'Banajara,Hyderabad,Telangana', 'e10adc3949ba59abbe56e057f20f883e', 2, '', '1', '2018-09-26 09:23:42'),
(127, 'arnold alois-schwarzenegger', 'arnold@gmail.com', '9999999999', '', '96e79218965eb72c92a549dd5a330112', 2, NULL, '1', '2018-09-26 14:34:36'),
(128, 'arnold-schwarzengger', 'silvster@gmail.com', '9999999999', 'kondapu.,hyderabad', '96e79218965eb72c92a549dd5a330112', 2, 'assets/uploads/e64c712e17344969ed158ee94e39b411.jpg', '1', '2018-09-26 15:10:25'),
(129, 'bruce lee-B', 'brucelee@gmail.com', '9999999999', 'Banajara,Hyderabad,Telangana', '96e79218965eb72c92a549dd5a330112', 2, '', '1', '2018-09-26 15:29:36'),
(130, 'narayana', 'rnarayanaraju4@gmail.com', '8985740230', '', 'e10adc3949ba59abbe56e057f20f883e', 3, '', '1', '2018-10-09 13:09:08'),
(131, 'narayana-r', 'narayana557@gmail.com', '8985740230', 'srnagar,hyderabad,Telangana', 'e10adc3949ba59abbe56e057f20f883e', 2, '', '1', '2018-10-09 13:10:33'),
(132, 'dillip', 'dillip@gmail.com', '9999999999', '', 'e10adc3949ba59abbe56e057f20f883e', 3, '', '1', '2018-10-29 12:44:11'),
(133, 'ganesh', 'imran@gmail.com', '8912345678', '', '16d7a4fca7442dda3ad93c9a726597e4', 3, '', '1', '2018-11-04 03:43:36');

-- --------------------------------------------------------

--
-- Table structure for table `users_roles`
--

DROP TABLE IF EXISTS `users_roles`;
CREATE TABLE IF NOT EXISTS `users_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_roles`
--

INSERT INTO `users_roles` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'partner'),
(3, 'customer'),
(4, 'artist');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_book_a_bottle`
--
ALTER TABLE `product_book_a_bottle`
  ADD CONSTRAINT `product_book_a_bottle_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_book_a_table`
--
ALTER TABLE `product_book_a_table`
  ADD CONSTRAINT `product_book_a_table_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_deals_offers`
--
ALTER TABLE `product_deals_offers`
  ADD CONSTRAINT `product_deals_offers_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_entry`
--
ALTER TABLE `product_entry`
  ADD CONSTRAINT `product_entry_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_guest_list`
--
ALTER TABLE `product_guest_list`
  ADD CONSTRAINT `product_guest_list_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_packages`
--
ALTER TABLE `product_packages`
  ADD CONSTRAINT `product_packages_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_surprise`
--
ALTER TABLE `product_surprise`
  ADD CONSTRAINT `product_surprise_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_terms`
--
ALTER TABLE `product_terms`
  ADD CONSTRAINT `product_terms_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
